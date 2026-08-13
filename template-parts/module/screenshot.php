<?php
/**
 * Módulo — captura de tela real.
 *
 * Se o arquivo ainda não existe em assets/screenshots/, a seção inteira é
 * omitida. É deliberado: moldura de "imagem em breve" comunica site
 * inacabado, ausência de seção não comunica nada.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$shot = sisb_module_screenshot( $module );

if ( ! $shot ) {
    return;
}
?>

<section class="section-sm">
  <div class="container">
    <figure class="module-shot">
      <div class="browser">
        <div class="browser-bar">
          <span class="dotr r"></span><span class="dotr y"></span><span class="dotr g"></span>
          <span class="browser-url"><?php echo esc_html( sisb_app_url_label() ); ?></span>
        </div>
        <img src="<?php echo esc_url( $shot['url'] ); ?>"
             alt="<?php echo esc_attr( $shot['alt'] ); ?>"
             loading="lazy" decoding="async">
      </div>
      <?php if ( $shot['caption'] ) : ?>
        <figcaption><?php echo esc_html( $shot['caption'] ); ?></figcaption>
      <?php endif; ?>
    </figure>
  </div>
</section>
