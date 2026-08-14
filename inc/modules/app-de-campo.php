
<?php
/**
 * Módulo: App de Campo Offline
 *
 * Fonte: doc/product-modules.md §A1
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'coleta',
    'icon'      => 'smartphone',
    'nav_label' => __( 'App de Campo', 'sisb' ),
    'title'     => __( 'App de Campo Offline', 'sisb' ),
    'h1'        => __( 'Inspeção em campo, com ou sem sinal', 'sisb' ),
    'summary'   => __( 'Aplicativo Android e iOS com banco de dados completo no dispositivo. A fiscalização acontece integralmente offline e sincroniza quando houver rede.', 'sisb' ),

    'problema'  => array(
        __( 'Barragem fica onde não há rede. Quando a coleta depende de conexão, a equipe volta a papel e planilha. O retrabalho de digitação no escritório vira a norma, não a exceção.', 'sisb' ),
        __( 'Pior que o retrabalho é a perda de evidência: foto sem vínculo com o item inspecionado, anotação que não chega, vistoria que precisa ser refeita porque o formulário voltou incompleto.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'A base vai junto para campo', 'sisb' ),
            'text'  => __( 'Antes do deslocamento, os empreendimentos designados ao fiscal são carregados no dispositivo. Cadastro, barragens, histórico e vistorias anteriores ficam disponíveis para consulta.', 'sisb' ),
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
            'text'  => __( 'O conteúdo de cada troca fica registrado, o que permite auditar divergências e reconstruir o que foi enviado por cada dispositivo.', 'sisb' ),
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
        'title' => __( 'Não é cache, é banco de dados', 'sisb' ),
        'text'  => __( 'A maior parte dos aplicativos de inspeção guarda um formulário em cache e falha quando o fluxo depende de dados relacionados. Aqui o dispositivo carrega o mesmo modelo de dados do servidor. Isso permite criar empreendimento, barragem, vistoria e auto em campo, todos relacionados entre si, sem nenhuma conexão.', 'sisb' ),
    ),

    'canais' => array( 'app' ),
    'perfis' => array( 'fiscal', 'fiscal_analista', 'terceiro' ),

    'relacionados' => array( 'vistorias', 'autos-e-outorga', 'avaliacao-de-risco' ),
);

