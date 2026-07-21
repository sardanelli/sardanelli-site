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


## Galeria automática

A galeria está integrada ao site e utiliza a pasta `fotos/`.

### Para adicionar fotos

1. Coloque JPG, JPEG, PNG, WEBP, GIF ou AVIF dentro de `fotos/`.
2. Faça commit e push para o GitHub.
3. O GitHub Actions gera automaticamente `gallery.json`.
4. O Cloudflare Pages publica a nova versão do site.

Não é necessário editar `index.html`, `style.css` ou `script.js` para adicionar/remover fotos.

A galeria mantém a identidade visual do site, com fundo escuro, dourado, roxo, animações de entrada e cantos arredondados. Ao clicar em uma imagem, ela se expande a partir do próprio card e retorna ao mesmo lugar ao fechar.

### Cloudflare Pages

Use o repositório do GitHub como origem do projeto. O projeto é estático; não há build command obrigatório. O diretório de saída é a raiz do repositório.

### GitHub Actions

O workflow em `.github/workflows/gallery.yml` atualiza automaticamente a lista de imagens sempre que a pasta `fotos/` é alterada.
