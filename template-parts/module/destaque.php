<?php
/**
 * Módulo — o diferencial que merece destaque.
 *
 * Opcional. Use apenas quando houver um argumento defensável em demo,
 * não para repetir a lista de capacidades em prosa.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( empty( $module['destaque']['title'] ) ) {
    return;
}
?>

<section class="dark-section module-destaque">
  <div class="container">
    <div class="module-destaque-inner">
      <div class="module-destaque-ico" aria-hidden="true"><?php echo sisb_icon( 'zap', 22 ); ?></div>
      <div>
        <h2 class="section-title on-dark"><?php echo esc_html( $module['destaque']['title'] ); ?></h2>
        <p><?php echo esc_html( $module['destaque']['text'] ); ?></p>
      </div>
    </div>
  </div>
</section>
