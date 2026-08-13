<?php
/**
 * Índice de módulos — /modulos/
 *
 * Agrupa os módulos publicados em Coleta, Gestão e Plataforma. Grupos sem
 * nenhum módulo publicado não são renderizados.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$groups = sisb_get_populated_groups();
?>

<main id="conteudo" class="module-page">

  <section class="module-hero">
    <div class="container">
      <?php sisb_module_breadcrumbs(); ?>

      <div style="max-width:720px">
        <span class="eyebrow"><?php echo sisb_icon( 'layers', 14 ); ?> <?php esc_html_e( 'Módulos', 'sisb' ); ?></span>
        <h1 class="module-hero-title text-balance"><?php esc_html_e( 'O que compõe a plataforma', 'sisb' ); ?></h1>
        <p class="module-hero-lead">
          <?php esc_html_e( 'O SISB acompanha a jornada da fiscalização de ponta a ponta: o que acontece na barragem, o que acontece no escritório e o que sustenta a operação. Cada módulo abaixo tem uma página com o fluxo real e as capacidades demonstráveis.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <?php if ( empty( $groups ) ) : ?>

    <section class="section">
      <div class="container">
        <p class="section-lead"><?php esc_html_e( 'Nenhum módulo publicado no momento.', 'sisb' ); ?></p>
      </div>
    </section>

  <?php else : ?>

    <?php $i = 0; foreach ( $groups as $group_slug => $group ) : $i++; ?>
      <section class="section" id="<?php echo esc_attr( $group_slug ); ?>"
               <?php if ( $i % 2 === 1 ) : ?>style="background:var(--surface)"<?php endif; ?>>
        <div class="container">
          <div style="max-width:640px">
            <span class="eyebrow">
              <?php echo sisb_icon( $group['icon'], 14 ); ?>
              <?php echo esc_html( $group['label'] ); ?>
            </span>
            <h2 class="section-title"><?php echo esc_html( $group['lead'] ); ?></h2>
          </div>

          <div class="cards cols-3">
            <?php foreach ( $group['modules'] as $slug => $item ) : ?>
              <a class="module module-link" href="<?php echo esc_url( sisb_module_url( $slug ) ); ?>">
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
        </div>
      </section>
    <?php endforeach; ?>

  <?php endif; ?>

  <section class="module-cta">
    <div class="container">
      <div class="module-cta-inner">
        <div>
          <h2 class="section-title on-dark"><?php esc_html_e( 'Qual parte da operação você quer resolver primeiro?', 'sisb' ); ?></h2>
          <p><?php esc_html_e( 'A implantação não precisa começar por tudo. Podemos apresentar o módulo mais próximo da sua urgência atual.', 'sisb' ); ?></p>
        </div>
        <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-primary btn-lg">
          <?php esc_html_e( 'Agendar demonstração', 'sisb' ); ?>
          <?php echo sisb_icon( 'arrow', 16 ); ?>
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
