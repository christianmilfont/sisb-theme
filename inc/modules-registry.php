<?php
/**
 * Registro dos módulos do produto.
 *
 * Cada módulo vive em seu próprio arquivo, em inc/modules/<slug>.php, que
 * devolve um array com o conteúdo daquele módulo. Este arquivo define os
 * grupos, os vocabulários compartilhados e a ordem de carregamento.
 *
 * A separação por arquivo existe por dois motivos: mantém cada página de
 * módulo revisável em um diff isolado, e permite que módulos diferentes sejam
 * escritos em paralelo sem colisão.
 *
 * REGRA: nada entra aqui sem contrapartida ✅ "Em produção" em
 * doc/product-modules.md. Itens previstos e ainda não implementados vão na
 * chave 'roadmap', renderizada em bloco visualmente separado.
 *
 * Ver doc/site-ia.md §3 para o significado de cada chave.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Grupos de módulos, na ordem em que aparecem na navegação e no índice.
 *
 * @return array<string,array>
 */
function sisb_module_groups() {
    return array(
        'coleta' => array(
            'label' => __( 'Coleta em campo', 'sisb' ),
            'lead'  => __( 'O que acontece na barragem: inspeção, evidência e instrumento de fiscalização, com ou sem conectividade.', 'sisb' ),
            'icon'  => 'smartphone',
        ),
        'gestao' => array(
            'label' => __( 'Gestão e conformidade', 'sisb' ),
            'lead'  => __( 'O que acontece no escritório: cadastro, análise de risco, planos de segurança, prazos e comunicação com o empreendedor.', 'sisb' ),
            'icon'  => 'shield',
        ),
        'plataforma' => array(
            'label' => __( 'Plataforma', 'sisb' ),
            'lead'  => __( 'O que sustenta a operação: integração com sistemas existentes, perfis de acesso e trilha de auditoria.', 'sisb' ),
            'icon'  => 'layers',
        ),
    );
}

/**
 * Rótulos legíveis dos perfis de acesso do sistema.
 *
 * As chaves espelham os papéis reais do SISB (UsuarioRole).
 *
 * @return array<string,string>
 */
function sisb_module_roles() {
    return array(
        'fiscal'          => __( 'Fiscal de campo', 'sisb' ),
        'fiscal_analista' => __( 'Fiscal analista', 'sisb' ),
        'admin'           => __( 'Administrador', 'sisb' ),
        'terceiro'        => __( 'Empresa contratada', 'sisb' ),
        'empreendedor'    => __( 'Empreendedor', 'sisb' ),
    );
}

/**
 * Rótulos dos canais em que um módulo está disponível.
 *
 * @return array<string,array{label:string,icon:string}>
 */
function sisb_module_channels() {
    return array(
        'app'    => array( 'label' => __( 'Aplicativo de campo', 'sisb' ),    'icon' => 'smartphone' ),
        'web'    => array( 'label' => __( 'Back-office web', 'sisb' ),        'icon' => 'database' ),
        'portal' => array( 'label' => __( 'Portal do empreendedor', 'sisb' ), 'icon' => 'building' ),
        'api'    => array( 'label' => __( 'API', 'sisb' ),                    'icon' => 'plug' ),
    );
}

/**
 * Ordem canônica dos módulos.
 *
 * Define a ordem do índice, do mega-menu e da navegação "próximo módulo".
 * Um slug listado aqui sem arquivo correspondente é ignorado silenciosamente.
 *
 * @return string[]
 */
function sisb_module_order() {
    return array(
        // Coleta em campo
        'app-de-campo',
        'vistorias',
        'autos-e-outorga',

        // Gestão e conformidade
        'prontuario-da-barragem',
        'avaliacao-de-risco',
        'planos-e-conformidade',
        'processos-e-equipe',
        'comunicacao-e-portal',
        'relatorios',
        'painel-de-dados',

        // Plataforma
        'integracoes',
        'governanca',
    );
}

/**
 * Registro completo dos módulos, indexado por slug.
 *
 * 'status' => 'ready' → publicado, com rota própria e listado no índice
 * 'status' => 'draft' → conteúdo ainda não escrito; não roteado, não listado
 *
 * @return array<string,array>
 */
function sisb_modules_registry() {
    static $cache = null;

    if ( null !== $cache ) {
        return $cache;
    }

    $modules = array();
    $dir     = get_template_directory() . '/inc/modules/';

    foreach ( sisb_module_order() as $slug ) {
        $file = $dir . $slug . '.php';

        if ( ! file_exists( $file ) ) {
            continue;
        }

        $module = require $file;

        if ( is_array( $module ) && ! empty( $module ) ) {
            $modules[ $slug ] = $module;
        }
    }

    /**
     * Permite estender ou ajustar o registro de módulos.
     *
     * @param array $modules Registro completo, indexado por slug.
     */
    $cache = apply_filters( 'sisb_modules_registry', $modules );

    return $cache;
}
