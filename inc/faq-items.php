```php
<?php
/**
 * Perguntas frequentes.
 *
 * Consumido por templates/pages/faq.php e por inc/schema.php (FAQPage).
 *
 * Fonte factual: doc/product-modules.md (somente itens) e
 * daee/doc/architecture.md para as respostas de infraestrutura.
 *
 * O valor de 'a' entra em JSON-LD: texto puro, sem HTML.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @return array<int,array{title:string,items:array<int,array{q:string,a:string}>}>
 */
function sisb_faq_items() {
    return array(

        array(
            'title' => __( 'Produto e escopo', 'sisb' ),
            'items' => array(
                array(
                    'q' => __( 'O que é o SISB?', 'sisb' ),
                    'a' => __( 'É uma plataforma de fiscalização e segurança de barragens formada por três aplicações sobre a mesma base de dados e a mesma API: um aplicativo de campo que opera sem conexão, um back-office web para análise e gestão, e um portal para o empreendedor. São doze módulos, do cadastro da barragem ao relatório de inspeção com evidências.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Para quem o SISB foi feito?', 'sisb' ),
                    'a' => __( 'Para o órgão que fiscaliza barragens e para o empreendedor que responde por elas. O sistema tem seis perfis de acesso, administrador, analista de fiscalização, fiscal de campo, empresa contratada, empreendedor e usuário base. Cada item de menu declara quais perfis o enxergam.', 'sisb' ),
                ),
                array(
                    'q' => __( 'O SISB cobre apenas segurança de barragem?', 'sisb' ),
                    'a' => __( 'Não. São duas cadeias de fiscalização no mesmo produto: a de segurança de barragem, com vistoria, avaliação de risco e planos de segurança; e a de outorga, com auto de inspeção próprio e registro dos usos de recurso hídrico constatados em campo.', 'sisb' ),
                ),
                array(
                    'q' => __( 'O que o empreendedor resolve sozinho no portal?', 'sisb' ),
                    'a' => __( 'Ele acompanha as barragens sob sua responsabilidade e a classificação de cada uma, consulta as notificações que recebeu, acompanha suas tramitações cadastrais e envia propostas de resolução para itens do plano de melhoria e do plano de emergência. Toda solicitação cadastral vinda do portal passa por aprovação de um analista do órgão antes de valer.', 'sisb' ),
                ),
                array(
                    'q' => __( 'O que o SISB não faz?', 'sisb' ),
                    'a' => __( 'Não é ferramenta de engenharia: não faz modelagem de ruptura, estudo de mancha de inundação nem projeto de intervenção. A mancha existe apenas como tipo de processo, não como análise. Também não há módulo de recebimento e tratamento de denúncias.', 'sisb' ),
                ),
            ),
        ),

        array(
            'title' => __( 'Operação em campo', 'sisb' ),
            'items' => array(
                array(
                    'q' => __( 'Como o aplicativo funciona sem sinal?', 'sisb' ),
                    'a' => __( 'Antes do deslocamento, os empreendimentos designados ao fiscal são carregados no aparelho, com cadastro, barragens e vistorias anteriores. Em campo, vistoria, avaliação de risco, autos e fotos são gravados primeiro no banco local do dispositivo, sem depender de rede para serem concluídos.', 'sisb' ),
                ),
                array(
                    'q' => __( 'O que é sincronizado quando a rede volta?', 'sisb' ),
                    'a' => __( 'A sincronização é bidirecional: o aparelho envia o que produziu e recebe o que mudou no servidor. O conteúdo de cada troca fica registrado, o que permite auditar divergências e reconstruir o que foi enviado por cada dispositivo.', 'sisb' ),
                ),
                array(
                    'q' => __( 'E se o mesmo registro for alterado no celular e no escritório?', 'sisb' ),
                    'a' => __( 'A resolução de conflito é por data de alteração: prevalece a versão mais recente. Por isso vale combinar quem edita o quê enquanto há vistoria em campo. O histórico de sincronização permite identificar depois o que foi sobrescrito.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Em quais plataformas o aplicativo roda?', 'sisb' ),
                    'a' => __( 'Android e iOS, com o mesmo formulário de vistoria disponível também no navegador. A distribuição das versões Android é feita por canal controlado para as equipes designadas.', 'sisb' ),
                ),
                array(
                    'q' => __( 'O formulário de vistoria é o mesmo para toda barragem?', 'sisb' ),
                    'a' => __( 'Não. Há dois formulários, um para barragem de terra e outro para barragem de concreto. Cada item inspecionado recebe classificação de anomalia, o sistema calcula o Nível de Perigo Global e permite comparar o resultado com a vistoria anterior da mesma estrutura.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Como a evidência fotográfica é tratada?', 'sisb' ),
                    'a' => __( 'Fotos e vídeos são vinculados ao item inspecionado, com coordenadas por imagem, legenda editável e marca d\'água aplicada no aplicativo. A equipe decide imagem a imagem o que entra no relatório final.', 'sisb' ),
                ),
            ),
        ),

        array(
            'title' => __( 'Implantação e integração', 'sisb' ),
            'items' => array(
                array(
                    'q' => __( 'Como entra a base de barragens que já existe?', 'sisb' ),
                    'a' => __( 'Há importação de barragens por planilha, além do cadastro de pessoas físicas e jurídicas com validação de CPF e CNPJ e vínculo com os empreendimentos. A planilha precisa ser preparada e mapeada antes. Essa parte é trabalho de projeto, não de clique.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Dá para integrar com o sistema que já usamos?', 'sisb' ),
                    'a' => __( 'Sim, pela API REST documentada em OpenAPI, com dois esquemas de autenticação em paralelo: token de usuário e chave de serviço. Hoje há uma integração em produção com o sistema de outorga que envia os requerimentos, individualmente por protocolo ou em lote.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Existem conectores prontos para outros sistemas?', 'sisb' ),
                    'a' => __( 'Não. Cada nova integração é construída sobre a API, com mapeamento de campos definido caso a caso. O que já está pronto é a porta de entrada: emissão, regeneração e desativação de chaves de serviço, além da documentação publicada pela própria API.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Como o acesso das equipes é controlado?', 'sisb' ),
                    'a' => __( 'Pelos seis perfis, com o menu filtrado item a item conforme o papel do usuário. A estrutura de unidades regionais complementa esse controle: a barragem é associada à unidade competente pela coordenada, o que organiza a operação em mais de uma região.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Precisamos adotar todos os módulos de uma vez?', 'sisb' ),
                    'a' => __( 'Os módulos compartilham a mesma base de dados e a mesma API, então não são pedaços independentes de software que se instalam separadamente. O que varia é a ordem em que a equipe passa a usar cada parte. Começar por cadastro e vistoria e incorporar planos, notificações e portal do empreendedor depois é um caminho possível.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Quanto tempo leva a implantação?', 'sisb' ),
                    'a' => __( 'Não há prazo padrão a publicar. O tempo depende do volume e do estado da base a migrar, da definição das unidades e dos perfis e da preparação dos modelos de notificação e de relatório. Esse é um trabalho de serviço que existe além do software. A estimativa é feita caso a caso, a partir desses pontos.', 'sisb' ),
                ),
            ),
        ),

        array(
            'title' => __( 'Conformidade e dados', 'sisb' ),
            'items' => array(
                array(
                    'q' => __( 'Como o sistema enquadra a barragem?', 'sisb' ),
                    'a' => __( 'O formulário de avaliação de risco é estruturado em seções: características técnicas, estado de conservação, plano de segurança e classificação do dano potencial. A partir delas o sistema calcula a Categoria de Risco e o Dano Potencial Associado e posiciona a barragem na matriz de classificação, conforme a Política Nacional de Segurança de Barragens. O aplicativo e o web usam a mesma lógica de cálculo.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Como os planos de segurança e seus prazos são acompanhados?', 'sisb' ),
                    'a' => __( 'O plano de segurança da barragem organiza eventos, prazos por evento e propostas de resolução sujeitas a aprovação do analista. Os planos de ação de melhoria e de emergência seguem a mesma mecânica, com criticidade e cronograma visual. Monitores em segundo plano acompanham o vencimento dos prazos e disparam notificação por e-mail e no aplicativo. Não há envio por SMS.', 'sisb' ),
                ),
                array(
                    'q' => __( 'O que fica registrado para auditoria?', 'sisb' ),
                    'a' => __( 'Há trilha de eventos consultável em tela dedicada ao administrador, histórico próprio das atribuições técnicas com comentários e anexos, e registro de cada sincronização do aplicativo. O painel gerencial guarda fotografias periódicas dos indicadores, o que dá série histórica em vez de apenas o número do dia.', 'sisb' ),
                ),
                array(
                    'q' => __( 'Onde os dados ficam hospedados?', 'sisb' ),
                    'a' => __( 'Em infraestrutura na AWS, com os ambientes de homologação e de produção isolados um do outro. O banco de dados roda em contêiner com volume persistente e cópia diária enviada para armazenamento em nuvem, com retenção de sete dias. Imagens, anexos, documentos e relatórios ficam em repositórios separados por ambiente.', 'sisb' ),
                ),
                array(
                    'q' => __( 'O SISB tem certificação de segurança?', 'sisb' ),
                    'a' => __( 'Não temos certificação ISO ou SOC 2 a apresentar. O que descrevemos são práticas verificáveis em demonstração: autenticação por token com expiração e renovação, seis perfis de acesso, trilha de auditoria das operações, isolamento entre ambientes e cópia diária do banco.', 'sisb' ),
                ),
                array(
                    'q' => __( 'O sistema trata dados pessoais?', 'sisb' ),
                    'a' => __( 'Sim: nome, CPF ou CNPJ, endereço e contato das pessoas vinculadas aos empreendimentos, além dos dados dos próprios usuários. O acesso é restrito por perfil, as operações ficam na trilha de auditoria e o empreendedor enxerga apenas o seu portal, com as barragens pelas quais responde.', 'sisb' ),
                ),
            ),
        ),

    );
}
```
