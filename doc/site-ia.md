# SISB — Arquitetura de Informação do Site

> **Alvo:** `Z:\sisb-theme` (tema WordPress).
> **Posicionamento:** SaaS multi-cliente — SISB como produto vendável para órgãos fiscalizadores,
> secretarias, autarquias, concessionárias e empresas de engenharia. DAEE / SP Águas como
> cliente-âncora e case.
> **Fonte de conteúdo:** [`product-modules.md`](./product-modules.md).
> **Correções obrigatórias antes de publicar:** [`landing-gap-analysis.md`](./landing-gap-analysis.md).
> **Data:** 2026-08-13

---

## 1. Princípio de organização

O material de referência do próprio cliente (`sisb-theme/image-1.png`) já divide o produto em
**Coleta** e **Gestão**. Essa divisão é boa e deve ser mantida — ela espelha a jornada real do
usuário (campo → escritório) e é imediatamente compreensível para o comprador.

Adiciono um terceiro eixo que o material não tem, mas que é obrigatório em venda de SaaS público:
**Plataforma** (integração, acessos, auditoria, administração) — é onde moram as objeções de TI.

```
                    ┌──────────────────────────────────────────┐
                    │              SISB — Produto              │
                    └──────────────────────────────────────────┘
                                       │
        ┌──────────────────────────────┼──────────────────────────────┐
        │                              │                              │
   ▼ COLETA                       ▼ GESTÃO                      ▼ PLATAFORMA
  (campo, offline)          (escritório, conformidade)     (TI, integração, governança)

  1. App de Campo           4. Prontuário da Barragem      9. Integrações e API
  2. Vistorias e NPG        5. Avaliação de Risco         10. Plataforma e Governança
  3. Autos e Outorga        6. Planos e Conformidade
                            7. Processos e Equipe
                            8. Comunicação e Portal
                               do Empreendedor
                           (+) Relatórios e Documentos
                           (+) Painel de Dados
```

---

## 2. Sitemap proposto

```
/                                       Home (reescrita)
│
├── /modulos/                           Índice de módulos — hub visual (Coleta | Gestão | Plataforma)
│   │
│   │   ── COLETA ──
│   ├── /modulos/app-de-campo/                    App mobile offline-first
│   ├── /modulos/vistorias/                       Vistorias de terra e concreto + NPG + evidências
│   ├── /modulos/autos-e-outorga/                 Autos de inspeção, infração e fiscalização de outorga
│   │
│   │   ── GESTÃO ──
│   ├── /modulos/prontuario-da-barragem/          Cadastro, prontuário, documentos, mapa
│   ├── /modulos/avaliacao-de-risco/              CRI, DPA, matriz de classificação
│   ├── /modulos/planos-e-conformidade/           PSB, PAE, PAM, faixas de alerta
│   ├── /modulos/processos-e-equipe/              Requerimentos, atribuições técnicas, tramitações
│   ├── /modulos/comunicacao-e-portal/            Notificações, templates, portal do empreendedor
│   ├── /modulos/relatorios/                      PDF, templates, exportações
│   ├── /modulos/painel-de-dados/                 Dashboard gerencial e indicadores
│   │
│   │   ── PLATAFORMA ──
│   ├── /modulos/integracoes/                     API, API Keys, Swagger, importações
│   └── /modulos/governanca/                      Perfis de acesso, auditoria, configurações
│
├── /solucoes/                          (fase 2) Recorte por perfil de comprador
│   ├── /solucoes/orgaos-reguladores/
│   ├── /solucoes/concessionarias/
│   └── /solucoes/empresas-de-engenharia/
│
├── /precos/                            Modelo comercial / "fale com vendas"
├── /seguranca/                         Segurança da informação, LGPD, hospedagem, backup
├── /api/                               Documentação e capacidade de integração
├── /casos/                             Cases — começar com DAEE / SP Águas
├── /faq/                               Perguntas frequentes (com schema.org FAQPage)
├── /sobre/                             Quem desenvolve, contrato, credenciais
├── /contato/                           Formulário dedicado (hoje só existe como âncora)
│
└── Legal
    ├── /privacidade/
    ├── /termos/
    └── /acessibilidade/                Declaração de conformidade (e-MAG / WCAG 2.1 AA)
```

