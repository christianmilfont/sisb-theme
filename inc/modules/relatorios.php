<?php
/**
 * Módulo: Relatórios, Documentos e Exportações
 *
 * Fonte: doc/product-modules.md §F1, §F2, §B3
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'gestao',
    'icon'      => 'file',
    'nav_label' => __( 'Relatórios e Documentos', 'sisb' ),
    'title'     => __( 'Relatórios, Documentos e Exportações', 'sisb' ),
    'h1'        => __( 'O documento técnico sai pronto', 'sisb' ),
    'summary'   => __( 'Relatório em PDF gerado a partir dos dados da vistoria, com anexo fotográfico, templates configuráveis e acervo documental por barragem.', 'sisb' ),

    'problema'  => array(
        __( 'A inspeção termina e o trabalho recomeça: alguém redigita no editor de texto o que já foi preenchido no formulário, escolhe fotos em uma pasta e monta o documento à mão. O relatório demora mais que a vistoria.', 'sisb' ),
        __( 'Depois o arquivo some. PSB, PAE, laudos e projetos ficam em unidades de rede, caixas de e-mail, pastas pessoais e quem precisa reconstituir o histórico de uma barragem começa perguntando quem tem o arquivo.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'O relatório nasce do processo', 'sisb' ),
            'text'  => __( 'O documento é vinculado ao processo de vistoria e à avaliação de risco correspondente. Os dados já preenchidos em campo são a matéria-prima — não há redigitação.', 'sisb' ),
        ),
        array(
            'title' => __( 'A evidência entra selecionada', 'sisb' ),
            'text'  => __( 'Cada foto tem legenda, coordenada e um controle de visibilidade. Só entra no documento o que foi marcado para entrar; o restante permanece no acervo da vistoria.', 'sisb' ),
        ),
        array(
            'title' => __( 'O template define a forma', 'sisb' ),
            'text'  => __( 'Os modelos de relatório são configuráveis no próprio sistema, o que permite ajustar o documento ao padrão do órgão sem depender de nova versão.', 'sisb' ),
        ),
        array(
            'title' => __( 'A geração roda em fila', 'sisb' ),
            'text'  => __( 'O PDF é produzido em fila assíncrona, um a um ou em lote. O documento principal sai acompanhado de um anexo fotográfico em arquivo separado.', 'sisb' ),
        ),
        array(
            'title' => __( 'O arquivo fica no prontuário', 'sisb' ),
            'text'  => __( 'Relatórios e demais documentos ficam armazenados em nuvem e organizados por barragem, em estrutura de pastas navegável.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'relatorios.png',
        'alt'     => __( 'Tela de relatórios do SISB com geração de PDF e acervo de documentos por barragem', 'sisb' ),
        'caption' => __( 'Geração do relatório de inspeção e repositório documental da barragem.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Relatório vinculado ao processo de vistoria', 'sisb' ),
        __( 'Relatório vinculado à avaliação de risco', 'sisb' ),
        __( 'Geração de PDF em fila assíncrona', 'sisb' ),
        __( 'Geração em lote dos relatórios', 'sisb' ),
        __( 'Anexo fotográfico em PDF separado', 'sisb' ),
        __( 'Templates de relatório configuráveis', 'sisb' ),
        __( 'Seleção de quais evidências entram no documento', 'sisb' ),
        __( 'Exportação do relatório de classificação em Excel', 'sisb' ),
        __( 'Exportação e importação de cronograma de PAM e PAE', 'sisb' ),
        __( 'Repositório de documentos por barragem, em pastas', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'O relatório não trava a tela', 'sisb' ),
        'text'  => __( 'A montagem do PDF acontece em fila, fora do ciclo da interface. Quem pediu o documento continua trabalhando enquanto ele é produzido, e o encerramento de uma campanha de fiscalização não depende de gerar um arquivo por vez: é possível disparar a geração de todos os relatórios em lote.', 'sisb' ),
    ),

    'canais' => array( 'web', 'api' ),
    'perfis' => array( 'fiscal_analista', 'admin', 'fiscal' ),

    'relacionados' => array( 'vistorias', 'prontuario-da-barragem', 'planos-e-conformidade' ),
);
