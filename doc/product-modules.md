# SISB — Mapa de Módulos do Produto

> **Propósito:** fonte única de verdade sobre *o que o SISB faz hoje*, derivada do código
> (`backend/Controllers`, `backend/Services`, `backend/Models`, `frontend/src/routes|views|menu-items`,
> `app/src/screens|navigation`) e cruzada com o Termo de Referência (`doc/TR`) e as especificações
> (`doc/spec/1.0.0.md`, `doc/spec/2.0.0.md`).
>
> **Uso primário:** base factual para o site institucional/comercial (`sisb-theme`) — landing page e
> páginas por módulo. Também serve como onboarding técnico e material de pré-venda.
>
> **Data do levantamento:** 2026-08-13 · branch `dev`

---

## Legenda de status

| Status | Significado |
|---|---|
| ✅ **Em produção** | Implementado ponta a ponta (API + interface) e disponível para o usuário final. |
| 🟡 **Parcial** | Existe e funciona, mas com escopo menor que o previsto no TR, ou sem interface completa em algum canal. |
| 🔵 **Roadmap** | Previsto no TR / spec, ainda não implementado. |
| ⛔ **Não implementado** | Consta em material de referência (contrato, diagramas de oferta), mas **não existe no código**. |

> ⚠️ Itens 🔵 e ⛔ **não podem ser apresentados como funcionalidade existente** no site.
> Podem aparecer marcados como *"em desenvolvimento"* / *"previsto"*, conforme decisão de posicionamento.

---

## 1. Visão geral da plataforma

O SISB é uma plataforma de **fiscalização e segurança de barragens** composta por três aplicações
integradas sobre uma única base de dados e API:

| Canal | Stack | Público | Papel |
|---|---|---|---|
| **App Mobile** (`app/`) | React Native + WatermelonDB (SQLite) | Fiscal em campo | Coleta offline-first, sincronizada |
| **Web Back-office** (`frontend/`) | React 19 + Vite + MUI v7 | Fiscal analista, admin, terceiros | Gestão, análise, conformidade, relatórios |
| **Portal do Empreendedor** (`frontend/`, rotas `/empreendedor/*`) | mesma app web, papel `EMPREENDEDOR` | Empreendedor/proprietário | Autoatendimento: status, notificações, tramitações |
| **API** (`backend/`) | ASP.NET Core 9, EF Core, SQL Server | Sistemas terceiros | Integração via JWT + API Key |

Detalhes de infraestrutura, CI/CD e armazenamento: ver [`architecture.md`](./architecture.md).

### Números do sistema (escala real, útil para prova de maturidade)

| Métrica | Valor |
|---|---|
| Controllers de API | 37 |
| Serviços de domínio (backend) | ~55 |
| Entidades de domínio | ~40 |
| Módulos de rota no web | 18 |
| Áreas de tela no app mobile | 13 |
| Papéis de acesso | 6 (`ADMIN`, `FISCAL_ANALISTA`, `FISCAL`, `TERCEIRO`, `EMPREENDEDOR`, `USER`) |
| Serviços em background | 5 (e-mail, PDF, thumbnails, monitor PAM, monitor eventos PSB) |

---

## 2. Papéis e permissões (`UsuarioRole`)

Fonte: `frontend/src/views/usuarios/types/usuario.types.ts:101` e `backend/Models/Roles.cs`.

| Papel | Descrição operacional | Acesso característico |
|---|---|---|
| `ADMIN` | Administrador da plataforma | Tudo + Usuários, Órgãos de Controle, Auditoria, Templates, Configurações |
| `FISCAL_ANALISTA` | Analista de fiscalização (escritório) | Gerenciamento, tramitações, notificações, unidades |
| `FISCAL` | Fiscal de campo | Coleta, vistorias, autos, notificações |
| `TERCEIRO` | Empresa/consultoria contratada | Cadastros, processos de vistoria, atribuições técnicas |
| `EMPREENDEDOR` | Proprietário/responsável pela barragem | Apenas portal do empreendedor (dashboard, notificações, tramitações) |
| `USER` | Papel base | Acesso mínimo |

O menu do back-office é filtrado por `allowedRoles` item a item
(`frontend/src/menu-items/dashboard.tsx`) — o produto já é **multi-perfil por design**, o que é
condição necessária para operação multi-órgão.

