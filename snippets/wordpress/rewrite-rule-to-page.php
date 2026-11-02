<?php
/**
 * Maps /cleaners/{slug}/ to a fixed page with add_rewrite_rule().
 */
function custom_rewrite_rule() {
    add_rewrite_rule('^cleaners/([^/]*)/?','index.php?page_id=1500','top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);
