# Documentos de referência do site SISB

Estes documentos são a **base factual** do conteúdo do site. Foram derivados diretamente do
código-fonte do sistema SISB (repositório `daee`: `backend/`, `frontend/`, `app/`) e cruzados com o
Termo de Referência e as especificações de versão.

| Documento | O que é |
|---|---|
| [`product-modules.md`](./product-modules.md) | Catálogo do que o sistema faz, módulo a módulo, com status de implementação e evidência no código |
| [`landing-gap-analysis.md`](./landing-gap-analysis.md) | Auditoria do site: o que era afirmado × o que o sistema realmente faz |
| [`site-ia.md`](./site-ia.md) | Arquitetura de informação proposta: sitemap, páginas de módulo e template |

## Regra de uso

**Nenhuma afirmação entra no site sem contrapartida ✅ no `product-modules.md`.**

Ao escrever ou revisar copy:

1. Localize o módulo no catálogo.
2. Só afirme o que estiver marcado ✅ **Em produção**.
3. Itens 🔵 **Roadmap** vão em bloco visualmente separado, rotulado como "em desenvolvimento".
4. Itens ⛔ **Não implementado** não entram — em nenhuma forma.
5. Número no site exige fonte: ou é métrica contável do sistema, ou é dado de cliente com autorização.

Ver `landing-gap-analysis.md` §7 para as regras completas de redação.

## Sincronização

A fonte de verdade destes arquivos é o repositório do sistema (`daee/doc/`). Esta é uma cópia para
que a revisão do site possa ser feita sem acesso ao repositório do sistema.

Revisar quando: um novo controller entrar no backend, um novo módulo de rota entrar no frontend, uma
nova tela entrar no app, ou houver mudança de escopo no TR.

> Referências a `architecture.md` dentro destes documentos apontam para
> `daee/doc/architecture.md`, que não é copiado aqui por conter detalhes de infraestrutura.

## Pendências

[`paginas-pendentes.md`](./paginas-pendentes.md) registra as cinco páginas previstas que **não**
foram construídas por dependerem de informação comercial, jurídica ou de auditoria — e os dois
questionários (segurança e integração) cujas lacunas o site hoje evita afirmar.