---

## 3. Catálogo de módulos

Organizado em 7 domínios. Os módulos marcados com ⭐ são candidatos a **página própria** no site
(ver `site-ia.md`).

---

### Domínio A — Coleta em Campo ⭐

O que a referência de contrato chama de *"Produto (coleta)"*.

#### A1. App Mobile Offline-First ⭐ — ✅ Em produção

**O que é:** aplicativo React Native (Android/iOS) que replica o processo de fiscalização em campo e
opera **sem conectividade**, com banco local SQLite (WatermelonDB) e sincronização bidirecional.

**Como funciona:**
- Banco local completo — o fiscal baixa os empreendimentos designados antes de ir a campo
  (`EmpreendimentoOffline`, endpoint `POST /Usuario/{id}/empreendimento-offline/{empreendimentoId}`).
- Todas as operações (criar vistoria, avaliação, auto, fotos) gravam **primeiro no dispositivo**.
- Sincronização por *pull/push* contra `SyncController` (`GET /Sync/pull`, `POST /Sync/push`),
  com histórico de payloads (`SyncPayloadHistory`) para auditoria e depuração de conflitos.
- Resolução de conflito por timestamp.

**Telas disponíveis** (`app/src/navigation/routeName.ts`):
Home · Segurança de Barragem · Fiscalização de Outorga · Vistorias · Avaliação de Risco ·
Empreendimentos · Barragens · Requerimentos · Auto de Inspeção e Infração · Uso de Recurso Hídrico ·
Unidades · Sincronização · Configurações.

**Distribuição:** build Android via Fastlane → Firebase App Distribution (lanes *beta* e *release*).

**Diferencial vendável:** não é "app com cache". É um **banco relacional completo no dispositivo**,
com o mesmo modelo de dados do servidor.

---

#### A2. Vistorias (Terra e Concreto) + NPG ⭐ — ✅ Em produção

**O que é:** o formulário de inspeção de segurança propriamente dito, em duas variantes conforme o
tipo de barragem.

**Como funciona:**
- Dois formulários distintos: **Barragem de Terra** e **Barragem de Concreto**
  (`app/src/screens/vistorias/EditVistoriaScreen/{Terra,Concreto}`,
  `frontend/src/views/vistorias/formulario`).
- Cada item inspecionado recebe classificação de anomalia; o sistema calcula o
  **NPG — Nível de Perigo Global** (`GlobalDangerLevel.tsx`, `UnifiedInspectionTable.tsx`).
- Registro fotográfico por item, com coordenadas e legenda.
- Ciclo de vida: rascunho → transferência de responsável (`POST /Vistoria/{id}/transferir`) →
  conclusão (`POST /Vistoria/{id}/concluir`) → cancelamento (`POST /Vistoria/{id}/cancel`).
- **Vistoria avulsa** (`POST /Vistoria/avulsa`) — permite inspeção sem requerimento prévio.
- Comparação com a vistoria anterior (`GET /Vistoria/{id}/previous`) para evolução de anomalias.

**Disponível em:** app mobile ✅ · web ✅ (paridade de formulário).

---

#### A3. Captura de Mídia Georreferenciada — ✅ Em produção

**O que é:** gestão de evidências fotográficas e de vídeo vinculadas a vistorias e relatórios.

**Como funciona** (`MediaController`, `MediaService`, `ThumbnailBackgroundService`):
- Upload de fotos e vídeos, vinculados a vistoria (`GET /Media/vistoria/{id}`) ou relatório.
- **Coordenadas por imagem** (`PATCH /Media/{id}/coordinates`) — evidência georreferenciada.
- Legenda editável (`PATCH /Media/{id}/caption`).
- Controle de visibilidade no relatório (`PATCH /Media/{id}/toggle-visibility`).
- **Marca d'água** aplicada às imagens no app (commits recentes `0f8c2885`, `db599b0e`).
- Geração assíncrona de miniaturas via `BackgroundService`.
- Armazenamento em S3 (buckets `daee-imagens-*`, `daee-anexos-*`).

---

#### A4. Autos de Inspeção e Autos de Infração ⭐ — ✅ Em produção

**O que é:** os instrumentos formais de fiscalização — o documento que constata e o que penaliza.

