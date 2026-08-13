# Auditoria da Landing Page SISB — Alegado × Real

> **Alvo:** `Z:\sisb-theme` (tema WordPress, single-page).
> **Referência de verdade:** [`product-modules.md`](./product-modules.md), derivado do código em `Z:\daee`.
> **Posicionamento acordado:** SaaS multi-cliente (SISB como produto vendável; DAEE/SP Águas como
> cliente-âncora e case), com roadmap explicitamente marcado.
> **Data:** 2026-08-13

---

## 0. Diagnóstico em uma frase

O site vende **um subconjunto genérico** do produto, escrito a partir do **contrato**, enquanto o
sistema entregue é **substancialmente maior e mais específico** do que o anunciado — e, em três
pontos, o site promete coisas que **não existem**.

O README do tema confirma a origem do problema:

> *"Utilizado como referência para textos e direcionamentos os módulos presentes no contrato."*

Contrato ≠ produto entregue. Hoje divergem nos dois sentidos.

### Placar

| Categoria | Qtd | Gravidade |
|---|---|---|
| 🔴 Afirmações **falsas ou não sustentáveis** | 8 | Alta — risco de credibilidade e de compliance comercial |
| 🟠 Afirmações **vagas/genéricas** que subvendem o produto | 6 | Média — perda de diferenciação |
| 🟡 **Placeholders** deixados em produção | 5 | Alta — o site parece não terminado |
| ⚪ **Módulos reais ausentes** do site | 14 | Alta — é o maior custo de oportunidade |
| 🔵 **Estrutura ausente** para um site de SaaS | 12 | Média/Alta — ver §5 |

---

## 1. 🔴 Afirmações falsas ou não sustentáveis (corrigir antes de qualquer outra coisa)

### 1.1 Estatísticas inventadas — seção `RESULTS` (`index.php:262-268`)

```php
array( '80%',  'Menos papel', 'Eliminação progressiva de formulários e relatórios impressos.' ),
array( '−60%', 'Tempo de relatórios', 'Geração automatizada com evidências e dados consolidados.' ),
array( '100%', 'Rastreabilidade', 'Histórico completo de inspeções, avaliações e responsáveis.' ),
```

**Problema:** não há nenhuma medição por trás desses números. `80%` e `−60%` são invenções.
Em venda para órgão público, número sem fonte é passivo — pode ser cobrado em due diligence,
e o `100%` é uma alegação absoluta.

**Correção:** substituir por afirmações **verificáveis a partir do produto**:
- "Trilha de auditoria de todas as operações" (existe: `AuditEvent`, `/auditoria`).
- "Relatório em PDF gerado em fila assíncrona, individual ou em lote" (existe: `PdfBackgroundService`,
  `POST /Relatorio/generate-pdf/all`).
- "Formulário de vistoria digital para barragem de terra e de concreto, com NPG calculado" (existe).

Se o cliente quiser números, colhê-los do DAEE e publicar como **case com fonte nomeada** — aí sim
com valor de venda.

---

### 1.2 Estatísticas inventadas — seção `NATIONAL` (`index.php:207-210`)

```php
array( '+1.000', 'Inspeções potenciais/mês' ),
```

**Problema:** "inspeções **potenciais**/mês" não significa nada — é um número inventado com uma
palavra que tenta neutralizá-lo. Piora a percepção em vez de melhorar.

**Correção:** trocar por métricas de arquitetura, que são verdadeiras e verificáveis:
`37 endpoints de API` · `6 perfis de acesso` · `2 stacks (staging/produção)` · `sync offline bidirecional`.
Ou remover a seção de números por completo até haver dados reais.

---

### 1.3 "Emissão de Alarmes" / alarmes configuráveis

**Onde:** implícito em `Avaliação de Riscos` e `Dashboards Gerenciais`; central no material de
referência (`image.png`).

**Realidade:** 🟡 parcial. Existe classificação por faixa (verde/amarela/vermelha) derivada das
anomalias (`VistoriaAlertaService`, `submit-faixa-alerta`, `DashboardFaixas.cs`).
**Não existe** configuração paramétrica das faixas conforme Volume VI do Manual do Empreendedor (ANA),
nem comprovação de recebimento, nem **SMS**.

**Correção:** anunciar como *"classificação automática por faixas de alerta a partir das anomalias
constatadas, com notificação por e-mail e push"*. Não usar "alarmes configuráveis" nem citar SMS.

---

### 1.4 Gestão de riscos por FMEA

**Onde:** não está textualmente no site hoje — **mas está no TR** e tende a vazar para a copy na
próxima revisão.

