<?php
/**
 * Módulo — módulos relacionados e navegação sequencial.
 *
 * Relações que apontam para módulos ainda não publicados são silenciosamente
 * ignoradas, o que permite declarar a malha completa no registro antes de
 * todo o conteúdo existir.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$related = array();

if ( ! empty( $module['relacionados'] ) ) {
    foreach ( $module['relacionados'] as $slug ) {
        $item = sisb_get_module( $slug );

        if ( $item ) {
            $related[] = $item;
        }
    }
}

$next = sisb_next_module( $module['slug'] );

if ( empty( $related ) && ! $next ) {
    return;
}
?>

<section class="section">
  <div class="container">

    <?php if ( ! empty( $related ) ) : ?>
      <div style="max-width:640px">
        <span class="eyebrow"><?php echo sisb_icon( 'branch', 14 ); ?> <?php esc_html_e( 'Conecta com', 'sisb' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Módulos relacionados', 'sisb' ); ?></h2>
      </div>

      <div class="cards cols-3">
        <?php foreach ( $related as $item ) : ?>
          <a class="module module-link" href="<?php echo esc_url( sisb_module_url( $item['slug'] ) ); ?>">
            <div class="module-head">
              <div class="module-ico"><?php echo sisb_icon( $item['icon'], 22 ); ?></div>
              <h3><?php echo esc_html( $item['nav_label'] ); ?></h3>
            </div>
            <p class="module-summary"><?php echo esc_html( $item['summary'] ); ?></p>
            <span class="module-more">
              <?php esc_html_e( 'Ver módulo', 'sisb' ); ?>
              <?php echo sisb_icon( 'arrow', 14 ); ?>
            </span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ( $next ) : ?>
      <a class="module-next" href="<?php echo esc_url( sisb_module_url( $next['slug'] ) ); ?>">
        <span class="module-next-label"><?php esc_html_e( 'Próximo módulo', 'sisb' ); ?></span>
        <span class="module-next-title">
          <?php echo esc_html( $next['nav_label'] ); ?>
          <?php echo sisb_icon( 'arrow', 18 ); ?>
        </span>
      </a>
    <?php endif; ?>

  </div>
</section>