**Como funciona:**
- **Auto de Inspeção** (`AutoInspecaoController`, 12 ações): emissão por unidade, vinculação a
  requerimento, requerimentos avulsos disponíveis, transferência de responsável
  (`POST /AutoInspecao/{id}/change-owner`).
- **Auto de Infração** (`AutoInfracaoController`): lavratura, **geração de PDF**
  (`POST /AutoInfracao/pdf`, `AutoInfracaoPdfService` com QuestPDF) e emissão de notificação
  vinculada (`POST /AutoInfracao/{id}/notificacao`).
- Penalidades e constatação de infração modeladas em formulário próprio no app
  (`app/src/screens/auto-de-inspecao-infracao/create-inspecao-infracao-screen/components/penalidades`).
- Valores de penalidade parametrizados por **UFESP**, configurável em runtime
  (`GET|PUT /Configuracao/ufesp`).

**Disponível em:** app mobile ✅ · web ✅ (`/autoinfracoes`, `/autoinspecoes`).

---

#### A5. Fiscalização de Outorga (Uso de Recurso Hídrico) — ✅ Em produção

**O que é:** trilha de fiscalização paralela à de segurança de barragem, voltada ao **uso de recursos
hídricos** e ao cumprimento da outorga.

**Como funciona:**
- `AutoInspecaoOutorgaController` — auto de inspeção específico de outorga, por unidade e por
  empreendimento.
- `UsoRecursoHidricoController` — registro dos usos declarados/constatados vinculados ao auto.
- Tela dedicada no app (`FiscalizacaoOutorgaScreen`) e no web (`/autoinspecoes-outorga`).

**Nota:** este módulo **não aparece em nenhum material de referência do site** e é um dos
diferenciais mais concretos do produto (duas cadeias de valor: segurança + outorga).

---

### Domínio B — Cadastro e Prontuário

#### B1. Empreendimentos e Empreendedores ⭐ — ✅ Em produção

**O que é:** a base cadastral de quem é responsável pelo quê.

**Como funciona:**
- `Empreendimento` com endereço de local (coordenadas) e endereço de correspondência
  (`EnderecoController`).
- `Pessoa` — PF ou PJ, com validação de **CPF/CNPJ** por atributos customizados
  (`backend/Models/Validation`).
- Vínculo N:N pessoa↔empreendimento com papel (`VinculoPessoaEmpreendimento`,
  `POST /Pessoa/{pessoaId}/empreendimento/{empreendimentoId}`).
- **Promoção de pessoa a usuário** do sistema (`POST /Pessoa/{id}/transform-to-user`) — é assim que
  um empreendedor ganha acesso ao portal.
- Visão consolidada (`GET /Empreendimento/{id}/complete`) e dashboard por empreendimento.

---

#### B2. Barragens e Prontuário Digital ⭐ — ✅ Em produção

**O que é:** o registro técnico de cada estrutura e o **hub de tudo que acontece com ela**.
É a tela mais densa do sistema.

**Como funciona** (`BarragemController`, 20 ações · `frontend/src/views/barragens/dashboard`):
- Cadastro técnico completo + tipos de barragem (`GET /Barragem/tipos`).
- **Dashboard da barragem** com abas: **Classificação · PSB · Plano de Ação de Emergência ·
  Plano de Ação de Melhoria · Documentos · Notificações**.
- Status e faixa de alerta consolidados (`GET /Barragem/{id}/status`).
- Histórico de classificações (`GET /Barragem/{id}/classificacoes`).
- **Anomalias constatadas acumuladas** (`GET /Barragem/{id}/anomalias-constatadas`) — visão
  longitudinal do estado da estrutura.
- **Mapa**: `GET /Barragem/coordinates` alimenta a visão georreferenciada do parque de barragens.
- **Importação em massa via Excel** (`POST /Barragem/import`, `BarragemExcelImportService`) —
  caminho de onboarding de um novo cliente com base legada.
- **Exportação do relatório de classificação em Excel**
  (`GET /Barragem/{id}/classification-report/excel`).

---

#### B3. Documentos por Barragem — ✅ Em produção

**O que é:** repositório de arquivos hierárquico (pastas e arquivos) por barragem —
`DocumentosController` (13 ações), armazenamento S3.

Criação de diretórios raiz e aninhados, upload/download de arquivos, navegação por caminho
(`GET /Documentos/path/{entryId}`). É onde ficam PSB, PAE, laudos e projetos enviados pelo
empreendedor.

