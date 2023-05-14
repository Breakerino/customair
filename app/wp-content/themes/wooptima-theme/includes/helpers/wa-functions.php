<?php

/* ----------------------------------------------------------------------------------------
 * Wooptima Functions
 * ----------------------------------------------------------------------------------------
 * @enviroment	production
 * @version			1.0.0
 * @updated 11/08/2022
 * ----------------------------------------------------------------------------------------
 */

defined('ABSPATH') || exit;

/**
 * Inject "Google Conversion Tracking" script into the page.
 * 
 * @hook action wp_head
 * @return void
 */
function wa_handle_inject_gtm_conversion_tracking_script() {
	if ( ! defined('WA_GTM_CLIENT_ID') || ! defined('WA_GTM_CONVERSION_LABEL') ) {
		return;
	}
	
	ob_start(); ?>

	<script type="text/javascript">
		gtag('event', 'conversion', { 'send_to': '<?= WA_GTM_CLIENT_ID; ?>/<?= WA_GTM_CONVERSION_LABEL ?>', 'value': 1.0, 'currency': '<?= get_woocommerce_currency(); ?>', 'transaction_id': '' });
	</script>

	<?php echo ob_get_clean();
}

/**
 * Inject "Google Tag Manager" script into the page.
 * 
 * @hook action wp_head
 * @return void
 */
function wa_handle_inject_gtm_script() {
	if ( ! defined('WA_GTM_CLIENT_ID') ) {
		return;
	}
	
	ob_start(); ?>

	<script async src="https://www.googletagmanager.com/gtag/js?id=<?= WA_GTM_CLIENT_ID; ?>"></script>
	<script>
  	window.dataLayer = window.dataLayer || [];
  	function gtag(){dataLayer.push(arguments);}
  	gtag('js', new Date());
  	gtag('config', '<?= WA_GTM_CLIENT_ID; ?>');
	</script>

	<?php echo ob_get_clean();
}

/**
 * 
 * Inject "SmartsUpp live chat" script into the page.
 * 
 * @hook action wp_head
 * @return void
 */
function wa_handle_inject_foxentry_script() {
	if ( ! defined('WA_FOXENTRY_CLIENT_ID') || ! is_checkout() ) {
		return;
	}
	
	ob_start(); ?>

	<script type="text/javascript">
		var Foxentry;
		(function () {
			var e = document.querySelector("script"), s = document.createElement('script');
			s.setAttribute('type', 'text/javascript');
			s.setAttribute('async', 'true');
			s.setAttribute('src', 'https://cdn.foxentry.cz/lib');
			e.parentNode.appendChild(s);
			s.onload = function(){ Foxentry = new FoxentryBase('<?= WA_FOXENTRY_CLIENT_ID; ?>'); }
		})();
	</script>

	<?php echo ob_get_clean();
}

/**
 * 
 * Inject "SmartsUpp live chat" script into the page.
 * 
 * @hook action wp_head
 * @return void
 */
function wa_handle_inject_smartsupp_livechat_script() {
	if ( ! defined('WA_SMARTSUPP_LIVECHAT_API_KEY') || ! defined('WA_SMARTSUPP_LIVECHAT_LOCALE') ) {
		return;
	}
	
	ob_start(); ?>

	<script type="text/javascript">
		var _smartsupp = _smartsupp || {};
		_smartsupp.key = "<?= WA_SMARTSUPP_LIVECHAT_API_KEY; ?>";
		window.smartsupp || (function(d) {
			var s, c, o = smartsupp = function() {
				o._.push(arguments)
			};
			o._ = [];
			s = d.getElementsByTagName("script")[0];
			c = d.createElement("script");
			c.type = "text/javascript";
			c.charset = "utf-8";
			c.async = true;
			c.src = "https://www.smartsuppchat.com/loader.js?";
			s.parentNode.insertBefore(c, s);
		})(document);
		smartsupp("language", "<?= WA_SMARTSUPP_LIVECHAT_LOCALE; ?>");
	</script>

<?php echo ob_get_clean();
}

