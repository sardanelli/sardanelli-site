# Sardanelli Produções — Site

Site estático (HTML + CSS + JS puro). Pronto para publicar no Cloudflare Pages.

## 🚀 Publicar no Cloudflare Pages via GitHub

1. Crie um repositório no GitHub e suba todos os arquivos desta pasta na raiz do repositório.
2. No painel da Cloudflare: **Workers & Pages → Create → Pages → Connect to Git**.
3. Selecione o repositório.
4. Configuração de build:
   - **Framework preset:** None
   - **Build command:** (deixe em branco)
   - **Build output directory:** `/` (raiz)
5. **Save and Deploy**.

A partir daí, qualquer novo commit já republica o site sozinho.

## Publicar sem GitHub (upload direto)

Também é possível usar **Workers & Pages → Upload assets** (sem conectar o GitHub) e subir os
arquivos desta pasta diretamente — não há nenhuma etapa de build necessária.

## Estrutura de arquivos

```
index.html
style.css
script.js
logo.png
favicon.png
```
