<?php
$pageTitle = 'Contato — RI';
$pageSlug = 'contact';
?>
<?php require __DIR__ . '/../partials/head.php'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<main class="content content--contact">
  <h1 class="content__title">Contato do RI</h1>
  <form class="form form--contact" method="post" action="#">
    <div class="form__row">
      <label class="form__label" for="name">Nome</label>
      <input class="form__input" type="text" id="name" name="name" required />
    </div>
    <div class="form__row">
      <label class="form__label" for="email">Email</label>
      <input class="form__input" type="email" id="email" name="email" required />
    </div>
    <div class="form__row">
      <label class="form__label" for="message">Mensagem</label>
      <textarea class="form__textarea" id="message" name="message" rows="4" required></textarea>
    </div>
    <div class="form__actions">
      <button class="button button--primary" type="submit">Enviar</button>
    </div>
  </form>
</main>
<?php require __DIR__ . '/../partials/footer.php'; ?>
