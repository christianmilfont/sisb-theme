<?php
/**
 * Main template — SISB Landing
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$status = isset( $_GET['sisb_status'] ) ? sanitize_key( $_GET['sisb_status'] ) : '';
$dashboard = get_template_directory_uri() . '/assets/sisb-dashboard.png';
?>

<main>

<!-- HERO -->
<section class="hero">
  <div class="container hero-grid">
    <div class="fade-up">
      <div class="seals">
        <span class="seal"><span class="dot"></span> <?php esc_html_e( 'Plataforma Enterprise', 'sisb' ); ?></span>
        <span class="seal"><span class="dot"></span> <?php esc_html_e( 'Desenvolvida para Fiscalização de Barragens', 'sisb' ); ?></span>
      </div>
      <h1 class="hero-title text-balance">
        <?php esc_html_e( 'Digitalize toda a operação de fiscalização de barragens em uma', 'sisb' ); ?>
        <span class="accent"><?php esc_html_e( 'única plataforma', 'sisb' ); ?></span>.
      </h1>
      <p class="hero-lead">
        <?php esc_html_e( 'O SISB integra inspeções, avaliações de risco, relatórios e monitoramento operacional em uma plataforma desenvolvida para órgãos públicos e operadores de barragens.', 'sisb' ); ?>
      </p>
      <div class="hero-cta">
        <a href="#contato" class="btn btn-primary btn-lg">
          <?php esc_html_e( 'Agendar Demonstração', 'sisb' ); ?>
          <?php echo sisb_icon( 'arrow', 16 ); ?>
        </a>
        <a href="#plataforma" class="btn btn-ghost btn-lg"><?php esc_html_e( 'Conhecer a Plataforma', 'sisb' ); ?></a>
      </div>
    </div>

    <div class="hero-visual fade-up delay-1">
      <div class="browser">
        <div class="browser-bar">
          <span class="dotr r"></span><span class="dotr y"></span><span class="dotr g"></span>
          <span class="browser-url"><?php echo esc_html( sisb_app_url_label() ); ?></span>
        </div>
        <img src="<?php echo esc_url( $dashboard ); ?>" alt="<?php esc_attr_e( 'Painel SISB com mapa de barragens', 'sisb' ); ?>">
      </div>
      <div class="callout c1"><span class="cico"><?php echo sisb_icon( 'activity', 14 ); ?></span> <?php esc_html_e( 'Inspeções em tempo real', 'sisb' ); ?></div>
      <div class="callout c2"><span class="cico"><?php echo sisb_icon( 'pin', 14 ); ?></span> <?php esc_html_e( 'Barragens georreferenciadas', 'sisb' ); ?></div>
      <div class="callout c3"><span class="cico"><?php echo sisb_icon( 'signal', 14 ); ?></span> <?php esc_html_e( 'Sincronização offline', 'sisb' ); ?></div>
    </div>
  </div>
</section>

<!-- CREDIBILITY -->
<section class="credibility">
  <div class="container">
    <div class="head">
      <h2><?php esc_html_e( 'Em operação real, não em protótipo', 'sisb' ); ?></h2>
      <p class="section-lead" style="margin-inline:auto"><?php esc_html_e( 'O SISB está em produção no DAEE / SP Águas, apoiando a fiscalização e a gestão de segurança de barragens do estado de São Paulo — com aplicativo de campo, back-office, portal do empreendedor e integração com o sistema de outorga já existente.', 'sisb' ); ?></p>
    </div>
    <div class="logo-grid">
      <?php
      // Fatos verificáveis do produto — não são clientes.
      $proof = array(
        __( 'Aplicativo de campo Android e iOS', 'sisb' ),
        __( 'Operação offline com sincronização', 'sisb' ),
        __( 'Back-office web', 'sisb' ),
        __( 'Portal do empreendedor', 'sisb' ),
        __( 'API de integração documentada', 'sisb' ),
        __( 'Trilha de auditoria', 'sisb' ),
      );
      foreach ( $proof as $l ) : ?>
        <div class="logo-cell"><?php echo esc_html( $l ); ?></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CHALLENGES -->
<section class="section">
  <div class="container">
    <div style="max-width:640px">
      <span class="eyebrow"><?php echo sisb_icon( 'alert', 14 ); ?> <?php esc_html_e( 'Contexto do setor', 'sisb' ); ?></span>
      <h2 class="section-title"><?php esc_html_e( 'Os desafios da fiscalização tradicional', 'sisb' ); ?></h2>
    </div>
    <div class="cards cols-4">
      <?php
      $challenges = array(
        array( 'branch',  __( 'Processos descentralizados', 'sisb' ),         __( 'Informações distribuídas entre planilhas, documentos e sistemas isolados.', 'sisb' ) ),
        array( 'search',  __( 'Baixa rastreabilidade', 'sisb' ),              __( 'Dificuldade para acompanhar histórico de inspeções e ações corretivas.', 'sisb' ) ),
        array( 'signal',  __( 'Operação em campo limitada', 'sisb' ),         __( 'Coletas realizadas manualmente e sujeitas a inconsistências.', 'sisb' ) ),
        array( 'scroll',  __( 'Conformidade regulatória complexa', 'sisb' ), __( 'Necessidade constante de atender requisitos técnicos e normativos.', 'sisb' ) ),
      );
      foreach ( $challenges as $c ) : ?>
        <div class="card">
          <div class="ico"><?php echo sisb_icon( $c[0], 20 ); ?></div>
          <h3><?php echo esc_html( $c[1] ); ?></h3>
          <p><?php echo esc_html( $c[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SOLUTION -->
<section id="plataforma" class="section" style="background:var(--surface)">
  <div class="container">
    <div style="display:grid;gap:32px;grid-template-columns:1fr">
      <div>
        <span class="eyebrow"><?php echo sisb_icon( 'layers', 14 ); ?> <?php esc_html_e( 'A solução SISB', 'sisb' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Uma plataforma completa para fiscalização de barragens', 'sisb' ); ?></h2>
      </div>
      <p class="section-lead" style="max-width:none"><?php esc_html_e( 'O SISB integra coleta de dados em campo, gestão de inspeções, avaliações técnicas e geração de relatórios em uma única solução digital — pensada para a complexidade do setor regulado.', 'sisb' ); ?></p>
    </div>
    <div class="cards cols-3">
      <?php
      $modules = array(
        array( 'list',       __( 'Coleta de Dados', 'sisb' ),           array( __( 'Formulários digitais', 'sisb' ), __( 'Captura em campo', 'sisb' ), __( 'Padronização das inspeções', 'sisb' ) ) ),
        array( 'smartphone', __( 'Aplicativo Mobile', 'sisb' ),         array( __( 'Android e iOS', 'sisb' ), __( 'Operação offline', 'sisb' ), __( 'Sincronização automática', 'sisb' ) ) ),
        array( 'shield',     __( 'Gestão de Inspeções', 'sisb' ),       array( __( 'Planejamento', 'sisb' ), __( 'Execução', 'sisb' ), __( 'Histórico completo', 'sisb' ) ) ),
        array( 'building',   __( 'Gestão de Empreendimentos', 'sisb' ), array( __( 'Cadastro de barragens', 'sisb' ), __( 'Dados técnicos', 'sisb' ), __( 'Georreferenciamento', 'sisb' ) ) ),
        array( 'chart',      __( 'Avaliação de Riscos', 'sisb' ),       array( __( 'CRI e DPA', 'sisb' ), __( 'Matrizes de risco', 'sisb' ), __( 'Indicadores', 'sisb' ) ) ),
        array( 'file',       __( 'Relatórios e Exportações', 'sisb' ),  array( __( 'PDF e relatórios técnicos', 'sisb' ), __( 'Evidências fotográficas', 'sisb' ), __( 'Compartilhamento controlado', 'sisb' ) ) ),
      );
      foreach ( $modules as $m ) : ?>
        <div class="module">
          <div class="module-head">
            <div class="module-ico"><?php echo sisb_icon( $m[0], 22 ); ?></div>
            <h3><?php echo esc_html( $m[1] ); ?></h3>
          </div>
          <ul>
            <?php foreach ( $m[2] as $b ) : ?>
              <li><span class="check"><?php echo sisb_icon( 'check-circ', 16 ); ?></span><span><?php echo esc_html( $b ); ?></span></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section id="funcionalidades" class="section">
  <div class="container">
    <div style="max-width:640px">
      <span class="eyebrow"><?php esc_html_e( 'Funcionalidades', 'sisb' ); ?></span>
      <h2 class="section-title"><?php esc_html_e( 'Recursos que apoiam toda a jornada de fiscalização', 'sisb' ); ?></h2>
    </div>
    <div class="features">
      <?php
      $feats = array(
        array( 'shield',     __( 'Gestão de Inspeções', 'sisb' ) ),
        array( 'database',   __( 'Gestão de Barragens', 'sisb' ) ),
        array( 'scroll',     __( 'Gestão de Requisitos', 'sisb' ) ),
        array( 'chart',      __( 'Avaliação de Risco', 'sisb' ) ),
        array( 'file',       __( 'Emissão de Relatórios', 'sisb' ) ),
        array( 'list',       __( 'Formulários Digitais', 'sisb' ) ),
        array( 'signal',     __( 'Operação Offline', 'sisb' ) ),
        array( 'image',      __( 'Captura de Fotos e Vídeos', 'sisb' ) ),
        array( 'search',     __( 'Gestão de Evidências', 'sisb' ) ),
        array( 'lock',       __( 'Controle de Acessos', 'sisb' ) ),
        array( 'workflow',   __( 'Workflow de Aprovação', 'sisb' ) ),
        array( 'history',    __( 'Histórico de Auditoria', 'sisb' ) ),
        array( 'pin',        __( 'Geolocalização', 'sisb' ) ),
        array( 'activity',   __( 'Dashboards Gerenciais', 'sisb' ) ),
        array( 'chart',      __( 'Indicadores Operacionais', 'sisb' ) ),
        array( 'plug',       __( 'Integrações via API', 'sisb' ) ),
      );
      foreach ( $feats as $f ) : ?>
        <div class="feat">
          <div class="feat-ico"><?php echo sisb_icon( $f[0], 18 ); ?></div>
          <span><?php echo esc_html( $f[1] ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- DIFFERENTIATORS -->
<section id="diferenciais" class="dark-section">
  <div class="container">
    <div style="max-width:640px">
      <span class="eyebrow eyebrow-dark"><?php esc_html_e( 'Diferenciais', 'sisb' ); ?></span>
      <h2 class="section-title on-dark"><?php esc_html_e( 'Por que escolher o SISB', 'sisb' ); ?></h2>
    </div>
    <div class="dark-cards">
      <?php
      $diffs = array(
        array( 'shield',   __( 'Especializado em Barragens', 'sisb' ),   __( 'Construído especificamente para processos de fiscalização e gestão de barragens.', 'sisb' ) ),
        array( 'signal',   __( 'Operação Offline', 'sisb' ),             __( 'Continuidade das atividades mesmo em locais sem conectividade.', 'sisb' ) ),
        array( 'globe',    __( 'Escalável para Todo o Brasil', 'sisb' ), __( 'Arquitetura preparada para diferentes estados, autarquias e concessionárias.', 'sisb' ) ),
        array( 'history',  __( 'Rastreabilidade Completa', 'sisb' ),     __( 'Histórico consolidado de inspeções, avaliações e ações executadas.', 'sisb' ) ),
        array( 'database', __( 'Centralização de Informações', 'sisb' ), __( 'Todos os dados técnicos e operacionais em uma única plataforma.', 'sisb' ) ),
        array( 'zap',      __( 'Redução de Processos Manuais', 'sisb' ), __( 'Maior produtividade e menor risco operacional.', 'sisb' ) ),
      );
      foreach ( $diffs as $d ) : ?>
        <div class="dark-card">
          <div class="ico"><?php echo sisb_icon( $d[0], 20 ); ?></div>
          <h3><?php echo esc_html( $d[1] ); ?></h3>
          <p><?php echo esc_html( $d[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- NATIONAL -->
<section id="mercados" class="section">
  <div class="container">
    <div class="national-grid">
      <div>
        <span class="eyebrow"><?php echo sisb_icon( 'globe', 14 ); ?> <?php esc_html_e( 'Expansão Nacional', 'sisb' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Preparado para atender órgãos e operadores em todo o Brasil', 'sisb' ); ?></h2>
        <p class="section-lead"><?php esc_html_e( 'O SISB foi desenvolvido para ser adaptável às necessidades regulatórias, operacionais e administrativas de diferentes estados, agências fiscalizadoras e organizações responsáveis pela segurança de barragens.', 'sisb' ); ?></p>
        <div class="stats">
          <?php
          // Cada número precisa ser verificável no próprio produto.
          $stats = array(
            array( '3',     __( 'Canais: app de campo, web e portal do empreendedor', 'sisb' ) ),
            array( '6',     __( 'Perfis de acesso configuráveis', 'sisb' ) ),
            array( 'Multi', __( 'Unidades regionais resolvidas por geolocalização', 'sisb' ) ),
            array( 'API',   __( 'Integração com sistemas existentes', 'sisb' ) ),
          );
          foreach ( $stats as $s ) : ?>
            <div class="stat">
              <div class="stat-v"><?php echo esc_html( $s[0] ); ?></div>
              <div class="stat-l"><?php echo esc_html( $s[1] ); ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php
      // TODO: substituir por captura real do mapa georreferenciado do parque de
      // barragens (o produto já expõe as coordenadas em /Barragem/coordinates).
      // Até lá, o bloco apresenta os fatos de arquitetura que sustentam a escala.
      ?>
      <div class="module">
        <div class="module-head">
          <div class="module-ico"><?php echo sisb_icon( 'layers', 22 ); ?></div>
          <h3><?php esc_html_e( 'O que sustenta a operação em escala', 'sisb' ); ?></h3>
        </div>
        <ul>
          <?php
          $scale = array(
            __( 'Unidades regionais com competência resolvida pela coordenada da barragem', 'sisb' ),
            __( 'Perfis de acesso distintos para órgão, equipe de campo, terceiros e empreendedor', 'sisb' ),
            __( 'Ambientes de homologação e produção isolados, com implantação automatizada', 'sisb' ),
            __( 'Importação da base existente de barragens por planilha', 'sisb' ),
            __( 'Integração com sistemas legados por API, já em produção', 'sisb' ),
          );
          foreach ( $scale as $s ) : ?>
            <li><span class="check"><?php echo sisb_icon( 'check-circ', 16 ); ?></span><span><?php echo esc_html( $s ); ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- RESULTS -->
<section class="results">
  <div class="container">
    <div style="max-width:640px">
      <span class="eyebrow"><?php esc_html_e( 'Na prática', 'sisb' ); ?></span>
      <h2 class="section-title"><?php esc_html_e( 'O que muda na operação', 'sisb' ); ?></h2>
    </div>
    <div class="result-grid">
      <?php
      // Cada item precisa ser demonstrável em uma demo do produto.
      $rs = array(
        array( 'signal',   __( 'Campo sem conectividade', 'sisb' ),   __( 'A inspeção acontece offline e sincroniza quando houver rede, sem perda de evidência.', 'sisb' ) ),
        array( 'file',     __( 'Relatório sem redigitação', 'sisb' ), __( 'O PDF é gerado a partir dos dados da vistoria, individualmente ou em lote, com anexo fotográfico.', 'sisb' ) ),
        array( 'zap',      __( 'Prazos cobrados pelo sistema', 'sisb' ), __( 'Monitores automáticos acompanham vencimentos de plano de segurança e de planos de ação e disparam notificação.', 'sisb' ) ),
        array( 'workflow', __( 'Mesmo critério em toda a equipe', 'sisb' ), __( 'O formulário de vistoria e o cálculo de risco são idênticos no aplicativo e na web.', 'sisb' ) ),
        array( 'history',  __( 'Rastreabilidade das operações', 'sisb' ), __( 'Trilha de auditoria consultável, histórico de atribuições e registro de cada sincronização.', 'sisb' ) ),
      );
      foreach ( $rs as $r ) : ?>
        <div class="result">
          <div class="ico"><?php echo sisb_icon( $r[0], 20 ); ?></div>
          <div class="result-l"><?php echo esc_html( $r[1] ); ?></div>
          <p><?php echo esc_html( $r[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section id="contato" class="contact">
  <div class="container contact-grid">
    <div>
      <h2 class="section-title on-dark"><?php esc_html_e( 'Transforme a gestão e fiscalização de barragens', 'sisb' ); ?></h2>
      <p class="contact-lead"><?php esc_html_e( 'Conheça como o SISB pode apoiar sua organização na digitalização de processos, melhoria da governança e aumento da eficiência operacional.', 'sisb' ); ?></p>
      <div class="audiences">
        <?php
        $aud = array(
          array( 'landmark', __( 'Agências Reguladoras', 'sisb' ) ),
          array( 'building', __( 'Secretarias Estaduais', 'sisb' ) ),
          array( 'hardhat',  __( 'Empresas de Engenharia', 'sisb' ) ),
          array( 'factory',  __( 'Concessionárias', 'sisb' ) ),
        );
        foreach ( $aud as $a ) : ?>
          <div class="audience"><?php echo sisb_icon( $a[0], 20 ); ?><span><?php echo esc_html( $a[1] ); ?></span></div>
        <?php endforeach; ?>
      </div>
      <?php
      $c_email    = sisb_contact_field( 'email' );
      $c_phone    = sisb_contact_field( 'phone' );
      $c_linkedin = sisb_contact_field( 'linkedin' );
      if ( $c_email || $c_phone || $c_linkedin ) : ?>
        <div class="contact-info">
          <?php if ( $c_email ) : ?>
            <div><?php echo sisb_icon( 'mail', 16 ); ?> <a href="mailto:<?php echo esc_attr( $c_email ); ?>"><?php echo esc_html( $c_email ); ?></a></div>
          <?php endif; ?>
          <?php if ( $c_phone ) : ?>
            <div><?php echo sisb_icon( 'phone', 16 ); ?> <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $c_phone ) ); ?>"><?php echo esc_html( $c_phone ); ?></a></div>
          <?php endif; ?>
          <?php if ( $c_linkedin ) : ?>
            <div><?php echo sisb_icon( 'linkedin', 16 ); ?> <a href="<?php echo esc_url( $c_linkedin ); ?>" target="_blank" rel="noopener">LinkedIn</a></div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>

    <form class="form-card" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
      <input type="hidden" name="action" value="sisb_demo_form">
      <?php wp_nonce_field( 'sisb_demo_form', 'sisb_nonce' ); ?>
      <!-- Honeypot -->
      <input type="text" name="website" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px" aria-hidden="true">

      <h3><?php esc_html_e( 'Solicitar demonstração', 'sisb' ); ?></h3>
      <p class="subline"><?php esc_html_e( 'Nossa equipe responderá em até 1 dia útil.', 'sisb' ); ?></p>

      <?php if ( $status === 'ok' ) : ?>
        <div class="form-alert">
          <?php echo sisb_icon( 'check-circ', 40 ); ?>
          <div class="t"><?php esc_html_e( 'Solicitação registrada', 'sisb' ); ?></div>
          <p><?php esc_html_e( 'Obrigado pelo interesse. Entraremos em contato em breve.', 'sisb' ); ?></p>
        </div>
      <?php else : ?>
        <?php if ( $status === 'error' ) : ?>
          <div class="form-error">
            <?php
            $fallback = sisb_contact_field( 'email' );
            if ( $fallback ) {
                printf(
                    /* translators: %s: e-mail público de contato */
                    esc_html__( 'Não foi possível enviar sua solicitação. Tente novamente ou escreva diretamente para %s.', 'sisb' ),
                    esc_html( $fallback )
                );
            } else {
                esc_html_e( 'Não foi possível enviar sua solicitação. Tente novamente em instantes.', 'sisb' );
            }
            ?>
          </div>
        <?php elseif ( $status === 'invalid' ) : ?>
          <div class="form-error"><?php esc_html_e( 'Verifique os campos obrigatórios (Nome, Organização e E-mail).', 'sisb' ); ?></div>
        <?php endif; ?>

        <div class="form-grid">
          <label class="field">
            <span class="label"><?php esc_html_e( 'Nome', 'sisb' ); ?><span class="req"> *</span></span>
            <input type="text" name="nome" required>
          </label>
          <label class="field">
            <span class="label"><?php esc_html_e( 'Organização', 'sisb' ); ?><span class="req"> *</span></span>
            <input type="text" name="org" required>
          </label>
          <label class="field">
            <span class="label"><?php esc_html_e( 'Cargo', 'sisb' ); ?></span>
            <input type="text" name="cargo">
          </label>
          <label class="field">
            <span class="label"><?php esc_html_e( 'E-mail', 'sisb' ); ?><span class="req"> *</span></span>
            <input type="email" name="email" required>
          </label>
          <label class="field full">
            <span class="label"><?php esc_html_e( 'Telefone', 'sisb' ); ?></span>
            <input type="tel" name="tel">
          </label>
          <label class="field full">
            <span class="label"><?php esc_html_e( 'Mensagem', 'sisb' ); ?></span>
            <textarea name="msg" rows="4"></textarea>
          </label>
          <button type="submit" class="btn btn-primary">
            <?php esc_html_e( 'Solicitar Demonstração', 'sisb' ); ?>
            <?php echo sisb_icon( 'arrow', 16 ); ?>
          </button>
        </div>
      <?php endif; ?>
    </form>
  </div>
</section>

</main>

<?php get_footer(); ?>
