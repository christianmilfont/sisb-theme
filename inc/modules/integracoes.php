<?php
/**
 * Módulo: Integrações e API
 *
 * Fonte: doc/product-modules.md §G4
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

return array(
    'status'    => 'ready',
    'group'     => 'plataforma',
    'icon'      => 'plug',
    'nav_label' => __( 'Integrações e API', 'sisb' ),
    'title'     => __( 'Integrações e API', 'sisb' ),
    'h1'        => __( 'Conversa com o que você já tem', 'sisb' ),
    'summary'   => __( 'API documentada com autenticação por token e por chave de serviço, importação da base existente e integração já em produção com sistema legado.', 'sisb' ),

    'problema'  => array(
        __( 'Nenhum órgão começa do zero. Já existe o sistema de outorga, a base de cadastro, a planilha que a equipe mantém há anos. Um produto que ignora isso obriga a digitar duas vezes o mesmo dado — e a divergência entre as duas bases aparece em poucos meses.', 'sisb' ),
        __( 'A objeção costuma vir da área de TI, e é legítima: como o dado entra, como ele sai, com qual credencial e com qual documentação. Sem resposta a isso, a integração vira um projeto à parte, com prazo e custo próprios.', 'sisb' ),
    ),

    'como_funciona' => array(
        array(
            'title' => __( 'A API é a mesma que o produto usa', 'sisb' ),
            'text'  => __( 'Web, aplicativo de campo e sistemas terceiros consomem a mesma API REST. Não há endpoint de vitrine: o que o sistema faz é o que a integração alcança.', 'sisb' ),
        ),
        array(
            'title' => __( 'A documentação vem da própria API', 'sisb' ),
            'text'  => __( 'A especificação Swagger/OpenAPI é publicada pela aplicação, o que mantém a documentação alinhada à versão que está no ar.', 'sisb' ),
        ),
        array(
            'title' => __( 'São dois modos de autenticar', 'sisb' ),
            'text'  => __( 'Token JWT para acesso de usuário e chave de API para comunicação entre sistemas. O sistema integrador não precisa de uma conta de pessoa para funcionar.', 'sisb' ),
        ),
        array(
            'title' => __( 'As chaves são administradas pelo cliente', 'sisb' ),
            'text'  => __( 'Emissão, listagem, regeneração, ativação, desativação e exclusão são feitas na própria interface administrativa, sem depender do fornecedor.', 'sisb' ),
        ),
        array(
            'title' => __( 'A base existente entra por importação', 'sisb' ),
            'text'  => __( 'Requerimentos são importados do sistema legado de outorga, por protocolo ou em lote, e o cadastro de barragens entra por planilha Excel.', 'sisb' ),
        ),
    ),

    'screenshot' => array(
        'file'    => 'integracoes.png',
        'alt'     => __( 'Tela de gestão de chaves de API do SISB e documentação Swagger da API', 'sisb' ),
        'caption' => __( 'Administração de chaves de serviço e documentação da API publicada pela aplicação.', 'sisb' ),
    ),

    'capacidades' => array(
        __( 'API REST documentada em Swagger/OpenAPI', 'sisb' ),
        __( 'Autenticação por token JWT para usuários', 'sisb' ),
        __( 'Autenticação por chave de API para sistema a sistema', 'sisb' ),
        __( 'Emissão, regeneração, ativação e desativação de chaves', 'sisb' ),
        __( 'Importação de requerimentos do sistema legado de outorga', 'sisb' ),
        __( 'Importação por protocolo individual ou em lote', 'sisb' ),
        __( 'Importação do cadastro de barragens por planilha Excel', 'sisb' ),
        __( 'Exportação do relatório de classificação em Excel', 'sisb' ),
        __( 'Exportação e importação de cronograma de PAM e PAE', 'sisb' ),
        __( 'Download de documentos e evidências por endpoint', 'sisb' ),
    ),

    'destaque' => array(
        'title' => __( 'Integração comprovada, não prometida', 'sisb' ),
        'text'  => __( 'A importação de requerimentos do SOE, o sistema legado de outorga, já roda em produção — individual por protocolo e em lote. A diferença para um roteiro de integração no papel é que o caminho de dados já foi percorrido, com os problemas de formato e de duplicidade resolvidos em operação real.', 'sisb' ),
    ),

    'canais' => array( 'api' ),
    'perfis' => array( 'admin' ),

    'relacionados' => array( 'governanca', 'prontuario-da-barragem' ),
);
