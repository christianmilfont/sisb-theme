<?php
/**
 * Módulo — capacidades.
 *
 * Cada item precisa ser demonstrável em uma demo do produto.
 * Ver doc/product-modules.md antes de acrescentar qualquer linha.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( empty( $module['capacidades'] ) ) {
    return;
}
?>

<section class="section">
  <div class="container">
    <div style="max-width:640px">
      <span class="eyebrow"><?php echo sisb_icon( 'check-circ', 14 ); ?> <?php esc_html_e( 'Capacidades', 'sisb' ); ?></span>
      <h2 class="section-title"><?php esc_html_e( 'O que este módulo faz', 'sisb' ); ?></h2>
    </div>

    <ul class="features">
      <?php foreach ( $module['capacidades'] as $item ) : ?>
        <li class="feat">
          <div class="feat-ico"><?php echo sisb_icon( 'check', 18 ); ?></div>
          <span><?php echo esc_html( $item ); ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
