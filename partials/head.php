<?php
// Basic <head> partial for IR site
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $pageTitle ?? 'Relação com Investidores' ?></title>
  <meta name="description" content="Portal de Relações com Investidores" />
  <link rel="icon" href="/favicon.ico" />
</head>
<body class="page page--<?= $pageSlug ?? 'home' ?>">
