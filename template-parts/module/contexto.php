<?php
/**
 * Módulo — onde funciona e quem usa.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$channels = sisb_module_channels();
$roles    = sisb_module_roles();

$has_channels = ! empty( $module['canais'] );
$has_roles    = ! empty( $module['perfis'] );

if ( ! $has_channels && ! $has_roles ) {
    return;
}
?>

<section class="section-sm" style="background:var(--surface)">
  <div class="container">
    <div class="module-contexto">

      <?php if ( $has_channels ) : ?>
        <div>
          <span class="eyebrow"><?php esc_html_e( 'Onde funciona', 'sisb' ); ?></span>
          <ul class="chips">
            <?php foreach ( $module['canais'] as $key ) : ?>
              <?php if ( ! isset( $channels[ $key ] ) ) continue; ?>
              <li class="chip">
                <?php echo sisb_icon( $channels[ $key ]['icon'], 16 ); ?>
                <span><?php echo esc_html( $channels[ $key ]['label'] ); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if ( $has_roles ) : ?>
        <div>
          <span class="eyebrow"><?php esc_html_e( 'Quem usa', 'sisb' ); ?></span>
          <ul class="chips">
            <?php foreach ( $module['perfis'] as $key ) : ?>
              <?php if ( ! isset( $roles[ $key ] ) ) continue; ?>
              <li class="chip">
                <?php echo sisb_icon( 'lock', 16 ); ?>
                <span><?php echo esc_html( $roles[ $key ] ); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
