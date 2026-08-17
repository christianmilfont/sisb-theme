<?php
/**
 * Main template — SISB Landing
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$status = isset( $_GET['sisb_status'] ) ? sanitize_key( $_GET['sisb_status'] ) : '';
$dashboard = get_template_directory_uri() . '/assets/sisb-dashboard.png';
?>

<main id="conteudo">

<!-- HERO -->
<section class="hero">
  <div class="container hero-grid">
    <div class="fade-up">
      
      <!-- BADGE DE AUTORIDADE E PROVA SOCIAL -->
      <div class="hero-badge" style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; font-size: 13px; font-weight: 600; margin-bottom: 20px;">
        <span class="cico" style="color: #10b981;"><?php echo sisb_icon( 'shield', 14 ); ?></span>
        <span><?php esc_html_e( 'Em produção e validado no DAEE / SP Águas', 'sisb' ); ?></span>
      </div>

      <!-- TÍTULO FOCADO NO BENEFÍCIO/RESULTADO -->
      <h1 class="hero-title text-balance">
        <?php esc_html_e( 'Garanta 100% de conformidade e automação na', 'sisb' ); ?>
        <span class="accent"><?php esc_html_e( 'fiscalização de barragens', 'sisb' ); ?></span>.
      </h1>

      <!-- SUBTÍTULO DIRETO E ESCANEÁVEL -->
      <p class="hero-lead">
        <?php esc_html_e( 'Do campo à conformidade regulatória. Coleta offline via app, avaliação de risco automática, gestão de prazos e portal do empreendedor em uma única operação.', 'sisb' ); ?>
      </p>

      <!-- CTAS COM HIERARQUIA DE CONVERSÃO CORRIGIDA -->
      <div class="hero-cta">
        <a href="#contato" class="btn btn-primary btn-lg">
          <?php esc_html_e( 'Agendar demonstração', 'sisb' ); ?>
          <?php echo sisb_icon( 'arrow', 16 ); ?>
        </a>
        <a href="#como-funciona" class="btn btn-ghost btn-lg">
          <?php esc_html_e( 'Ver o SISB em operação', 'sisb' ); ?>
        </a>
      </div>

    </div>

    <!-- MOCKUP E CALLOUTS DE OPERAÇÃO REAL -->
    <div class="hero-visual fade-up delay-1">
      <div class="browser">
        <div class="browser-bar">
          <span class="dotr r"></span><span class="dotr y"></span><span class="dotr g"></span>
          <span class="browser-url"><?php echo esc_html( sisb_app_url_label() ); ?></span>
        </div>
        <img src="<?php echo esc_url( $dashboard ); ?>" alt="<?php esc_attr_e( 'Painel do SISB em produção no DAEE/SP Águas', 'sisb' ); ?>">
      </div>
      
      <!-- CALLOUTS REDIGIDOS PARA COMUNICAR DORES RESOLVIDAS -->
      <div class="callout c1"><span class="cico"><?php echo sisb_icon( 'shield', 14 ); ?></span> <?php esc_html_e( 'Validação no DAEE / SP Águas', 'sisb' ); ?></div>
      <div class="callout c2"><span class="cico"><?php echo sisb_icon( 'signal', 14 ); ?></span> <?php esc_html_e( 'Inspeção 100% Offline', 'sisb' ); ?></div>
      <div class="callout c3"><span class="cico"><?php echo sisb_icon( 'activity', 14 ); ?></span> <?php esc_html_e( 'Cobrança de Prazos Automática', 'sisb' ); ?></div>
    </div>
  </div>
</section>

<!-- CREDIBILITY -->
<section class="credibility">
  <div class="container">
    <div class="head">
      <h2><?php esc_html_e( 'Em operação real, não em protótipo', 'sisb' ); ?></h2>
      <p class="section-lead" style="margin-inline:auto"><?php esc_html_e( 'O SISB está em produção no DAEE / SP Águas, apoiando a fiscalização e a gestão de segurança de barragens do estado de São Paulo, com aplicativo de campo, back-office, portal do empreendedor e integração com o sistema de outorga já existente.', 'sisb' ); ?></p>
    </div>
    <div class="logo-grid">
      <?php
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
        array( 'branch',  __( 'Processos descentralizados', 'sisb' ), __( 'Informações distribuídas entre planilhas, documentos e sistemas isolados.', 'sisb' ) ),
        array( 'search',  __( 'Baixa rastreabilidade', 'sisb' ), __( 'Dificuldade para acompanhar histórico de inspeções e ações corretivas.', 'sisb' ) ),
        array( 'signal',  __( 'Operação em campo limitada', 'sisb' ), __( 'Coletas realizadas manualmente e sujeitas a inconsistências.', 'sisb' ) ),
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
        <span class="eyebrow"><?php echo sisb_icon( 'layers', 14 ); ?> <?php esc_html_e( 'A plataforma', 'sisb' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Doze módulos, três frentes de trabalho', 'sisb' ); ?></h2>
      </div>
      <p class="section-lead" style="max-width:none"><?php esc_html_e( 'O que acontece na barragem, o que acontece no escritório e o que sustenta a operação. Cada módulo tem uma página com o fluxo real e as capacidades que podem ser verificadas em uma demonstração.', 'sisb' ); ?></p>
    </div>

    <?php
    foreach ( sisb_get_populated_groups() as $group ) : ?>
      <div class="group-head">
        <?php echo sisb_icon( $group['icon'], 16 ); ?>
        <h3><?php echo esc_html( $group['label'] ); ?></h3>
      </div>
      <div class="cards cols-3 tight">
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
    <?php endforeach; ?>
  </div>
</section>

<!-- COMO FUNCIONA -->
<section id="como-funciona" class="section">
  <div class="container">
    <div style="max-width:640px">
      <span class="eyebrow"><?php echo sisb_icon( 'workflow', 14 ); ?> <?php esc_html_e( 'Como funciona', 'sisb' ); ?></span>
      <h2 class="section-title"><?php esc_html_e( 'Um ciclo, quatro etapas', 'sisb' ); ?></h2>
      <p class="section-lead"><?php esc_html_e( 'A fiscalização não termina na inspeção. O que dá trabalho é o que vem depois. É aí que planilha e e-mail param de funcionar.', 'sisb' ); ?></p>
    </div>
    <ol class="steps cols-4">
      <?php
      $flow = array(
        array(
          __( 'Campo', 'sisb' ),
          __( 'O fiscal inspeciona com o aplicativo, sem depender de sinal. Formulário por tipo de barragem, evidência fotográfica com coordenada e nível de perigo calculated na hora.', 'sisb' ),
        ),
        array(
          __( 'Análise', 'sisb' ),
          __( 'No escritório, a vistoria alimenta a avaliação de risco. Categoria de risco e dano potencial saem do mesmo motor de cálculo usado em campo, e a barragem é posicionada na matriz.', 'sisb' ),
        ),
        array(
          __( 'Conformidade', 'sisb' ),
          __( 'O que a inspeção apontou vira item de plano de ação, com responsável e prazo. O empreendedor propõe a resolução pelo portal e o analista aprova ou rejeita.', 'sisb' ),
        ),
        array(
          __( 'Prestação de contas', 'sisb' ),
          __( 'Relatório em PDF gerado a partir dos dados, com anexo fotográfico. Trilha de auditoria das operações e painel com a evolução do parque ao longo do tempo.', 'sisb' ),
        ),
      );
      foreach ( $flow as $i => $step ) : ?>
        <li class="step">
          <div class="step-n" aria-hidden="true"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></div>
          <div>
            <h3><?php echo esc_html( $step[0] ); ?></h3>
            <p><?php echo esc_html( $step[1] ); ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- DIFFERENTIATORS -->
<section id="diferenciais" class="dark-section">
  <div class="container">
    <div style="max-width:640px">
      <span class="eyebrow eyebrow-dark"><?php esc_html_e( 'Diferenciais', 'sisb' ); ?></span>
      <h2 class="section-title on-dark"><?php esc_html_e( 'O que distingue o SISB', 'sisb' ); ?></h2>
    </div>
    <div class="dark-cards">
      <?php
      $diffs = array(
        array( 'shield',   __( 'Duas cadeias de fiscalização', 'sisb' ), __( 'Segurança de barragem e fiscalização de outorga no mesmo produto, sobre a mesma base de empreendimentos, barragens e unidades.', 'sisb' ) ),
        array( 'building', __( 'Plataforma de duas pontas', 'sisb' ), __( 'O órgão fiscalizador e o empreendedor operam no mesmo sistema. O que o regulado responde entra direto no fluxo do analista.', 'sisb' ) ),
        array( 'zap',      __( 'Prazo cobrado automaticamente', 'sisb' ), __( 'Serviços em segundo plano acompanham os vencimentos do plano de segurança e do plano de melhoria, e notificam sem ação humana.', 'sisb' ) ),
        array( 'signal',   __( 'Campo sem conectividade', 'sisb' ), __( 'Banco de dados relacional no dispositivo, não apenas formulário em cache. A inspeção é concluída offline e sincroniza depois.', 'sisb' ) ),
        array( 'workflow', __( 'Mesmo critério nos dois canais', 'sisb' ), __( 'O formulário de vistoria e o cálculo de risco são idênticos no aplicativo e na web. A vistoria não muda de critério ao mudar de tela.', 'sisb' ) ),
        array( 'database', __( 'Começa com a base que já existe', 'sisb' ), __( 'Importação do parque de barragens por planilha e integração com o sistema de outorga em uso. Esta última já está rodando em produção.', 'sisb' ) ),
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
      $rs = array(
        array( 'signal',   __( 'Campo sem conectividade', 'sisb' ), __( 'A inspeção acontece offline e sincroniza quando houver rede, sem perda de evidência.', 'sisb' ) ),
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