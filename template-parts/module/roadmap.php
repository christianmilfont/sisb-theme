<?php
/**
 * Módulo — itens previstos, ainda não implementados.
 *
 * Bloco deliberadamente distinto do restante da página. Item de roadmap
 * nunca aparece junto às capacidades: a separação visual é o que impede
 * que uma promessa seja lida como entrega.
 *
 * Só entram aqui itens marcados 🔵 em doc/product-modules.md.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( empty( $module['roadmap'] ) ) {
    return;
}
?>

<section class="section-sm">
  <div class="container">
    <div class="roadmap">
      <div class="roadmap-head">
        <span class="roadmap-tag"><?php esc_html_e( 'Em desenvolvimento', 'sisb' ); ?></span>
        <p><?php esc_html_e( 'Os itens abaixo estão previstos e ainda não fazem parte da versão disponível.', 'sisb' ); ?></p>
      </div>
      <ul>
        <?php foreach ( $module['roadmap'] as $item ) : ?>
          <li><?php echo esc_html( $item ); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
