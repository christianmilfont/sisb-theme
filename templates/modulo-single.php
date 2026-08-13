<?php
/**
 * Template de uma página de módulo.
 *
 * Servido por template_include a partir de inc/modules.php para a rota
 * /modulos/<slug>/. Todas as páginas de módulo compartilham exatamente esta
 * sequência de seções — a consistência é o que faz o conjunto parecer um
 * produto, e não uma coleção de textos.
 *
 * Seções opcionais se auto-omitem quando o registro não traz os dados.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$module = sisb_current_module();

if ( ! $module ) {
    // Guarda de segurança: template_include já filtra, mas acesso direto não.
    wp_safe_redirect( sisb_modules_url() );
    exit;
}

get_header();
?>

<main class="module-page">
  <?php
  sisb_module_part( 'hero',          $module );
  sisb_module_part( 'problema',      $module );
  sisb_module_part( 'como-funciona', $module );
  sisb_module_part( 'screenshot',    $module );
  sisb_module_part( 'capacidades',   $module );
  sisb_module_part( 'destaque',      $module );
  sisb_module_part( 'contexto',      $module );
  sisb_module_part( 'roadmap',       $module );
  sisb_module_part( 'relacionados',  $module );
  sisb_module_part( 'cta',           $module );
  ?>
</main>

<?php get_footer(); ?>
