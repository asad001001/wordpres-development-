add_filter('gettext', 'translate_reply');
add_filter('ngettext', 'translate_reply');

function translate_reply($translated) {
$translated = str_ireplace('Shipping', 'Margin', $translated);
return $translated;
}

add_filter( 'woocommerce_cart_shipping_method_full_label', 'bbloomer_remove_shipping_label', 9999, 2 );   
function bbloomer_remove_shipping_label( $label, $method ) {
    $new_label = preg_replace( '/^.+:/
', '', $label );
    return $new_label;
}

add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );
add_filter( 'woocommerce_cart_needs_shipping_address', 'custom_cart_needs_shipping_address', 50, 1 );
function custom_cart_needs_shipping_address( $needs_shipping_address ) {
    // Loop though cat items
    foreach ( WC()->cart->get_cart() as $cart_item ) {
        if ( has_term( array('electronics'), 'product_cat', $cart_item['product_id'] ) ) {
            // Force enable shipping address for virtual "gift" products
            $needs_shipping_address = true; 
        }
		else { 
			$needs_shipping_address = false;
		}
    }
    return $needs_shipping_address;
}