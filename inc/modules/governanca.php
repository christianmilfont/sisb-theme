<?php
/**
 * Módulo: Acessos, Auditoria e Administração
 *
 * Fonte: doc/product-modules.md §G2, §G3, §G6, §B4
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'plataforma',
    'icon'      => 'lock',
    'nav_label' => __( 'Governança e Acessos', 'sisb' ),
    'title'     => __( 'Acessos, Auditoria e Administração', 'sisb' ),
    'h1'        => __( 'Controle, rastreabilidade e prestação de contas', 'sisb' ),
    'summary'   => __( 'Seis perfis de acesso com permissões distintas, trilha de auditoria consultável e configuração de parâmetros sem nova implantação.', 'sisb' ),

    'problema'  => array(
        __( 'Fiscal de campo, analista de escritório, empresa contratada e empreendedor não podem enxergar as mesmas telas. Quando o sistema tem um único nível de acesso, a saída acaba sendo o acordo informal — e a senha compartilhada.', 'sisb' ),
        __( 'Órgão público responde por quem fez o quê e quando. Se a resposta depende de consultar o banco de dados ou de perguntar ao fornecedor, a prestação de contas fica refém de terceiros justamente no momento em que ela é cobrada.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'O papel define o que aparece', 'sisb' ),
            'text'  => __( 'São seis perfis de acesso, e o menu é filtrado item a item conforme o papel do usuário. Cada um vê o recorte do sistema que corresponde à sua função.', 'sisb' ),
        ),
        array(
            'title' => __( 'O acesso é administrado por dentro', 'sisb' ),
            'text'  => __( 'Cadastro de usuário, redefinição de senha, habilitação e desabilitação de conta e designação de empreendimentos para uso offline são operações da equipe do cliente.', 'sisb' ),
        ),
        array(
            'title' => __( 'A estrutura regional organiza a operação', 'sisb' ),
            'text'  => __( 'As unidades regionais do órgão são cadastradas, e a barragem é associada à unidade competente pela sua coordenada. Órgãos de controle externos ficam disponíveis como destinatários de notificação.', 'sisb' ),
        ),
        array(
            'title' => __( 'O que acontece fica registrado', 'sisb' ),
            'text'  => __( 'A trilha de auditoria é consultável em tela própria do administrador, complementada pelo histórico das atribuições técnicas e pelo registro de cada sincronização do aplicativo.', 'sisb' ),
        ),
        array(
            'title' => __( 'Parâmetros mudam sem nova versão', 'sisb' ),
            'text'  => __( 'O valor da UFESP, base de cálculo das penalidades, é atualizado pela administração do sistema. Reajuste anual não vira chamado nem janela de implantação.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'governanca.png',
        'alt'     => __( 'Tela de auditoria e gestão de usuários do SISB', 'sisb' ),
        'caption' => __( 'Trilha de auditoria consultável e administração de usuários e perfis.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'Seis perfis de acesso com permissões distintas', 'sisb' ),
        __( 'Menu filtrado por papel, item a item', 'sisb' ),
        __( 'Autenticação JWT com refresh token', 'sisb' ),
        __( 'Recuperação e redefinição de senha', 'sisb' ),
        __( 'Habilitar e desabilitar usuário', 'sisb' ),
        __( 'Trilha de auditoria consultável em tela dedicada', 'sisb' ),
        __( 'Histórico de atribuições técnicas e de sincronização', 'sisb' ),
        __( 'Unidades regionais resolvidas pela coordenada da barragem', 'sisb' ),
        __( 'Órgãos de controle externos como destinatários de notificação', 'sisb' ),
        __( 'Atualização do valor da UFESP sem novo deploy', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'A unidade competente sai da coordenada', 'sisb' ),
        'text'  => __( 'A estrutura regional do órgão é cadastrada no sistema, e a consulta por localização devolve a unidade responsável pela barragem a partir de suas coordenadas. Isso evita a associação manual, que é onde a operação multirregional costuma acumular erro. É também a peça que permite um mesmo cliente operar várias regionais sem separar bases.', 'sisb' ),
    ),

    'canais' => array( 'web', 'api' ),
    'perfis' => array( 'admin' ),

    'relacionados' => array( 'integracoes', 'processos-e-equipe' ),
);
