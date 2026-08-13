<?php
/**
 * Módulo — como funciona, na ordem em que o usuário executa.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( empty( $module['como_funciona'] ) ) {
    return;
}
?>

<section class="section" style="background:var(--surface)">
  <div class="container">
    <div style="max-width:640px">
      <span class="eyebrow"><?php echo sisb_icon( 'workflow', 14 ); ?> <?php esc_html_e( 'Como funciona', 'sisb' ); ?></span>
      <h2 class="section-title"><?php esc_html_e( 'O fluxo, do início ao fim', 'sisb' ); ?></h2>
    </div>

    <ol class="steps">
      <?php foreach ( $module['como_funciona'] as $i => $step ) : ?>
        <li class="step">
          <div class="step-n" aria-hidden="true"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></div>
          <div>
            <h3><?php echo esc_html( $step['title'] ); ?></h3>
            <p><?php echo esc_html( $step['text'] ); ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
