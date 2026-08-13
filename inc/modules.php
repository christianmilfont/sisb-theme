<?php
/**
 * Páginas de módulo: consulta, roteamento e metadados.
 *
 * As páginas /modulos/ e /modulos/<slug>/ são virtuais: não existem como posts
 * no banco. São servidas por rewrite rules a partir do registro em
 * inc/modules-registry.php, o que mantém o conteúdo versionado no Git e
 * dispensa qualquer configuração no painel.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

const SISB_MODULES_BASE = 'modulos';

/* ===================================================================
 * Consulta
 * =================================================================== */

/**
 * Módulos publicados, opcionalmente filtrados por grupo.
 *
 * Módulos com status diferente de 'ready' não têm rota e não são listados —
 * é assim que um módulo sem conteúdo escrito fica fora do ar sem precisar
 * ser removido do registro.
 *
 * @param string|null $group Slug do grupo, ou null para todos.
 * @return array<string,array> Indexado por slug, na ordem do registro.
 */
function sisb_get_modules( $group = null ) {
    $modules = array_filter(
        sisb_modules_registry(),
        static function ( $module ) {
            return isset( $module['status'] ) && 'ready' === $module['status'];
        }
    );

    if ( null === $group ) {
        return $modules;
    }

    return array_filter(
        $modules,
        static function ( $module ) use ( $group ) {
            return isset( $module['group'] ) && $group === $module['group'];
        }
    );
}

/**
 * Um módulo publicado pelo slug.
 *
 * @param string $slug
 * @return array|null Dados do módulo, com 'slug' incluído, ou null se não publicado.
 */
function sisb_get_module( $slug ) {
    $modules = sisb_get_modules();

    if ( ! isset( $modules[ $slug ] ) ) {
        return null;
    }

    return array_merge( array( 'slug' => $slug ), $modules[ $slug ] );
}

/**
 * URL do índice de módulos.
 *
 * @return string
 */
function sisb_modules_url() {
    return home_url( '/' . SISB_MODULES_BASE . '/' );
}

/**
 * URL de um módulo.
 *
 * @param string $slug
 * @return string
 */
function sisb_module_url( $slug ) {
    return home_url( '/' . SISB_MODULES_BASE . '/' . $slug . '/' );
}

/**
 * Grupos que possuem ao menos um módulo publicado.
 *
 * Evita renderizar cabeçalho de grupo vazio enquanto o conteúdo é escrito.
 *
 * @return array<string,array>
 */
function sisb_get_populated_groups() {
    $groups = array();

    foreach ( sisb_module_groups() as $slug => $group ) {
        $modules = sisb_get_modules( $slug );

        if ( ! empty( $modules ) ) {
            $group['modules']  = $modules;
            $groups[ $slug ]   = $group;
        }
    }

    return $groups;
}

/* ===================================================================
 * Roteamento
 * =================================================================== */

/**
 * Query vars usadas pelas páginas virtuais.
 *
 * Ficam registradas para que ?sisb_modulo=<slug> funcione mesmo em
 * instalações com links permanentes simples.
 *
 * @param string[] $vars
 * @return string[]
 */
function sisb_modules_query_vars( $vars ) {
    $vars[] = 'sisb_modulo';
    $vars[] = 'sisb_modulos_index';

    return $vars;
}
add_filter( 'query_vars', 'sisb_modules_query_vars' );

/**
 * Regras de reescrita do índice e das páginas de módulo.
 */
function sisb_modules_rewrite_rules() {
    add_rewrite_rule(
        '^' . SISB_MODULES_BASE . '/?$',
        'index.php?sisb_modulos_index=1',
        'top'
    );

    add_rewrite_rule(
        '^' . SISB_MODULES_BASE . '/([^/]+)/?$',
        'index.php?sisb_modulo=$matches[1]',
        'top'
    );
}
add_action( 'init', 'sisb_modules_rewrite_rules' );

/**
 * Recria as regras quando o tema é ativado ou quando o registro muda.
 *
 * A versão é comparada com a armazenada para que um deploy que adiciona
 * módulos não exija visita manual a Configurações → Links permanentes.
 */
function sisb_modules_maybe_flush_rules() {
    $slugs = array_keys( sisb_modules_registry() );

    if ( function_exists( 'sisb_static_pages' ) ) {
        $slugs = array_merge( $slugs, array_keys( sisb_static_pages() ) );
    }

    $signature = md5( implode( '|', $slugs ) . SISB_VERSION );

    if ( get_option( 'sisb_modules_signature' ) !== $signature ) {
        sisb_modules_rewrite_rules();

        if ( function_exists( 'sisb_pages_rewrite_rules' ) ) {
            sisb_pages_rewrite_rules();
        }

        flush_rewrite_rules();
        update_option( 'sisb_modules_signature', $signature );
    }
}
add_action( 'init', 'sisb_modules_maybe_flush_rules', 20 );
add_action( 'after_switch_theme', 'sisb_modules_maybe_flush_rules' );

