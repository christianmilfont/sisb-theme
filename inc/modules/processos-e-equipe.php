<?php
/**
 * Módulo: Processos de Vistoria e Atribuições Técnicas
 *
 * Fonte: doc/product-modules.md §C1, §C2, §C3, §C4
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'gestao',
    'icon'      => 'workflow',
    'nav_label' => __( 'Processos e Equipe', 'sisb' ),
    'title'     => __( 'Processos de Vistoria e Atribuições Técnicas', 'sisb' ),
    'h1'        => __( 'Quem está fazendo o quê, e até quando', 'sisb' ),
    'summary'   => __( 'Processos de fiscalização com máquina de estados, fila de atribuições por técnico e tramitação de solicitações cadastrais.', 'sisb' ),

    'problema'  => array(
        __( 'A distribuição do trabalho costuma acontecer por e-mail e conversa. Funciona enquanto a equipe é pequena. Passa disso, e responder quantos processos estão em revisão, ou qual técnico está sobrecarregado, exige perguntar de mesa em mesa.', 'sisb' ),
        __( 'Some-se a isso a demanda que chega de fora: pedido de atualização cadastral, vínculo de representante, contestação de classificação. Sem fila formal, cada um desses pedidos vira uma pendência pessoal de quem recebeu e some quando essa pessoa sai de férias.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'O processo entra pelo SOE ou nasce no SISB', 'sisb' ),
            'text'  => __( 'Requerimentos do sistema legado de outorga são importados por protocolo ou em lote. O SISB também gera os seus, inclusive a partir de uma vistoria criada em campo.', 'sisb' ),
        ),
        array(
            'title' => __( 'O trabalho vira atribuição com responsável', 'sisb' ),
            'text'  => __( 'A tarefa é atribuída a um técnico e passa a existir na fila pessoal dele. O dashboard de atribuições mostra a distribuição da carga entre a equipe.', 'sisb' ),
        ),
        array(
            'title' => __( 'A execução fica registrada no próprio item', 'sisb' ),
            'text'  => __( 'Mudança de status, comentários, anexos e transferência para outro técnico ficam no histórico da atribuição, não em uma troca de mensagens paralela.', 'sisb' ),
        ),
        array(
            'title' => __( 'O processo percorre estados formais', 'sisb' ),
            'text'  => __( 'Envio para revisão, conclusão, aborto e restauração. Cada transição é uma ação do sistema, o que torna a listagem de processos de vistoria uma leitura confiável da situação.', 'sisb' ),
        ),
        array(
            'title' => __( 'O que vem de fora entra na mesma fila', 'sisb' ),
            'text'  => __( 'Solicitações cadastrais do empreendedor e pedidos de reclassificação chegam como tramitação, com aprovação ou rejeição pelo analista responsável.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'processos-e-equipe.png',
        'alt'     => __( 'Listagem de processos de vistoria e dashboard de atribuições técnicas do SISB', 'sisb' ),
        'caption' => __( 'Processos de vistoria e fila de atribuições por técnico.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Importação de requerimentos do SOE, individual e em lote', 'sisb' ),
        __( 'Requerimento gerado pelo SISB, inclusive a partir do aplicativo de campo', 'sisb' ),
        __( 'Requerimento avulso, sem processo prévio', 'sisb' ),
        __( 'Máquina de estados com revisão, conclusão, aborto e restauração', 'sisb' ),
        __( 'Listagem de processos de vistoria como entrada do back-office', 'sisb' ),
        __( 'Fila pessoal de atribuições por técnico', 'sisb' ),
        __( 'Dashboard de atribuições técnicas', 'sisb' ),
        __( 'Transferência de atribuição entre técnicos', 'sisb' ),
        __( 'Comentários, anexos e histórico por atribuição', 'sisb' ),
        __( 'Tramitação de cadastro e de vínculo de representante, com aprovar ou rejeitar', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'A carga da equipe deixa de ser estimativa', 'sisb' ),
        'text'  => __( 'Cada tarefa técnica tem responsável, prazo e histórico próprio, e o dashboard de atribuições mostra como ela se distribui entre os técnicos. Transferir uma tarefa é uma ação registrada, não um repasse informal. É o que permite responder por que um processo parou, e desde quando.', 'sisb' ),
    ),

    'canais' => array( 'web' ),
    'perfis' => array( 'fiscal_analista', 'admin', 'fiscal', 'terceiro' ),

    'relacionados' => array( 'vistorias', 'governanca', 'comunicacao-e-portal' ),
);