### Navegação principal proposta

| Item | Tipo | Destino |
|---|---|---|
| **Módulos** | mega-menu (3 colunas: Coleta · Gestão · Plataforma) | `/modulos/` |
| **Soluções** | dropdown (fase 2) | `/solucoes/` |
| **Segurança** | link | `/seguranca/` |
| **Casos** | link | `/casos/` |
| **Preços** | link | `/precos/` |
| *CTA* | botão | `/contato/` — "Agendar demonstração" |

> Remover o rótulo "Clientes" apontando para `#diferenciais` (bug atual, `header.php:36`).

---

## 3. Template de página de módulo

Estrutura fixa e repetível — cada página de módulo tem **as mesmas 9 seções**, na mesma ordem.
Consistência é o que faz um conjunto de páginas parecer um produto, e não uma coleção de textos.

| # | Seção | Conteúdo | Fonte |
|---|---|---|---|
| 1 | **Hero** | Eyebrow (grupo: Coleta/Gestão/Plataforma) · H1 = nome do módulo · 1 frase do que resolve · CTA primário (demo) + secundário (próximo módulo) | `product-modules.md` |
| 2 | **O problema** | 2–3 frases sobre a dor específica *deste* módulo. Concreto, sem clichê | Contexto de negócio |
| 3 | **Como funciona** | 3–5 blocos com o fluxo real do módulo, na ordem em que o usuário executa | Seção "Como funciona" do catálogo |
| 4 | **Screenshot real** | Print da tela do módulo, com legenda descritiva | 📸 **a produzir** — ver §5 |
| 5 | **Capacidades** | Lista objetiva do que o módulo faz. Cada item deve ser demonstrável em demo | Endpoints/telas do catálogo |
| 6 | **Onde funciona** | Selo App / Web / Portal do Empreendedor / API | Coluna "Disponível em" |
| 7 | **Quem usa** | Perfis (`FISCAL`, `FISCAL_ANALISTA`, `ADMIN`, `TERCEIRO`, `EMPREENDEDOR`) | §2 do catálogo |
| 8 | **Conecta com** | 3–4 links para módulos relacionados — cria a malha interna (SEO + navegação) | Relações do catálogo |
| 9 | **CTA final** | Bloco de conversão reaproveitado do template | — |

**Opcional, quando houver:** bloco *"Em desenvolvimento"* — visualmente distinto (fundo, borda,
rótulo explícito), listando apenas itens 🔵 do catálogo. **Nunca** misturado à seção 5.

---

## 4. Conteúdo por página de módulo

Resumo do que entra em cada página. O texto completo sai do `product-modules.md`.

### COLETA

#### `/modulos/app-de-campo/` — App de Campo Offline
- **H1:** Inspeção em campo, com ou sem sinal
- **Problema:** barragem fica onde não há rede. Coleta em papel gera retrabalho, perda de evidência e atraso.
- **Como funciona:** banco de dados completo no dispositivo → coleta integral offline → sincronização bidirecional → trilha de sincronização auditável.
- **Capacidades:** Android e iOS · designação de empreendimentos para uso offline · sincronização `pull/push` · resolução de conflito por timestamp · histórico de payloads · 13 áreas funcionais no app · distribuição via Firebase App Distribution.
- **Diferencial a destacar:** não é cache — é banco relacional local com o mesmo modelo do servidor.
- **Conecta com:** Vistorias · Avaliação de Risco · Autos e Outorga
- **Fonte:** catálogo A1