**Realidade:** ⛔ o sistema implementa **CRI, DPA e matriz de classificação (PNSB)**, não FMEA.

**Correção:** o texto correto é *"enquadramento por CRI e DPA com matriz de classificação, conforme
a Política Nacional de Segurança de Barragens"*. Isso é mais forte e mais específico que "FMEA"
para o comprador certo. **Nunca escrever FMEA.**

---

### 1.5 Gestão de denúncias

**Onde:** aparece **duas vezes** em `image-1.png` (material de referência do próprio tema).

**Realidade:** ⛔ **não existe** — zero ocorrências de `denuncia` em `backend/`, `frontend/src` e `app/src`.

**Correção:** não incluir. Se houver intenção de roadmap, marcar como *"previsto"* em uma seção de
roadmap separada e visualmente distinta.

---

### 1.6 "Workflow de Aprovação" como chip genérico (`index.php:151`)

**Realidade:** existem **quatro** workflows de aprovação distintos e nomeáveis — Tramitações,
Propostas de Resolução (PAM/PAE), Aprovação de PSB e Solicitação de Reclassificação.

**Problema:** a alegação genérica é *mais fraca que a verdade* e não é auditável em demo.

**Correção:** nomear os quatro. Ver §3.

---

### 1.7 Domínio e e-mail `sisb.gov.br` (`index.php:299`, `footer.php:42`, `header.php` OG)

```
contato@sisb.gov.br
sisb.gov.br/painel   ← na barra do browser mockado
```

**Problema duplo:** (a) o domínio não é do produto; (b) `.gov.br` num site de **SaaS vendido a
terceiros** sugere que o produto é do governo federal. Isso é uma alegação de origem institucional
que o produto não tem — e conflita frontalmente com o posicionamento SaaS multi-cliente.

**Correção:** usar o domínio comercial real do produto em todos os pontos, inclusive no mockup do
browser.

---

### 1.8 Logo grid textual como prova social (`index.php:60-64`)

```php
foreach ( array( 'SP Águas', 'Órgãos Reguladores', 'Empresas de Engenharia',
                 'Concessionárias', 'Secretarias Estaduais', 'Autarquias' ) as $l )
```

**Problema:** apresentado sob o título *"O SISB **já apoia** iniciativas…"*, em formato de logo grid.
Cinco dos seis itens são **categorias de mercado**, não clientes. Isso lê como lista de clientes e
não é. Só **SP Águas** é real.

**Correção:** uma linha honesta e mais forte —
*"Em operação no DAEE / SP Águas, no maior parque de barragens fiscalizado do país"* (ajustar ao fato)
— com logo real e autorizada. Um cliente real vale mais que seis categorias.

---

## 2. 🟡 Placeholders deixados em produção

| Local | Conteúdo | Ação |
|---|---|---|
| `index.php:300` | `+55 (11) 0000-0000` | Telefone real ou remover o campo |
| `index.php:301`, `footer.php:44` | `/company/sisb` (LinkedIn) | URL real ou remover |
| `index.php:299`, `footer.php:42` | `contato@sisb.gov.br` | E-mail real |
| `index.php:42` | `sisb.gov.br/painel` no mockup | Domínio real |
| `index.php:228-243` | **Mapa do Brasil desenhado em SVG à mão** — um polígono de 20 pontos que não tem a forma do Brasil, com labels `SP/MG`, `PA/TO` posicionados arbitrariamente | Substituir por SVG geográfico correto, ou trocar a seção por um screenshot real do mapa de barragens do sistema (`GET /Barragem/coordinates` já alimenta um mapa real no produto) |

> O mapa é o item mais visível: uma agência reguladora reconhece um mapa do Brasil errado na hora.
> **O produto tem um mapa georreferenciado real** — usar o print dele resolve credibilidade e
> prova de produto ao mesmo tempo.

---

## 3. 🟠 O que o site diz × o que o produto faz

### 3.1 Seção `SOLUTION` — os 6 "módulos" (`index.php:106-113`)

