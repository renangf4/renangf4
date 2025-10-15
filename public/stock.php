<?php
$pageTitle = 'Ações — RI';
$pageSlug = 'stock';
$stock = [
  'ticker' => 'BVMF:EMSA3',
  'price' => 'R$ 25,42',
  'change' => '+1,23%'
];
?>
<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<main class="content content--stock">
  <h1 class="content__title">Informações das Ações</h1>
  <div class="kpis kpis--stock">
    <div class="kpis__item">
      <span class="kpis__label">Ticker</span>
      <span class="kpis__value"><?= htmlspecialchars($stock['ticker']) ?></span>
    </div>
    <div class="kpis__item">
      <span class="kpis__label">Preço</span>
      <span class="kpis__value"><?= htmlspecialchars($stock['price']) ?></span>
    </div>
    <div class="kpis__item">
      <span class="kpis__label">Variação</span>
      <span class="kpis__value"><?= htmlspecialchars($stock['change']) ?></span>
    </div>
  </div>
</main>
<?php require __DIR__ . '/../partials/footer.php'; ?>