#### `/modulos/vistorias/` — Vistorias e Nível de Perigo Global
- **H1:** Formulário de vistoria padronizado, com NPG calculado
- **Como funciona:** escolha do tipo (terra/concreto) → preenchimento item a item → registro fotográfico georreferenciado → NPG calculado → transferência/conclusão → comparação com a vistoria anterior.
- **Capacidades:** formulários distintos para terra e concreto · cálculo automático do NPG · foto e vídeo com coordenadas, legenda e marca d'água · controle de visibilidade da evidência no relatório · vistoria avulsa · comparação com a anterior · paridade app/web.
- **Conecta com:** App de Campo · Relatórios · Avaliação de Risco
- **Fonte:** catálogo A2, A3

#### `/modulos/autos-e-outorga/` — Autos de Inspeção, Infração e Fiscalização de Outorga
- **H1:** Do registro à sanção, no mesmo fluxo
- **Como funciona:** auto de inspeção por unidade → constatação de infração → penalidade calculada por UFESP → auto de infração em PDF → notificação ao empreendedor.
- **Capacidades:** auto de inspeção · auto de infração com geração de PDF · penalidades parametrizadas por UFESP (ajustável sem deploy) · notificação vinculada ao auto · transferência de responsável · **auto de inspeção de outorga** e registro de **uso de recurso hídrico**.
- **Diferencial a destacar:** duas cadeias de fiscalização no mesmo produto — segurança de barragem **e** outorga.
- **Conecta com:** Comunicação · Processos e Equipe · Prontuário
- **Fonte:** catálogo A4, A5

### GESTÃO

#### `/modulos/prontuario-da-barragem/` — Cadastro e Prontuário Digital
- **H1:** Tudo sobre cada barragem, em uma tela
- **Como funciona:** cadastro de empreendimento e empreendedor → barragem georreferenciada → prontuário com 6 abas → acervo documental.
- **Capacidades:** empreendedores PF/PJ com validação de CPF/CNPJ · vínculos pessoa↔empreendimento · endereço de local e de correspondência · **importação de barragens via Excel** · dashboard da barragem (Classificação · PSB · PAE · PAM · Documentos · Notificações) · anomalias constatadas acumuladas · histórico de classificações · mapa georreferenciado do parque · gestor de arquivos hierárquico por barragem · unidade resolvida por geolocalização.
- **Diferencial a destacar:** importação de base legada = time-to-value curto no onboarding.
- **Conecta com:** Avaliação de Risco · Planos e Conformidade · Relatórios
- **Fonte:** catálogo B1–B4

#### `/modulos/avaliacao-de-risco/` — Avaliação de Risco: CRI, DPA e Matriz
- **H1:** Enquadramento conforme a Política Nacional de Segurança de Barragens
- **Como funciona:** características técnicas → estado de conservação → plano de segurança → classificação DPA → resultado com posição na matriz.
- **Capacidades:** cálculo automático de CRI e DPA · matriz de classificação · avaliação avulsa · comparação com a avaliação anterior · última avaliação concluída por barragem · transferência e conclusão com responsável · **mesmo motor de cálculo no app e no web**.
- ⚠️ **Nunca escrever "FMEA"** — ver `landing-gap-analysis.md` §1.4.
- **Conecta com:** Vistorias · Planos e Conformidade · Painel de Dados
- **Fonte:** catálogo D1

