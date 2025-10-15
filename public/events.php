<?php
$pageTitle = 'Eventos — RI';
$pageSlug = 'events';
$events = [
  ['date' => '2025-11-15 10:00', 'title' => 'Teleconferência de Resultados 3T25', 'url' => '#'],
  ['date' => '2026-03-30 09:00', 'title' => 'Assembleia Geral Ordinária', 'url' => '#'],
];
?>
<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<main class="content content--events">
  <h1 class="content__title">Agenda de Eventos</h1>
  <ul class="list list--events">
    <?php foreach ($events as $event): ?>
    <li class="list__item">
      <span class="list__meta"><?= date('d/m/Y H:i', strtotime($event['date'])) ?></span>
      <a class="list__link" href="<?= $event['url'] ?>"><?= htmlspecialchars($event['title']) ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
</main>
<?php require __DIR__ . '/../partials/footer.php'; ?>
