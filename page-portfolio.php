<?php
/**
 * Template Name: Portfólio (Redesign)
 * Description: Página de portfólio com BEM, filtros, busca e ordenação (sem SCSS).
 */

if (!defined('ABSPATH')) {
    exit; // Segurança: impede acesso direto
}

get_header();

// Detecta um post type e taxonomia prováveis para portfólio
$post_type = post_type_exists('portfolio') ? 'portfolio' : (post_type_exists('project') ? 'project' : 'post');
$taxonomy = '';
if (taxonomy_exists('portfolio_category')) {
    $taxonomy = 'portfolio_category';
} elseif (taxonomy_exists('project_category')) {
    $taxonomy = 'project_category';
} elseif ($post_type === 'post' && taxonomy_exists('category')) {
    $taxonomy = 'category';
}

$terms = [];
if ($taxonomy) {
    $terms = get_terms([
        'taxonomy'   => $taxonomy,
        'hide_empty' => true,
    ]);
}

// Query de projetos
$query_args = [
    'post_type'      => $post_type,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'no_found_rows'  => true,
];

$projects = new WP_Query($query_args);
?>

<main id="primary" class="portfolio" aria-labelledby="portfolio-title">
  <header class="portfolio__header">
    <h1 id="portfolio-title" class="portfolio__title"><?php echo esc_html(get_the_title()); ?></h1>
    <?php if (has_excerpt()) : ?>
      <p class="portfolio__subtitle"><?php echo esc_html(get_the_excerpt()); ?></p>
    <?php endif; ?>
  </header>

  <section class="portfolio__controls" aria-label="Controles do portfólio">
    <?php if (!empty($terms)) : ?>
      <div class="portfolio__filters" role="group" aria-label="Filtros por categoria">
        <button type="button" class="portfolio__filter-button portfolio__filter-button--active" data-filter="all" aria-pressed="true">Tudo</button>
        <?php foreach ($terms as $term) : ?>
          <button type="button" class="portfolio__filter-button" data-filter="<?php echo esc_attr($term->slug); ?>" aria-pressed="false"><?php echo esc_html($term->name); ?></button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="portfolio__tools">
      <label class="portfolio__search" aria-label="Buscar projetos">
        <span class="portfolio__search-label">Buscar</span>
        <input type="search" class="portfolio__search-input" placeholder="Buscar projetos..." autocomplete="off" />
      </label>

      <label class="portfolio__sort" aria-label="Ordenar projetos">
        <span class="portfolio__sort-label">Ordenar</span>
        <select class="portfolio__sort-select">
          <option value="date_desc">Mais recentes</option>
          <option value="date_asc">Mais antigos</option>
          <option value="title_asc">Título A–Z</option>
          <option value="title_desc">Título Z–A</option>
        </select>
      </label>
    </div>
  </section>

  <section class="portfolio__grid" aria-live="polite">
    <?php if ($projects->have_posts()) : ?>
      <?php while ($projects->have_posts()) : $projects->the_post(); ?>
        <?php
          $title       = get_the_title();
          $permalink   = get_permalink();
          $timestamp   = get_post_time('U', true); // Unix timestamp
          $tags_list   = [];
          $display_terms = [];

          if ($taxonomy) {
              $post_terms = get_the_terms(get_the_ID(), $taxonomy);
              if (!is_wp_error($post_terms) && $post_terms) {
                  foreach ($post_terms as $t) {
                      $display_terms[] = $t->name;
                      $tags_list[] = $t->slug;
                  }
              }
          }

          $joined_slugs = implode(' ', array_map('sanitize_title', $tags_list));
          $tag_string   = implode(', ', $display_terms);
        ?>

        <article class="portfolio__card" 
                 data-title="<?php echo esc_attr($title); ?>" 
                 data-tags="<?php echo esc_attr($tag_string); ?>" 
                 data-date="<?php echo esc_attr((string) $timestamp); ?>" 
                 data-category-slugs="<?php echo esc_attr($joined_slugs); ?>">
          <a class="portfolio__card-link" href="<?php echo esc_url($permalink); ?>" aria-label="Abrir projeto: <?php echo esc_attr($title); ?>">
            <div class="portfolio__card-media">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', [
                  'class' => 'portfolio__card-image',
                  'alt'   => esc_attr($title),
                  'loading' => 'lazy',
                  'decoding' => 'async',
                ]); ?>
              <?php endif; ?>
            </div>

            <div class="portfolio__card-content">
              <h2 class="portfolio__card-title"><?php echo esc_html($title); ?></h2>
              <div class="portfolio__card-meta">
                <time class="portfolio__card-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                <?php if (!empty($display_terms)) : ?>
                  <ul class="portfolio__card-tags" aria-label="Categorias">
                    <?php foreach ($display_terms as $name) : ?>
                      <li class="portfolio__card-tag"><?php echo esc_html($name); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </div>
              <?php if (has_excerpt()) : ?>
                <p class="portfolio__card-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
              <?php endif; ?>
              <span class="portfolio__card-cta" aria-hidden="true">Ver projeto</span>
            </div>
          </a>
        </article>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <p class="portfolio__empty">Nenhum projeto encontrado.</p>
    <?php endif; ?>
  </section>