#### `/modulos/planos-e-conformidade/` — PSB, PAE, PAM e Faixas de Alerta
- **H1:** O que acontece depois da inspeção
- **Problema:** a inspeção aponta o problema; a conformidade exige acompanhar a correção — com prazo, responsável e prova.
- **Como funciona:** recebimento e aprovação do PSB → eventos com prazos → propostas de resolução do empreendedor → aprovação/rejeição do órgão → monitor automático de vencimento → notificação.
- **Capacidades:** ciclo completo de PSB (aprovar, arquivar, PSB ativo por barragem) · eventos de PSB incluindo **ISE** · gestão e prorrogação de prazos · **PAM** com status e criticidade · **PAE** por barragem e empreendimento · propostas de resolução com aprovação/reprovação em todos os três · exportação e importação de cronograma · cronograma visual (Gantt) · **monitores automáticos em background** para prazos de PSB e PAM · classificação por faixa verde/amarela/vermelha derivada das anomalias.
- ⚠️ **Não citar SMS nem "comprovação de recebimento"** — ver `landing-gap-analysis.md` §1.3.
- **Diferencial a destacar:** monitores automáticos — o sistema cobra o prazo sozinho.
- **Conecta com:** Comunicação e Portal · Prontuário · Painel de Dados
- **Fonte:** catálogo D2–D5

#### `/modulos/processos-e-equipe/` — Processos de Vistoria e Atribuições Técnicas
- **H1:** Quem está fazendo o quê, e até quando
- **Como funciona:** requerimento (SOE importado ou SISB gerado) → atribuição a um técnico → execução → revisão → conclusão; em paralelo, tramitações cadastrais aprovadas por analista.
- **Capacidades:** requerimento SOE e SISB · **importação SOE individual e em lote** · requerimento avulso · máquina de estados (revisão, conclusão, aborto, restauração) · fila pessoal e dashboard de atribuições · transferência de atribuição · comentários, anexos e histórico · tramitações de cadastro e vínculo de representante com aprovar/rejeitar · solicitação de reclassificação.
- **Conecta com:** Vistorias · Governança · Comunicação e Portal
- **Fonte:** catálogo C1–C4

#### `/modulos/comunicacao-e-portal/` — Notificações e Portal do Empreendedor
- **H1:** O órgão e o empreendedor na mesma plataforma
- **Problema:** notificar por ofício e planilha não gera trilha, não tem prazo e consome a equipe em atendimento.
- **Como funciona:** notificação a partir de template → envio individual ou em lote → e-mail e push → empreendedor acessa o portal, vê a classificação da sua barragem, responde com proposta de resolução.
- **Capacidades:** templates de notificação com editor rico · envio em lote · remetentes por barragem · estatísticas de notificação · eventos vencidos · histórico persistido · fila de e-mail assíncrona · push notification · **portal do empreendedor** com dashboard próprio, minhas notificações, minhas tramitações e envio de propostas.
- **Diferencial a destacar:** plataforma de duas pontas — reduz atendimento e cria trilha documental.
- **Conecta com:** Planos e Conformidade · Processos e Equipe
- **Fonte:** catálogo E1, E2

#### `/modulos/relatorios/` — Relatórios, Documentos e Exportações
- **H1:** O documento técnico sai pronto
- **Capacidades:** relatório de inspeção vinculado ao processo e à avaliação · geração de PDF em **fila assíncrona** · **geração em lote** · **PDF companion** com anexo fotográfico · templates de relatório configuráveis · exportação Excel do relatório de classificação · exportação/importação de PAM e PAE · gestor documental por barragem · armazenamento em nuvem.
- **Conecta com:** Vistorias · Prontuário · Planos e Conformidade
- **Fonte:** catálogo F1, F2, B3

#### `/modulos/painel-de-dados/` — Painel Gerencial
- **H1:** A situação do parque de barragens, agora e ao longo do tempo
- **Capacidades:** painel gerencial como tela inicial · distribuição por faixas de alerta · **snapshots append-only com série histórica** (não só foto do momento) · mapa georreferenciado do parque · busca geral unificada · dashboard por empreendimento e por barragem · dashboard de atribuições técnicas.
- **Conecta com:** Avaliação de Risco · Planos e Conformidade · Governança
- **Fonte:** catálogo G1, G5

### PLATAFORMA

