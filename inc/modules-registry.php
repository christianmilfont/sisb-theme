<?php
/**
 * Registro dos módulos do produto.
 *
 * Esta é a única fonte de conteúdo das páginas /modulos/. Não há conteúdo de
 * módulo em banco de dados: tudo vive aqui, versionado junto ao tema.
 *
 * REGRA: nada entra aqui sem contrapartida ✅ "Em produção" em
 * doc/product-modules.md. Itens previstos e ainda não implementados vão em
 * 'roadmap', que é renderizado em bloco visualmente separado.
 *
 * Ver doc/site-ia.md §3 para o significado de cada chave.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Grupos de módulos, na ordem em que aparecem na navegação e no índice.
 *
 * @return array<string,array>
 */
function sisb_module_groups() {
    return array(
        'coleta' => array(
            'label' => __( 'Coleta em campo', 'sisb' ),
            'lead'  => __( 'O que acontece na barragem: inspeção, evidência e instrumento de fiscalização — com ou sem conectividade.', 'sisb' ),
            'icon'  => 'smartphone',
        ),
        'gestao' => array(
            'label' => __( 'Gestão e conformidade', 'sisb' ),
            'lead'  => __( 'O que acontece no escritório: cadastro, análise de risco, planos de segurança, prazos e comunicação com o empreendedor.', 'sisb' ),
            'icon'  => 'shield',
        ),
        'plataforma' => array(
            'label' => __( 'Plataforma', 'sisb' ),
            'lead'  => __( 'O que sustenta a operação: integração com sistemas existentes, perfis de acesso e trilha de auditoria.', 'sisb' ),
            'icon'  => 'layers',
        ),
    );
}

/**
 * Rótulos legíveis dos perfis de acesso do sistema.
 *
 * @return array<string,string>
 */
function sisb_module_roles() {
    return array(
        'fiscal'          => __( 'Fiscal de campo', 'sisb' ),
        'fiscal_analista' => __( 'Fiscal analista', 'sisb' ),
        'admin'           => __( 'Administrador', 'sisb' ),
        'terceiro'        => __( 'Empresa contratada', 'sisb' ),
        'empreendedor'    => __( 'Empreendedor', 'sisb' ),
    );
}

/**
 * Rótulos dos canais em que um módulo está disponível.
 *
 * @return array<string,array{label:string,icon:string}>
 */
function sisb_module_channels() {
    return array(
        'app'    => array( 'label' => __( 'Aplicativo de campo', 'sisb' ), 'icon' => 'smartphone' ),
        'web'    => array( 'label' => __( 'Back-office web', 'sisb' ),     'icon' => 'database' ),
        'portal' => array( 'label' => __( 'Portal do empreendedor', 'sisb' ), 'icon' => 'building' ),
        'api'    => array( 'label' => __( 'API', 'sisb' ),                 'icon' => 'plug' ),
    );
}

/**
 * Registro completo dos módulos.
 *
 * 'status' => 'ready'  → publicado, com rota própria e listado no índice
 * 'status' => 'draft'  → conteúdo ainda não escrito; não roteado, não listado
 *
 * @return array<string,array>
 */
