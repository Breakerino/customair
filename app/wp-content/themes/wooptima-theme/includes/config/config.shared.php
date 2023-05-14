<?php

/**
 * ----------------------------------------------------------------------------------------
 * Configuration
 * ----------------------------------------------------------------------------------------
 * @enviroment		production
 * @version				1.0.0
 * @updated 			19/12/2022
 * @textdomain		wooptima-theme
 * ----------------------------------------------------------------------------------------
 */

defined('ABSPATH') || exit;

/**
 * ----------------------------------------------------------------------------------------
 * General
 * ----------------------------------------------------------------------------------------
 */
define('WA_PRODUCT_CATEGORY_TAXONOMY', 'product_cat');
define('WA_PURCHASED_PRODUCTS_GRID_ID', 1);

define('WA_ORDER_COMPANY_DETAILS_META_MAP', [
	'billing_company' => 'company_name',
	'billing_company_wi_id' => 'company_id',
	'billing_company_wi_vat' => 'company_vat_id',
	'billing_company_wi_tax' => 'company_tax_id'
]);

/**
 * Wooptima | Delivery date offset rules
 */
define('WA_DELIVERY_DATE_RULES', [
	[
		'days' => [0, 1, 2, 6], // po,ut,st
		'offset' => 2 // st, st, pia, ne
	],
	[
		'days' => [3, 4], // stv, pia
		'offset' => 4 // po, ut
	],
	[
		'days' => [5], // so
		'offset' => 3 // ut
	]
]);