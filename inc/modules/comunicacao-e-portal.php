<?php
/**
 * Módulo: Notificações e Portal do Empreendedor
 *
 * Fonte: doc/product-modules.md §E1, §E2
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'gestao',
    'icon'      => 'mail',
    'nav_label' => __( 'Comunicação e Portal', 'sisb' ),
    'title'     => __( 'Notificações e Portal do Empreendedor', 'sisb' ),
    'h1'        => __( 'O órgão e o empreendedor na mesma plataforma', 'sisb' ),
    'summary'   => __( 'Notificação oficial a partir de template, envio em lote por e-mail e push, e área de autoatendimento para o regulado responder.', 'sisb' ),

    'problema'  => array(
        __( 'Notificar por ofício redigido caso a caso consome o tempo de quem deveria estar analisando. O texto varia conforme quem escreve, o envio depende de um controle paralelo em planilha e o registro do que foi comunicado fica espalhado entre caixas de e-mail pessoais.', 'sisb' ),
        __( 'Do outro lado, o empreendedor não tem onde consultar a situação da própria barragem. Então ele liga. Boa parte da carga de atendimento do órgão é composta por perguntas cuja resposta já está no sistema.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'O texto sai de um template', 'sisb' ),
            'text'  => __( 'Os modelos de notificação são mantidos pelo administrador em editor de texto rico. A redação oficial deixa de ser reescrita a cada envio.', 'sisb' ),
        ),
        array(
            'title' => __( 'A notificação é montada por barragem', 'sisb' ),
            'text'  => __( 'A partir do template, a notificação é vinculada à barragem, com escolha entre os remetentes disponíveis para aquela estrutura.', 'sisb' ),
        ),
        array(
            'title' => __( 'O envio é individual ou em lote', 'sisb' ),
            'text'  => __( 'A entrega usa uma fila de e-mail assíncrona, com nova tentativa em caso de falha, e notificação push. O envio em lote atende situações que alcançam muitos empreendedores de uma vez.', 'sisb' ),
        ),
        array(
            'title' => __( 'O empreendedor responde pelo portal', 'sisb' ),
            'text'  => __( 'No portal, ele vê as próprias barragens e a classificação de cada uma, consulta notificações e tramitações e envia propostas de resolução para itens de PAM e PAE.', 'sisb' ),
        ),
        array(
            'title' => __( 'O que foi comunicado fica registrado', 'sisb' ),
            'text'  => __( 'O histórico de notificações é persistido, com estatísticas de envio e consulta dos eventos já vencidos.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'comunicacao-e-portal.png',
        'alt'     => __( 'Tela de notificações do SISB e dashboard do portal do empreendedor', 'sisb' ),
        'caption' => __( 'Notificação a partir de template e visão do empreendedor no portal.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Templates de notificação com editor de texto rico', 'sisb' ),
        __( 'Notificação vinculada à barragem, com remetentes disponíveis', 'sisb' ),
        __( 'Envio individual e envio em lote', 'sisb' ),
        __( 'Fila de e-mail assíncrona, com nova tentativa em caso de falha', 'sisb' ),
        __( 'Notificação push para o aplicativo', 'sisb' ),
        __( 'Estatísticas de notificação e consulta de eventos vencidos', 'sisb' ),
        __( 'Histórico de notificações persistido', 'sisb' ),
        __( 'Portal com dashboard das barragens do próprio empreendedor', 'sisb' ),
        __( 'Consulta de notificações e de tramitações pelo empreendedor', 'sisb' ),
        __( 'Envio de propostas de resolução de PAM e PAE pelo empreendedor', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'Duas pontas, um sistema só', 'sisb' ),
        'text'  => __( 'O empreendedor não é apenas destinatário de e-mail: ele tem acesso próprio, com a classificação das suas barragens e as pendências abertas. O que ele responde entra no mesmo fluxo que o analista já usa, sem digitação intermediária. Cada consulta que ele resolve sozinho no portal é um atendimento que a equipe do órgão não precisa fazer.', 'sisb' ),
    ),

    'canais' => array( 'web', 'portal' ),
    'perfis' => array( 'fiscal_analista', 'admin', 'empreendedor' ),

    'relacionados' => array( 'planos-e-conformidade', 'processos-e-equipe' ),
);
