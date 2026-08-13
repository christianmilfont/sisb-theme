<?php
/**
 * Módulo: PSB, PAE, PAM e Faixas de Alerta
 *
 * Fonte: doc/product-modules.md §D2, §D3, §D4, §D5
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'gestao',
    'icon'      => 'shield',
    'nav_label' => __( 'Planos e Conformidade', 'sisb' ),
    'title'     => __( 'PSB, PAE, PAM e Faixas de Alerta', 'sisb' ),
    'h1'        => __( 'O que acontece depois da inspeção', 'sisb' ),
    'summary'   => __( 'Plano de segurança, plano de emergência e plano de melhoria com cronograma, propostas de resolução e monitores automáticos de prazo.', 'sisb' ),

    'problema'  => array(
        __( 'A inspeção aponta o problema. A conformidade exige acompanhar a correção: quem responde, em que prazo e com que prova. É a parte do trabalho que sobrevive por mais tempo em planilha, e a que menos aguenta viver nela.', 'sisb' ),
        __( 'O efeito prático é o prazo que vence em silêncio. Ninguém abriu a planilha naquela semana, o empreendedor não foi cobrado, e a pendência só reaparece na inspeção seguinte — quando já não há como demonstrar que houve acompanhamento.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'O PSB entra e passa por aprovação', 'sisb' ),
            'text'  => __( 'O Plano de Segurança da Barragem é recebido, analisado e aprovado ou arquivado. Cada barragem tem um PSB ativo identificado, e o histórico dos anteriores permanece consultável.', 'sisb' ),
        ),
        array(
            'title' => __( 'Os eventos recebem prazo', 'sisb' ),
            'text'  => __( 'Do PSB derivam os eventos regulatórios, inclusive a Inspeção de Segurança Especial. Cada evento tem prazo próprio, e a prorrogação é registrada em vez de combinada por fora.', 'sisb' ),
        ),
        array(
            'title' => __( 'PAM e PAE organizam a intervenção', 'sisb' ),
            'text'  => __( 'O Plano de Ação de Melhoria trabalha por ação, com status e criticidade. O Plano de Ação de Emergência segue a mesma mecânica, por barragem e por empreendimento, em aba própria do dashboard.', 'sisb' ),
        ),
        array(
            'title' => __( 'O empreendedor propõe a resolução', 'sisb' ),
            'text'  => __( 'Para itens de PSB, PAM e PAE, o empreendedor envia uma proposta de resolução pelo portal. O analista aprova ou rejeita, e a decisão fica vinculada ao item.', 'sisb' ),
        ),
        array(
            'title' => __( 'O sistema vigia o vencimento', 'sisb' ),
            'text'  => __( 'Dois serviços em segundo plano acompanham os prazos de PSB e de PAM e disparam notificação por e-mail e push quando o prazo se aproxima ou vence.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'planos-e-conformidade.png',
        'alt'     => __( 'Aba de plano de ação no dashboard da barragem, com cronograma e prazos', 'sisb' ),
        'caption' => __( 'Cronograma do plano de ação, com prazos e propostas de resolução.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Aprovação e arquivamento do PSB, com PSB ativo por barragem', 'sisb' ),
        __( 'Eventos do PSB, incluindo Inspeção de Segurança Especial (ISE)', 'sisb' ),
        __( 'Prazo por evento, com prorrogação registrada', 'sisb' ),
        __( 'Plano de Ação de Melhoria com status e criticidade, filtrável', 'sisb' ),
        __( 'Plano de Ação de Emergência por barragem e por empreendimento', 'sisb' ),
        __( 'Propostas de resolução com aprovação ou rejeição do analista', 'sisb' ),
        __( 'Cronograma visual de prazos no dashboard da barragem', 'sisb' ),
        __( 'Exportação e importação de cronograma de PAM e PAE por barragem', 'sisb' ),
        __( 'Monitores em segundo plano para prazos de PSB e de PAM', 'sisb' ),
        __( 'Faixa de alerta verde, amarela ou vermelha derivada das anomalias constatadas', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'O prazo é cobrado sem ninguém lembrar dele', 'sisb' ),
        'text'  => __( 'Dois serviços rodam fora do ciclo de uso do sistema, um para eventos do PSB e outro para ações do PAM. Eles verificam os vencimentos e notificam por e-mail e push sem que um analista precise abrir a tela. A cobrança deixa de depender da rotina de quem está com a pasta.', 'sisb' ),
    ),

    'roadmap' => array(
        __( 'Configuração paramétrica das faixas de alerta conforme o Volume VI do Manual do Empreendedor (ANA)', 'sisb' ),
        __( 'Comprovação de recebimento do aviso pelos grupos pré-definidos', 'sisb' ),
    ),

    'canais' => array( 'web', 'portal' ),
    'perfis' => array( 'fiscal_analista', 'admin', 'empreendedor' ),

    'relacionados' => array( 'comunicacao-e-portal', 'prontuario-da-barragem', 'painel-de-dados' ),
);
