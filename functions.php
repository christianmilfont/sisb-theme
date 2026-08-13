<?php
/**
 * SISB Theme functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SISB_VERSION', '1.1.0' );

/**
 * Módulos do produto: registro de conteúdo, roteamento e helpers.
 * Carregado antes dos hooks para que o registro esteja sempre disponível.
 */
require_once get_template_directory() . '/inc/modules-registry.php';
require_once get_template_directory() . '/inc/modules.php';

if ( ! function_exists( 'sisb_setup' ) ) :
function sisb_setup() {
    load_theme_textdomain( 'sisb', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 40,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    register_nav_menus( array(
        'primary' => __( 'Menu Principal', 'sisb' ),
    ) );
}
endif;
add_action( 'after_setup_theme', 'sisb_setup' );

/**
 * Enqueue styles & fonts
 */
function sisb_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'sisb-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap',
        array(),
        null
    );

    wp_enqueue_style( 'sisb-style', get_stylesheet_uri(), array( 'sisb-fonts' ), SISB_VERSION );

    // CSS das páginas internas: só carrega onde é usado.
    // O 404 entra na lista porque reaproveita os mesmos componentes.
    if ( sisb_current_module() || sisb_is_modules_index() || is_404() ) {
        wp_enqueue_style(
            'sisb-modules',
            get_template_directory_uri() . '/assets/modules.css',
            array( 'sisb-style' ),
            SISB_VERSION
        );
    }

    wp_enqueue_script(
        'sisb-main',
        get_template_directory_uri() . '/assets/main.js',
        array(),
        SISB_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'sisb_scripts' );

/**
 * Recipient e-mail for the demo form.
 * Configurable at: Configurações -> Geral -> "E-mail do formulário SISB"
 * or by defining SISB_CONTACT_EMAIL in wp-config.php
 */
function sisb_get_contact_email() {
    if ( defined( 'SISB_CONTACT_EMAIL' ) && SISB_CONTACT_EMAIL ) {
        return SISB_CONTACT_EMAIL;
    }
    $opt = get_option( 'sisb_contact_email' );
    if ( $opt && is_email( $opt ) ) return $opt;
    return get_option( 'admin_email' );
}

/**
 * Dados públicos de contato exibidos no site.
 *
 * Nenhum valor vem preenchido: campo vazio simplesmente não é renderizado.
 * Isso evita que placeholders ("0000-0000", "/company/sisb") vão ao ar.
 *
 * Configurável em Configurações → Geral, ou por constante no wp-config.php:
 *   SISB_PUBLIC_EMAIL · SISB_PUBLIC_PHONE · SISB_PUBLIC_LINKEDIN · SISB_APP_URL
 *
 * @param string $key email|phone|linkedin
 * @return string Valor configurado ou string vazia.
 */
function sisb_contact_field( $key ) {
    $constants = array(
        'email'    => 'SISB_PUBLIC_EMAIL',
        'phone'    => 'SISB_PUBLIC_PHONE',
        'linkedin' => 'SISB_PUBLIC_LINKEDIN',
    );

    if ( isset( $constants[ $key ] ) && defined( $constants[ $key ] ) && constant( $constants[ $key ] ) ) {
        return trim( (string) constant( $constants[ $key ] ) );
    }

    return trim( (string) get_option( 'sisb_public_' . $key, '' ) );
}

/**
 * Rótulo do endereço da aplicação, usado no mockup de navegador do hero.
 * Sem configuração, cai no próprio domínio do site — nunca em um domínio inventado.
 */
function sisb_app_url_label() {
    $url = '';

    if ( defined( 'SISB_APP_URL' ) && SISB_APP_URL ) {
        $url = (string) SISB_APP_URL;
    } else {
        $url = (string) get_option( 'sisb_app_url', '' );
    }

    if ( $url ) {
        return preg_replace( '#^https?://#', '', untrailingslashit( trim( $url ) ) );
    }

    $host = wp_parse_url( home_url(), PHP_URL_HOST );

    return $host ? $host . '/painel' : 'painel';
}

/**
 * Campos de configuração do tema (Configurações → Geral)
 */
