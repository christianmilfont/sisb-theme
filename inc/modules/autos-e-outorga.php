```php
<?php
/**
 * Módulo: Autos de Inspeção, Infração e Fiscalização de Outorga
 *
 * Fonte: doc/product-modules.md §A4, §A5
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'coleta',
    'icon'      => 'scroll',
    'nav_label' => __( 'Autos e Outorga', 'sisb' ),
    'title'     => __( 'Autos de Inspeção, Infração e Fiscalização de Outorga', 'sisb' ),
    'h1'        => __( 'Do registro à sanção, no mesmo fluxo', 'sisb' ),
    'summary'   => __( 'Auto de inspeção, auto de infração com PDF e penalidade parametrizada, além da fiscalização de outorga e do uso de recursos hídricos.', 'sisb' ),

    'problema'  => array(
        __( 'O auto é o documento que sustenta a sanção. Quando ele nasce em papel e é redigitado depois, o intervalo entre a constatação e a lavratura aumenta. Com isso, cresce também o risco de divergência entre o que o fiscal viu e o que o processo registra.', 'sisb' ),
        __( 'A base de cálculo agrava o problema. Penalidade referenciada em UFESP e calculada fora do sistema depende de alguém lembrar do valor vigente. O erro só aparece quando a autuação é questionada.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'O auto de inspeção é emitido pela unidade', 'sisb' ),
            'text'  => __( 'A lavratura parte da unidade responsável e pode ser vinculada a um requerimento existente ou seguir por requerimento avulso, quando a inspeção não tem processo prévio.', 'sisb' ),
        ),
        array(
            'title' => __( 'A constatação de infração tem formulário próprio', 'sisb' ),
            'text'  => __( 'O fiscal registra a infração constatada e as penalidades cabíveis em formulário estruturado, no aplicativo ou na web.', 'sisb' ),
        ),
        array(
            'title' => __( 'A penalidade usa a UFESP vigente', 'sisb' ),
            'text'  => __( 'O valor da multa sai das unidades UFESP aplicadas, multiplicadas pela UFESP vigente. O mesmo cálculo é utilizado no aplicativo e no servidor. A atualização do valor é feita pela administração do sistema, sem novo deploy.', 'sisb' ),
        ),
        array(
            'title' => __( 'O auto de infração vira documento e notificação', 'sisb' ),
            'text'  => __( 'O sistema gera o PDF do auto e permite emitir a notificação vinculada ao empreendedor a partir dele, sem redigitar dados.', 'sisb' ),
        ),
        array(
            'title' => __( 'A trilha de outorga corre em paralelo', 'sisb' ),
            'text'  => __( 'O auto de inspeção de outorga tem fluxo próprio, por unidade e por empreendimento, com os usos de recurso hídrico registrados e vinculados ao auto.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'autos-e-outorga.png',
        'alt'     => __( 'Tela do SISB de lavratura de auto de infração com penalidades', 'sisb' ),
        'caption' => __( 'Auto de infração com constatação, penalidades e emissão de PDF.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Auto de inspeção emitido por unidade', 'sisb' ),
        __( 'Vinculação do auto a requerimento, com requerimento avulso disponível', 'sisb' ),
        __( 'Transferência de responsável pelo auto', 'sisb' ),
        __( 'Lavratura de auto de infração', 'sisb' ),
        __( 'Geração do auto de infração em PDF', 'sisb' ),
        __( 'Notificação ao empreendedor emitida a partir do auto', 'sisb' ),
        __( 'Formulário de constatação de infração e penalidades', 'sisb' ),
        __( 'Cálculo do valor da multa a partir das unidades UFESP aplicadas', 'sisb' ),
        __( 'Valor da UFESP configurável em tempo de execução', 'sisb' ),
        __( 'Auto de inspeção de outorga por unidade e por empreendimento', 'sisb' ),
        __( 'Registro de uso de recurso hídrico vinculado ao auto', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'Duas cadeias de fiscalização, um só produto', 'sisb' ),
        'text'  => __( 'Segurança de barragem e outorga costumam viver em sistemas separados, com cadastros que não conversam. Aqui as duas trilhas correm sobre a mesma base de empreendimentos, barragens e unidades, cada uma com seu auto e seu formulário. O órgão que fiscaliza os dois temas não precisa manter dois sistemas nem reconciliar dois cadastros.', 'sisb' ),
    ),

    'canais' => array( 'app', 'web' ),
    'perfis' => array( 'fiscal', 'fiscal_analista', 'admin' ),

    'relacionados' => array( 'vistorias', 'comunicacao-e-portal', 'processos-e-equipe' ),
);
```