/**
 * Adjust Complianz cookies category
 * 
 * @hook filter cmplz_known_script_tags
 * @param array $tags
 * @return array
 */
function wa_handle_adjust_compilanz_cookies_categories($tags) {
	if ( ! defined('WA_CMPLZ_COOKIES_CATEGORIES') ) return $tags;
	return array_map(function ($tag) {
		if (!isset($tag['name'])) {
			return $tag;
		}

		foreach (WA_CMPLZ_COOKIES_CATEGORIES as $category => $tags) {
			if (in_array($tag, $tags)) {
				$tag['category'] = $category;
			}
		}

		return $tag;
	}, $tags);
}

/**
 * Exclude product duplication meta
 *
 * @hook filter woocommerce_duplicate_product_exclude_meta
 * @param array $excludedMeta
 * @return array
 */
function wa_handle_excluded_product_duplication_meta($excludedMeta) {
	return defined('WA_PRODUCT_EXCLUDED_DUPLICATION_META') ? array_merge($excludedMeta, WA_PRODUCT_EXCLUDED_DUPLICATION_META) : $excludedMeta;
}

/**
 * Adjust checkout payment gateways according to defined rules
 * 
 * @hook filter woocommerce_available_payment_gateways
 * @param array $availableGateways
 * @status tested
 * @return array
 */
function wa_handle_adjust_available_payment_gateways($availableGateways) {
	if (is_admin() || ! defined('WA_CHECKOUT_CONDITIONAL_PAYMENT_GATEWAYS_RULES')) {
		return $availableGateways;
	}

	foreach (WA_CHECKOUT_CONDITIONAL_PAYMENT_GATEWAYS_RULES as $gatewayID => $conditions) {
		if (!isset($availableGateways[$gatewayID])) {
			continue;
		}

		foreach ($conditions as $name => $values) {
			switch ($name) {
				case 'countries':
					if (!in_array(WC()->customer->get_billing_country(), $values)) {
						unset($availableGateways[$gatewayID]);
						break 3;
					}

					break;

				case 'category': 
					foreach (WC()->cart->get_cart_contents() as $cartItem) {
						$product = \wc_get_product($cartItem['product_id']);
						
						if ( wa_product_has_categories($product, $values)) { 
							unset($availableGateways[$gatewayID]); 
							break 3;
						}
					}
					break;
			}
		}
	}

	return $availableGateways;
}

/**
 * Include custom cron schedules
 * 
 * @hook cron_schedules
 * @param array $schedules
 * @return array
 */
function wa_handle_include_custom_cron_schedules($schedules) {
	if ( ! defined('WA_CUSTOM_CRON_SCHEDULES') ) {
		return $schedules;
	}
	
	foreach (WA_CUSTOM_CRON_SCHEDULES as $name => $args) {
		if (!isset($schedules[$name])) {
			$schedules[$name] = $args;
		}
	}

	return $schedules;
}

/**
 * Forward failed/cancelled order emails to to customer's email
 * 
 * @hook filter woocommerce_email_recipient_failed_order, woocommerce_email_recipient_cancelled_order
 * @param string $recipient
 * @param \WC_Order $order
 * @return string
 */
function wa_forward_admin_order_emails_to_customer($recipient, $order) {
	if (!($order instanceof \WC_Order)) {
		return $recipient;
	}

	$customerEmail = $order->get_billing_email();

	return !empty($customerEmail) ? $customerEmail : $recipient;
}

/**
 * Allow to edit order while order is in ceratin statuses
 *
 * @hook filter wc_order_is_editable
 * @param boolean $isEditable
 * @param \WC_Order $order
 * @return boolean
 */
function wa_handle_adjust_editable_orders_statuses($isEditable, $order) {
	return defined('WA_ORDER_EDITABLE_STATUSES') ? (in_array($order->get_status(), WA_ORDER_EDITABLE_STATUSES) ? true : $isEditable) : $isEditable;
}