---

#### B4. Unidades e Órgãos de Controle — ✅ Em produção

- **Unidades** (`UnidadeController`): estrutura organizacional regional do órgão fiscalizador,
  com **resolução por localização** (`GET /Unidade/by-location`) — a barragem é automaticamente
  associada à unidade competente pela coordenada.
- **Órgãos de Controle** (`OrgaoDeControleController`): entidades externas de controle
  (Ministério Público, tribunais de contas, defesa civil) endereçáveis em notificações.

**Relevância SaaS:** `Unidade` é a peça que permite **operação multirregional** dentro de um mesmo
cliente — base técnica para o discurso de escala.

---

### Domínio C — Processo de Fiscalização (workflow)

#### C1. Requerimentos / Processos de Vistoria ⭐ — ✅ Em produção

**O que é:** a unidade de processo que organiza o trabalho de fiscalização — o "case" que agrupa
vistoria, avaliação de risco e relatório.

**Como funciona** (`RequerimentoController`, 18 ações):
- Dois tipos: **Requerimento SOE** (importado do sistema legado de outorga) e
  **Requerimento SISB** (gerado pelo próprio sistema, inclusive automaticamente pelo app).
- **Importação do SOE**: individual por protocolo (`POST /Requerimento/import/{protocolo}`) e
  **em lote** (`POST /Requerimento/import/batch`) — integração com sistema existente.
- Requerimento avulso (`POST /Requerimento/avulso`).
- Máquina de estados: criar → **enviar para revisão** (`PUT /{id}/enviar-revisao`) →
  **concluir** (`PUT /{id}/concluir`, `PUT /{id}/calcula-concluir`) → abortar (`PUT /{id}/aborted`)
  → restaurar (`PUT /{id}/restore`).
- Listagem dedicada "Processos de vistoria" (`GET /Requerimento/processos-vistoria`) — é o item de
  menu principal do back-office.

---

#### C2. Atribuições Técnicas ⭐ — ✅ Em produção

**O que é:** gestão de carga de trabalho e responsabilidade técnica — quem é responsável por qual
tarefa, com prazo, transferência e trilha.

**Como funciona** (`AtribuicaoTecnicaController`, 15 ações):
- Fila pessoal (`GET /AtribuicaoTecnica/minhas`) e **dashboard de atribuições**
  (`GET /AtribuicaoTecnica/dashboard`).
- Ciclo: criar → mudar status (`PATCH /{id}/status`) → **transferir** (`POST /{id}/transferir`) →
  concluir (`POST /{id}/concluir`) / cancelar (`POST /{id}/cancelar`).
- **Comentários** (`POST /{id}/comentarios`), **anexos** (`POST /{id}/anexos`) e
  **histórico completo** (`GET /{id}/historico`).

**Relevância comercial:** é o módulo que responde à objeção *"como eu controlo minha equipe?"*.
Não aparece em nenhum material de referência atual.

---

#### C3. Tramitações (aprovação de cadastro) — ✅ Em produção

**O que é:** fluxo de solicitação e aprovação para mudanças cadastrais originadas fora do órgão —
tipicamente pelo próprio empreendedor.

**Como funciona** (`TramitacaoController`):
- Tipos: cadastro de empreendimento/barragem, **vínculo de representante**, atualização de
  empreendimento, atualização de barragem.
- Fila do analista (`GET /Tramitacao/minhas`) → **aprovar** (`PUT /{id}/aprovar`) /
  **rejeitar** (`PUT /{id}/rejeitar`).
- Visível também no portal do empreendedor (`/empreendedor/tramitacoes`).

---

#### C4. Solicitação de Reclassificação — ✅ Em produção

Fluxo formal para o empreendedor contestar/solicitar mudança na classificação de risco da barragem
(`SolicitacaoReclassificacaoController`): abertura por barragem, consulta de pendência, aprovação e
rejeição pelo analista.

---

### Domínio D — Risco e Conformidade ⭐

Este é o núcleo técnico do produto e o que mais o diferencia de um "app de checklist".

#### D1. Avaliação de Risco — CRI, DPA e Matriz de Classificação ⭐ — ✅ Em produção

**O que é:** o enquadramento da barragem conforme a legislação de segurança de barragens (PNSB).

