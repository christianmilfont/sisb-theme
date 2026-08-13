<?php
/**
 * Página institucional: Segurança e Proteção de Dados
 *
 * Descreve o que está implantado hoje em controle de acesso, rastreabilidade,
 * infraestrutura e tratamento de dados pessoais. Nada aqui é alegação de
 * certificação ou de conformidade atestada: o que não estiver documentado em
 * doc/architecture.md e doc/product-modules.md aparece como pendência de
 * detalhamento, em blocos .note.
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
        <span class="eyebrow"><?php echo sisb_icon( 'lock', 14 ); ?> <?php esc_html_e( 'Segurança', 'sisb' ); ?></span>
        <h1 class="module-hero-title text-balance"><?php esc_html_e( 'Segurança e proteção de dados', 'sisb' ); ?></h1>
        <p class="module-hero-lead">
          <?php esc_html_e( 'O SISB trata dados de infraestrutura crítica e dados pessoais de empreendedores e de servidores. Esta página descreve o que está implantado hoje: perfis de acesso, autenticação, trilha de auditoria, hospedagem, backup e isolamento de ambientes.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <!-- ============ CONTROLE DE ACESSO ============ -->
  <section class="section">
    <div class="container">
      <div style="max-width:640px">
        <span class="eyebrow"><?php echo sisb_icon( 'shield', 14 ); ?> <?php esc_html_e( 'Controle de acesso', 'sisb' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Cada pessoa vê o que o seu papel permite', 'sisb' ); ?></h2>
      </div>

      <div class="prose">
        <p>
          <?php esc_html_e( 'O sistema nasceu multiperfil. O papel do usuário define as telas do menu, as operações da API e os dados que descem para o aplicativo de campo. Não há perfil único com acesso indiferenciado ao conjunto da base.', 'sisb' ); ?>
        </p>
      </div>

      <div class="assurance">
        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'shield', 22 ); ?></div>
          <h3><?php esc_html_e( 'Seis perfis distintos', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'Administrador, fiscal analista, fiscal de campo, terceiro contratado, empreendedor e usuário base. Cada um com um conjunto próprio de permissões.', 'sisb' ); ?></p>
        </div>

        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'lock', 22 ); ?></div>
          <h3><?php esc_html_e( 'Sessão com token e renovação', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'A autenticação emite um token de sessão, renovado por token de atualização. O encerramento de sessão é uma operação explícita da API.', 'sisb' ); ?></p>
        </div>

        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'plug', 22 ); ?></div>
          <h3><?php esc_html_e( 'Dois esquemas em paralelo', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'Token de usuário para pessoas e chave de serviço para integrações entre sistemas. As chaves podem ser emitidas, regeneradas, desativadas e excluídas sem afetar contas de usuário.', 'sisb' ); ?></p>
        </div>

        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'check-circ', 22 ); ?></div>
          <h3><?php esc_html_e( 'Ciclo de vida da conta', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'Redefinição de senha por e-mail, troca de senha pelo próprio usuário e habilitação ou desabilitação da conta pela administração, sem exclusão de registro.', 'sisb' ); ?></p>
        </div>

        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'layers', 22 ); ?></div>
          <h3><?php esc_html_e( 'Menu filtrado por perfil', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'A navegação do back-office é montada item a item conforme os papéis autorizados. Telas administrativas, como a de auditoria, ficam restritas ao perfil de administrador.', 'sisb' ); ?></p>
        </div>

        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'pin', 22 ); ?></div>
          <h3><?php esc_html_e( 'Dados no dispositivo por designação', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'O aplicativo de campo não baixa a base inteira. A administração designa quais empreendimentos vão para cada dispositivo, e é isso que fica disponível fora de rede.', 'sisb' ); ?></p>
        </div>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'alert', 20 ); ?>
        <p>
          <strong><?php esc_html_e( 'Sobre o escopo desta página.', 'sisb' ); ?></strong>
          <?php esc_html_e( 'O texto descreve controles implantados e verificáveis em demonstração. Não há aqui alegação de certificação de segurança da informação nem de auditoria independente. Quando um item ainda não está documentado, ele aparece nesta página como pendência, e não como afirmação.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <!-- ============ RASTREABILIDADE ============ -->
  <section class="section" style="background:var(--surface)">
    <div class="container">
      <div style="max-width:640px">
        <span class="eyebrow"><?php echo sisb_icon( 'history', 14 ); ?> <?php esc_html_e( 'Rastreabilidade', 'sisb' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'O que foi feito, por quem e quando', 'sisb' ); ?></h2>
      </div>

      <div class="prose">
        <p>
          <?php esc_html_e( 'Fiscalização gera ato administrativo. O sistema registra os eventos relevantes em trilhas consultáveis dentro do próprio produto, sem depender de leitura de log de servidor.', 'sisb' ); ?>
        </p>
      </div>

      <div class="assurance">
        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'search', 22 ); ?></div>
          <h3><?php esc_html_e( 'Trilha de auditoria consultável', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'Os eventos de auditoria ficam em tela própria do back-office, com consulta pela equipe administradora. É registro de aplicação, exposto ao usuário autorizado.', 'sisb' ); ?></p>
        </div>

        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'workflow', 22 ); ?></div>
          <h3><?php esc_html_e( 'Histórico de atribuições técnicas', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'A responsabilidade técnica sobre cada processo tem histórico próprio: quem estava designado, desde quando e o que mudou na designação.', 'sisb' ); ?></p>
        </div>

        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'signal', 22 ); ?></div>
          <h3><?php esc_html_e( 'Registro de cada sincronização', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'Toda sincronização entre aplicativo de campo e servidor guarda o seu registro. Divergência de dado coletado pode ser reconstituída a partir do que o dispositivo enviou.', 'sisb' ); ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ INFRAESTRUTURA E DADOS ============ -->
  <section class="section">
    <div class="container">
      <div style="max-width:640px">
        <span class="eyebrow"><?php echo sisb_icon( 'database', 14 ); ?> <?php esc_html_e( 'Infraestrutura', 'sisb' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Onde os dados ficam e como são preservados', 'sisb' ); ?></h2>
      </div>

      <div class="prose">
        <p>
          <?php esc_html_e( 'A tabela abaixo descreve a instalação atual. Ela serve de base para a avaliação técnica da sua área de TI e pode ser adaptada ao ambiente do órgão, inclusive em infraestrutura própria.', 'sisb' ); ?>
        </p>
      </div>

      <div class="spec-wrap">
        <table class="spec">
          <thead>
            <tr>
              <th><?php esc_html_e( 'Item', 'sisb' ); ?></th>
              <th><?php esc_html_e( 'Como está implantado hoje', 'sisb' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th><?php esc_html_e( 'Hospedagem', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Servidor na Amazon Web Services. As aplicações rodam em contêineres, com proxy reverso à frente dos serviços web e da API. O acesso do navegador é feito por HTTPS.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Banco de dados', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'SQL Server 2022, em contêiner próprio de cada ambiente, com volume persistente. Não há banco compartilhado entre homologação e produção.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Arquivos e imagens', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Amazon S3, em repositórios separados por finalidade: anexos, imagens de vistoria, documentos e relatórios. A separação também é por ambiente.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Backup', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Cópia diária do banco de produção, compactada e enviada para repositório de backup no Amazon S3, com retenção de sete dias.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Ambientes', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Homologação e produção são ambientes isolados: endereços, contêineres, bancos e repositórios de arquivo distintos. Homologação recebe a versão antes da produção.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Publicação de versão', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Automatizada por pipeline. Cada versão vira uma imagem versionada em registro privado, publicada primeiro em homologação e depois em produção, a partir do controle de versão.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Monitoramento de erros', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'As exceções de homologação e de produção são enviadas para um serviço de monitoramento, com identificação do ambiente de origem.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Entrega de e-mail', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Em produção, provedor externo de envio, por SMTP com SSL, com fila e nova tentativa em caso de falha. Em homologação, servidor de e-mail interno ao ambiente: mensagem de teste não chega a destinatário real.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Dados no dispositivo', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'O aplicativo mantém base local no aparelho, restrita aos empreendimentos designados, e sincroniza com a API quando há rede.', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th><?php esc_html_e( 'Distribuição do aplicativo', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'O aplicativo de campo é distribuído por plataforma de distribuição controlada, para grupos de testadores definidos, e não por loja pública aberta.', 'sisb' ); ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'alert', 20 ); ?>
        <p>
          <strong><?php esc_html_e( 'Itens que a equipe detalha sob demanda.', 'sisb' ); ?></strong>
          <?php esc_html_e( 'Criptografia em repouso, política de restauração e teste periódico de backup, plano de continuidade, segregação de rede e retenção de registros de acesso não estão descritos na documentação técnica pública. Na avaliação com a área de TI, a equipe apresenta a situação de cada um desses pontos, sem generalizar.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <!-- ============ DADOS PESSOAIS ============ -->
  <section class="section" style="background:var(--surface)">
    <div class="container">
      <div style="max-width:640px">
        <span class="eyebrow"><?php echo sisb_icon( 'file', 14 ); ?> <?php esc_html_e( 'Dados pessoais', 'sisb' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Que dado pessoal o sistema trata e para quê', 'sisb' ); ?></h2>
      </div>

      <div class="prose">
        <h2><?php esc_html_e( 'Categorias tratadas', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'O tratamento é o necessário para identificar o responsável por uma barragem e para conduzir o processo de fiscalização. Em linhas gerais:', 'sisb' ); ?>
        </p>
        <ul>
          <li><?php esc_html_e( 'Empreendedores e responsáveis: nome ou razão social, CPF ou CNPJ, endereço, telefone e e-mail.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'Servidores e técnicos usuários do sistema: nome, e-mail, perfil de acesso e situação da conta.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'Autoria dos atos: cada lançamento, vistoria e tramitação fica associado ao usuário que o registrou e ao momento do registro.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'Contexto de campo: coordenadas e imagens da estrutura inspecionada, coletadas para instruir o processo.', 'sisb' ); ?></li>
        </ul>

        <h2><?php esc_html_e( 'Finalidade', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'O uso é o exercício da fiscalização de segurança de barragens: identificar o responsável legal pela estrutura, notificá-lo, instruir o processo administrativo e manter o registro do que foi apurado. Dados de contato servem às comunicações do próprio processo.', 'sisb' ); ?>
        </p>

        <h2><?php esc_html_e( 'Controles que existem hoje', 'sisb' ); ?></h2>
        <ul>
          <li><?php esc_html_e( 'Acesso segmentado por perfil, com menu e operações filtrados papel a papel.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'Trilha de auditoria consultável, restrita ao perfil de administrador.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'Conta desabilitável sem perda do histórico dos atos já praticados.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'Ambientes de homologação e produção isolados, com bases distintas.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'Em homologação, o envio de e-mail permanece contido no ambiente.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'No dispositivo de campo, presença de dado limitada aos empreendimentos designados.', 'sisb' ); ?></li>
          <li><?php esc_html_e( 'Portal do empreendedor com escopo próprio: o titular acessa o que é dele, não a base de fiscalização.', 'sisb' ); ?></li>
        </ul>

        <h2><?php esc_html_e( 'Sobre a LGPD', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'A plataforma foi construída para apoiar o atendimento à Lei Geral de Proteção de Dados pelo órgão que a opera: segmentação de acesso, registro de autoria e trilha de eventos são pré-requisitos técnicos desse atendimento.', 'sisb' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'O controlador dos dados é o órgão público. A definição da base legal, do prazo de guarda e do fluxo de resposta ao titular cabe a ele, e é o órgão quem atesta a sua própria conformidade. O papel do fornecedor é implementar os controles acordados e documentar o que o sistema faz.', 'sisb' ); ?>
        </p>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'alert', 20 ); ?>
        <p>
          <strong><?php esc_html_e( 'O que precisa ser definido em conjunto.', 'sisb' ); ?></strong>
          <?php esc_html_e( 'Prazo de guarda e rotina de eliminação de dado pessoal, fluxo de atendimento a pedidos de titular, indicação de encarregado e cláusulas de operador no contrato não são decisões do produto. A equipe detalha sob demanda o que o sistema já suporta e o que exige acordo com a área jurídica do órgão.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <section class="module-cta">
    <div class="container">
      <div class="module-cta-inner">
        <div>
          <h2 class="section-title on-dark"><?php esc_html_e( 'Sua área de TI tem um questionário a preencher?', 'sisb' ); ?></h2>
          <p><?php esc_html_e( 'Podemos responder item a item, com a documentação técnica do sistema e o que estiver pendente indicado como pendente.', 'sisb' ); ?></p>
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
