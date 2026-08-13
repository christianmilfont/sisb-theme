<?php
/**
 * Módulo — cabeçalho.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$groups = sisb_module_groups();
$group  = isset( $groups[ $module['group'] ] ) ? $groups[ $module['group'] ] : null;
?>

<section class="module-hero">
  <div class="container">
    <?php sisb_module_breadcrumbs( $module ); ?>

    <div class="module-hero-grid">
      <div>
        <?php if ( $group ) : ?>
          <span class="eyebrow">
            <?php echo sisb_icon( $group['icon'], 14 ); ?>
            <?php echo esc_html( $group['label'] ); ?>
          </span>
        <?php endif; ?>

        <h1 class="module-hero-title text-balance"><?php echo esc_html( $module['h1'] ); ?></h1>
        <p class="module-hero-lead"><?php echo esc_html( $module['summary'] ); ?></p>

        <div class="hero-cta">
          <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-primary btn-lg">
            <?php esc_html_e( 'Agendar demonstração', 'sisb' ); ?>
            <?php echo sisb_icon( 'arrow', 16 ); ?>
          </a>
          <a href="<?php echo esc_url( sisb_modules_url() ); ?>" class="btn btn-ghost btn-lg">
            <?php esc_html_e( 'Ver todos os módulos', 'sisb' ); ?>
          </a>
        </div>
      </div>

      <div class="module-hero-badge" aria-hidden="true">
        <?php echo sisb_icon( $module['icon'], 40 ); ?>
      </div>
    </div>
  </div>
</section>