</main>

<script>
(function() {
  "use strict";

  function normalize(text) {
    return (text || "")
      .toString()
      .toLowerCase()
      .normalize("NFD")
      .replace(/\p{Diacritic}/gu, "");
  }

  function sortNodes(container, getSortableValue, direction) {
    const children = Array.from(container.children);
    const multiplier = direction === "asc" ? 1 : -1;
    children.sort((a, b) => {
      const va = getSortableValue(a);
      const vb = getSortableValue(b);
      if (va < vb) return -1 * multiplier;
      if (va > vb) return 1 * multiplier;
      return 0;
    });
    for (const node of children) {
      container.appendChild(node);
    }
  }

  document.addEventListener("DOMContentLoaded", function() {
    const root = document.querySelector(".portfolio");
    if (!root) return;

    const grid = root.querySelector(".portfolio__grid");
    const filterButtons = Array.from(root.querySelectorAll(".portfolio__filter-button"));
    const searchInput = root.querySelector(".portfolio__search-input");
    const sortSelect = root.querySelector(".portfolio__sort-select");

    let activeFilter = "all";
    let searchQuery = "";

    function applyFilters() {
      const items = Array.from(grid.querySelectorAll(".portfolio__card"));
      const q = normalize(searchQuery);
      const filter = activeFilter;

      let visibleCount = 0;

      for (const item of items) {
        const title = normalize(item.getAttribute("data-title"));
        const tags = normalize(item.getAttribute("data-tags"));
        const categories = (item.getAttribute("data-category-slugs") || "").split(/\s+/).filter(Boolean);

        const matchesFilter = (filter === "all") || categories.includes(filter);
        const matchesSearch = !q || title.includes(q) || tags.includes(q);

        const show = matchesFilter && matchesSearch;
        item.style.display = show ? "" : "none";
        if (show) visibleCount++;
      }

      grid.setAttribute("data-visible-count", String(visibleCount));
    }

    function handleFilterClick(btn) {
      for (const b of filterButtons) {
        const isActive = b === btn;
        b.classList.toggle("portfolio__filter-button--active", isActive);
        b.setAttribute("aria-pressed", isActive ? "true" : "false");
      }
      activeFilter = btn.getAttribute("data-filter") || "all";
      applyFilters();
    }

    for (const btn of filterButtons) {
      btn.addEventListener("click", () => handleFilterClick(btn));
    }

    if (searchInput) {
      searchInput.addEventListener("input", () => {
        searchQuery = searchInput.value || "";
        applyFilters();
      });
    }

    if (sortSelect) {
      sortSelect.addEventListener("change", () => {
        const val = sortSelect.value;
        if (val === "date_desc") {
          sortNodes(grid, el => Number(el.getAttribute("data-date")) || 0, "desc");
        } else if (val === "date_asc") {
          sortNodes(grid, el => Number(el.getAttribute("data-date")) || 0, "asc");
        } else if (val === "title_asc") {
          sortNodes(grid, el => (el.getAttribute("data-title") || "").toLowerCase(), "asc");
        } else if (val === "title_desc") {
          sortNodes(grid, el => (el.getAttribute("data-title") || "").toLowerCase(), "desc");
        }
      });

      // Ordenação padrão: Mais recentes
      sortNodes(grid, el => Number(el.getAttribute("data-date")) || 0, "desc");
    }

    // Aplica filtros iniciais
    applyFilters();
  });
})();
</script>

<?php get_footer(); ?>