**Como funciona:**
- Formulário estruturado em seções (`app/src/screens/avaliacao-risco/components/sections`,
  `frontend/src/views/avaliacao_de_risco/components/sections`):
  **Características Técnicas · Estado de Conservação · Plano de Segurança da Barragem ·
  Classificação DPA · Resultado**.
- Cálculo automático de **CRI** (Categoria de Risco) e **DPA** (Dano Potencial Associado),
  e posicionamento na **matriz de classificação** (A/B/C/D) —
  `frontend/src/views/avaliacao_de_risco/utils/calculos.ts`, `calculoService.ts`,
  `useAvaliacaoRiscoCalculations.ts`.
- Ciclo: rascunho → transferir → concluir (`POST /AvaliacaoRisco/{id}/concluir`).
- **Avaliação avulsa** (`POST /AvaliacaoRisco/avulsa`) e consulta da
  **última concluída por barragem** (`GET /AvaliacaoRisco/barragem/{id}/ultima-concluida`).
- Comparação com a avaliação anterior (`GET /AvaliacaoRisco/{id}/previous`).

**Disponível em:** app mobile ✅ · web ✅ — mesmo motor de cálculo nos dois canais.

> ⚠️ **Divergência com o TR:** o TR (§1.5 / spec 2.0.0) descreve a Gestão de Riscos pela metodologia
> **FMEA** (modos de falha, severidade, ocorrência, detecção, nota de risco). O sistema implementa
> **CRI/DPA/Matriz** conforme PNSB. Não há implementação de FMEA no código
> (busca por `fmea` → 0 ocorrências em código-fonte).
> **Não anunciar FMEA no site.** Ver `landing-gap-analysis.md`.

---

#### D2. PSB — Plano de Segurança da Barragem ⭐ — ✅ Em produção

**O que é:** gestão do ciclo de vida do PSB e dos eventos regulatórios que ele obriga.

**Como funciona** (`PSBController`, 31 ações — o maior controller do sistema):
- Recebimento e **aprovação** do PSB (`PUT /PSB/{id}/aprovar`), arquivamento
  (`PUT /PSB/{id}/arquivar`), PSB ativo por barragem (`GET /PSB/barragem/{id}/active`).
- **Eventos do PSB**: criação de eventos, incluindo **ISE — Inspeção de Segurança Especial**
  (`POST /PSB/{psbId}/eventos/ise`).
- **Propostas de resolução** por evento, com **aprovação/rejeição** pelo analista
  (`PUT .../propostas/{id}/aprovar|rejeitar`).
- **Gestão de prazos** por evento (`PUT /PSB/{psbId}/eventos/{eventoId}/prazos`) — inclusive
  prorrogações.
- **Monitor automático de eventos** rodando em background (`PSBEventoMonitorService`) — dispara
  notificação quando um prazo se aproxima ou vence.
- Interface: aba **PSB** no dashboard da barragem + `SimpleGanttChart.tsx` (cronograma visual).

---

#### D3. PAM — Plano de Ação de Melhoria ⭐ — ✅ Em produção

**O que é:** o *follow-up* das recomendações de intervenção — a Funcionalidade 1.4 do TR.

**Como funciona** (`PlanoAcaoMelhoriaController`, 18 ações):
- Ações com **status** e **criticidade**, filtráveis (`GET /PlanoAcaoMelhoria/status/{status}`,
  `/criticidade/{criticidade}`).
- Por barragem e por empreendimento.
- **Propostas de resolução** enviadas pelo empreendedor → aprovação/reprovação pelo órgão.
- **Exportação e importação por barragem** (`GET|POST /barragem/{id}/export|import`).
- **Monitor em background** (`PlanoAcaoMelhoriaMonitorService`) para vencimento de prazos.
- Interface: aba dedicada no dashboard da barragem, com cronograma.

---

#### D4. PAE — Plano de Ação de Emergência ⭐ — ✅ Em produção

**O que é:** cadastro e acompanhamento do PAE exigido pela PNSB.

**Como funciona** (`PlanoAcaoEmergenciaController`, 16 ações): mesma mecânica do PAM —
por barragem/empreendimento, conclusão, propostas de resolução com aprovação/reprovação,
exportação e importação. Aba própria no dashboard da barragem.

