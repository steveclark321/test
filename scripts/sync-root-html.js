#!/usr/bin/env node
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const publicDir = path.join(root, 'public');
const pages = ['index', 'about', 'services', 'equipment', 'industries', 'quote', 'contact', 'privacy', 'terms'];

for (const page of pages) {
  const src = path.join(publicDir, `${page}.html`);
  const dest = path.join(root, `${page}.html`);
  if (!fs.existsSync(src)) {
    console.error('Missing', src);
    process.exit(1);
  }
  fs.copyFileSync(src, dest);
}

console.log('Synced HTML pages to repository root for Vercel.');
