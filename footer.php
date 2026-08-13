<?php
/**
 * Footer
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand">
          <span class="brand-badge"><?php echo sisb_icon( 'shield', 20 ); ?></span>
          <span>
            <div class="brand-title">SISB</div>
            <div class="brand-sub"><?php esc_html_e( 'Fiscalização de Barragens', 'sisb' ); ?></div>
          </span>
        </a>
        <p class="footer-desc"><?php esc_html_e( 'Sistema Integrado de Fiscalização de Barragens — plataforma nacional para gestão, inspeção e conformidade regulatória.', 'sisb' ); ?></p>
      </div>
      <div class="footer-cols">
        <div>
          <div class="t"><?php esc_html_e( 'Produto', 'sisb' ); ?></div>
          <ul>
            <li><a href="#funcionalidades"><?php esc_html_e( 'Funcionalidades', 'sisb' ); ?></a></li>
            <li><a href="#plataforma"><?php esc_html_e( 'Gestão de Inspeções', 'sisb' ); ?></a></li>
            <li><a href="#plataforma"><?php esc_html_e( 'Mobile', 'sisb' ); ?></a></li>
            <li><a href="#plataforma"><?php esc_html_e( 'Relatórios', 'sisb' ); ?></a></li>
          </ul>
        </div>
        <div>
          <div class="t"><?php esc_html_e( 'Mercados', 'sisb' ); ?></div>
          <ul>
            <li><a href="#contato"><?php esc_html_e( 'Agências Reguladoras', 'sisb' ); ?></a></li>
            <li><a href="#contato"><?php esc_html_e( 'Secretarias Estaduais', 'sisb' ); ?></a></li>
            <li><a href="#contato"><?php esc_html_e( 'Empresas de Engenharia', 'sisb' ); ?></a></li>
            <li><a href="#contato"><?php esc_html_e( 'Concessionárias', 'sisb' ); ?></a></li>
          </ul>
        </div>
        <div>
          <div class="t"><?php esc_html_e( 'Contato', 'sisb' ); ?></div>
          <ul>
            <li><a href="mailto:contato@sisb.gov.br">E-mail</a></li>
            <li><a href="#contato"><?php esc_html_e( 'Telefone', 'sisb' ); ?></a></li>
            <li><a href="#contato">LinkedIn</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="copyright">
      &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> SISB — <?php esc_html_e( 'Sistema Integrado de Fiscalização de Barragens', 'sisb' ); ?>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
