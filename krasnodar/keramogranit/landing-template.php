<?php
$baseDir = __DIR__;
$dataPath = $baseDir . '/landing-data.json';
$data = json_decode(file_get_contents($dataPath), true);
$pages = [];
if (is_array($data) && isset($data['pages']) && is_array($data['pages'])) {
    foreach ($data['pages'] as $pageItem) {
        if (isset($pageItem['slug'])) {
            $pages[$pageItem['slug']] = $pageItem;
        }
    }
}
if (!isset($landingSlug) || !isset($pages[$landingSlug])) {
    http_response_code(404);
    echo '<h1>Страница не найдена</h1>';
    return;
}
$page = $pages[$landingSlug];
$metaTitle = htmlspecialchars($page['meta_title'], ENT_QUOTES, 'UTF-8');
$metaDescription = htmlspecialchars($page['meta_description'], ENT_QUOTES, 'UTF-8');
?><!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $metaTitle ?></title>
  <meta name="description" content="<?= $metaDescription ?>">
  <style>
    body{font-family:Arial,sans-serif;margin:0;color:#1f2937;line-height:1.45;background:#f8fafc}
    .wrap{max-width:1120px;margin:0 auto;padding:20px}
    .block{background:#fff;border-radius:12px;padding:20px;margin:14px 0;box-shadow:0 2px 10px rgba(0,0,0,.04)}
    .hero{background:#0f172a;color:#fff}
    .btn{display:inline-block;background:#2563eb;color:#fff;padding:11px 16px;border-radius:8px;text-decoration:none;margin:6px 8px 0 0}
    .btn.alt{background:#059669}
    .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:12px}
    .card{border:1px solid #e2e8f0;border-radius:10px;padding:12px;background:#fff}
    h1{margin:0 0 8px;font-size:30px}
    h2{margin:0 0 10px;font-size:24px}
    ul{margin:0;padding-left:18px}
    .small{font-size:14px;color:#475569}
    .price{font-weight:700;color:#0f766e}
    .crumbs a{color:#1d4ed8;text-decoration:none}
  </style>
</head>
<body>
<div class="wrap">
  <div class="crumbs small"><a href="/">Главная</a> / <a href="/krasnodar/keramogranit/">Керамогранит Краснодар</a> / <?= htmlspecialchars($page['h1'], ENT_QUOTES, 'UTF-8') ?></div>

  <section class="block hero">
    <h1><?= htmlspecialchars($page['h1'], ENT_QUOTES, 'UTF-8') ?></h1>
    <p><?= htmlspecialchars($page['intro'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong><?= htmlspecialchars($page['offer'], ENT_QUOTES, 'UTF-8') ?></strong></p>
    <a class="btn" href="tel:+78610000000"><?= htmlspecialchars($page['ctas'][0], ENT_QUOTES, 'UTF-8') ?></a>
    <a class="btn alt" href="/krasnodar/keramogranit/"><?= htmlspecialchars($page['ctas'][1], ENT_QUOTES, 'UTF-8') ?></a>
    <a class="btn" href="mailto:sales@mg-ceramic.ru"><?= htmlspecialchars($page['ctas'][2], ENT_QUOTES, 'UTF-8') ?></a>
  </section>

  <section class="block">
    <h2>Почему этот кластер работает под рекламу в Краснодаре</h2>
    <p>Страница собрана под коммерческий интент: звонок, заявка, переход в каталог и быстрый подбор по параметрам.</p>
    <ul>
      <li>Региональный оффер и обработка заявок именно по Краснодару.</li>
      <li>Ясная товарная логика из ТЗ: формат, применение, фактура, свойства.</li>
      <li>Быстрые CTA для горячего и сравнительного трафика.</li>
    </ul>
  </section>

  <section class="block">
    <h2>Подбор по параметрам</h2>
    <div class="grid">
      <div class="card"><strong>Форматы</strong><br><span class="small"><?= htmlspecialchars(implode(', ', $page['formats']), ENT_QUOTES, 'UTF-8') ?></span></div>
      <div class="card"><strong>Типы</strong><br><span class="small"><?= htmlspecialchars(implode(', ', $page['types']), ENT_QUOTES, 'UTF-8') ?></span></div>
      <div class="card"><strong>Противоскольжение</strong><br><span class="small"><?= htmlspecialchars(implode(', ', $page['anti']), ENT_QUOTES, 'UTF-8') ?></span></div>
      <div class="card"><strong>Диапазон цены</strong><br><span class="small">от <?= (int)$page['price_range'][0] ?> до <?= (int)$page['price_range'][1] ?> ₽/м²</span></div>
    </div>
  </section>

  <section class="block">
    <h2>Сценарии применения</h2>
    <ul>
      <?php foreach ($page['scenarios'] as $scenario): ?>
        <li><?= htmlspecialchars($scenario, ENT_QUOTES, 'UTF-8') ?></li>
      <?php endforeach; ?>
    </ul>
  </section>

  <section class="block">
    <h2>Релевантные товары из ассортимента</h2>
    <p class="small"><?= htmlspecialchars($page['assortment_note'], ENT_QUOTES, 'UTF-8') ?></p>
    <div class="grid">
      <?php foreach ($page['products'] as $product): ?>
        <article class="card">
          <strong><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></strong><br>
          <span class="price"><?= (int)$product['price'] ?> ₽/м²</span><br>
          <span class="small">Формат: <?= htmlspecialchars($product['format'], ENT_QUOTES, 'UTF-8') ?> | Тип: <?= htmlspecialchars($product['type'], ENT_QUOTES, 'UTF-8') ?></span><br>
          <span class="small">Цвет: <?= htmlspecialchars($product['color'], ENT_QUOTES, 'UTF-8') ?> | Покрытие: <?= htmlspecialchars($product['finish'], ENT_QUOTES, 'UTF-8') ?></span><br>
          <a href="<?= htmlspecialchars($product['url'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Открыть товар</a>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="block">
    <h2>Преимущества работы с филиалом MG Ceramic в Краснодаре</h2>
    <ul>
      <?php foreach ($page['benefits'] as $benefit): ?>
        <li><?= htmlspecialchars($benefit, ENT_QUOTES, 'UTF-8') ?></li>
      <?php endforeach; ?>
    </ul>
  </section>

  <section class="block">
    <h2>Как мы работаем по заявке</h2>
    <ol>
      <li>Уточняем задачу: зона применения, бюджет, стиль и сроки.</li>
      <li>Даем 3–5 релевантных вариантов с ценой и параметрами.</li>
      <li>Согласовываем объем и доставку по Краснодару.</li>
      <li>Фиксируем поставку и сопровождаем до приемки.</li>
    </ol>
  </section>

  <section class="block">
    <h2>FAQ</h2>
    <?php foreach ($page['faq'] as $qa): ?>
      <p><strong><?= htmlspecialchars($qa['q'], ENT_QUOTES, 'UTF-8') ?></strong><br><?= htmlspecialchars($qa['a'], ENT_QUOTES, 'UTF-8') ?></p>
    <?php endforeach; ?>
  </section>

  <section class="block hero">
    <h2>Нужна консультация и коммерческое предложение?</h2>
    <p>Позвоните в краснодарский филиал MG Ceramic или оставьте запрос — подберем керамогранит под ваш сценарий и бюджет.</p>
    <a class="btn" href="tel:+78610000000">Позвонить в Краснодар</a>
    <a class="btn alt" href="mailto:sales@mg-ceramic.ru">Запросить подборку</a>
  </section>
</div>
</body>
</html>