---

#### D5. Classificação e Faixas de Alerta (verde / amarela / vermelha) — 🟡 Parcial

**O que existe:**
- Modelo `Alerta` + `AlertaController` (CRUD, consulta por origem e por tipo).
- `VistoriaAlertaService` — deriva alerta a partir das anomalias da vistoria.
- `POST /Barragem/{barragemId}/submit-faixa-alerta` — submissão da faixa.
- Faixa de alerta exibida na aba **Classificação** do dashboard da barragem, nos cards do
  empreendedor e no `getStatus.tsx`; `DashboardFaixas.cs` no back-end.

**O que falta em relação ao TR (§1.3):**
- 🔵 Configuração paramétrica das faixas conforme Volume VI do Manual do Empreendedor (ANA).
- 🔵 **Comprovação de recebimento** do aviso pelos grupos pré-definidos.
- ⛔ **Canal SMS** — o TR exige "e-mail e SMS, no mínimo". Não há integração SMS no código
  (busca por `sms` em `backend/` → 0 ocorrências). Existem **e-mail** e **push**.

> **Redação segura para o site:** falar em *"classificação por faixas de alerta a partir das anomalias
> constatadas, com notificação automática por e-mail e push"* — e **não** em "emissão de alarmes
> configurável com confirmação de recebimento via SMS".

---

### Domínio E — Comunicação e Follow-up

#### E1. Notificações e Templates ⭐ — ✅ Em produção

**O que é:** o canal oficial entre órgão fiscalizador e empreendedor, com trilha documental.

**Como funciona** (`NotificacaoController`, 19 ações):
- Notificação por barragem, com **remetentes disponíveis**
  (`GET /Notificacao/barragem/{id}/remetentes`).
- **Envio individual e em lote** (`POST /Notificacao/{id}/enviar`, `POST /Notificacao/bulk-enviar`).
- **Templates de notificação** com CRUD próprio (`/Notificacao/templates`, tela
  `/notificacoes-template`, restrita a `ADMIN`) — editor rico (CKEditor).
- **Estatísticas** (`GET /Notificacao/statistics`) e **eventos vencidos**
  (`GET /Notificacao/eventos-vencidos`).
- Histórico persistido (`HistoricoNotificacao`).
- Entrega: fila de e-mail assíncrona (`EmailQueueService` + `EmailBackgroundService`,
  Resend SMTP em produção) e **push notification** (`PushNotificationService`, Google Cloud Run).
- Visão do destinatário: `GET /Notificacao/empreendedor` → `/empreendedor/notificacoes`.

---

#### E2. Portal do Empreendedor ⭐ — ✅ Em produção

**O que é:** área de autoatendimento para o regulado. Reduz a carga de atendimento do órgão.

**Como funciona** (`frontend/src/routes/modules/empreendedor.routes.tsx`,
`EmpreendedoresController`, `EmpreendedorDashboardService`):
- **Dashboard próprio** com suas barragens e a classificação/faixa de cada uma
  (`BarragensSection.tsx`, `ClassificacaoEmpreendedorCard.tsx`).
- **Minhas notificações** — recebimento e ciência.
- **Minhas tramitações** — acompanhar solicitações cadastrais.
- Envio de **propostas de resolução** para itens de PAM/PAE.
- Filtros e detalhamento (`GET /Empreendedores/filtro-options`, `/{id}/detalhe`).

**Relevância comercial:** é o módulo que transforma o SISB de "sistema interno do órgão" em
**plataforma de duas pontas** — argumento forte e hoje **ausente do site**.

---

### Domínio F — Relatórios e Saídas

#### F1. Relatórios de Inspeção e Geração de PDF ⭐ — ✅ Em produção

**O que é:** produção do documento técnico final, com evidências.

**Como funciona** (`RelatorioController`, `RelatorioInspecaoController`, `RelatorioPdfService`):
- Relatório vinculado ao requerimento (`GET /Relatorio/requerimento/{id}`) e à avaliação de risco
  (`GET /RelatorioInspecao/avaliacaorisco/{id}`).
- **Geração de PDF com QuestPDF**, em **fila assíncrona** (`PdfQueueService` +
  `PdfBackgroundService`) — não trava a interface.
