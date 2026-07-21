import { readdir, writeFile } from 'node:fs/promises';
import path from 'node:path';

const folder = path.resolve('fotos');
const output = path.resolve('gallery.json');
const allowed = new Set(['.jpg', '.jpeg', '.png', '.webp', '.gif', '.avif']);

const entries = await readdir(folder, { withFileTypes: true });
const files = entries
  .filter(entry => entry.isFile())
  .map(entry => entry.name)
  .filter(name => allowed.has(path.extname(name).toLowerCase()))
  .sort((a, b) => a.localeCompare(b, 'pt-BR', { numeric: true, sensitivity: 'base' }))
  .map(name => `fotos/${encodeURIComponent(name).replace(/%2F/g, '/')}`);

await writeFile(output, `${JSON.stringify(files, null, 2)}\n`, 'utf8');
console.log(`Galeria atualizada: ${files.length} imagem(ns).`);
