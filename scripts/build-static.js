#!/usr/bin/env node
/**
 * Build static HTML for Vercel from the PHP page templates when PHP is available.
 * On Vercel (no PHP), reuse committed public/*.html and copy assets.
 */
const { execFileSync } = require('child_process');
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
} else if (pages.every((p) => fs.existsSync(path.join(publicDir, `${p}.html`)))) {
  console.log('PHP not available — using existing public/*.html');
} else if (pages.every((p) => fs.existsSync(path.join(root, `${p}.html`)))) {
  for (const page of pages) {
    fs.copyFileSync(path.join(root, `${page}.html`), path.join(publicDir, `${page}.html`));
  }
  console.log('PHP not available — copied root HTML into public/');
} else {
  console.error('No PHP and no prebuilt HTML found.');
  process.exit(1);
}

for (const dir of ['css', 'js', 'assets']) {
  copyDir(path.join(root, dir), path.join(publicDir, dir));
}
for (const file of ['robots.txt', 'sitemap.xml']) {
  fs.copyFileSync(path.join(root, file), path.join(publicDir, file));
}

console.log('Static site ready in public/');