- **Geração em lote** (`POST /Relatorio/generate-pdf/all`).
- Documento principal + **PDF companion** (`GET /Relatorio/{id}/pdf-companion`) — anexo
  fotográfico separado.
- Armazenamento em S3 (`daee-relatorios-*`).
- **Templates de relatório** configuráveis (`TemplateRelatorioController`, `TemplateRelatorio`).

---

#### F2. Exportações e Importações — ✅ Em produção

| Saída/Entrada | Endpoint | Uso |
|---|---|---|
| Barragens (Excel) — importação | `POST /Barragem/import` | Onboarding de base legada |
| Relatório de classificação (Excel) | `GET /Barragem/{id}/classification-report/excel` | Prestação de contas |
| PAM por barragem | `GET|POST /PlanoAcaoMelhoria/barragem/{id}/export|import` | Intercâmbio de cronograma |
| PAE por barragem | `GET|POST /PlanoAcaoEmergencia/barragem/{id}/export|import` | Intercâmbio de cronograma |
| Requerimentos SOE | `POST /Requerimento/import`, `/import/batch` | Integração com sistema legado |
| Arquivos/Mídia | `GET /Media/{id}/download`, `GET /Documentos/file/{id}/download` | Evidências |

---

### Domínio G — Plataforma e Administração ⭐

#### G1. Painel de Dados (Dashboard Gerencial) ⭐ — ✅ Em produção

`DashboardController` (`GET /Dashboard/gerencial`) alimentado por `DashboardSnapshotBuilder`
com snapshots **append-only** (`DashboardSnapshotBarragens`, `GeneratedAt` + payload JSON) —
ou seja, há **série histórica**, não apenas foto do momento. Distribuição por faixas
(`DashboardFaixas.cs`) e rótulos padronizados (`DashboardLabels.cs`).
É a tela inicial (`/`) para ADMIN, FISCAL_ANALISTA, FISCAL e TERCEIRO.

#### G2. Gestão de Usuários e Acessos — ✅ Em produção

`UsuarioController` + `AuthController`: registro, login JWT, refresh token, logout,
**esqueci/redefinir senha**, perfil, troca de senha, **habilitar/desabilitar usuário**,
consulta de papéis (`GET /Usuario/roles`), seleção de técnicos (`GET /Usuario/tecnicos`) e
designação de empreendimentos para uso offline.

#### G3. Auditoria — ✅ Em produção

`AuditController` + `AuditService` + entidade `AuditEvent`. Trilha consultável de eventos,
com tela dedicada (`/auditoria`, exclusiva de `ADMIN`). Complementada pelo histórico específico de
Atribuições Técnicas e pelo `SyncPayloadHistory`.

#### G4. API de Integração e API Keys — ✅ Em produção

- **Dois esquemas de autenticação em paralelo**: JWT Bearer (usuários) e **API Key**
  (serviço a serviço) — `backend/Program.cs`.
- `ApiKeyController`: emissão, listagem, **regeneração** (`POST /ApiKey/regenerate`),
  **ativação/desativação** (`PATCH /ApiKey/toggle`) e exclusão.
- Documentação **Swagger/OpenAPI** publicada pela própria API.
- Integração real já em produção: importação de requerimentos do **SOE**.

#### G5. Busca Geral — ✅ Em produção

`BuscaGeralController` + `BuscaGeralService`: busca unificada transversal às entidades
(barragem, empreendimento, pessoa, processo) a partir de um único campo.

#### G6. Configurações do Sistema — ✅ Em produção

`ConfiguracaoController`: valor da **UFESP** (base de cálculo das penalidades, atualizável sem
deploy) e rotina administrativa de atualização de unidades de autos de inspeção.

---

## 4. Serviços de background (diferencial de arquitetura)

Cinco `BackgroundService` mantêm o sistema trabalhando fora do ciclo de request —
vale como argumento de robustez:

| Serviço | Função |
|---|---|
| `EmailBackgroundService` + `EmailQueueService` | Fila de e-mail com retry (Resend em produção, Mailpit em staging) |
| `PdfBackgroundService` + `PdfQueueService` | Geração de relatórios PDF sem bloquear a interface |
| `ThumbnailBackgroundService` | Miniaturas das evidências fotográficas |
| `PlanoAcaoMelhoriaMonitorService` | Vigia prazos do PAM e dispara notificação |
| `PSBEventoMonitorService` | Vigia eventos e prazos do PSB |

