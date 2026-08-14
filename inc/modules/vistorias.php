<?php
/**
 * Módulo: Vistorias e Nível de Perigo Global
 *
 * Fonte: doc/product-modules.md §A2, §A3
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'coleta',
    'icon'      => 'list',
    'nav_label' => __( 'Vistorias e NPG', 'sisb' ),
    'title'     => __( 'Vistorias e Nível de Perigo Global', 'sisb' ),
    'h1'        => __( 'Formulário de vistoria padronizado, com NPG calculado', 'sisb' ),
    'summary'   => __( 'Formulários distintos para barragem de terra e de concreto, com registro fotográfico georreferenciado e cálculo automático do Nível de Perigo Global.', 'sisb' ),

    'problema'  => array(
        __( 'Quando cada equipe usa a sua planilha, duas inspeções da mesma estrutura não são comparáveis e a evolução de uma anomalia ao longo do tempo deixa de ser visível.', 'sisb' ),
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
            'text'  => __( 'Rascunho, transferência de responsável, conclusão e cancelamento, cada transição com autor registrado.', 'sisb' ),
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
        'text'  => __( 'O formulário e o motor de cálculo do NPG são os mesmos no aplicativo e na web. Uma vistoria iniciada em campo e concluída no escritório não muda de critério no caminho, o que elimina a divergência que costuma aparecer quando os dois canais são sistemas diferentes.', 'sisb' ),
    ),

    'canais' => array( 'app', 'web' ),
    'perfis' => array( 'fiscal', 'fiscal_analista', 'terceiro' ),

    'relacionados' => array( 'app-de-campo', 'avaliacao-de-risco', 'relatorios' ),
);
