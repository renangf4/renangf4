<?php
$pageTitle = 'Imprensa — RI';
$pageSlug = 'press';
$press = [
  ['date' => '2025-10-01', 'title' => 'Comunicado ao Mercado', 'url' => '#'],
  ['date' => '2025-09-20', 'title' => 'Fato Relevante', 'url' => '#'],
  ['date' => '2025-09-05', 'title' => 'Nota à Imprensa', 'url' => '#'],
];
?>
<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<main class="content content--press">
  <h1 class="content__title">Sala de Imprensa</h1>
  <ul class="list list--press">
    <?php foreach ($press as $item): ?>
    <li class="list__item">
      <span class="list__meta"><?= date('d/m/Y', strtotime($item['date'])) ?></span>
      <a class="list__link" href="<?= $item['url'] ?>"><?= htmlspecialchars($item['title']) ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
</main>
<?php require __DIR__ . '/../partials/footer.php'; ?>