| Site diz | Realidade | Veredito |
|---|---|---|
| **Coleta de Dados** — "Formulários digitais, Captura em campo, Padronização das inspeções" | Vistoria Terra + Vistoria Concreto com **NPG calculado**, auto de inspeção, auto de infração com PDF, auto de inspeção de outorga, uso de recurso hídrico | 🟠 **Subvende** — genérico demais |
| **Aplicativo Mobile** — "Android e iOS, Operação offline, Sincronização automática" | Correto. WatermelonDB, sync bidirecional `/Sync/pull|push`, histórico de payload, designação de empreendimentos offline | ✅ **Preciso** (único item bem descrito) |
| **Gestão de Inspeções** — "Planejamento, Execução, Histórico completo" | Requerimentos com máquina de estados (8 transições), Atribuições Técnicas com transferência/comentários/anexos/histórico, Tramitações | 🟠 **Subvende muito** |
| **Gestão de Empreendimentos** — "Cadastro de barragens, Dados técnicos, Georreferenciamento" | + Pessoas PF/PJ com validação CPF/CNPJ, vínculos N:N, endereço de local e correspondência, **importação Excel**, dashboard por empreendimento, **prontuário da barragem com 6 abas** | 🟠 **Subvende** |
| **Avaliação de Riscos** — "CRI e DPA, Matrizes de risco, Indicadores" | Correto quanto a CRI/DPA/Matriz. "Indicadores" é vago | 🟡 **Quase preciso** |
| **Relatórios e Exportações** — "PDF e relatórios técnicos, Evidências fotográficas, Compartilhamento controlado" | + Fila assíncrona, **geração em lote**, **PDF companion**, **templates de relatório**, exportação Excel de classificação, export/import de PAM e PAE | 🟠 **Subvende** |

**Ausentes desta lista, embora sejam módulos completos em produção:**
PSB · PAE · PAM · Portal do Empreendedor · Autos de Inspeção/Infração · Fiscalização de Outorga ·
Tramitações · Atribuições Técnicas · Notificações · Auditoria · Documentos · Painel Gerencial ·
API/Integrações · Solicitação de Reclassificação.

---

### 3.2 Seção `FEATURES` — os 16 chips (`index.php:140-157`)

| Chip | Existe? | Observação |
|---|---|---|
| Gestão de Inspeções | ✅ | |
| Gestão de Barragens | ✅ | Muito além do chip — o dashboard tem 6 abas |
| **Gestão de Requisitos** | ❓ | Termo ambíguo. Se for "requerimentos", o nome está **errado** — corrigir para **Processos de Vistoria / Requerimentos** |
| Avaliação de Risco | ✅ | |
| Emissão de Relatórios | ✅ | |
| Formulários Digitais | ✅ | |
| Operação Offline | ✅ | Diferencial real, tratado como chip secundário |
| Captura de Fotos e Vídeos | ✅ | `MediaController` suporta ambos |
| Gestão de Evidências | ✅ | Com coordenadas por imagem e marca d'água |
| Controle de Acessos | ✅ | 6 papéis, menu filtrado por papel |
| Workflow de Aprovação | ✅ | Existem 4 — nomear (ver §1.6) |
| Histórico de Auditoria | ✅ | `AuditEvent` + tela `/auditoria` |
| Geolocalização | ✅ | Coordenadas de barragem, de imagem e **unidade por localização** |
| Dashboards Gerenciais | ✅ | Com **série histórica** (snapshots append-only) |
| Indicadores Operacionais | 🟡 | Vago; sobrepõe o anterior |
| Integrações via API | ✅ | JWT + API Key + Swagger + importação SOE real |

**Veredito:** nenhum chip é falso, mas **o formato é o problema**. Uma grade de 16 chips genéricos é
indistinguível da de qualquer concorrente. O que diferencia o SISB — PSB com eventos e prazos
monitorados, PAM/PAE com propostas de resolução, portal do regulado, dupla cadeia
segurança + outorga — **não está ali**.

---

### 3.3 Seção `DIFFERENTIATORS` (`index.php:177-184`)

| Site diz | Avaliação |
|---|---|
| Especializado em Barragens | ✅ Verdadeiro e é o melhor argumento do site |
| Operação Offline | ✅ Verdadeiro |
| Escalável para Todo o Brasil | 🟠 Afirmação de capacidade, não de fato. Suportável: multi-unidade, unidade por geolocalização, dois stacks, Docker/ECR. Reescrever ancorando nesses fatos |
| Rastreabilidade Completa | 🟠 "Completa" é absoluto. Trocar por "trilha de auditoria de operações, histórico de atribuições e histórico de sincronização" |
| Centralização de Informações | ✅ |
| Redução de Processos Manuais | 🟠 Sem prova. Ancorar em fatos: geração de PDF em lote, importação de base via Excel, monitores automáticos de prazo |