function sisb_register_settings() {
    $fields = array(
        'sisb_contact_email' => array(
            'label'       => __( 'E-mail do formulário SISB', 'sisb' ),
            'type'        => 'email',
            'sanitize'    => 'sanitize_email',
            'placeholder' => get_option( 'admin_email' ),
            'description' => __( 'Endereço que recebe as solicitações de demonstração. Se vazio, usa o e-mail do administrador.', 'sisb' ),
        ),
        'sisb_public_email' => array(
            'label'       => __( 'E-mail público de contato', 'sisb' ),
            'type'        => 'email',
            'sanitize'    => 'sanitize_email',
            'placeholder' => 'contato@seudominio.com.br',
            'description' => __( 'Exibido no site. Se vazio, o e-mail não aparece.', 'sisb' ),
        ),
        'sisb_public_phone' => array(
            'label'       => __( 'Telefone público', 'sisb' ),
            'type'        => 'text',
            'sanitize'    => 'sanitize_text_field',
            'placeholder' => '+55 (11) 90000-0000',
            'description' => __( 'Exibido no site. Se vazio, o telefone não aparece.', 'sisb' ),
        ),
        'sisb_public_linkedin' => array(
            'label'       => __( 'LinkedIn', 'sisb' ),
            'type'        => 'url',
            'sanitize'    => 'esc_url_raw',
            'placeholder' => 'https://www.linkedin.com/company/…',
            'description' => __( 'URL completa. Se vazio, o link não aparece.', 'sisb' ),
        ),
        'sisb_app_url' => array(
            'label'       => __( 'Endereço da aplicação', 'sisb' ),
            'type'        => 'text',
            'sanitize'    => 'sanitize_text_field',
            'placeholder' => wp_parse_url( home_url(), PHP_URL_HOST ) . '/painel',
            'description' => __( 'Mostrado no mockup de navegador da página inicial. Se vazio, usa o domínio deste site.', 'sisb' ),
        ),
    );

    foreach ( $fields as $name => $field ) {
        register_setting( 'general', $name, array(
            'type'              => 'string',
            'sanitize_callback' => $field['sanitize'],
            'default'           => '',
        ) );

        add_settings_field(
            $name,
            $field['label'],
            function() use ( $name, $field ) {
                printf(
                    '<input type="%1$s" name="%2$s" id="%2$s" value="%3$s" class="regular-text" placeholder="%4$s" />',
                    esc_attr( $field['type'] ),
                    esc_attr( $name ),
                    esc_attr( get_option( $name, '' ) ),
                    esc_attr( $field['placeholder'] )
                );
                echo '<p class="description">' . esc_html( $field['description'] ) . '</p>';
            },
            'general'
        );
    }
}
add_action( 'admin_init', 'sisb_register_settings' );

/**
 * Handle demo form submission (works on the front page).
 * Uses admin-post.php for both logged-in and anonymous users.
 */
function sisb_handle_demo_form() {
    if ( ! isset( $_POST['sisb_nonce'] ) || ! wp_verify_nonce( $_POST['sisb_nonce'], 'sisb_demo_form' ) ) {
        wp_safe_redirect( add_query_arg( 'sisb_status', 'error', home_url( '/#contato' ) ) );
        exit;
    }

    // Honeypot
    if ( ! empty( $_POST['website'] ) ) {
        wp_safe_redirect( add_query_arg( 'sisb_status', 'ok', home_url( '/#contato' ) ) );
        exit;
    }

    $nome  = isset( $_POST['nome'] )  ? sanitize_text_field( wp_unslash( $_POST['nome'] ) )  : '';
    $org   = isset( $_POST['org'] )   ? sanitize_text_field( wp_unslash( $_POST['org'] ) )   : '';
    $cargo = isset( $_POST['cargo'] ) ? sanitize_text_field( wp_unslash( $_POST['cargo'] ) ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) )      : '';
    $tel   = isset( $_POST['tel'] )   ? sanitize_text_field( wp_unslash( $_POST['tel'] ) )   : '';
    $msg   = isset( $_POST['msg'] )   ? sanitize_textarea_field( wp_unslash( $_POST['msg'] ) ) : '';

    if ( ! $nome || ! $org || ! is_email( $email ) ) {
        wp_safe_redirect( add_query_arg( 'sisb_status', 'invalid', home_url( '/#contato' ) ) );
        exit;
    }

    $to      = sisb_get_contact_email();
    $subject = sprintf( '[SISB] Solicitação de demonstração — %s (%s)', $nome, $org );

    $body  = "Nova solicitação de demonstração recebida via site SISB\n\n";
    $body .= "Nome:         {$nome}\n";
    $body .= "Organização:  {$org}\n";
    $body .= "Cargo:        {$cargo}\n";
    $body .= "E-mail:       {$email}\n";
    $body .= "Telefone:     {$tel}\n\n";
    $body .= "Mensagem:\n{$msg}\n\n";
    $body .= "---\nEnviado em " . current_time( 'mysql' ) . "\nIP: " . ( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );

    $sitename = wp_parse_url( home_url(), PHP_URL_HOST );
    $from     = 'no-reply@' . preg_replace( '/^www\./', '', $sitename );
    $headers  = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo( 'name' ) . ' <' . $from . '>',
        'Reply-To: ' . $nome . ' <' . $email . '>',
    );

    $sent = wp_mail( $to, $subject, $body, $headers );

    wp_safe_redirect( add_query_arg( 'sisb_status', $sent ? 'ok' : 'error', home_url( '/#contato' ) ) );
    exit;
}
add_action( 'admin_post_nopriv_sisb_demo_form', 'sisb_handle_demo_form' );
add_action( 'admin_post_sisb_demo_form', 'sisb_handle_demo_form' );