---

## 5. Itens do material de referência que NÃO existem no sistema

Levantados a partir de `sisb-theme/image.png` e `sisb-theme/image-1.png` (diagramas de oferta/contrato).

| Item no material de referência | Situação real | Evidência |
|---|---|---|
| **Gestão de denúncias** (aparece 2× em `image-1.png`; TR §1.2.7, §1.4.7, §1.4.8) | ⛔ **Não implementado** | `grep -ri "denuncia"` em `backend/`, `frontend/src`, `app/src` → 0 ocorrências |
| **Estudo de Mancha de Inundação** (TR §1.2.5, §1.3.3) | 🟡 Apenas como *tipo de requerimento*; não há módulo de análise | 2 ocorrências, em `RequerimentoService.cs` e `ConfirmRequerimentoDialog.tsx` |
| **Metodologia FMEA** para gestão de riscos (TR §1.5) | ⛔ **Não implementado** — o sistema usa CRI/DPA/Matriz (PNSB) | `grep -ri "fmea"` em código-fonte → 0 ocorrências |
| **Alarmes via SMS com comprovação de recebimento** (TR §1.3) | ⛔ Não implementado — existem e-mail e push | `grep -ri "sms"` em `backend/` → 0 ocorrências |
| **"Implantação/Homologação"** como módulo (`image.png`) | ➖ Não é módulo de software; é fase de projeto/serviço | — |
| **"Administração da Plataforma"** (`image.png`) | ✅ Existe, distribuída em G2–G6 | — |
| **Emissão de Alarmes** como módulo completo (`image.png`) | 🟡 Parcial — ver D5 | — |
| **Follow Up e Plano de Ação** (`image.png`) | ✅ Existe e é mais rico que o descrito — PAM + PAE + PSB + Atribuições | — |

---

## 6. O que o sistema tem e o material de referência NÃO menciona

Estes são os ativos **subaproveitados** comercialmente:

1. **Portal do Empreendedor** (E2) — plataforma de duas pontas.
2. **Atribuições Técnicas** (C2) — gestão de equipe, prazos e responsabilidade técnica.
3. **Tramitações** (C3) — workflow de aprovação cadastral com o regulado.
4. **Fiscalização de Outorga / Uso de Recurso Hídrico** (A5) — segunda cadeia de valor completa.
5. **PSB com eventos, propostas e prazos monitorados** (D2) — o maior módulo do sistema.
6. **PAE e PAM com propostas de resolução e cronograma** (D3, D4).
7. **Gestão documental por barragem** (B3).
8. **Auditoria** (G3) e **trilha de sincronização**.
9. **Painel gerencial com série histórica** (G1).
10. **API Keys + Swagger + importação SOE** (G4) — integração comprovada, não só prometida.
11. **Importação de barragens via Excel** (B2) — argumento de onboarding rápido.
12. **Solicitação de Reclassificação** (C4).
13. **Busca geral unificada** (G5).
14. **Unidades por geolocalização** (B4) — base da operação multirregional.

---

## 7. Resumo por status

| Status | Contagem | Módulos |
|---|---|---|
| ✅ Em produção | 22 | A1–A5, B1–B4, C1–C4, D1–D4, E1–E2, F1–F2, G1–G6 |
| 🟡 Parcial | 2 | D5 (faixas de alerta), Mancha de Inundação |
| 🔵 Roadmap | 3 | Config. paramétrica de faixas (ANA Vol. VI), comprovação de recebimento, cronograma RPSB/ISR automatizado (spec 2.0.0) |
| ⛔ Não implementado | 3 | Denúncias, FMEA, SMS |

---

## 8. Manutenção deste documento

Este arquivo deve ser revisado sempre que:
- um novo `Controller` for adicionado em `backend/Controllers/`;
- um novo módulo de rota entrar em `frontend/src/routes/modules/`;
- uma nova tela entrar em `app/src/navigation/routeName.ts`;
- houver mudança de escopo no TR ou nas specs.

Documentos relacionados:
- [`architecture.md`](./architecture.md) — infraestrutura, deploy e integrações
- [`landing-gap-analysis.md`](./landing-gap-analysis.md) — auditoria do site atual
- [`site-ia.md`](./site-ia.md) — arquitetura de informação proposta para o site
