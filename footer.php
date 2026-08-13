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
            <?php if ( sisb_get_modules() ) : ?>
              <li><a href="<?php echo esc_url( sisb_modules_url() ); ?>"><?php esc_html_e( 'Módulos', 'sisb' ); ?></a></li>
            <?php endif; ?>
            <li><a href="<?php echo esc_url( sisb_anchor( '#plataforma' ) ); ?>"><?php esc_html_e( 'A plataforma', 'sisb' ); ?></a></li>
            <li><a href="<?php echo esc_url( sisb_anchor( '#como-funciona' ) ); ?>"><?php esc_html_e( 'Como funciona', 'sisb' ); ?></a></li>
            <li><a href="<?php echo esc_url( sisb_anchor( '#diferenciais' ) ); ?>"><?php esc_html_e( 'Diferenciais', 'sisb' ); ?></a></li>
            <li><a href="<?php echo esc_url( sisb_anchor( '#mercados' ) ); ?>"><?php esc_html_e( 'Operação em escala', 'sisb' ); ?></a></li>
          </ul>
        </div>
        <div>
          <div class="t"><?php esc_html_e( 'Recursos', 'sisb' ); ?></div>
          <ul>
            <?php foreach ( sisb_get_static_pages() as $ft_slug => $ft_page ) : ?>
              <li><a href="<?php echo esc_url( sisb_static_page_url( $ft_slug ) ); ?>"><?php echo esc_html( $ft_page['nav_label'] ); ?></a></li>
            <?php endforeach; ?>
            <li><a href="<?php echo esc_url( sisb_anchor( '#mercados' ) ); ?>"><?php esc_html_e( 'Setores atendidos', 'sisb' ); ?></a></li>
          </ul>
        </div>
        <div>
          <div class="t"><?php esc_html_e( 'Contato', 'sisb' ); ?></div>
          <ul>
            <li><a href="<?php echo esc_url( sisb_anchor( '#contato' ) ); ?>"><?php esc_html_e( 'Agendar demonstração', 'sisb' ); ?></a></li>
            <?php
            $f_email    = sisb_contact_field( 'email' );
            $f_phone    = sisb_contact_field( 'phone' );
            $f_linkedin = sisb_contact_field( 'linkedin' );
            ?>
            <?php if ( $f_email ) : ?>
              <li><a href="mailto:<?php echo esc_attr( $f_email ); ?>"><?php echo esc_html( $f_email ); ?></a></li>
            <?php endif; ?>
            <?php if ( $f_phone ) : ?>
              <li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $f_phone ) ); ?>"><?php echo esc_html( $f_phone ); ?></a></li>
            <?php endif; ?>
            <?php if ( $f_linkedin ) : ?>
              <li><a href="<?php echo esc_url( $f_linkedin ); ?>" target="_blank" rel="noopener">LinkedIn</a></li>
            <?php endif; ?>
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
