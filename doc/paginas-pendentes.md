# Páginas pendentes — o que falta e por quê

Cinco páginas previstas em [`site-ia.md`](./site-ia.md) **não foram construídas** porque dependem de
informação que não está no código nem nos documentos do projeto. Escrever qualquer uma delas a
partir de suposição produziria exatamente o problema que este trabalho veio corrigir.

Este documento registra o que falta, quem decide e o que já está pronto para ser aproveitado.

---

## 1. `/precos/` — Modelo comercial

**Bloqueio:** o modelo de cobrança não está definido em nenhum artefato do projeto.

**Decisões necessárias:**

- Unidade de cobrança — por barragem? por usuário? por órgão? por faixa de parque fiscalizado?
- Há mensalidade, licença anual, ou contratação por processo licitatório?
- O que entra na implantação (migração da base, treinamento, homologação) e como é cobrado?
- Existe faixa de entrada, ou tudo é "fale com vendas"?
- Módulos são vendidos separadamente ou a plataforma é indivisível?

**Recomendação:** mesmo sem tabela pública, a página vale a pena. Comprador público precisa
entender a **estrutura** do custo para montar o processo de contratação. Uma página que explica o
modelo e as variáveis, terminando em "fale com vendas", converte mais do que a ausência de página.

**Prioridade:** alta. É a segunda página mais visitada de um site de SaaS.

---

## 2. `/sobre/` — Quem desenvolve

**Bloqueio:** a identidade do fornecedor não está definida no material disponível. O repositório
menciona ambientes em `produtoreativo.com` e o tema original vem de outro autor, mas nada disso
autoriza afirmar razão social, CNPJ ou histórico.

**Decisões necessárias:**

- Razão social, CNPJ e endereço do fornecedor
- Quem assina o contrato com o DAEE / SP Águas
- Histórico da empresa, equipe técnica, outros projetos no setor público
- Se há sócios ou parceiros a nomear

**Por que importa:** órgão público não contrata fornecedor anônimo. Ausência de página "Sobre" é
objeção real em qualificação.

**Prioridade:** alta.

---

## 3. `/privacidade/` — Política de Privacidade

**Bloqueio:** documento jurídico. Não deve ser redigido por quem não responde por ele.

**Ponto importante:** o levantamento técnico já foi feito e está abaixo. Isso é o insumo que um
advogado precisa — entregue isto, não um template genérico.

### Dados pessoais tratados pelo sistema

| Categoria | Onde | Origem |
|---|---|---|
| Nome, CPF ou CNPJ | `Pessoa` (empreendedores PF e PJ) | Cadastro pelo órgão ou tramitação do empreendedor |
| Endereço de local e de correspondência | `Endereco` | Cadastro |
| Telefone e e-mail | `Pessoa`, `User` | Cadastro e criação de usuário |
| Nome e credenciais de servidores e técnicos | `User` | Administração do sistema |
| Coordenadas geográficas | `Barragem`, `Media` | Coleta em campo |
| Fotos e vídeos de inspeção | `Media` → S3 | Coleta em campo |
| Endereço IP | Formulário de contato do site | Envio de formulário |

### Finalidade

Exercício da fiscalização e da gestão de segurança de barragens — atividade de competência do órgão
fiscalizador. A base legal provável é execução de política pública / cumprimento de obrigação legal,
**mas isso é definição jurídica, não técnica.**

### Onde os dados ficam

- Banco SQL Server em container, com volume persistente, no host de cada ambiente
- Arquivos em AWS S3 (buckets separados para anexos, imagens, documentos e relatórios)
- Backup diário do banco em S3, com retenção de sete dias
- Cópia local no dispositivo do fiscal (banco SQLite do aplicativo), limitada aos empreendimentos
  designados àquele usuário

### Terceiros com acesso a dado

