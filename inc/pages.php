<?php
/**
 * Páginas institucionais: registro, roteamento e metadados.
 *
 * Mesma mecânica das páginas de módulo (inc/modules.php): rotas virtuais,
 * servidas por rewrite rule, sem post no banco e sem configuração no painel.
 *
 * Cada página tem seu template em templates/pages/<slug>.php e é livre para
 * montar a própria estrutura — ao contrário dos módulos, que compartilham um
 * template único.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registro das páginas institucionais.
 *
 * 'status' => 'ready' → publicada, com rota e presente na navegação
 * 'status' => 'draft' → sem rota; ver doc/site-ia.md para o que falta
 * 'nav'    => true    → aparece no menu principal
 *
 * @return array<string,array>
 */
function sisb_static_pages() {
    $pages = array(
        'seguranca' => array(
            'status'    => 'ready',
            'nav'       => true,
            'icon'      => 'lock',
            'nav_label' => __( 'Segurança', 'sisb' ),
            'title'     => __( 'Segurança e Proteção de Dados', 'sisb' ),
            'summary'   => __( 'Como o SISB protege dados de infraestrutura crítica e dados pessoais: autenticação, perfis de acesso, trilha de auditoria, armazenamento, backup e isolamento de ambientes.', 'sisb' ),
        ),
        'api' => array(
            'status'    => 'ready',
            'nav'       => true,
            'icon'      => 'plug',
            'nav_label' => __( 'API', 'sisb' ),
            'title'     => __( 'API e Integração', 'sisb' ),
            'summary'   => __( 'API REST documentada, com autenticação por token de usuário e por chave de serviço, importação da base existente e integração em produção com sistema legado.', 'sisb' ),
        ),
        'faq' => array(
            'status'    => 'ready',
            'nav'       => false,
            'icon'      => 'search',
            'nav_label' => __( 'Perguntas frequentes', 'sisb' ),
            'title'     => __( 'Perguntas Frequentes', 'sisb' ),
            'summary'   => __( 'Respostas às dúvidas mais comuns sobre implantação, operação offline, integração, perfis de acesso e conformidade do SISB.', 'sisb' ),
        ),
    );

    /**
     * Permite estender o registro de páginas institucionais.
     *
     * @param array $pages Registro completo, indexado por slug.
     */
    return apply_filters( 'sisb_static_pages', $pages );
}

/**
 * Páginas institucionais publicadas.
 *
 * @param bool $nav_only Retornar apenas as marcadas para o menu.
 * @return array<string,array>
 */
function sisb_get_static_pages( $nav_only = false ) {
    return array_filter(
        sisb_static_pages(),
        static function ( $page ) use ( $nav_only ) {
            if ( ! isset( $page['status'] ) || 'ready' !== $page['status'] ) {
                return false;
            }

            return $nav_only ? ! empty( $page['nav'] ) : true;
        }
    );
}

/**
 * URL de uma página institucional.
 *
 * @param string $slug
 * @return string
 */
function sisb_static_page_url( $slug ) {
    return home_url( '/' . $slug . '/' );
}

/**
 * A página institucional da requisição atual, se houver.
 *
 * @return array|null Dados da página com 'slug' incluído.
 */
function sisb_current_static_page() {
    $slug = get_query_var( 'sisb_page' );

    if ( ! $slug ) {
        return null;
    }

    $slug  = sanitize_key( $slug );
    $pages = sisb_get_static_pages();

    if ( ! isset( $pages[ $slug ] ) ) {
        return null;
    }

    return array_merge( array( 'slug' => $slug ), $pages[ $slug ] );
}

/* ===================================================================
 * Roteamento
 * =================================================================== */

/**
 * @param string[] $vars
 * @return string[]
 */
function sisb_pages_query_vars( $vars ) {
    $vars[] = 'sisb_page';

    return $vars;
}
add_filter( 'query_vars', 'sisb_pages_query_vars' );

/**
 * Regras de reescrita, uma por página registrada.
 *
 * Registrar slug a slug (em vez de um curinga) evita capturar URLs que não
 * pertencem ao tema e deixa páginas do WordPress com outros slugs intactas.
 */
function sisb_pages_rewrite_rules() {
    foreach ( array_keys( sisb_static_pages() ) as $slug ) {
        add_rewrite_rule(
            '^' . preg_quote( $slug, '/' ) . '/?$',
            'index.php?sisb_page=' . $slug,
            'top'
        );
    }
}
add_action( 'init', 'sisb_pages_rewrite_rules' );

/**
 * Direciona as páginas institucionais para os seus templates.
 *
 * @param string $template
 * @return string
 */
function sisb_pages_template( $template ) {
    if ( ! get_query_var( 'sisb_page' ) ) {
        return $template;
    }

    $page = sisb_current_static_page();

    if ( ! $page ) {
        return sisb_render_404( $template );
    }

    $found = locate_template( 'templates/pages/' . $page['slug'] . '.php' );

    if ( ! $found ) {
        return sisb_render_404( $template );
    }

    sisb_force_http_200();

    return $found;
}
add_filter( 'template_include', 'sisb_pages_template' );

/**
 * Trilha de navegação das páginas institucionais.
 *
 * @param array $page
 */
function sisb_static_page_breadcrumbs( $page ) {
    ?>
    <nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Trilha de navegação', 'sisb' ); ?>">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Início', 'sisb' ); ?></a>
      <span aria-hidden="true">›</span>
      <span aria-current="page"><?php echo esc_html( $page['nav_label'] ); ?></span>
    </nav>
    <?php
}