**Faltando aqui** (diferenciais reais e defensáveis em demo):
- **Duas cadeias de valor no mesmo produto**: segurança de barragem **e** fiscalização de outorga.
- **Plataforma de duas pontas**: órgão fiscalizador **e** empreendedor no mesmo sistema.
- **Monitores automáticos de prazo** (PSB e PAM) que notificam sem ação humana.
- **Paridade real app/web**: o mesmo motor de cálculo de risco nos dois canais.
- **Onboarding com base legada**: importação de barragens por Excel + importação de requerimentos SOE.

---

### 3.4 Navegação (`header.php:32-38`)

```php
<a href="#diferenciais">Clientes</a>   ← rótulo "Clientes" aponta para "Diferenciais"
```

| Rótulo | Destino | Problema |
|---|---|---|
| Solução | `#plataforma` | ok |
| Funcionalidades | `#funcionalidades` | ok |
| Setores | `#mercados` | ok |
| **Clientes** | `#diferenciais` | 🔴 **Rótulo não corresponde ao conteúdo.** Não há seção de clientes |
| Contato | `#contato` | ok |

Além disso: **toda a navegação é âncora**. Não há uma única página interna — é exatamente o problema
que motivou este trabalho.

---

### 3.5 Footer (`footer.php`)

- Coluna "Produto": 3 dos 4 links apontam para o **mesmo** `#plataforma`.
- Coluna "Contato": "Telefone" e "LinkedIn" apontam para `#contato`, não para telefone/LinkedIn.
- **Ausente:** Política de Privacidade, Termos de Uso, LGPD, Acessibilidade, Segurança, Status,
  Documentação/API, Mapa do site.

Para um SaaS que trata dado de infraestrutura crítica e dado pessoal de empreendedores (CPF/CNPJ,
endereço, telefone), a ausência de política de privacidade e menção à **LGPD** é um problema
jurídico, não estético.

---

## 4. ⚪ Módulos reais ausentes do site (custo de oportunidade)

Ordenados por impacto comercial estimado:

| # | Módulo | Por que importa na venda |
|---|---|---|
| 1 | **Portal do Empreendedor** | Transforma "sistema interno" em plataforma de duas pontas; reduz carga de atendimento do órgão. Argumento de ROI direto |
| 2 | **PSB — eventos, propostas e prazos** | Maior módulo do sistema (31 endpoints). É a obrigação regulatória central do comprador |
| 3 | **PAM e PAE** | Follow-up com cronograma e aprovação de propostas — responde "e depois da inspeção, o que acontece?" |
| 4 | **Autos de Inspeção e Infração** | O instrumento com poder de polícia. Com PDF e cálculo por UFESP |
| 5 | **Fiscalização de Outorga** | Segunda cadeia de valor completa — dobra o mercado endereçável |
| 6 | **Atribuições Técnicas** | Responde "como controlo minha equipe e os prazos dela?" |
| 7 | **Tramitações** | Workflow de aprovação cadastral com o regulado |
| 8 | **Notificações + Templates** | Comunicação oficial com trilha documental, envio em lote, e-mail + push |
| 9 | **Painel de Dados** | Primeira tela do gestor; tem série histórica |
| 10 | **API / API Keys / Swagger** | Integração comprovada (SOE), não prometida. Objeção clássica de TI pública |
| 11 | **Auditoria** | Requisito de compliance de órgão de controle |
| 12 | **Documentos por barragem** | Repositório do acervo técnico |
| 13 | **Importação Excel de barragens** | Argumento de time-to-value no onboarding |
| 14 | **Solicitação de Reclassificação** | Devido processo para o regulado contestar |

---

## 5. 🔵 O que falta como *site de SaaS*

Auditoria estrutural, independente de conteúdo. Estado atual: **single-page, 8 seções, 1 formulário**.

### 5.1 Estrutura e conteúdo

| Item | Estado | Prioridade |
|---|---|---|
| **Páginas por módulo** | ❌ Ausente — é o pedido do cliente | 🔴 Alta |
| **Página de preços** (ou "Fale com vendas" com faixas/modelo) | ❌ Ausente | 🔴 Alta — é a segunda página mais visitada de qualquer SaaS |
| **Case / prova social real** | ❌ Ausente (só o logo grid falso) | 🔴 Alta |
| **Página de Segurança e LGPD** | ❌ Ausente | 🔴 Alta — bloqueia venda pública |
| **Página de API / Documentação** | ❌ Ausente (a API existe e tem Swagger) | 🟠 Média |
| **FAQ** | ❌ Ausente | 🟠 Média — captura tráfego e reduz ciclo de venda |
| **Demonstração em vídeo / tour de produto** | ❌ Ausente | 🟠 Média |
| **Screenshots reais do produto** | 🟡 Um único `sisb-dashboard.png` no hero | 🔴 Alta |
| **Blog / conteúdo (SEO)** | ❌ Ausente | 🟡 Baixa (fase 2) |
| **Comparativo com alternativa atual** ("planilha e papel") | 🟡 Só a seção de desafios | 🟡 Baixa |
| **Página "Sobre / Quem somos"** | ❌ Ausente | 🟠 Média — venda pública exige saber quem é o fornecedor |
| **Legal**: Privacidade, Termos, Cookies | ❌ Ausente | 🔴 Alta |

