<?php
/**
 * Módulo: Avaliação de Risco — CRI, DPA e Matriz de Classificação
 *
 * Fonte: doc/product-modules.md §D1
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'gestao',
    'icon'      => 'chart',
    'nav_label' => __( 'Avaliação de Risco', 'sisb' ),
    'title'     => __( 'Avaliação de Risco: CRI, DPA e Matriz', 'sisb' ),
    'h1'        => __( 'Enquadramento conforme a Política Nacional de Segurança de Barragens', 'sisb' ),
    'summary'   => __( 'Cálculo automático de Categoria de Risco e Dano Potencial Associado, com posicionamento na matriz de classificação.', 'sisb' ),

    'problema'  => array(
        __( 'A classificação da barragem define prioridade de fiscalização, prazo e exigência documental. Quando ela sai de planilha montada por cada técnico, duas estruturas equivalentes podem terminar em categorias diferentes.', 'sisb' ),
        __( 'E o resultado envelhece sem deixar rastro. Meses depois, ninguém consegue dizer quais respostas produziram aquela categoria — o que fragiliza o órgão justamente quando a classificação é contestada.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'Características técnicas da estrutura', 'sisb' ),
            'text'  => __( 'A avaliação abre pelos dados construtivos da barragem, que compõem a primeira parte da Categoria de Risco.', 'sisb' ),
        ),
        array(
            'title' => __( 'Estado de conservação', 'sisb' ),
            'text'  => __( 'O técnico registra a condição observada da estrutura, seção que dialoga diretamente com o que foi constatado na vistoria.', 'sisb' ),
        ),
        array(
            'title' => __( 'Plano de Segurança da Barragem', 'sisb' ),
            'text'  => __( 'A existência e a situação do PSB entram como seção própria do formulário, conforme previsto na classificação.', 'sisb' ),
        ),
        array(
            'title' => __( 'Classificação do Dano Potencial Associado', 'sisb' ),
            'text'  => __( 'Volume, ocupação a jusante e demais fatores de dano são informados em seção separada, que produz o DPA.', 'sisb' ),
        ),
        array(
            'title' => __( 'Resultado e posição na matriz', 'sisb' ),
            'text'  => __( 'O sistema calcula CRI e DPA e apresenta a posição da barragem na matriz de classificação, com as categorias A, B, C e D.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'avaliacao-de-risco.png',
        'alt'     => __( 'Tela de avaliação de risco do SISB com resultado de CRI, DPA e matriz de classificação', 'sisb' ),
        'caption' => __( 'Resultado da avaliação com CRI, DPA e posição na matriz de classificação.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Formulário estruturado em cinco seções', 'sisb' ),
        __( 'Cálculo automático da Categoria de Risco (CRI)', 'sisb' ),
        __( 'Cálculo automático do Dano Potencial Associado (DPA)', 'sisb' ),
        __( 'Posicionamento na matriz de classificação (A, B, C e D)', 'sisb' ),
        __( 'Avaliação avulsa, sem processo prévio', 'sisb' ),
        __( 'Rascunho, transferência de responsável e conclusão registrada', 'sisb' ),
        __( 'Consulta da última avaliação concluída por barragem', 'sisb' ),
        __( 'Comparação com a avaliação anterior da mesma estrutura', 'sisb' ),
        __( 'Mesmo motor de cálculo no aplicativo e na web', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'A categoria fica reconstituível', 'sisb' ),
        'text'  => __( 'Cada avaliação guarda as respostas que produziram o CRI e o DPA, e a avaliação anterior da mesma barragem fica acessível ao lado. Quando o empreendedor questiona a classificação, a resposta do órgão não depende da memória de quem preencheu. É a diferença entre uma categoria que se explica e uma que apenas se afirma.', 'sisb' ),
    ),

    'canais' => array( 'app', 'web' ),
    'perfis' => array( 'fiscal', 'fiscal_analista' ),

    'relacionados' => array( 'vistorias', 'planos-e-conformidade', 'painel-de-dados' ),
);
