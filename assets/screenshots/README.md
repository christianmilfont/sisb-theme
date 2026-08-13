# Capturas de tela dos módulos

Cada página de módulo espera um arquivo com o nome do seu slug. **Enquanto o
arquivo não existir, a seção de captura simplesmente não é renderizada** — a
página continua íntegra. Não é preciso criar imagem provisória.

## Arquivos esperados

| Arquivo | Módulo | O que capturar |
|---|---|---|
| `app-de-campo.png` | App de Campo | Aplicativo em campo: formulário de vistoria e tela de sincronização. Mockup de dispositivo ajuda |
| `vistorias.png` | Vistorias e NPG | Formulário de vistoria com itens classificados e o NPG consolidado |
| `autos-e-outorga.png` | Autos e Outorga | Auto de infração com penalidade calculada, ou o PDF gerado |
| `prontuario-da-barragem.png` | Prontuário da Barragem | Dashboard da barragem com as abas visíveis |
| `avaliacao-de-risco.png` | Avaliação de Risco | Resultado da avaliação com a matriz de classificação |
| `planos-e-conformidade.png` | Planos e Conformidade | Cronograma de PSB ou PAM, com prazos |
| `processos-e-equipe.png` | Processos e Equipe | Dashboard de atribuições técnicas ou lista de processos |
| `comunicacao-e-portal.png` | Comunicação e Portal | Portal do empreendedor, ou a tela de envio de notificação |
| `relatorios.png` | Relatórios e Documentos | Relatório em PDF, ou o gestor documental da barragem |
| `painel-de-dados.png` | Painel de Dados | Painel gerencial com distribuição por faixas |
| `integracoes.png` | Integrações e API | Swagger da API, ou a tela de gestão de chaves |
| `governanca.png` | Governança e Acessos | Trilha de auditoria, ou a gestão de perfis |

Além destes, a home precisa de:

| Arquivo | Onde | O que capturar |
|---|---|---|
| `mapa-barragens.png` | Home, seção "Expansão Nacional" | Mapa georreferenciado do parque de barragens. Substitui o bloco de texto que hoje ocupa o lugar do SVG removido |

## Requisitos

- **Formato:** PNG, tema claro, largura entre 1440 e 1920 px.
- **Proporção:** aproximadamente 16:10. As imagens entram em uma moldura de
  navegador, então evite capturar a barra do navegador real.
- **Peso:** comprima antes de commitar. Acima de 300 KB por arquivo, otimize.

## ⚠️ Dado real não pode aparecer

Use ambiente de homologação com massa fictícia. **Não pode aparecer em captura:**

- Nome, CPF ou CNPJ de empreendedor real
- Nome ou localização de barragem real
- Número de processo real
- Nome de servidor ou de técnico real
- Endereço, telefone ou e-mail real

Se a captura sair do ambiente de produção, anonimize antes de commitar — e
lembre que borrar com filtro reversível não é anonimizar; substitua o pixel.

## Como adicionar

1. Salve o arquivo aqui com o nome exato da tabela.
2. A seção aparece sozinha na próxima carga da página — nenhum código a alterar.
3. Revise o `alt` e a legenda em `inc/modules/<slug>.php`, chave `screenshot`.
   Eles já estão escritos, mas devem descrever a imagem que você de fato
   capturou.
