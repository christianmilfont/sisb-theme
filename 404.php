<?php
/**
 * 404 — página não encontrada.
 *
 * O tema não tinha template de 404, então qualquer URL inválida caía no
 * index.php e devolvia a landing page inteira. Além de confundir o visitante,
 * isso gera conteúdo duplicado em URLs inexistentes.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$groups = sisb_get_populated_groups();
?>

<main class="module-page">

  <section class="module-hero">
    <div class="container">
      <div style="max-width:640px">
        <span class="eyebrow"><?php echo sisb_icon( 'search', 14 ); ?> <?php esc_html_e( 'Erro 404', 'sisb' ); ?></span>
        <h1 class="module-hero-title text-balance"><?php esc_html_e( 'Esta página não existe', 'sisb' ); ?></h1>
        <p class="module-hero-lead">
          <?php esc_html_e( 'O endereço acessado não corresponde a nenhuma página do site. Pode ter sido removido, renomeado ou digitado incorretamente.', 'sisb' ); ?>
        </p>
        <div class="hero-cta">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg">
            <?php esc_html_e( 'Voltar ao início', 'sisb' ); ?>
            <?php echo sisb_icon( 'arrow', 16 ); ?>
          </a>
          <?php if ( ! empty( $groups ) ) : ?>
            <a href="<?php echo esc_url( sisb_modules_url() ); ?>" class="btn btn-ghost btn-lg">
              <?php esc_html_e( 'Ver os módulos', 'sisb' ); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php if ( ! empty( $groups ) ) : ?>
    <section class="section">
      <div class="container">
        <div style="max-width:640px">
          <span class="eyebrow"><?php echo sisb_icon( 'layers', 14 ); ?> <?php esc_html_e( 'Talvez você procure', 'sisb' ); ?></span>
        </div>
        <div class="cards cols-3">
          <?php foreach ( $groups as $group ) : ?>
            <?php foreach ( $group['modules'] as $slug => $item ) : ?>
              <a class="module module-link" href="<?php echo esc_url( sisb_module_url( $slug ) ); ?>">
                <div class="module-head">
                  <div class="module-ico"><?php echo sisb_icon( $item['icon'], 22 ); ?></div>
                  <h3><?php echo esc_html( $item['nav_label'] ); ?></h3>
                </div>
                <p class="module-summary"><?php echo esc_html( $item['summary'] ); ?></p>
              </a>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

</main>

<?php get_footer(); ?>
