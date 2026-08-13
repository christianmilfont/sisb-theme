<?php
/**
 * Módulo — bloco final de conversão.
 *
 * @var array $module
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<section class="module-cta">
  <div class="container">
    <div class="module-cta-inner">
      <div>
        <h2 class="section-title on-dark"><?php esc_html_e( 'Veja funcionando com os seus dados', 'sisb' ); ?></h2>
        <p><?php esc_html_e( 'Apresentamos o módulo em uma sessão com a sua equipe, usando o contexto da sua operação.', 'sisb' ); ?></p>
      </div>
      <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-primary btn-lg">
        <?php esc_html_e( 'Agendar demonstração', 'sisb' ); ?>
        <?php echo sisb_icon( 'arrow', 16 ); ?>
      </a>
    </div>
  </div>
</section>