| Serviço | Função | Dado exposto |
|---|---|---|
| AWS (S3, ECR, EC2) | Hospedagem e armazenamento | Todos |
| Sentry | Rastreamento de erro | Metadados de execução; pode conter identificadores |
| Resend | Entrega de e-mail em produção | Destinatário e conteúdo da notificação |
| Google Cloud Run | Push notification | Identificador de dispositivo e conteúdo do aviso |
| Firebase App Distribution | Distribuição do aplicativo | Dados de instalação |

### Perguntas para o jurídico

- Quem é controlador e quem é operador na relação fornecedor ↔ órgão?
- Qual a base legal declarada para cada categoria?
- Prazo de retenção — inclusive da cópia no dispositivo do fiscal
- Como o titular exerce os direitos da LGPD, e por qual canal
- Há transferência internacional? (S3, Sentry, Resend e GCP podem implicar)
- Encarregado (DPO) nomeado e canal de contato

**Prioridade:** alta. Sem esta página, o site coleta dado pessoal (formulário de demonstração) sem
política publicada.

---

## 4. `/termos/` — Termos de Uso

**Bloqueio:** documento jurídico.

Depende de: modelo de contratação, SLA oferecido, propriedade dos dados inseridos pelo cliente,
condições de rescisão e portabilidade da base ao final do contrato.

**Prioridade:** média. Menos urgente que a política de privacidade, porque o site em si não cria
relação contratual — mas necessária antes de qualquer contratação.

---

## 5. `/acessibilidade/` — Declaração de Acessibilidade

**Bloqueio parcial.** A declaração precisa afirmar um **nível verificado** de conformidade, e essa
verificação ainda não foi feita.

**O que já foi implementado no tema:**

- Atalho "pular para o conteúdo", visível ao receber foco por teclado
- Foco visível consistente em links, botões, campos e acordeões, com contraste próprio sobre fundo escuro
- Menu mobile com `aria-expanded`, `aria-controls`, fechamento por `Escape` e devolução de foco ao botão
- Mega-menu que abre por `:focus-within`, navegável por teclado sem JavaScript
- FAQ em `<details>/<summary>` — acordeão acessível sem JavaScript
- Trilha de navegação com `aria-current="page"`
- Um único `<h1>` por página, hierarquia de títulos sem salto
- Tabelas com `<th>` e cabeçalho de escopo, dentro de contêiner com rolagem própria
- Imagens com `alt` descritivo; ícones decorativos com `aria-hidden`
- `prefers-reduced-motion` respeitado nas animações

**O que falta para poder declarar conformidade:**

- Auditoria com ferramenta automatizada (axe, Lighthouse, ASES do governo federal)
- Verificação manual de contraste em todos os pares de cor do design system
- Teste com leitor de tela (NVDA ou JAWS)
- Definição do nível a declarar — e-MAG e/ou WCAG 2.1 AA

**Prioridade:** alta se houver venda a órgão público. A declaração é exigível.

---

## 6. Questionário de segurança — lacunas conhecidas

Levantado ao redigir `/seguranca/`. São perguntas que **qualquer área de TI de órgão público faz**
em qualificação de fornecedor, e para as quais não existe fato verificado no projeto. A página de
segurança foi escrita sem afirmar nenhuma delas.

Não é lista de defeitos — é a diferença entre o que o sistema faz e o que ainda não foi
documentado ou decidido.

### Proteção de dados

1. **Criptografia em repouso** — banco, volumes dos contêineres e objetos no S3: existe? Como a chave é gerenciada?
2. **Proteção do dispositivo de campo** — a base local do aplicativo é cifrada? Há remoção remota quando o aparelho é perdido ou o usuário é desabilitado?
3. **Localização dos dados** — região AWS do host e dos buckets. Há tratamento fora do Brasil?
4. **Subprocessadores** — lista formal e contrato de operador com AWS, Sentry, Resend, Firebase e o serviço de push. Transferência internacional não foi avaliada.

### Continuidade

5. **Teste de restauração** — o backup diário é restaurado e validado periodicamente? A retenção de sete dias basta contratualmente?
6. **Recuperação de desastre** — RPO e RTO definidos? Hoje há um único host, com banco em contêiner, sem serviço gerenciado nem réplica documentada.
7. **Disponibilidade** — há SLA, janela de manutenção e monitoramento de uptime? O Sentry cobre erro de aplicação, não disponibilidade.

