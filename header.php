<?php
/**
 * Header
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
/**
 * Descrição, canonical e Open Graph são gerados por sisb_head_meta()
 * (inc/modules.php), que resolve os valores conforme a página atual.
 * Mantê-los aqui produzia meta tags duplicadas nas páginas internas.
 */
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#conteudo"><?php esc_html_e( 'Pular para o conteúdo', 'sisb' ); ?></a>

<header class="site-header" id="top">
  <div class="container nav-inner">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand">
      <span class="brand-badge"><?php echo sisb_icon( 'shield', 20 ); ?></span>
      <span>
        <div class="brand-title">SISB</div>
        <div class="brand-sub"><?php esc_html_e( 'Fiscalização de Barragens', 'sisb' ); ?></div>
      </span>
    </a>
    <?php $sisb_nav_groups = sisb_get_populated_groups(); ?>
    <nav class="nav-links" aria-label="Principal">
      <?php if ( ! empty( $sisb_nav_groups ) ) : ?>
        <span class="has-mega">
          <a href="<?php echo esc_url( sisb_modules_url() ); ?>" class="mega-trigger">
            <?php esc_html_e( 'Módulos', 'sisb' ); ?>
            <?php echo sisb_icon( 'chevron', 14 ); ?>
          </a>
          <div class="mega">
            <div class="mega-grid">
              <?php foreach ( $sisb_nav_groups as $sisb_group ) : ?>
                <div class="mega-col">
                  <div class="mega-col-title">
                    <?php echo sisb_icon( $sisb_group['icon'], 14 ); ?>
                    <?php echo esc_html( $sisb_group['label'] ); ?>
                  </div>
                  <ul>
                    <?php foreach ( $sisb_group['modules'] as $sisb_slug => $sisb_module_item ) : ?>
                      <li>
                        <a href="<?php echo esc_url( sisb_module_url( $sisb_slug ) ); ?>">
                          <?php echo esc_html( $sisb_module_item['nav_label'] ); ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="mega-foot">
              <a href="<?php echo esc_url( sisb_modules_url() ); ?>">
                <?php esc_html_e( 'Ver todos os módulos', 'sisb' ); ?>
                <?php echo sisb_icon( 'arrow', 14 ); ?>
              </a>
            </div>
          </div>
        </span>
      <?php endif; ?>
      <a href="<?php echo esc_url( sisb_anchor( '#como-funciona' ) ); ?>"><?php esc_html_e( 'Como funciona', 'sisb' ); ?></a>
      <a href="<?php echo esc_url( sisb_anchor( '#diferenciais' ) ); ?>"><?php esc_html_e( 'Diferenciais', 'sisb' ); ?></a>
      <?php foreach ( sisb_get_static_pages( true ) as $sisb_page_slug => $sisb_page ) : ?>
        <a href="<?php echo esc_url( sisb_static_page_url( $sisb_page_slug ) ); ?>"><?php echo esc_html( $sisb_page['nav_label'] ); ?></a>
      <?php endforeach; ?>
      <a href="<?php echo esc_url( sisb_anchor( '#contato' ) ); ?>"><?php esc_html_e( 'Contato', 'sisb' ); ?></a>
    </nav>
    <a href="<?php echo esc_url( sisb_anchor( '#contato' ) ); ?>" class="btn btn-primary nav-cta"><?php esc_html_e( 'Agendar Demonstração', 'sisb' ); ?></a>
    <button class="menu-toggle" id="sisbMenuToggle" type="button"
            aria-label="<?php esc_attr_e( 'Abrir menu', 'sisb' ); ?>"
            aria-controls="sisbMobileMenu" aria-expanded="false">
      <?php echo sisb_icon( 'menu', 24 ); ?>
    </button>
  </div>
  <div class="mobile-menu" id="sisbMobileMenu">
    <div class="container">
      <?php if ( ! empty( $sisb_nav_groups ) ) : ?>
        <a href="<?php echo esc_url( sisb_modules_url() ); ?>"><?php esc_html_e( 'Módulos', 'sisb' ); ?></a>
        <?php foreach ( $sisb_nav_groups as $sisb_group ) : ?>
          <div class="mobile-group-title"><?php echo esc_html( $sisb_group['label'] ); ?></div>
          <?php foreach ( $sisb_group['modules'] as $sisb_slug => $sisb_module_item ) : ?>
            <a class="mobile-sub" href="<?php echo esc_url( sisb_module_url( $sisb_slug ) ); ?>">
              <?php echo esc_html( $sisb_module_item['nav_label'] ); ?>
            </a>
          <?php endforeach; ?>
        <?php endforeach; ?>
      <?php endif; ?>
      <a href="<?php echo esc_url( sisb_anchor( '#como-funciona' ) ); ?>"><?php esc_html_e( 'Como funciona', 'sisb' ); ?></a>
      <a href="<?php echo esc_url( sisb_anchor( '#diferenciais' ) ); ?>"><?php esc_html_e( 'Diferenciais', 'sisb' ); ?></a>
      <?php foreach ( sisb_get_static_pages( true ) as $sisb_page_slug => $sisb_page ) : ?>
        <a href="<?php echo esc_url( sisb_static_page_url( $sisb_page_slug ) ); ?>"><?php echo esc_html( $sisb_page['nav_label'] ); ?></a>
      <?php endforeach; ?>
      <a href="<?php echo esc_url( sisb_anchor( '#contato' ) ); ?>"><?php esc_html_e( 'Contato', 'sisb' ); ?></a>
      <a href="<?php echo esc_url( sisb_anchor( '#contato' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Agendar Demonstração', 'sisb' ); ?></a>
    </div>
  </div>
</header>
