<?php
$data = json_decode(file_get_contents(__DIR__ . '/landing-data.json'), true);
$pages = isset($data['pages']) && is_array($data['pages']) ? $data['pages'] : [];
?><!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Посадочные по керамограниту — Краснодар | MG Ceramic</title>
  <meta name="description" content="Индекс посадочных страниц по керамограниту для рекламного трафика в Краснодаре.">
  <style>body{font-family:Arial,sans-serif;padding:20px;background:#f8fafc;color:#0f172a}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:12px}.card{background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:14px}a{color:#1d4ed8;text-decoration:none}</style>
</head>
<body>
  <h1>Керамогранит в Краснодаре — карта PPC/SEO посадочных</h1>
  <p>Всего страниц: <?= count($pages) ?>. Все подборки построены на основании ТЗ (tz1–tz4) и ассортимента из mg-ceramic.ru.xml.</p>
  <div class="grid">
    <?php foreach ($pages as $page): ?>
      <div class="card">
        <a href="<?= htmlspecialchars($page['url'], ENT_QUOTES, 'UTF-8') ?>"><strong><?= htmlspecialchars($page['h1'], ENT_QUOTES, 'UTF-8') ?></strong></a>
        <p><?= htmlspecialchars($page['intro'], ENT_QUOTES, 'UTF-8') ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
