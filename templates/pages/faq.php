<?php
/**
 * Página institucional: Perguntas Frequentes
 *
 * As perguntas vêm de inc/faq-items.php, carregado por functions.php, que
 * também alimenta o JSON-LD de FAQPage em inc/schema.php.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$page = sisb_current_static_page();

get_header();
?>

<main id="conteudo" class="module-page">

  <section class="module-hero">
    <div class="container">
      <?php sisb_static_page_breadcrumbs( $page ); ?>
      <div style="max-width:720px">
        <span class="eyebrow"><?php echo sisb_icon( 'search', 14 ); ?> <?php esc_html_e( 'Perguntas frequentes', 'sisb' ); ?></span>
        <h1 class="module-hero-title text-balance"><?php esc_html_e( 'O que costumam perguntar antes da demonstração', 'sisb' ); ?></h1>
        <p class="module-hero-lead"><?php esc_html_e( 'Escopo do produto, operação em campo sem sinal, entrada da base existente, integração com o sistema legado e tratamento dos dados. Inclusive o que o SISB não faz — é mais barato descobrir isso agora.', 'sisb' ); ?></p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="prose">
        <?php foreach ( sisb_faq_items() as $group ) : ?>
          <div class="faq-group">
            <h2><?php echo esc_html( $group['title'] ); ?></h2>
            <div class="faq-list">
              <?php foreach ( $group['items'] as $item ) : ?>
                <details class="faq-item">
                  <summary><?php echo esc_html( $item['q'] ); ?></summary>
                  <div class="faq-answer"><p><?php echo esc_html( $item['a'] ); ?></p></div>
                </details>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="module-cta">
    <div class="container">
      <div class="module-cta-inner">
        <div>
          <h2 class="section-title on-dark"><?php esc_html_e( 'Ficou uma pergunta que não está aqui?', 'sisb' ); ?></h2>
          <p><?php esc_html_e( 'Pergunte diretamente. Se a resposta for que o produto ainda não faz aquilo, é o que você vai ouvir.', 'sisb' ); ?></p>
        </div>
        <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-primary btn-lg">
          <?php esc_html_e( 'Falar com a equipe', 'sisb' ); ?>
          <?php echo sisb_icon( 'arrow', 16 ); ?>
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