### 5.2 Técnico

| Item | Estado | Nota |
|---|---|---|
| Meta description + OG | ✅ Presente (`header.php:11-15`) | Falta `og:image` e `og:url` |
| Imagem OG | ❌ Ausente | `twitter:card` é `summary_large_image` mas não há imagem |
| Favicon | ❓ Não declarado no tema | Verificar |
| `sitemap.xml` / `robots.txt` | ❌ Não gerenciado pelo tema | Plugin de SEO ou geração própria |
| Dados estruturados (schema.org `SoftwareApplication`, `Organization`, `FAQPage`) | ❌ Ausente | Ganho direto de SERP |
| Canonical | ❌ Ausente | Necessário ao criar páginas internas |
| Analytics + rastreio de conversão de CTA | ❌ Ausente | Sem isso não há como otimizar |
| Formulário → CRM | ❌ Só `wp_mail` | Lead se perde na caixa de entrada |
| **Acessibilidade (WCAG 2.1 AA / e-MAG)** | ❓ Não auditado | 🔴 **Obrigatório** para venda a órgão público brasileiro |
| Performance (fontes Google, imagens) | 🟡 `preconnect` presente | Auditar LCP; `sisb-dashboard.png` sem `loading`/`width`/`height` |
| Multi-idioma | ✅ Preparado (`__()`, textdomain `sisb`) | Sem tradução carregada |
| Segurança do formulário | ✅ Nonce + sanitização + honeypot | Bom. Considerar rate limit |

### 5.3 Conversão

| Item | Estado |
|---|---|
| CTA único e claro | ✅ "Agendar Demonstração", consistente |
| CTA secundário de baixo atrito (ex.: baixar ficha técnica, ver tour) | ❌ Ausente — 100% do site depende de um formulário de 6 campos |
| Prova de risco reduzido (segurança, hospedagem, SLA, suporte) | ❌ Ausente |
| Página de agradecimento com próximo passo | 🟡 Só um alerta inline |
| Chat / WhatsApp | ❌ Ausente |

---

## 6. Ordem de correção recomendada

**Bloco 1 — parar o sangramento (baixo esforço, alto risco evitado)**
1. Remover/substituir as estatísticas inventadas (§1.1, §1.2).
2. Corrigir todos os placeholders de contato e domínio (§2).
3. Corrigir o logo grid falso (§1.8).
4. Corrigir o rótulo "Clientes" na navegação (§3.4).
5. Substituir o mapa SVG artesanal por screenshot real do mapa do produto (§2).

**Bloco 2 — dizer a verdade maior (esforço médio, ganho alto)**
6. Reescrever a seção de módulos a partir do catálogo real (§3.1 + `product-modules.md`).
7. Reescrever os diferenciais com os cinco argumentos defensáveis (§3.3).
8. Adicionar screenshots reais por módulo.

**Bloco 3 — virar site de produto (o pedido original)**
9. Criar as páginas por módulo (ver `site-ia.md`).
10. Criar Preços, Segurança & LGPD, API, FAQ, Sobre e as páginas legais.
11. Instrumentar analytics, SEO técnico e integração do formulário.

---

## 7. Regras de redação (para manter o site honesto daqui em diante)

1. **Nada entra no site sem existir no código.** `product-modules.md` é a fonte; se não está lá com ✅,
   não vira copy afirmativa.
2. **Roadmap fica em bloco visualmente separado**, com rótulo "em desenvolvimento". Nunca misturado à
   lista de funcionalidades.
3. **Número no site exige fonte.** Ou é métrica do sistema (contável), ou é dado de cliente com
   autorização e atribuição.
4. **Preferir o específico ao superlativo.** "Cronograma de PSB com monitor automático de prazos"
   vende mais que "gestão completa e integrada".
5. **Sem absolutos** — "completo", "100%", "total" — salvo quando literalmente verdadeiro.
6. **Não usar `.gov.br`** nem qualquer marca institucional sem autorização escrita.
7. Ao adicionar um `Controller` novo no backend, revisar se o site precisa acompanhar.