/**
 * Add filter wrapper
 *
 * @param string $hook
 * @param array $args
 * @param integer $priority
 * @param integer $acceptedArgs
 * @return void
 */
function wa_add_filter($hook, $args, $priority = 10, $acceptedArgs = 1) {
	['strategy' => $strategy, 'value' => $value, 'callback' => $callback] = \wp_parse_args($args, [
		'value' => '',
		'callback' => '',
		'strategy' => 'replace'
	]);

	// TODO: Native functionality support

	$callbackFunction = null;

	switch ($strategy) {
		case 'merge':
			$callbackFunction = function ($currentValue) use ($value) {
				return is_array($currentValue) && is_array($value) ? array_merge($currentValue, $value) : $currentValue;
			};
			break;
		case 'replace':
			$callbackFunction = function ($currentValue) use ($value) {
				return $value;
			};
			break;
		case 'push':
			$callbackFunction = function ($currentValue) use ($value) {
				return is_array($currentValue) ? array_push($currentValue, $value) : $currentValue;
			};
			break;
	}

	if (!is_callable($callbackFunction)) {
		return;
	}

	\add_filter($hook, $callbackFunction, $priority, $acceptedArgs);
}

/**
 * ----------------------------------------------------------------------
 * Get boolean as yes/no text value
 * ----------------------------------------------------------------------
 * @author Matúš Mendel
 * @updated 11/08/2022
 * ----------------------------------------------------------------------
 * @param mixed $value 
 * @return string
 * ----------------------------------------------------------------------
 */ 
function wa_get_text_boolean_value($value) {
	return (bool) $value ? 'yes' : 'no';
}

/**
 * Insert a single array item inside another array at a set position
 *
 * @since  2.0.2
 * @param  array $array    Array to modify. Is passed by reference, and no return is needed. Passed by reference.
 * @param  array $new      New array to insert.
 * @param  int   $position Position in the main array to insert the new array.
 */
function wa_array_insert( &$array, $new, $position ) {
	$before = array_slice( $array, 0, $position - 1 );
	$after  = array_diff_key( $array, $before );
	$array  = array_merge( $before, $new, $after );
}

/**
 * Undocumented function
 *
 * @param [type] $field
 * @return void
 */
function wa_get_product_category_field($field) {
	$category = wa_get_queried_product_category();
	
	if ( ! $category ) {
		return null;
	}
	
	//$queriedObject = get_queried_object();
	//
	//if ( ! ( $queriedObject instanceof \WP_Term ) || $queriedObject->taxonomy !== 'product_cat' ) {
	//	return null;
	//}
	
	switch ($field) {
		case 'name':
			return $category->name;
		case 'description':
			return wpautop($category->description);
		case 'image':
			return (int) get_term_meta($category->term_id, 'thumbnail_id', true);
	}
	
	return null;
}

/**
 * Undocumented function
 *
 * @param [type] $postID
 * @param [type] $metaList
 * @param boolean $single
 * @return void
 */
function wa_get_post_meta($postID, $metaList, $single = false) {
	$metaData = get_post_meta($postID, null, $single);
	return wp_parse_args($metaData, array_combine($metaList, array_fill(0, count($metaList), null)));
}

/**
 * Retrieve the terms of a post in hierarchical order
 *
 * @author Wooptima
 * 
 * @param \WP_Post|int $post
 * @param string $taxonomy
 * @param array $args
 * 
 * @return array
 */
function wa_get_post_terms($post, string $taxonomy, array $args = []): array {
	if (is_numeric($post)) {
		$post = \get_post($post);
	}

	if (!($post instanceof \WP_Post) || !\taxonomy_exists($taxonomy)) {
		return [];
	}

	$termIDs = \wp_get_post_terms($post->ID, $taxonomy, ['fields' => 'ids']);

	return \get_terms(
		array_merge($args, [
			'taxonomy' => $taxonomy,
			'limit' => count($termIDs),
			//'hierarchical' => true,
			'include' => $termIDs,
			//'orderby' => 'parent',
			//'order' => 'ASC',
			'hide_empty' => false,
		])
	);
}