/**
 * Limpa a assinatura ao desativar, para que a próxima ativação recrie as regras.
 */
function sisb_modules_on_switch_away() {
    delete_option( 'sisb_modules_signature' );
}
add_action( 'switch_theme', 'sisb_modules_on_switch_away' );

/**
 * O módulo pedido na requisição atual, se houver.
 *
 * @return array|null
 */
function sisb_current_module() {
    $slug = get_query_var( 'sisb_modulo' );

    if ( ! $slug ) {
        return null;
    }

    return sisb_get_module( sanitize_key( $slug ) );
}

/**
 * Estamos no índice de módulos?
 *
 * @return bool
 */
function sisb_is_modules_index() {
    return (bool) get_query_var( 'sisb_modulos_index' );
}

/**
 * Direciona as páginas virtuais para os templates do tema.
 *
 * Slug desconhecido cai no 404 padrão do WordPress — nunca em uma página
 * de módulo vazia.
 *
 * @param string $template
 * @return string
 */
function sisb_modules_template( $template ) {
    if ( sisb_is_modules_index() ) {
        $found = locate_template( 'templates/modulos-index.php' );

        if ( $found ) {
            sisb_force_http_200();
            return $found;
        }
    }

    if ( get_query_var( 'sisb_modulo' ) ) {
        if ( ! sisb_current_module() ) {
            // Slug desconhecido ou módulo ainda não publicado.
            //
            // Sem este ramo o WordPress trataria /modulos/qualquer-coisa/ como
            // a consulta da home e devolveria a landing page inteira com HTTP
            // 200 — conteúdo duplicado em uma URL inexistente.
            return sisb_render_404( $template );
        }

        $found = locate_template( 'templates/modulo-single.php' );

        if ( $found ) {
            sisb_force_http_200();
            return $found;
        }
    }

    return $template;
}
add_filter( 'template_include', 'sisb_modules_template' );

/**
 * Páginas virtuais não têm post correspondente, então o WordPress as trata
 * como 404 por padrão. Aqui o status é corrigido antes do envio dos headers.
 */
function sisb_force_http_200() {
    global $wp_query;

    if ( $wp_query instanceof WP_Query ) {
        $wp_query->is_404 = false;
    }

    status_header( 200 );
}

/**
 * Devolve um 404 de verdade — status, headers e template.
 *
 * @param string $fallback Template a usar se o tema não tiver 404.php.
 * @return string
 */
function sisb_render_404( $fallback ) {
    global $wp_query;

    if ( $wp_query instanceof WP_Query ) {
        $wp_query->set_404();
    }

    status_header( 404 );
    nocache_headers();

    $not_found = get_404_template();

    return $not_found ? $not_found : $fallback;
}

/* ===================================================================
 * Metadados
 * =================================================================== */

/**
 * Título do documento nas páginas virtuais.
 *
 * @param array $parts
 * @return array
 */
function sisb_modules_document_title( $parts ) {
    $module = sisb_current_module();

    if ( $module ) {
        $parts['title'] = $module['title'];
        return $parts;
    }

    if ( sisb_is_modules_index() ) {
        $parts['title'] = __( 'Módulos', 'sisb' );
    }

    return $parts;
}
add_filter( 'document_title_parts', 'sisb_modules_document_title' );

/**
 * Descrição, canonical e Open Graph de todas as páginas do tema.
 *
 * Centralizado aqui para que exista exatamente uma fonte de meta tags —
 * antes a home tinha valores fixos em header.php e as páginas de módulo
 * acrescentavam os seus, produzindo tags duplicadas.
 *
 * O tema não depende de plugin de SEO para isso.
 */
function sisb_head_meta() {
    $module = sisb_current_module();

    $static = function_exists( 'sisb_current_static_page' ) ? sisb_current_static_page() : null;

    if ( $module ) {
        $title       = $module['title'];
        $description = $module['summary'];
        $canonical   = sisb_module_url( $module['slug'] );
    } elseif ( $static ) {
        $title       = $static['title'];
        $description = $static['summary'];
        $canonical   = sisb_static_page_url( $static['slug'] );
    } elseif ( sisb_is_modules_index() ) {
        $title       = __( 'Módulos', 'sisb' );
        $description = __( 'Os módulos do SISB, organizados por coleta em campo, gestão e conformidade, e plataforma.', 'sisb' );
        $canonical   = sisb_modules_url();
    } elseif ( is_404() ) {
        // Sem canonical: a URL não representa nenhum recurso.
        printf( '<meta name="robots" content="noindex,follow">' . "\n" );
        return;
    } else {
        $title       = get_bloginfo( 'name' ) . ' — ' . __( 'Sistema Integrado de Fiscalização de Barragens', 'sisb' );
        $description = __( 'Plataforma para gestão, inspeção e fiscalização digital de barragens. Coleta em campo offline, avaliação de risco, planos de segurança e prestação de contas em um só lugar.', 'sisb' );
        $canonical   = home_url( '/' );
    }

    printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
    printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonical ) );
    printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
    printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
    printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
    printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $canonical ) );
    echo '<meta property="og:type" content="website">' . "\n";

    // summary_large_image sem imagem renderiza como card simples de qualquer
    // forma. A imagem de compartilhamento entra em etapa própria.
    echo '<meta name="twitter:card" content="summary">' . "\n";
}
add_action( 'wp_head', 'sisb_head_meta', 1 );

