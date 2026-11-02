# WordPress Development

Themes, plugins and code snippets from WordPress / WooCommerce client projects. Every PHP file passes `php -l` and every JS file passes `node --check`.

## Projects

| Folder | What it is |
|---|---|
| [projects/weddings-directory-theme](projects/weddings-directory-theme) | Wedding venues & vendors directory: archive and detail templates, AJAX filters by location, guests, property type, facilities and style |
| [projects/woocommerce-ajax-filters-plugin](projects/woocommerce-ajax-filters-plugin) | WooCommerce AJAX product filter plugin: category, year, power, manufacturer and height range |

## Themes

| File | What it is |
|---|---|
| [aquarium-woodmart-child-functions.php](themes/aquarium-woodmart-child-functions.php) | WoodMart child theme for an aquarium shop: AJAX search/filters, bulk add-to-cart, mini-cart quantity controls |
| [aquarium-woodmart-child-scripts.js](themes/aquarium-woodmart-child-scripts.js) | Front-end scripts for the same child theme |
| [child-theme-functions.php](themes/child-theme-functions.php) | Child theme with a settings page and AJAX team-member filters |

## Snippets

**WooCommerce**
- [ajax-add-to-cart-with-custom-data.php](snippets/woocommerce/ajax-add-to-cart-with-custom-data.php) – custom options carried from product → cart → order
- [variation-dropdown-on-shop-page.php](snippets/woocommerce/variation-dropdown-on-shop-page.php) – variation selects on the shop loop
- [rename-shipping-label.php](snippets/woocommerce/rename-shipping-label.php) – rename "Shipping" via gettext

**WordPress**
- [blog-listing-shortcode.php](snippets/wordpress/blog-listing-shortcode.php) – latest posts shortcode
- [taxonomy-terms-list.php](snippets/wordpress/taxonomy-terms-list.php) – terms ordered by count
- [rewrite-rule-to-page.php](snippets/wordpress/rewrite-rule-to-page.php) – custom rewrite rule
- [import-posts-from-api.php](snippets/wordpress/import-posts-from-api.php) – create posts from an external API
- [user-ratings-loop.php](snippets/wordpress/user-ratings-loop.php) – print ratings from API data
- [non-profit-search-page-template.php](snippets/wordpress/non-profit-search-page-template.php) – page template with search and filters

**JavaScript**
- [debounced-ajax-search.js](snippets/javascript/debounced-ajax-search.js) – search after the user stops typing
- [array-filter-by-name.js](snippets/javascript/array-filter-by-name.js) – filter people by name
- [mouse-parallax-element.js](snippets/javascript/mouse-parallax-element.js) – mouse parallax effect

## Notes

- Code comes from real client sites, so post types, meta keys and IDs are project-specific.
- Request input is sanitised (`sanitize_text_field` via `map_deep`) before use.
