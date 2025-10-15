<?php
$pageTitle = 'Início — RI';
$pageSlug = 'home';
?>
<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<main class="content content--home">
  <section class="hero hero--home">
    <div class="hero__inner">
      <h1 class="hero__title">Relação com Investidores</h1>
      <p class="hero__subtitle">Transparência, governança e desempenho para o mercado.</p>
    </div>
  </section>
  <section class="cards cards--highlights">
    <div class="cards__grid">
      <article class="card card--kpi">
        <h2 class="card__title">Resultados</h2>
        <p class="card__text">Veja nossos resultados trimestrais e anuais.</p>
        <a class="card__action" href="/financials.php">Acessar</a>
      </article>
      <article class="card card--gov">
        <h2 class="card__title">Governança</h2>
        <p class="card__text">Estrutura de administração, conselhos e políticas.</p>
        <a class="card__action" href="/governance.php">Acessar</a>
      </article>
      <article class="card card--press">
        <h2 class="card__title">Imprensa</h2>
        <p class="card__text">Comunicados e notícias relevantes ao mercado.</p>
        <a class="card__action" href="/press.php">Acessar</a>
      </article>
    </div>
  </section>
</main>
<?php require __DIR__ . '/../partials/footer.php'; ?>
