<?php
/**
 * Dados estruturados (JSON-LD) e imagem de compartilhamento.
 *
 * O tema emite o próprio schema.org em vez de depender de plugin de SEO,
 * pelo mesmo motivo das meta tags: as páginas de módulo e institucionais são
 * virtuais e nenhum plugin as enxerga.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * URL da imagem de compartilhamento, se o arquivo existir.
 *
 * Enquanto não existir, nenhuma tag og:image é emitida — melhor do que
 * apontar para uma imagem quebrada.
 *
 * @return string Vazio se não houver imagem.
 */
function sisb_og_image_url() {
    $path = get_template_directory() . '/assets/og-image.png';

    if ( ! file_exists( $path ) ) {
        return '';
    }

    return get_template_directory_uri() . '/assets/og-image.png';
}

/**
 * Emite og:image e ajusta o tipo de card do Twitter quando há imagem.
 */
function sisb_og_image_tags() {
    $image = sisb_og_image_url();

    if ( ! $image ) {
        return;
    }

    printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
    printf( '<meta property="og:image:width" content="1200">' . "\n" );
    printf( '<meta property="og:image:height" content="630">' . "\n" );
}
add_action( 'wp_head', 'sisb_og_image_tags', 2 );

/**
 * Imprime um bloco JSON-LD.
 *
 * @param array $data
 */
function sisb_print_jsonld( array $data ) {
    echo '<script type="application/ld+json">'
        . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES )
        . '</script>' . "\n";
}

/**
 * Dados estruturados de cada página.
 */
function sisb_structured_data() {
    if ( is_404() ) {
        return;
    }

    $org = array(
        '@type' => 'Organization',
        '@id'   => home_url( '/#organization' ),
        'name'  => get_bloginfo( 'name' ),
        'url'   => home_url( '/' ),
    );

    $image = sisb_og_image_url();

    if ( $image ) {
        $org['logo'] = $image;
    }

    $email = sisb_contact_field( 'email' );
    $phone = sisb_contact_field( 'phone' );

    if ( $email || $phone ) {
        $contact = array( '@type' => 'ContactPoint', 'contactType' => 'sales' );

        if ( $email ) {
            $contact['email'] = $email;
        }

        if ( $phone ) {
            $contact['telephone'] = $phone;
        }

        $org['contactPoint'] = array( $contact );
    }

    sisb_print_jsonld( array( '@context' => 'https://schema.org' ) + $org );

    $module = sisb_current_module();
    $static = sisb_current_static_page();

    // Home: descreve o produto.
    if ( ! $module && ! $static && ! sisb_is_modules_index() && is_front_page() ) {
        sisb_print_jsonld( array(
            '@context'            => 'https://schema.org',
            '@type'               => 'SoftwareApplication',
            'name'                => 'SISB',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem'     => 'Web, Android, iOS',
            'url'                 => home_url( '/' ),
            'description'         => __( 'Plataforma para fiscalização e segurança de barragens: coleta em campo offline, avaliação de risco, planos de segurança com prazo monitorado e portal do empreendedor.', 'sisb' ),
            'publisher'           => array( '@id' => home_url( '/#organization' ) ),
        ) );

        return;
    }

    // Trilha de navegação das páginas internas.
    $crumbs = array(
        array( 'name' => __( 'Início', 'sisb' ), 'item' => home_url( '/' ) ),
    );

    if ( sisb_is_modules_index() ) {
        $crumbs[] = array( 'name' => __( 'Módulos', 'sisb' ), 'item' => sisb_modules_url() );
    } elseif ( $module ) {
        $crumbs[] = array( 'name' => __( 'Módulos', 'sisb' ), 'item' => sisb_modules_url() );
        $crumbs[] = array( 'name' => $module['nav_label'], 'item' => sisb_module_url( $module['slug'] ) );
    } elseif ( $static ) {
        $crumbs[] = array( 'name' => $static['nav_label'], 'item' => sisb_static_page_url( $static['slug'] ) );
    } else {
        return;
    }

    $items = array();

    foreach ( $crumbs as $i => $crumb ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $crumb['name'],
            'item'     => $crumb['item'],
        );
    }

    sisb_print_jsonld( array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ) );

    // FAQ: só emite se houver perguntas registradas.
    if ( $static && 'faq' === $static['slug'] && function_exists( 'sisb_faq_items' ) ) {
        $entities = array();

        foreach ( sisb_faq_items() as $group ) {
            foreach ( $group['items'] as $item ) {
                $entities[] = array(
                    '@type'          => 'Question',
                    'name'           => $item['q'],
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => $item['a'],
                    ),
                );
            }
        }

        if ( $entities ) {
            sisb_print_jsonld( array(
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => $entities,
            ) );
        }
    }
}
add_action( 'wp_head', 'sisb_structured_data', 5 );