### Acesso

8. **Política de senha e sessão** — comprimento e complexidade mínimos, expiração de token, bloqueio por tentativa. **Não há MFA.**
9. **Segregação de rede** — o banco está exposto apenas à rede interna? Há security group, VPN ou bastion para acesso administrativo?
10. **Gestão de chaves de serviço** — rotação obrigatória, escopo por chave, expiração automática.
11. **Retenção da trilha de auditoria** — por quanto tempo os eventos são mantidos? São imutáveis?

### Processo

12. **Teste de segurança** — houve pentest, varredura de dependências ou análise estática no pipeline?
13. **LGPD operacional** — prazo de guarda, rotina de eliminação, fluxo de atendimento ao titular, encarregado indicado, RIPD.
14. **Resposta a incidente** — existe procedimento e prazo de notificação ao controlador em caso de vazamento?

> **Recomendação:** tratar isto como backlog de pré-venda. Cada item resolvido vira uma linha a mais
> que a página de segurança pode afirmar — e uma objeção a menos em qualificação. Os itens 1, 2, 5,
> 8 e 12 são os que mais aparecem em questionário de órgão público.

---

## 7. Questionário técnico de integração — lacunas conhecidas

Mesma lógica do anterior, levantado ao redigir `/api/`. São perguntas que a área de TI do cliente
faz antes de aprovar uma integração. A página foi escrita sem afirmar nenhuma.

**Já resolvido durante a redação:** o cabeçalho da chave de serviço é `X-API-Key`
(`Authentication/ApiKeyAuthenticationOptions.cs:8`). Catálogo e página corrigidos.

### Contrato da API

1. **Versionamento** — há prefixo de versão? Qual a política de mudança incompatível e o prazo de depreciação?
2. **Formato de erro e códigos de retorno** padronizados
3. **Paginação e filtros** nas listagens
4. **Rate limit ou quota** — hoje inexistente na documentação

### Credenciais

5. **Tempo de vida** do token de acesso e do refresh token; a chave de serviço expira?
6. **Escopo da chave de serviço** — dá acesso à API inteira ou a um subconjunto? Há vínculo com papel?
7. **Rotação** — obrigatória, ou fica a critério do cliente?
8. **IP allowlist, mTLS ou VPN** para o tráfego sistema a sistema

### Operação

9. **Ambiente de homologação para o cliente integrar** — existe stack de staging interna, mas não há fato de que seja oferecida a terceiros
10. **SLA e janela de manutenção** da API

### Integrações específicas

11. **Contrato da importação SOE** — quem chama quem? Que credencial o SISB usa contra o SOE? Só os endpoints de importação estão documentados
12. **Layout da planilha de barragens** — colunas obrigatórias, tratamento de duplicidade, relatório de erro da importação
13. **Formato dos arquivos de export/import de PAM e PAE** — Excel, CSV ou JSON? Não consta
14. **Sincronização do aplicativo** — intervalo, gatilho, tamanho de payload, retenção do histórico

> Os itens 1, 2, 3 e 6 são os que travam aprovação de integração com mais frequência. Documentá-los
> custa pouco e destrava a página `/api/` para afirmar bem mais do que afirma hoje.

---

## Resumo

| Página | Bloqueio | Quem resolve | Prioridade |
|---|---|---|---|
| `/precos/` | Modelo comercial indefinido | Comercial | Alta |
| `/sobre/` | Identidade do fornecedor | Comercial / societário | Alta |
| `/privacidade/` | Redação jurídica (insumo técnico pronto acima) | Jurídico | Alta |
| `/termos/` | Redação jurídica | Jurídico | Média |
| `/acessibilidade/` | Auditoria não realizada | Técnico | Alta |

Assim que qualquer um destes for destravado, a página se cria com a mesma mecânica das existentes:
uma entrada em `inc/pages.php` e um template em `templates/pages/<slug>.php`. Nenhuma configuração
no painel do WordPress.