function sisb_modules_registry() {
    $modules = array(

        /* ============================ COLETA ============================ */

        'app-de-campo' => array(
            'status'    => 'ready',
            'group'     => 'coleta',
            'icon'      => 'smartphone',
            'nav_label' => __( 'App de Campo', 'sisb' ),
            'title'     => __( 'App de Campo Offline', 'sisb' ),
            'h1'        => __( 'Inspeção em campo, com ou sem sinal', 'sisb' ),
            'summary'   => __( 'Aplicativo Android e iOS com banco de dados completo no dispositivo: a fiscalização acontece integralmente offline e sincroniza quando houver rede.', 'sisb' ),

            'problema'  => array(
                __( 'Barragem fica onde não há rede. Quando a coleta depende de conexão, a equipe volta a papel e planilha — e o retrabalho de digitação no escritório vira a norma, não a exceção.', 'sisb' ),
                __( 'Pior que o retrabalho é a perda de evidência: foto sem vínculo com o item inspecionado, anotação que não chega, vistoria que precisa ser refeita porque o formulário voltou incompleto.', 'sisb' ),
            ),

            'como_funciona' => array(
                array(
                    'title' => __( 'A base vai junto para campo', 'sisb' ),
                    'text'  => __( 'Antes do deslocamento, os empreendimentos designados ao fiscal são carregados no dispositivo — cadastro, barragens, histórico e vistorias anteriores.', 'sisb' ),
                ),
                array(
                    'title' => __( 'A coleta acontece localmente', 'sisb' ),
                    'text'  => __( 'Vistoria, avaliação de risco, autos e fotos são gravados primeiro no aparelho, em banco relacional local. Nada depende de conexão para ser concluído.', 'sisb' ),
                ),
                array(
                    'title' => __( 'A sincronização é bidirecional', 'sisb' ),
                    'text'  => __( 'Ao reencontrar rede, o app envia o que produziu e recebe o que mudou no servidor, com resolução de conflito por data de alteração.', 'sisb' ),
                ),
                array(
                    'title' => __( 'Cada sincronização deixa rastro', 'sisb' ),
                    'text'  => __( 'O conteúdo de cada troca fica registrado, o que permite auditar divergências e reconstruir o que foi enviado por qual dispositivo.', 'sisb' ),
                ),
            ),

            'screenshot' => array(
                'file'    => 'app-de-campo.png',
                'alt'     => __( 'Telas do aplicativo SISB de coleta em campo', 'sisb' ),
                'caption' => __( 'Formulário de vistoria e sincronização no aplicativo de campo.', 'sisb' ),
            ),

            'capacidades' => array(
                __( 'Android e iOS', 'sisb' ),
                __( 'Operação integral sem conectividade', 'sisb' ),
                __( 'Designação de empreendimentos para uso offline', 'sisb' ),
                __( 'Sincronização bidirecional com o servidor', 'sisb' ),
                __( 'Resolução de conflito por data de alteração', 'sisb' ),
                __( 'Histórico auditável de cada sincronização', 'sisb' ),
                __( 'Vistoria, avaliação de risco, autos e cadastro no mesmo aplicativo', 'sisb' ),
                __( 'Captura de fotos e vídeos com coordenadas', 'sisb' ),
                __( 'Distribuição controlada de versões para as equipes', 'sisb' ),
            ),

            'destaque' => array(
                'title' => __( 'Não é cache — é banco de dados', 'sisb' ),
                'text'  => __( 'A maior parte dos aplicativos de inspeção guarda um formulário em cache e falha quando o fluxo depende de dados relacionados. Aqui o dispositivo carrega o mesmo modelo de dados do servidor, o que permite criar empreendimento, barragem, vistoria e auto em campo, encadeados entre si, sem nenhuma conexão.', 'sisb' ),
            ),

            'canais'  => array( 'app' ),
            'perfis'  => array( 'fiscal', 'fiscal_analista', 'terceiro' ),

            'relacionados' => array( 'vistorias', 'autos-e-outorga', 'avaliacao-de-risco' ),
        ),

        'vistorias' => array(
            'status'    => 'ready',
            'group'     => 'coleta',
            'icon'      => 'list',
            'nav_label' => __( 'Vistorias e NPG', 'sisb' ),
            'title'     => __( 'Vistorias e Nível de Perigo Global', 'sisb' ),
            'h1'        => __( 'Formulário de vistoria padronizado, com NPG calculado', 'sisb' ),
            'summary'   => __( 'Formulários distintos para barragem de terra e de concreto, com registro fotográfico georreferenciado e cálculo automático do Nível de Perigo Global.', 'sisb' ),

            'problema'  => array(
                __( 'Quando cada equipe usa a sua planilha, duas inspeções da mesma estrutura não são comparáveis — e a evolução de uma anomalia ao longo do tempo deixa de ser visível.', 'sisb' ),
                __( 'O agravante é a nota final: calculada à mão, ela varia com quem preencheu, o que fragiliza qualquer decisão tomada a partir dela.', 'sisb' ),
            ),

            'como_funciona' => array(
                array(
                    'title' => __( 'O formulário segue o tipo da estrutura', 'sisb' ),
                    'text'  => __( 'Barragem de terra e barragem de concreto têm formulários próprios, com os itens de inspeção pertinentes a cada uma.', 'sisb' ),
                ),
                array(
                    'title' => __( 'Cada item recebe classificação de anomalia', 'sisb' ),
                    'text'  => __( 'O inspetor classifica item a item e anexa a evidência fotográfica correspondente, com coordenada e legenda.', 'sisb' ),
                ),
                array(
                    'title' => __( 'O NPG é calculado pelo sistema', 'sisb' ),
                    'text'  => __( 'O Nível de Perigo Global sai das classificações informadas, com o mesmo critério em todas as equipes e nos dois canais.', 'sisb' ),
                ),
                array(
                    'title' => __( 'A vistoria tem ciclo formal', 'sisb' ),
                    'text'  => __( 'Rascunho, transferência de responsável, conclusão e cancelamento — cada transição com autor registrado.', 'sisb' ),
                ),
                array(
                    'title' => __( 'A comparação com a anterior é direta', 'sisb' ),
                    'text'  => __( 'A vistoria anterior da mesma estrutura fica acessível, o que torna a evolução das anomalias observável.', 'sisb' ),
                ),
            ),

            'screenshot' => array(
                'file'    => 'vistorias.png',
                'alt'     => __( 'Formulário de vistoria do SISB com itens de inspeção e nível de perigo global', 'sisb' ),
                'caption' => __( 'Formulário de vistoria com classificação por item e NPG consolidado.', 'sisb' ),
            ),

            'capacidades' => array(
                __( 'Formulário específico para barragem de terra', 'sisb' ),
                __( 'Formulário específico para barragem de concreto', 'sisb' ),
                __( 'Cálculo automático do Nível de Perigo Global (NPG)', 'sisb' ),
                __( 'Registro fotográfico por item inspecionado', 'sisb' ),
                __( 'Fotos e vídeos com coordenadas, legenda e marca d\'água', 'sisb' ),
                __( 'Controle de quais evidências entram no relatório', 'sisb' ),
                __( 'Transferência de responsável pela vistoria', 'sisb' ),
                __( 'Vistoria avulsa, sem processo prévio', 'sisb' ),
                __( 'Consulta à vistoria anterior da mesma barragem', 'sisb' ),
            ),

            'destaque' => array(
                'title' => __( 'O mesmo cálculo no campo e no escritório', 'sisb' ),
                'text'  => __( 'O formulário e o motor de cálculo do NPG são os mesmos no aplicativo e na web. Uma vistoria iniciada em campo e concluída no escritório não muda de critério no caminho — o que elimina a divergência que costuma aparecer quando os dois canais são sistemas diferentes.', 'sisb' ),
            ),

            'canais'  => array( 'app', 'web' ),
            'perfis'  => array( 'fiscal', 'fiscal_analista', 'terceiro' ),

            'relacionados' => array( 'app-de-campo', 'avaliacao-de-risco', 'relatorios' ),
        ),

        'autos-e-outorga' => array(
            'status'    => 'draft',
            'group'     => 'coleta',
            'icon'      => 'scroll',
            'nav_label' => __( 'Autos e Outorga', 'sisb' ),
            'title'     => __( 'Autos de Inspeção, Infração e Fiscalização de Outorga', 'sisb' ),
            'h1'        => __( 'Do registro à sanção, no mesmo fluxo', 'sisb' ),
            'summary'   => __( 'Auto de inspeção, auto de infração com PDF e penalidade parametrizada, e a trilha paralela de fiscalização de outorga e uso de recursos hídricos.', 'sisb' ),
        ),

        /* ============================ GESTÃO ============================ */

        'prontuario-da-barragem' => array(
            'status'    => 'draft',
            'group'     => 'gestao',
            'icon'      => 'building',
            'nav_label' => __( 'Prontuário da Barragem', 'sisb' ),
            'title'     => __( 'Cadastro e Prontuário Digital', 'sisb' ),
            'h1'        => __( 'Tudo sobre cada barragem, em uma tela', 'sisb' ),
            'summary'   => __( 'Empreendimentos, empreendedores e barragens georreferenciadas, com prontuário que reúne classificação, planos, documentos e notificações.', 'sisb' ),
        ),

        'avaliacao-de-risco' => array(
            'status'    => 'draft',
            'group'     => 'gestao',
            'icon'      => 'chart',
            'nav_label' => __( 'Avaliação de Risco', 'sisb' ),
            'title'     => __( 'Avaliação de Risco: CRI, DPA e Matriz', 'sisb' ),
            'h1'        => __( 'Enquadramento conforme a Política Nacional de Segurança de Barragens', 'sisb' ),
            'summary'   => __( 'Cálculo automático de Categoria de Risco e Dano Potencial Associado, com posicionamento na matriz de classificação.', 'sisb' ),
        ),

        'planos-e-conformidade' => array(
            'status'    => 'draft',
            'group'     => 'gestao',
            'icon'      => 'shield',
            'nav_label' => __( 'Planos e Conformidade', 'sisb' ),
            'title'     => __( 'PSB, PAE, PAM e Faixas de Alerta', 'sisb' ),
            'h1'        => __( 'O que acontece depois da inspeção', 'sisb' ),
            'summary'   => __( 'Plano de segurança, plano de emergência e plano de melhoria com cronograma, propostas de resolução e monitores automáticos de prazo.', 'sisb' ),
        ),

        'processos-e-equipe' => array(
            'status'    => 'draft',
            'group'     => 'gestao',
            'icon'      => 'workflow',
            'nav_label' => __( 'Processos e Equipe', 'sisb' ),
            'title'     => __( 'Processos de Vistoria e Atribuições Técnicas', 'sisb' ),
            'h1'        => __( 'Quem está fazendo o quê, e até quando', 'sisb' ),
            'summary'   => __( 'Processos de fiscalização com máquina de estados, fila de atribuições por técnico e tramitação de solicitações cadastrais.', 'sisb' ),
        ),

        'comunicacao-e-portal' => array(
            'status'    => 'draft',
            'group'     => 'gestao',
            'icon'      => 'mail',
            'nav_label' => __( 'Comunicação e Portal', 'sisb' ),
            'title'     => __( 'Notificações e Portal do Empreendedor', 'sisb' ),
            'h1'        => __( 'O órgão e o empreendedor na mesma plataforma', 'sisb' ),
            'summary'   => __( 'Notificação oficial a partir de template, envio em lote por e-mail e push, e área de autoatendimento para o regulado responder.', 'sisb' ),
        ),

        'relatorios' => array(
            'status'    => 'draft',
            'group'     => 'gestao',
            'icon'      => 'file',
            'nav_label' => __( 'Relatórios e Documentos', 'sisb' ),
            'title'     => __( 'Relatórios, Documentos e Exportações', 'sisb' ),
            'h1'        => __( 'O documento técnico sai pronto', 'sisb' ),
            'summary'   => __( 'Relatório em PDF gerado a partir dos dados da vistoria, com anexo fotográfico, templates configuráveis e acervo documental por barragem.', 'sisb' ),
        ),

        'painel-de-dados' => array(
            'status'    => 'draft',
            'group'     => 'gestao',
            'icon'      => 'activity',
            'nav_label' => __( 'Painel de Dados', 'sisb' ),
            'title'     => __( 'Painel Gerencial', 'sisb' ),
            'h1'        => __( 'A situação do parque de barragens, agora e ao longo do tempo', 'sisb' ),
            'summary'   => __( 'Distribuição por faixas de alerta, mapa georreferenciado e série histórica — não apenas a foto do momento.', 'sisb' ),
        ),

        /* ========================== PLATAFORMA ========================== */

        'integracoes' => array(
            'status'    => 'draft',
            'group'     => 'plataforma',
            'icon'      => 'plug',
            'nav_label' => __( 'Integrações e API', 'sisb' ),
            'title'     => __( 'Integrações e API', 'sisb' ),
            'h1'        => __( 'Conversa com o que você já tem', 'sisb' ),
            'summary'   => __( 'API documentada com autenticação por token e por chave de serviço, importação da base existente e integração já em produção com sistema legado.', 'sisb' ),
        ),

        'governanca' => array(
            'status'    => 'draft',
            'group'     => 'plataforma',
            'icon'      => 'lock',
            'nav_label' => __( 'Governança e Acessos', 'sisb' ),
            'title'     => __( 'Acessos, Auditoria e Administração', 'sisb' ),
            'h1'        => __( 'Controle, rastreabilidade e prestação de contas', 'sisb' ),
            'summary'   => __( 'Seis perfis de acesso com permissões distintas, trilha de auditoria consultável e configuração de parâmetros sem nova implantação.', 'sisb' ),
        ),
    );

    /**
     * Permite estender ou ajustar o registro de módulos.
     *
     * @param array $modules Registro completo, indexado por slug.
     */
    return apply_filters( 'sisb_modules_registry', $modules );
}
