<?php
$pageTitle = 'Financeiro — RI';
$pageSlug = 'financials';
$releases = [
  ['period' => '3T 2025', 'pdf' => '#', 'xsl' => '#'],
  ['period' => '2T 2025', 'pdf' => '#', 'xsl' => '#'],
  ['period' => '1T 2025', 'pdf' => '#', 'xsl' => '#'],
];
?>
<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<main class="content content--financials">
  <h1 class="content__title">Resultados Financeiros</h1>
  <section class="list list--releases">
    <ul class="list__items">
      <?php foreach ($releases as $item): ?>
      <li class="list__item">
        <span class="list__label"><?= htmlspecialchars($item['period']) ?></span>
        <div class="list__actions">
          <a class="button button--primary" href="<?= $item['pdf'] ?>">PDF</a>
          <a class="button button--secondary" href="<?= $item['xsl'] ?>">Planilha</a>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </section>
</main>
<?php require __DIR__ . '/../partials/footer.php'; ?>