#### `/modulos/integracoes/` — Integrações e API
- **H1:** Conversa com o que você já tem
- **Capacidades:** API REST documentada em **Swagger/OpenAPI** · **dois esquemas de autenticação** (JWT para usuários, API Key para sistema a sistema) · gestão de API Keys com regeneração e ativação/desativação · **importação de requerimentos do SOE**, individual e em lote · importação de barragens via Excel · exportações Excel e PDF · webhook de push notification.
- **Diferencial a destacar:** integração **já em produção** com sistema legado (SOE), não apenas prometida.
- **Conecta com:** Governança · Prontuário
- **Fonte:** catálogo G4

#### `/modulos/governanca/` — Acessos, Auditoria e Administração
- **H1:** Controle, rastreabilidade e prestação de contas
- **Capacidades:** **6 perfis de acesso** com menu filtrado por papel · autenticação JWT com refresh token · recuperação e redefinição de senha · habilitar/desabilitar usuário · **trilha de auditoria** consultável · histórico de atribuições técnicas · histórico de sincronização · órgãos de controle cadastrados como destinatários · unidades regionais · configurações em runtime (UFESP).
- **Conecta com:** Integrações · Processos e Equipe
- **Fonte:** catálogo G2, G3, G6, B4

---

## 5. Ativos a produzir

| Ativo | Uso | Responsável |
|---|---|---|
| **12 screenshots reais** (1 por módulo), em tema claro, com dado fictício mas plausível | Seção 4 de cada página | Time de produto |
| **Screenshot do mapa de barragens** | Substitui o SVG artesanal do Brasil na home | Time de produto |
| **Screenshot do app mobile** (2–3 telas, mockup de dispositivo) | Página App de Campo + home | Time de produto |
| **PDF de exemplo** (relatório e auto de infração, anonimizados) | Página Relatórios — prova concreta | Time de produto |
| **Logo autorizada do DAEE / SP Águas** | Prova social real | Comercial — exige autorização escrita |
| **Imagem OG** 1200×630 | `header.php` — hoje ausente apesar de `summary_large_image` | Design |
| **Favicon** | Não declarado no tema | Design |
| **Vídeo de tour** (2–3 min) ou GIFs curtos por módulo | Home + páginas de módulo | Fase 2 |
| **Ficha técnica em PDF** | CTA secundário de baixo atrito | Comercial |

> ⚠️ Dado real de barragem, empreendedor (CPF/CNPJ) ou processo **não pode** aparecer em screenshot.
> Usar ambiente de staging com massa fictícia.

---

## 6. Home reescrita — estrutura proposta

Mantém a espinha atual (que é boa), corrige o conteúdo e passa a apontar para as páginas internas.

| # | Seção | Mudança |
|---|---|---|
| 1 | Hero | Manter estrutura. Trocar URL do mockup. Callouts ancorados em fatos reais |
| 2 | Prova social | **Reescrever** — um cliente real nomeado, não seis categorias (`gap §1.8`) |
| 3 | Desafios do setor | Manter — está bem escrita |
| 4 | **Módulos** | **Reescrever completamente** — 3 grupos (Coleta / Gestão / Plataforma), cada card linkando para a página do módulo. Substitui a lista genérica de 6 |
| 5 | Como funciona (novo) | Fluxo em 4 passos: Campo → Análise → Conformidade → Prestação de contas. Dá coerência ao conjunto |
| 6 | Funcionalidades | **Substituir** os 16 chips genéricos pelos 5 diferenciais defensáveis (`gap §3.3`) |
| 7 | Diferenciais | Reescrever ancorando em fatos verificáveis |
| 8 | Escala nacional | Trocar o SVG artesanal por screenshot do mapa real. Trocar as métricas inventadas por métricas de arquitetura (`gap §1.2`) |
| 9 | Resultados | **Remover** até haver dado real de cliente (`gap §1.1`) |
| 10 | Segurança e conformidade (novo) | Bloco curto → `/seguranca/`. Remove objeção de TI cedo |
| 11 | Contato | Manter formulário. Corrigir placeholders. Adicionar CTA secundário de baixo atrito |

---

## 7. Implementação no tema WordPress

