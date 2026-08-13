<?php
/**
 * Módulo — o problema que o módulo resolve.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( empty( $module['problema'] ) ) {
    return;
}
?>

<section class="section-sm module-problema">
  <div class="container">
    <div class="module-problema-inner">
      <span class="eyebrow"><?php echo sisb_icon( 'alert', 14 ); ?> <?php esc_html_e( 'O problema', 'sisb' ); ?></span>
      <?php foreach ( $module['problema'] as $paragraph ) : ?>
        <p><?php echo esc_html( $paragraph ); ?></p>
      <?php endforeach; ?>
    </div>
  </div>
</section>
