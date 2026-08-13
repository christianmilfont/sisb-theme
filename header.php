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
<meta name="description" content="Plataforma nacional para gestão, inspeção e fiscalização digital de barragens. Centralize dados, padronize processos e fortaleça a conformidade regulatória.">
<meta property="og:title" content="SISB — Sistema Integrado de Fiscalização de Barragens">
<meta property="og:description" content="Plataforma nacional para gestão, inspeção e fiscalização digital de barragens.">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="top">
  <div class="container nav-inner">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand">
      <span class="brand-badge"><?php echo sisb_icon( 'shield', 20 ); ?></span>
      <span>
        <div class="brand-title">SISB</div>
        <div class="brand-sub"><?php esc_html_e( 'Fiscalização de Barragens', 'sisb' ); ?></div>
      </span>
    </a>
    <nav class="nav-links" aria-label="Principal">
      <a href="#plataforma"><?php esc_html_e( 'Solução', 'sisb' ); ?></a>
      <a href="#funcionalidades"><?php esc_html_e( 'Funcionalidades', 'sisb' ); ?></a>
      <a href="#mercados"><?php esc_html_e( 'Setores', 'sisb' ); ?></a>
      <a href="#diferenciais"><?php esc_html_e( 'Diferenciais', 'sisb' ); ?></a>
      <a href="#contato"><?php esc_html_e( 'Contato', 'sisb' ); ?></a>
    </nav>
    <a href="#contato" class="btn btn-primary nav-cta"><?php esc_html_e( 'Agendar Demonstração', 'sisb' ); ?></a>
    <button class="menu-toggle" id="sisbMenuToggle" aria-label="Menu" aria-expanded="false">
      <?php echo sisb_icon( 'menu', 24 ); ?>
    </button>
  </div>
  <div class="mobile-menu" id="sisbMobileMenu">
    <div class="container">
      <a href="#plataforma"><?php esc_html_e( 'Solução', 'sisb' ); ?></a>
      <a href="#funcionalidades"><?php esc_html_e( 'Funcionalidades', 'sisb' ); ?></a>
      <a href="#mercados"><?php esc_html_e( 'Setores', 'sisb' ); ?></a>
      <a href="#diferenciais"><?php esc_html_e( 'Diferenciais', 'sisb' ); ?></a>
      <a href="#contato"><?php esc_html_e( 'Contato', 'sisb' ); ?></a>
      <a href="#contato" class="btn btn-primary"><?php esc_html_e( 'Agendar Demonstração', 'sisb' ); ?></a>
    </div>
  </div>
</header>