/**
 * Undocumented function
 *
 * @param [type] $variable
 * @param boolean $exit
 * @return void
 */
function wa_print($variable, $exit = false) {
	if ( wp_get_current_user()->ID !== 3 ) return;
	if ( $exit ) {
		ob_clean();
	}
	echo sprintf('<pre data-origin="wooptima-debug">%s</pre>', is_array($variable) ? print_r($variable, true) : (string) $variable);
	if ($exit) exit;
}

/**
 * Get summarized post excerpt
 *
 * @return string
 */
function wa_get_summarized_post_excerpt($maxWords = 20) {
	global $post;

	if (!($post instanceof \WP_Post)) {
		return null;
	}

	$excerpt = apply_filters('the_excerpt', $post->post_excerpt);
	
	if ( empty($excerpt) ) {
		$excerpt = wa_get_post_excerpt_from_content();
	}
	
	$excerpt = wp_strip_all_tags($excerpt);
	$excerpt = wp_trim_words($excerpt, $maxWords);

	return $excerpt;
}

/**
 * Get post excerpt from content
 *
 * @return string
 */
function wa_get_post_excerpt_from_content($post = null) {
	if ( ! $post ) {
		global $post;
	}
	
	if (!($post instanceof \WP_Post)) {
		return null;
	}
	
	$excerpt = apply_filters('the_content', $post->post_content);
	$excerpt = wp_strip_all_tags($excerpt);
	$excerpt = wp_trim_words($excerpt, 20);

	return $excerpt;
}

/**
 * Get formatted post date diff
 * in human-readable format
 *
 * @param \WP_Post|null $post
 * @return string
 */
function wa_get_formatted_post_date($post = null) {
	if ( is_null($post) ) {
		global $post;
	}
	
	if ( ! ($post instanceof \WP_Post) ) {
		return null;
	}
	
	$publishedTimestamp = get_the_time('U', $post);
	$currentTimestamp = current_time('timestamp');
	
	// if ( $publishedTimestamp > ($currentTimestamp - MONTH_IN_SECONDS) ) {
	// 	$humanTimeDiff = human_time_diff($publishedTimestamp, $currentTimestamp);
	// 	return sprintf( esc_html__( '%s ago', 'bricks' ), $humanTimeDiff );
	// }
	
	return wp_date('d. F Y', $publishedTimestamp);
}

define('WA_POST_READING_TIME_AVERAGE_WPM', 180);
define('WA_POST_READING_TIME_META_KEY', 'wa_post_reading_time');

/**
 * Calculate average content reading time
 *
 * @param string $content
 * @return int (seconds)
 */
function wa_calculate_content_reading_time($content) {
	$sanitizedContent = wp_strip_all_tags(strip_shortcodes($content));
	$numOfWords = str_word_count($sanitizedContent);
	
	return ceil(($numOfWords / WA_POST_READING_TIME_AVERAGE_WPM)) * MINUTE_IN_SECONDS;
}

/**
 * Get post reading time
 *
 * @param \WP_Post|null $post
 * @return string
 */
function wa_get_formatted_post_reading_time($post = null) {
	if ( is_null($post) ) {
		global $post;
	}
	
	if ( ! ($post instanceof \WP_Post) ) {
		return null;
	}
	
	$readingTime = get_post_meta($post->ID, WA_POST_READING_TIME_META_KEY, true);
	
	if ( empty($readingTime) ) {
		$readingTime = wa_calculate_content_reading_time(get_the_content(null, false, $post->content));
	}
	
	return sprintf('%d min.', $readingTime / MINUTE_IN_SECONDS);
}