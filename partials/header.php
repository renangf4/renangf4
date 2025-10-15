<?php
$current = $pageSlug ?? '';
$nav = [
  'home' => ['href' => '/index.php', 'label' => 'Início'],
  'financials' => ['href' => '/financials.php', 'label' => 'Financeiro'],
  'governance' => ['href' => '/governance.php', 'label' => 'Governança'],
  'press' => ['href' => '/press.php', 'label' => 'Imprensa'],
  'events' => ['href' => '/events.php', 'label' => 'Eventos'],
  'resources' => ['href' => '/resources.php', 'label' => 'Recursos'],
  'contact' => ['href' => '/contact.php', 'label' => 'Contato'],
  'stock' => ['href' => '/stock.php', 'label' => 'Ações']
];
?>
<header class="site-header">
  <div class="site-header__brand">
    <a class="site-header__logo" href="/index.php">Empresa S.A.</a>
    <span class="site-header__tagline">Relação com Investidores</span>
  </div>
  <nav class="site-nav" aria-label="Navegação principal">
    <ul class="site-nav__list">
    <?php foreach ($nav as $slug => $item): ?>
      <?php $isActive = $slug === $current ? ' site-nav__item--active' : ''; ?>
      <li class="site-nav__item<?= $isActive ?>">
        <a class="site-nav__link" href="<?= $item['href'] ?>"><?= $item['label'] ?></a>
      </li>
    <?php endforeach; ?>
    </ul>
  </nav>
</header>
