#!/usr/bin/env node
/**
 * Build static HTML for Vercel from the PHP page templates.
 * Requires PHP CLI available at build time (local/CI). On Vercel we also
 * commit/prebuild public/ so deploy works without PHP on the builder.
 */
const { execFileSync, existsSync } = require('child_process');
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const publicDir = path.join(root, 'public');
const pages = ['index', 'about', 'services', 'equipment', 'industries', 'quote', 'contact'];

fs.mkdirSync(publicDir, { recursive: true });

function copyDir(src, dest) {
  fs.mkdirSync(dest, { recursive: true });
  for (const entry of fs.readdirSync(src, { withFileTypes: true })) {
    const from = path.join(src, entry.name);
    const to = path.join(dest, entry.name);
    if (entry.isDirectory()) copyDir(from, to);
    else fs.copyFileSync(from, to);
  }
}

let usedPhp = false;
try {
  execFileSync('php', ['-v'], { stdio: 'ignore' });
  usedPhp = true;
} catch {
  usedPhp = false;
}

if (usedPhp) {
  for (const page of pages) {
    const out = execFileSync('php', [path.join(root, `${page}.php`)], {
      cwd: root,
      encoding: 'utf8',
      maxBuffer: 10 * 1024 * 1024,
    });
    fs.writeFileSync(path.join(publicDir, `${page}.html`), out);
  }
  console.log('Built HTML from PHP templates.');
} else if (pages.every((p) => existsSync(path.join(publicDir, `${p}.html`)))) {
  console.log('PHP not available — using existing public/*.html');
} else {
  console.error('No PHP and no prebuilt public HTML found.');
  process.exit(1);
}

for (const dir of ['css', 'js', 'assets']) {
  copyDir(path.join(root, dir), path.join(publicDir, dir));
}
for (const file of ['robots.txt', 'sitemap.xml']) {
  fs.copyFileSync(path.join(root, file), path.join(publicDir, file));
}

console.log('Static site ready in public/');
