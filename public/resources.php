<?php
$pageTitle = 'Recursos — RI';
$pageSlug = 'resources';
$resources = [
  ['label' => 'Formulário de Referência', 'url' => '#'],
  ['label' => 'Estatuto Social', 'url' => '#'],
  ['label' => 'Política de Divulgação', 'url' => '#'],
];
?>
<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<main class="content content--resources">
  <h1 class="content__title">Documentos e Recursos</h1>
  <ul class="list list--resources">
    <?php foreach ($resources as $file): ?>
    <li class="list__item">
      <a class="list__link" href="<?= $file['url'] ?>"><?= htmlspecialchars($file['label']) ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
</main>
<?php require __DIR__ . '/../partials/footer.php'; ?>
