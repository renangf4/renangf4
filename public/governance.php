<?php
$pageTitle = 'Governança — RI';
$pageSlug = 'governance';
$board = [
  ['name' => 'Maria Souza', 'role' => 'Presidente do Conselho'],
  ['name' => 'João Lima', 'role' => 'Conselheiro Independente'],
  ['name' => 'Ana Pereira', 'role' => 'Conselheira'],
];
?>
<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<main class="content content--governance">
  <h1 class="content__title">Governança Corporativa</h1>
  <section class="grid grid--board">
    <?php foreach ($board as $member): ?>
    <article class="card card--person">
      <h2 class="card__title"><?= htmlspecialchars($member['name']) ?></h2>
      <p class="card__text"><?= htmlspecialchars($member['role']) ?></p>
    </article>
    <?php endforeach; ?>
  </section>
</main>
<?php require __DIR__ . '/../partials/footer.php'; ?>