/**
 * SVG icon helper — inline lucide-style icons
 */
function sisb_icon( $name, $size = 20, $class = '' ) {
    $icons = array(
        'shield'    => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        'activity'  => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>',
        'smartphone'=> '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>',
        'file'      => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
        'layers'    => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>',
        'chart'     => '<line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/>',
        'database'  => '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14a9 3 0 0 0 18 0V5"/><path d="M3 12a9 3 0 0 0 18 0"/>',
        'workflow'  => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><path d="M10 6.5h4A2.5 2.5 0 0 1 16.5 9v5"/>',
        'lock'      => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
        'history'   => '<path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/>',
        'pin'       => '<path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
        'image'     => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/>',
        'plug'      => '<path d="M9 2v6"/><path d="M15 2v6"/><path d="M6 8h12v3a6 6 0 0 1-6 6 6 6 0 0 1-6-6z"/><path d="M12 17v5"/>',
        'check'     => '<path d="M20 6 9 17l-5-5"/>',
        'check-circ'=> '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>',
        'arrow'     => '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>',
        'chevron'   => '<polyline points="6 9 12 15 18 9"/>',
        'building'  => '<rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01M16 6h.01M12 6h.01M12 10h.01M12 14h.01M16 10h.01M16 14h.01M8 10h.01M8 14h.01"/>',
        'landmark'  => '<line x1="3" y1="22" x2="21" y2="22"/><line x1="6" y1="18" x2="6" y2="11"/><line x1="10" y1="18" x2="10" y2="11"/><line x1="14" y1="18" x2="14" y2="11"/><line x1="18" y1="18" x2="18" y2="11"/><polygon points="12 2 20 7 4 7"/>',
        'hardhat'   => '<path d="M2 18a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-2a4 4 0 0 0-4-4h-3l-1-4h-4l-1 4H6a4 4 0 0 0-4 4z"/>',
        'factory'   => '<path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>',
        'alert'     => '<path d="m21.73 18-8-14a2 2 0 0 0-3.46 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
        'search'    => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
        'signal'    => '<path d="M2 20h.01"/><path d="M7 20v-4"/><path d="M12 20v-8"/><path d="M17 20V8"/>',
        'scroll'    => '<path d="M8 21h12a2 2 0 0 0 2-2v-2H10v2a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v3h4"/><path d="M19 17V5a2 2 0 0 0-2-2H4"/>',
        'globe'     => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
        'zap'       => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
        'branch'    => '<line x1="6" y1="3" x2="6" y2="15"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M18 9a9 9 0 0 1-9 9"/>',
        'list'      => '<path d="m3 17 2 2 4-4"/><path d="m3 7 2 2 4-4"/><line x1="13" y1="6" x2="21" y2="6"/><line x1="13" y1="12" x2="21" y2="12"/><line x1="13" y1="18" x2="21" y2="18"/>',
        'menu'      => '<line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/>',
        'x'         => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
        'mail'      => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/>',
        'phone'     => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
        'linkedin'  => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
    );
    $path = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
    $cls  = $class ? ' class="' . esc_attr( $class ) . '"' : '';
    return '<svg' . $cls . ' xmlns="http://www.w3.org/2000/svg" width="' . intval( $size ) . '" height="' . intval( $size ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
}
