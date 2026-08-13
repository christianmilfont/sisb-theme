<?php
/**
 * Página institucional: API e Integração
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
        <span class="eyebrow"><?php echo sisb_icon( 'plug', 14 ); ?> <?php esc_html_e( 'API e Integração', 'sisb' ); ?></span>
        <h1 class="module-hero-title text-balance"><?php esc_html_e( 'A mesma API que sustenta o produto é a que integra o seu sistema', 'sisb' ); ?></h1>
        <p class="module-hero-lead">
          <?php esc_html_e( 'O SISB é uma API REST em ASP.NET Core 9 com três clientes sobre ela: o aplicativo de campo, o back-office web e o portal do empreendedor. Não há uma API secundária de integração, mantida à parte. Sistemas terceiros consomem a mesma superfície que o produto usa todos os dias.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="prose">
        <h2><?php esc_html_e( 'Dois esquemas de autenticação, em paralelo', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'A API aceita duas formas de autenticação ao mesmo tempo, configuradas lado a lado no back-end. A escolha depende de quem chama: uma pessoa em uma sessão, ou um sistema executando uma rotina.', 'sisb' ); ?>
        </p>

        <h3><?php esc_html_e( 'Token de usuário', 'sisb' ); ?></h3>
        <p>
          <?php esc_html_e( 'Esquema JWT Bearer. O token é emitido no login e representa um usuário nomeado, com o seu papel de acesso. A sessão tem renovação por refresh token e encerramento por logout, além dos fluxos de troca e redefinição de senha. É o que os canais do produto usam.', 'sisb' ); ?>
        </p>
        <p>
          <strong><?php esc_html_e( 'Use quando', 'sisb' ); ?></strong>
          <?php esc_html_e( 'a ação precisa ser atribuída a uma pessoa e respeitar o papel dela — inclusive na trilha de auditoria.', 'sisb' ); ?>
        </p>

        <h3><?php esc_html_e( 'Chave de serviço', 'sisb' ); ?></h3>
        <p>
          <?php esc_html_e( 'Esquema de API Key, para tráfego sistema a sistema. Não há sessão nem usuário por trás: a chave identifica o sistema integrado, e o seu ciclo de vida é administrado no SISB. É o caminho de rotinas automáticas, como uma carga noturna vinda de outro sistema do órgão.', 'sisb' ); ?>
        </p>
        <p>
          <strong><?php esc_html_e( 'Use quando', 'sisb' ); ?></strong>
          <?php esc_html_e( 'a chamada parte de um servidor, sem uma pessoa na frente, e precisa continuar funcionando sem depender de uma senha de alguém.', 'sisb' ); ?>
        </p>
      </div>

      <div class="spec-wrap">
        <table class="spec">
          <thead>
            <tr>
              <th scope="col"><?php esc_html_e( 'Aspecto', 'sisb' ); ?></th>
              <th scope="col"><?php esc_html_e( 'Token de usuário', 'sisb' ); ?></th>
              <th scope="col"><?php esc_html_e( 'Chave de serviço', 'sisb' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><?php esc_html_e( 'Esquema', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'JWT Bearer', 'sisb' ); ?></td>
              <td><?php esc_html_e( 'API Key', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Identidade', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Usuário nomeado, com papel de acesso', 'sisb' ); ?></td>
              <td><?php esc_html_e( 'Sistema integrado', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Ciclo de vida', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Login, renovação por refresh token, logout', 'sisb' ); ?></td>
              <td><?php esc_html_e( 'Emissão, regeneração, ativação, desativação e exclusão', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Uso típico', 'sisb' ); ?></th>
              <td><?php esc_html_e( 'Aplicativo de campo, back-office web, portal do empreendedor', 'sisb' ); ?></td>
              <td><?php esc_html_e( 'Rotinas automáticas entre sistemas', 'sisb' ); ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <pre class="code"><span class="c"><?php echo esc_html__( '# Token de usuário: emitido no login, renovável por refresh token.', 'sisb' ); ?></span>
<?php echo esc_html( 'Authorization: Bearer <token>' ); ?>

<span class="c"><?php echo esc_html__( '# Tráfego sistema a sistema usa chave de serviço, emitida no SISB.', 'sisb' ); ?></span>
<?php echo esc_html( 'X-API-Key: <chave>' ); ?>

<span class="c"><?php echo esc_html__( '# O contrato de cada endpoint consta da especificação publicada pela API.', 'sisb' ); ?></span></pre>
    </div>
  </section>

  <section class="section" style="background:var(--surface)">
    <div class="container">
      <div class="prose">
        <h2><?php esc_html_e( 'Gestão das chaves de serviço', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'A chave não é um segredo estático distribuído por e-mail e esquecido. Ela tem administração própria dentro do sistema, o que permite responder a um incidente sem parar a integração.', 'sisb' ); ?>
        </p>
      </div>

      <ol class="steps">
        <li class="step">
          <div class="step-n">01</div>
          <div>
            <h3><?php esc_html_e( 'Emissão', 'sisb' ); ?></h3>
            <p><?php esc_html_e( 'Uma chave é criada para o sistema que vai consumir a API. Cada integração tem a sua, para que uma não dependa da outra.', 'sisb' ); ?></p>
          </div>
        </li>
        <li class="step">
          <div class="step-n">02</div>
          <div>
            <h3><?php esc_html_e( 'Listagem', 'sisb' ); ?></h3>
            <p><?php esc_html_e( 'As chaves emitidas ficam visíveis para a administração da plataforma. Saber quais existem é o que torna possível revisá-las.', 'sisb' ); ?></p>
          </div>
        </li>
        <li class="step">
          <div class="step-n">03</div>
          <div>
            <h3><?php esc_html_e( 'Regeneração', 'sisb' ); ?></h3>
            <p><?php esc_html_e( 'Suspeita de exposição não exige refazer a integração: a chave é regenerada e o sistema parceiro passa a usar o novo valor.', 'sisb' ); ?></p>
          </div>
        </li>
        <li class="step">
          <div class="step-n">04</div>
          <div>
            <h3><?php esc_html_e( 'Ativação, desativação e exclusão', 'sisb' ); ?></h3>
            <p><?php esc_html_e( 'Uma chave pode ser desativada e reativada, ou removida em definitivo. O corte de acesso é imediato e reversível quando precisa ser.', 'sisb' ); ?></p>
          </div>
        </li>
      </ol>

      <div class="note">
        <?php echo sisb_icon( 'lock', 20 ); ?>
        <p>
          <?php esc_html_e( 'Ações administrativas do sistema são registradas em trilha de auditoria consultável, com tela dedicada ao perfil de administrador.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="prose">
        <h2><?php esc_html_e( 'Documentação gerada pela própria API', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'A API publica a sua especificação OpenAPI, navegável pelo Swagger. A documentação é produzida a partir do código que está no ar, e não de um documento mantido em separado — o que reduz a chance de a referência descrever algo que o serviço já não faz.', 'sisb' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'A equipe de TI do cliente recebe o endereço da especificação do ambiente contratado e consegue percorrer os endpoints, os parâmetros e os modelos de dados antes de escrever a primeira linha de integração.', 'sisb' ); ?>
        </p>
      </div>

      <div class="assurance">
        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'file', 22 ); ?></div>
          <h3><?php esc_html_e( 'Especificação navegável', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'OpenAPI publicada pela própria API, com os endpoints e modelos do serviço em execução.', 'sisb' ); ?></p>
        </div>
        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'layers', 22 ); ?></div>
          <h3><?php esc_html_e( 'Uma superfície só', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'App, web e portal do empreendedor consomem a mesma API. O que integra é o que o produto usa.', 'sisb' ); ?></p>
        </div>
        <div class="card">
          <div class="ico"><?php echo sisb_icon( 'history', 22 ); ?></div>
          <h3><?php esc_html_e( 'Ambientes separados', 'sisb' ); ?></h3>
          <p><?php esc_html_e( 'Homologação e produção rodam em pilhas isoladas, com bancos e armazenamento próprios de cada ambiente.', 'sisb' ); ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="section" style="background:var(--surface)">
    <div class="container">
      <div class="prose">
        <h2><?php esc_html_e( 'Integração em produção com o sistema de outorga', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'Este é o ponto que separa integração comprovada de integração prometida. O SISB importa processos do SOE, o sistema de outorga já existente, e essa rotina está em produção.', 'sisb' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'A importação alimenta os processos de fiscalização: um requerimento vindo do SOE entra no SISB como processo de vistoria e segue a mesma máquina de estados dos processos criados no próprio sistema — envio para revisão, conclusão, aborto e restauração. O processo importado não vira um registro paralelo; ele entra no fluxo.', 'sisb' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'São dois modos de entrada, para dois cenários diferentes:', 'sisb' ); ?>
        </p>
        <ul>
          <li><strong><?php esc_html_e( 'Individual, por protocolo', 'sisb' ); ?></strong> — <?php esc_html_e( 'para o caso pontual, quando um processo específico precisa ser trazido na hora.', 'sisb' ); ?></li>
          <li><strong><?php esc_html_e( 'Em lote', 'sisb' ); ?></strong> — <?php esc_html_e( 'para a carga periódica, quando o volume acumulado do período é trazido de uma vez.', 'sisb' ); ?></li>
        </ul>
      </div>

      <div class="spec-wrap">
        <table class="spec">
          <thead>
            <tr>
              <th scope="col"><?php esc_html_e( 'Entrada', 'sisb' ); ?></th>
              <th scope="col"><?php esc_html_e( 'Endpoint', 'sisb' ); ?></th>
              <th scope="col"><?php esc_html_e( 'Cenário', 'sisb' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><?php esc_html_e( 'Processo do SOE, por protocolo', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'POST /Requerimento/import/{protocolo}' ); ?></td>
              <td><?php esc_html_e( 'Importação pontual de um processo identificado', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Processos do SOE, em lote', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'POST /Requerimento/import/batch' ); ?></td>
              <td><?php esc_html_e( 'Carga periódica de vários processos', 'sisb' ); ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'check-circ', 20 ); ?>
        <p>
          <?php esc_html_e( 'O SISB distingue o processo importado do sistema de outorga daquele gerado internamente, inclusive dos que o aplicativo cria em campo. A origem do processo continua visível depois da importação.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="prose">
        <h2><?php esc_html_e( 'Entrada da base que você já tem', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'Quase nenhum órgão começa do zero. Costuma existir uma planilha com o parque de barragens, mantida há anos. O SISB importa essa base por Excel, em massa, e esse é o caminho normal de onboarding de um cliente com histórico.', 'sisb' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'Planos de ação também entram por importação, barragem a barragem: o cronograma do Plano de Ação de Melhoria e o do Plano de Ação de Emergência podem ser carregados a partir de arquivo, o que permite trazer um planejamento montado fora do sistema em vez de redigitá-lo.', 'sisb' ); ?>
        </p>
      </div>

      <div class="spec-wrap">
        <table class="spec">
          <thead>
            <tr>
              <th scope="col"><?php esc_html_e( 'Entrada', 'sisb' ); ?></th>
              <th scope="col"><?php esc_html_e( 'Endpoint', 'sisb' ); ?></th>
              <th scope="col"><?php esc_html_e( 'Uso', 'sisb' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><?php esc_html_e( 'Parque de barragens, por planilha', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'POST /Barragem/import' ); ?></td>
              <td><?php esc_html_e( 'Onboarding com base legada em Excel', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Plano de Ação de Melhoria, por barragem', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'POST /PlanoAcaoMelhoria/barragem/{id}/import' ); ?></td>
              <td><?php esc_html_e( 'Carga de cronograma montado fora do sistema', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Plano de Ação de Emergência, por barragem', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'POST /PlanoAcaoEmergencia/barragem/{id}/import' ); ?></td>
              <td><?php esc_html_e( 'Carga de cronograma montado fora do sistema', 'sisb' ); ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'database', 20 ); ?>
        <p>
          <?php esc_html_e( 'O formato esperado da planilha de barragens e o dos arquivos de plano de ação são apresentados pela equipe técnica na etapa de implantação, junto com a validação de uma amostra da sua base.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <section class="section" style="background:var(--surface)">
    <div class="container">
      <div class="prose">
        <h2><?php esc_html_e( 'Saídas disponíveis hoje', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'As exportações do SISB são nominadas, não genéricas. Cada uma existe porque atende a um uso concreto: prestação de contas, intercâmbio de cronograma ou recuperação de evidência. A lista abaixo é o que está em produção.', 'sisb' ); ?>
        </p>
      </div>

      <div class="spec-wrap">
        <table class="spec">
          <thead>
            <tr>
              <th scope="col"><?php esc_html_e( 'Saída', 'sisb' ); ?></th>
              <th scope="col"><?php esc_html_e( 'Endpoint', 'sisb' ); ?></th>
              <th scope="col"><?php esc_html_e( 'Uso', 'sisb' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><?php esc_html_e( 'Relatório de classificação, em Excel', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'GET /Barragem/{id}/classification-report/excel' ); ?></td>
              <td><?php esc_html_e( 'Prestação de contas', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Plano de Ação de Melhoria, por barragem', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'GET /PlanoAcaoMelhoria/barragem/{id}/export' ); ?></td>
              <td><?php esc_html_e( 'Intercâmbio de cronograma', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Plano de Ação de Emergência, por barragem', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'GET /PlanoAcaoEmergencia/barragem/{id}/export' ); ?></td>
              <td><?php esc_html_e( 'Intercâmbio de cronograma', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Mídia de vistoria', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'GET /Media/{id}/download' ); ?></td>
              <td><?php esc_html_e( 'Recuperação de evidência fotográfica', 'sisb' ); ?></td>
            </tr>
            <tr>
              <th scope="row"><?php esc_html_e( 'Arquivo do acervo da barragem', 'sisb' ); ?></th>
              <td><?php echo esc_html( 'GET /Documentos/file/{id}/download' ); ?></td>
              <td><?php esc_html_e( 'Recuperação de documento enviado', 'sisb' ); ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'alert', 20 ); ?>
        <p>
          <?php esc_html_e( 'Extrações que não estejam nesta lista dependem de análise. Preferimos dizer o que existe hoje a prometer uma exportação genérica de tudo.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="prose">
        <h2><?php esc_html_e( 'A sincronização do aplicativo usa a mesma API', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'O aplicativo de campo mantém um banco relacional no próprio dispositivo e opera sem conectividade. Quando volta a ter rede, ele conversa com a mesma API por dois endpoints de sincronização bidirecional: um de leitura e um de escrita.', 'sisb' ); ?>
        </p>
        <ul>
          <li><strong><?php echo esc_html( 'GET /Sync/pull' ); ?></strong> — <?php esc_html_e( 'traz para o dispositivo o que mudou no servidor.', 'sisb' ); ?></li>
          <li><strong><?php echo esc_html( 'POST /Sync/push' ); ?></strong> — <?php esc_html_e( 'envia ao servidor o que foi produzido em campo.', 'sisb' ); ?></li>
        </ul>
        <p>
          <?php esc_html_e( 'Cada payload trocado fica registrado em histórico próprio, o que permite auditar uma sincronização e depurar divergência sem depender do relato do fiscal. Conflitos são resolvidos por timestamp.', 'sisb' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'Antes de ir a campo, o fiscal recebe a designação dos empreendimentos que ficarão disponíveis offline no seu dispositivo — também por chamada à API. Para a sua área de TI, a consequência prática é direta: o comportamento do aplicativo é inspecionável pelos mesmos meios que qualquer outro cliente da API.', 'sisb' ); ?>
        </p>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'smartphone', 20 ); ?>
        <p>
          <?php esc_html_e( 'O aplicativo não é um cliente com cache. Ele carrega um banco relacional com o mesmo modelo de dados do servidor, e a sincronização é o contrato entre os dois.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <section class="section" style="background:var(--surface)">
    <div class="container">
      <div class="prose">
        <h2><?php esc_html_e( 'O que depende de conversa técnica', 'sisb' ); ?></h2>
        <p>
          <?php esc_html_e( 'Algumas decisões de integração não têm resposta única de catálogo: dependem do ambiente contratado, do volume e da política do órgão. Preferimos tratá-las com a sua equipe a publicar um número que não se sustente.', 'sisb' ); ?>
        </p>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'signal', 20 ); ?>
        <p>
          <strong><?php esc_html_e( 'Limites de uso, versionamento e disponibilidade.', 'sisb' ); ?></strong>
          <?php esc_html_e( 'Política de limite de requisições, estratégia de versionamento da API e compromissos de disponibilidade são definidos por contrato. A equipe técnica detalha cada ponto sob demanda.', 'sisb' ); ?>
        </p>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'workflow', 20 ); ?>
        <p>
          <strong><?php esc_html_e( 'Notificação de eventos para sistemas externos.', 'sisb' ); ?></strong>
          <?php esc_html_e( 'O consumo por sistemas terceiros é feito por chamada à API. Cenários em que o seu sistema precisa ser avisado de uma mudança devem ser desenhados junto com a equipe técnica.', 'sisb' ); ?>
        </p>
      </div>

      <div class="note">
        <?php echo sisb_icon( 'globe', 20 ); ?>
        <p>
          <strong><?php esc_html_e( 'Integração com outro sistema legado.', 'sisb' ); ?></strong>
          <?php esc_html_e( 'A importação do sistema de outorga mostra que o caminho existe e funciona. Uma integração com outro sistema começa por uma leitura do contrato dele, e é escopo de projeto.', 'sisb' ); ?>
        </p>
      </div>
    </div>
  </section>

  <section class="module-cta">
    <div class="container">
      <div class="module-cta-inner">
        <div>
          <h2 class="section-title on-dark"><?php esc_html_e( 'Traga o seu time de TI para a conversa', 'sisb' ); ?></h2>
          <p><?php esc_html_e( 'Podemos percorrer a especificação da API, o formato de importação da sua base e o desenho da integração com os sistemas que você já opera.', 'sisb' ); ?></p>
        </div>
        <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-primary btn-lg">
          <?php esc_html_e( 'Falar com a equipe técnica', 'sisb' ); ?>
          <?php echo sisb_icon( 'arrow', 16 ); ?>
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