/* ===================================================================
 * Auxiliares de renderização
 * =================================================================== */

/**
 * Renderiza um partial de módulo passando os dados adiante.
 *
 * @param string $part   Nome do arquivo em template-parts/module/, sem extensão.
 * @param array  $module Dados do módulo.
 */
function sisb_module_part( $part, $module ) {
    $file = locate_template( 'template-parts/module/' . $part . '.php' );

    if ( ! $file ) {
        return;
    }

    // Disponível como $module dentro do partial incluído.
    include $file;
}

/**
 * Âncora de seção da home, resolvida conforme a página atual.
 *
 * Na home devolve a âncora pura, preservando o scroll suave. Em qualquer
 * página interna devolve a URL absoluta, para que o link continue funcionando.
 *
 * As páginas virtuais são servidas pela query da home, então is_front_page()
 * sozinho não basta como teste.
 *
 * @param string $anchor Ex.: '#contato'.
 * @return string
 */
function sisb_anchor( $anchor ) {
    $on_virtual_page = sisb_current_module()
        || sisb_is_modules_index()
        || ( function_exists( 'sisb_current_static_page' ) && sisb_current_static_page() );

    if ( is_front_page() && ! $on_virtual_page ) {
        return $anchor;
    }

    return home_url( '/' . $anchor );
}

/**
 * Trilha de navegação das páginas virtuais.
 *
 * @param array|null $module Módulo atual, ou null no índice.
 */
function sisb_module_breadcrumbs( $module = null ) {
    $group  = $module && isset( $module['group'] ) ? $module['group'] : '';
    $groups = sisb_module_groups();
    ?>
    <nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Trilha de navegação', 'sisb' ); ?>">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Início', 'sisb' ); ?></a>
      <span aria-hidden="true">›</span>
      <?php if ( $module ) : ?>
        <a href="<?php echo esc_url( sisb_modules_url() ); ?>"><?php esc_html_e( 'Módulos', 'sisb' ); ?></a>
        <span aria-hidden="true">›</span>
        <?php if ( isset( $groups[ $group ] ) ) : ?>
          <span><?php echo esc_html( $groups[ $group ]['label'] ); ?></span>
          <span aria-hidden="true">›</span>
        <?php endif; ?>
        <span aria-current="page"><?php echo esc_html( $module['nav_label'] ); ?></span>
      <?php else : ?>
        <span aria-current="page"><?php esc_html_e( 'Módulos', 'sisb' ); ?></span>
      <?php endif; ?>
    </nav>
    <?php
}

/**
 * Módulo seguinte na ordem do registro, para navegação sequencial.
 *
 * @param string $slug Slug atual.
 * @return array|null
 */
function sisb_next_module( $slug ) {
    $slugs = array_keys( sisb_get_modules() );
    $index = array_search( $slug, $slugs, true );

    if ( false === $index || ! isset( $slugs[ $index + 1 ] ) ) {
        return null;
    }

    return sisb_get_module( $slugs[ $index + 1 ] );
}

/**
 * Caminho e URL do screenshot de um módulo, se o arquivo existir.
 *
 * Enquanto a captura real não é produzida, a seção inteira é omitida —
 * é preferível à moldura de "imagem em breve".
 *
 * @param array $module
 * @return array{url:string,alt:string,caption:string}|null
 */
function sisb_module_screenshot( $module ) {
    if ( empty( $module['screenshot']['file'] ) ) {
        return null;
    }

    $file = $module['screenshot']['file'];
    $path = get_template_directory() . '/assets/screenshots/' . $file;

    if ( ! file_exists( $path ) ) {
        return null;
    }

    return array(
        'url'     => get_template_directory_uri() . '/assets/screenshots/' . $file,
        'alt'     => isset( $module['screenshot']['alt'] ) ? $module['screenshot']['alt'] : '',
        'caption' => isset( $module['screenshot']['caption'] ) ? $module['screenshot']['caption'] : '',
    );
}