### 7.1 Abordagem recomendada: registro de módulos em PHP + template único

Evita 12 páginas WordPress mantidas à mão e mantém o conteúdo versionado no Git junto ao tema.

```
sisb-theme/
├── inc/
│   ├── modules-registry.php      # array PHP com os 12 módulos (dados das 9 seções)
│   └── module-helpers.php        # renderizadores das seções
├── template-parts/
│   └── module/
│       ├── hero.php · problema.php · como-funciona.php · screenshot.php
│       ├── capacidades.php · canais.php · perfis.php · relacionados.php
│       ├── roadmap.php           # bloco "em desenvolvimento", condicional
│       └── cta.php
├── page-modulos.php              # índice /modulos/ (3 grupos)
├── single-modulo.php             # ou page-modulo.php + rewrite rule
├── page-precos.php · page-seguranca.php · page-api.php · page-faq.php
└── assets/
    └── screenshots/              # 1 por módulo
```

**Alternativa** (se o cliente quiser editar sem deploy): Custom Post Type `modulo` com ACF/campos
nativos. Mais flexível para o cliente, mais frágil quanto à consistência do conteúdo — e o conteúdo
sai do controle de versão. **Recomendo o registro em PHP**, dado que a fonte de verdade é o código
do sistema e as revisões devem acompanhar releases.

### 7.2 Itens técnicos a incluir junto

- `og:image` e `og:url` no `header.php` (hoje há `twitter:card` sem imagem).
- `<link rel="canonical">` — necessário assim que houver páginas internas.
- **Schema.org**: `SoftwareApplication` na home, `Organization` global, `FAQPage` em `/faq/`,
  `BreadcrumbList` nas páginas de módulo.
- **Breadcrumbs** visíveis: `Início › Módulos › Coleta › Vistorias`.
- **Navegação sequencial** entre módulos no rodapé de cada página ("próximo módulo").
- `sitemap.xml` e `robots.txt`.
- Analytics + evento de conversão em cada CTA (identificar de qual página de módulo veio o lead).
- Formulário → CRM (ou, no mínimo, persistência em CPT além do `wp_mail`, para não perder lead).
- **Acessibilidade**: auditoria WCAG 2.1 AA / e-MAG — contraste, foco visível, `alt` em todo
  screenshot, navegação por teclado no mega-menu. Obrigatório para venda a órgão público.
- `loading="lazy"` + `width`/`height` em todos os screenshots.

---

## 8. Sequência de execução sugerida

| Etapa | Escopo | Depende de |
|---|---|---|
| **1** | Correções de credibilidade na home (`gap §6, Bloco 1`) | Nada — pode começar hoje |
| **2** | Produção dos 12 screenshots + logo autorizada | Time de produto / comercial |
| **3** | Reescrita das seções de módulos e diferenciais da home | Etapa 1 |
| **4** | Registro de módulos + template + índice `/modulos/` | Etapa 2 |
| **5** | Páginas institucionais: Segurança/LGPD, Preços, API, FAQ, Sobre, legais | Paralelo à 4 |
| **6** | SEO técnico, schema.org, analytics, acessibilidade | Etapas 4 e 5 |
| **7** | Páginas por perfil de comprador (`/solucoes/`), cases, blog | Fase 2 |

---

## 9. Checklist de publicação (por página)

- [ ] Toda afirmação tem contrapartida ✅ em `product-modules.md`
- [ ] Nenhum número sem fonte
- [ ] Itens de roadmap em bloco separado e rotulado
- [ ] Screenshot real, sem dado pessoal ou de barragem real
- [ ] `alt` descritivo em todas as imagens
- [ ] Title, meta description e canonical preenchidos
- [ ] Breadcrumb e links para módulos relacionados
- [ ] CTA primário e secundário presentes
- [ ] Contraste e navegação por teclado verificados
- [ ] Sem menção a FMEA, SMS, denúncias ou `.gov.br`
