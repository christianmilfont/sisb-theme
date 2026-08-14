<?php
/**
 * Módulo: Cadastro e Prontuário Digital
 *
 * Fonte: doc/product-modules.md §B1, §B2, §B3, §B4
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'gestao',
    'icon'      => 'building',
    'nav_label' => __( 'Prontuário da Barragem', 'sisb' ),
    'title'     => __( 'Cadastro e Prontuário Digital', 'sisb' ),
    'h1'        => __( 'Tudo sobre cada barragem, em uma tela', 'sisb' ),
    'summary'   => __( 'Empreendimentos, empreendedores e barragens georreferenciadas, com prontuário que reúne classificação, planos, documentos e notificações.', 'sisb' ),

    'problema'  => array(
        __( 'O histórico de uma barragem costuma estar espalhado: o cadastro em um sistema, os laudos em uma pasta de rede, as notificações no e-mail de quem as enviou. Responder a uma pergunta simples sobre a estrutura vira uma pequena investigação.', 'sisb' ),
        __( 'Quem responde pela barragem também se perde no caminho. Sem vínculo explícito entre pessoa e empreendimento, a notificação segue para o endereço antigo e a cobrança de prazo cai no vazio.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'O cadastro começa por quem responde', 'sisb' ),
            'text'  => __( 'Empreendimento e empreendedor são cadastrados com validação de CPF e CNPJ, e ligados por vínculo com papel definido, uma pessoa pode responder por mais de um empreendimento.', 'sisb' ),
        ),
        array(
            'title' => __( 'A barragem entra georreferenciada', 'sisb' ),
            'text'  => __( 'O cadastro técnico registra o tipo da estrutura e a coordenada do local. É a coordenada que resolve qual unidade regional é competente sobre aquela barragem.', 'sisb' ),
        ),
        array(
            'title' => __( 'O prontuário reúne as seis abas', 'sisb' ),
            'text'  => __( 'Classificação, PSB, Plano de Ação de Emergência, Plano de Ação de Melhoria, Documentos e Notificações ficam na mesma tela, com o status e a faixa de alerta consolidados.', 'sisb' ),
        ),
        array(
            'title' => __( 'O acervo documental fica junto da estrutura', 'sisb' ),
            'text'  => __( 'Pastas e arquivos por barragem guardam PSB, PAE, laudos e projetos, com upload e download pela própria tela do prontuário.', 'sisb' ),
        ),
        array(
            'title' => __( 'O parque é lido no mapa e no histórico', 'sisb' ),
            'text'  => __( 'As coordenadas alimentam a visão georreferenciada do conjunto, e cada estrutura acumula histórico de classificações e anomalias constatadas.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'prontuario-da-barragem.png',
        'alt'     => __( 'Prontuário digital de uma barragem no SISB, com abas de classificação, planos e documentos', 'sisb' ),
        'caption' => __( 'Prontuário da barragem com classificação, planos, documentos e notificações.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Empreendedor pessoa física ou jurídica, com validação de CPF e CNPJ', 'sisb' ),
        __( 'Vínculo entre pessoa e empreendimento, com papel', 'sisb' ),
        __( 'Empreendedor promovido a usuário do portal', 'sisb' ),
        __( 'Endereço de local com coordenadas e endereço de correspondência', 'sisb' ),
        __( 'Prontuário com seis abas: Classificação, PSB, PAE, PAM, Documentos e Notificações', 'sisb' ),
        __( 'Histórico de classificações da barragem', 'sisb' ),
        __( 'Anomalias constatadas acumuladas por estrutura', 'sisb' ),
        __( 'Pastas e arquivos por barragem, com upload e download', 'sisb' ),
        __( 'Mapa georreferenciado do parque de barragens', 'sisb' ),
        __( 'Importação de barragens por planilha Excel', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'A base legada entra por planilha', 'sisb' ),
        'text'  => __( 'Todo órgão chega com um inventário de barragens em Excel, montado ao longo de anos. O SISB importa esse arquivo direto para o cadastro, o que dispensa digitação estrutura por estrutura antes da primeira vistoria. O sistema começa a operar com o parque real, e não com uma base vazia esperando ser alimentada.', 'sisb' ),
    ),

    'canais' => array( 'web', 'app', 'portal' ),
    'perfis' => array( 'fiscal_analista', 'admin', 'fiscal', 'terceiro' ),

    'relacionados' => array( 'avaliacao-de-risco', 'planos-e-conformidade', 'relatorios' ),
);
