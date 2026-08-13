<?php
/**
 * Módulo: Painel Gerencial
 *
 * Fonte: doc/product-modules.md §G1, §G5
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'gestao',
    'icon'      => 'activity',
    'nav_label' => __( 'Painel de Dados', 'sisb' ),
    'title'     => __( 'Painel Gerencial', 'sisb' ),
    'h1'        => __( 'A situação do parque de barragens, agora e ao longo do tempo', 'sisb' ),
    'summary'   => __( 'Distribuição por faixas de alerta, mapa georreferenciado e série histórica — não apenas a foto do momento.', 'sisb' ),

    'problema'  => array(
        __( 'Quando a direção pergunta quantas barragens estão em faixa vermelha, alguém abre uma planilha e começa a somar. A resposta chega dias depois e já não corresponde ao que está no sistema.', 'sisb' ),
        __( 'A pergunta seguinte é pior: melhorou ou piorou desde o ano passado? Em geral não há resposta, porque o número anterior foi sobrescrito pelo atual e o comparativo nunca foi guardado.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'O painel é a primeira tela', 'sisb' ),
            'text'  => __( 'Ao entrar no back-office, o usuário cai no painel gerencial. O indicador não é um relatório que alguém precisa pedir — é o ponto de partida do dia.', 'sisb' ),
        ),
        array(
            'title' => __( 'O parque aparece distribuído por faixa', 'sisb' ),
            'text'  => __( 'As barragens são agrupadas por faixa de alerta, com rótulos padronizados. A leitura é a mesma para todas as unidades e todos os perfis.', 'sisb' ),
        ),
        array(
            'title' => __( 'O mapa mostra onde estão', 'sisb' ),
            'text'  => __( 'As coordenadas cadastradas alimentam a visão georreferenciada do parque, o que permite ler concentração e dispersão do risco no território.', 'sisb' ),
        ),
        array(
            'title' => __( 'Cada consolidação vira registro', 'sisb' ),
            'text'  => __( 'Os dados consolidados são gravados como snapshots datados, sem sobrescrever os anteriores. A comparação entre períodos passa a ser consulta, não reconstrução.', 'sisb' ),
        ),
        array(
            'title' => __( 'A busca atravessa o cadastro', 'sisb' ),
            'text'  => __( 'Um único campo de busca alcança barragem, empreendimento, pessoa e processo, para quem já sabe o que procura e não quer navegar por menus.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'painel-de-dados.png',
        'alt'     => __( 'Painel gerencial do SISB com distribuição por faixas de alerta e mapa das barragens', 'sisb' ),
        'caption' => __( 'Painel gerencial com distribuição por faixa de alerta e visão georreferenciada do parque.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Painel gerencial como tela inicial do back-office', 'sisb' ),
        __( 'Distribuição do parque por faixas de alerta', 'sisb' ),
        __( 'Rótulos de indicador padronizados entre as telas', 'sisb' ),
        __( 'Snapshots datados, sem sobrescrita, com série histórica', 'sisb' ),
        __( 'Mapa georreferenciado das barragens cadastradas', 'sisb' ),
        __( 'Busca geral unificada em um único campo', 'sisb' ),
        __( 'Status e faixa de alerta consolidados por barragem', 'sisb' ),
        __( 'Dashboard por empreendimento', 'sisb' ),
        __( 'Dashboard de atribuições técnicas da equipe', 'sisb' ),
        __( 'Painel próprio do empreendedor, com suas barragens e a faixa de cada uma', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'Série histórica, não só o número de hoje', 'sisb' ),
        'text'  => __( 'Cada consolidação do painel é gravada como um novo registro datado, e os registros anteriores permanecem. Isso muda a pergunta que o gestor pode fazer: em vez de apenas como está o parque, passa a ser possível responder como ele chegou até aqui. Para prestação de contas, a trajetória costuma valer mais que o retrato.', 'sisb' ),
    ),

    'canais' => array( 'web', 'portal' ),
    'perfis' => array( 'admin', 'fiscal_analista', 'empreendedor' ),

    'relacionados' => array( 'avaliacao-de-risco', 'planos-e-conformidade', 'governanca' ),
);
