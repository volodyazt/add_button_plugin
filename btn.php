<?php 
	global $wpdb;

	//получаем значения из бд
	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'token'" );
	$item = reset($items);
	$db_token = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'refclass'" );
	$item = reset($items);
	$refclass = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'reftext'" );
	$item = reset($items);
	$reftext = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'reftext_alt'" );
	$item = reset($items);
	$reftext_alt = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'reftext_second'" );
	$item = reset($items);
	$reftext_second = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'reftext_alt_second'" );
	$item = reset($items);
	$reftext_alt_second = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'multilang'" );
	$item = reset($items);
	$multilang = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'lang_code'" );
	$item = reset($items);
	$lang_code = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'auto_btn'" );
	$item = reset($items);
	$auto_btn = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'amp'" );
	$item = reset($items);
	$amp = $item->value;


require_once dirname(__FILE__) . '/kclient.php';
$client = new KClient('https://littlelnk.com/api.php?', $db_token);
global $client;
//echo $client->getOffer();

//устранение ошибки keitaro при активации плагина
include_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( is_plugin_active( 'addbtn/addbtn.php' ) ) {
$reflink = $client->getOffer();
}

$reftext = __($reftext);
if (empty($reftext_alt)) {
	$reftext_alt = $reftext;
} else {
	$reftext_alt = __($reftext_alt);
}
$refclass = $refclass;

// текст кнопок для двуязычных сайтов	
if ($multilang == 'on') {
	if (get_locale() == $lang_code) {
		$reftext = __($reftext_second);
		if (empty($reftext_alt)) {
			$reftext_alt = $reftext;
		} else {
			$reftext_alt = __($reftext_alt_second);
		}
	}
}

//определение реффссылки в зависимости от id страницы
function def_page(){
	global $wpdb;
	global $client;
	// определяем или включена поддержка сайтов с несколькими бк
	$items = $wpdb->get_results( "SELECT name, value FROM wp_addbtn_table WHERE name = 'morebk'" );
	$item = reset($items);
	$morebk_check = $item->value;
	if($morebk_check =='off') {
		$reflink = $client->getOffer();
        return $reflink;
	} else {	
		$url_btn = $_SERVER['REQUEST_URI'];
		$postid_btn = url_to_postid($url_btn);		

	    if (is_front_page() || is_home()) {
	    	$items = $wpdb->get_results( "SELECT name, value, value_pages FROM wp_addbtn_table WHERE value_main = 'on'" );
	    	$item = reset($items);
	    	$bk_main = $item->name;
	    	$link_main = $item->value;
		        $reflink = $client->getOffer(array('offer_id' => $link_main), '#');
		        return $reflink;
	    } else {		
			$items = $wpdb->get_results( "SELECT name, value FROM wp_addbtn_table WHERE value_pages = $postid_btn" );
			$item = reset($items);
			$bk_name = $item->name;
			$bk_id = $item->value;
			$reflink = $client->getOffer(array('offer_id' => $bk_id), '#');
			return $reflink;
		}
	}
}
add_filter('wp_head', 'def_page');

function end_of_content($content)
{
    global $reftext;
    global $refclass;
    global $reflink;
    global $country;

    $content.= '<a href="'. def_page() . '"  class="'. $refclass.'" rel="nofollow">'. $reftext . '</a>';
	return $content;
}


function between_headings($text)
{
    global $reftext, $reftext_alt;
    global $refclass;
    global $reflink;

		$refbutton = '<a href="' . def_page() . '" class="' . $refclass . '" rel="nofollow">' . $reftext . '</a>';
        $refbutton_alt = '<a href="' . def_page() . '" class="' . $refclass . '" rel="nofollow">' . $reftext_alt . '</a>';
        $replace = array(
            '<h2>' => $refbutton . '<h2>',
            '<h3>' => $refbutton_alt . '<h3>',

        );
        $text = str_replace(array_keys($replace) , $replace, $text);
        return $text;
}
//для вывода на сайте, нужно добавить do_action(add_btn); в нужнном месте шаблона
function header_btn() {
    global $reftext;
    global $refclass;
    global $reflink;

	echo '<a href="'. def_page() . '" class="'. $refclass.'" rel="nofollow">'. $reftext . '</a>';
} 

function amp_button() {
    global $reftext;
    global $refclass;
    global $reflink;

	echo '<a href="'. def_cat() . '" class="'. $refclass.'" rel="nofollow">'. $reftext . '</a>';
}

//включение функций добавления кнопок только при включенном из админки режиме авторасстановки кнопок
if ($auto_btn == 'on') {
	add_action('add_btn', 'header_btn' );
	add_filter('the_content', 'end_of_content', 0);
	add_filter('the_content', 'between_headings');
}
if ($amp == 'on') {
	add_action('ampforwp_after_header','amp_button');
}

//стили кнопок
function adbtn_css() {
	 global $refclass;
	echo '<style>
	.'.$refclass. '{
		font-size: 24px;
		box-shadow: inset 0 -2px 12px 0px rgba(0,0,0,.2);
		display: block;
		transition: .5s;
		max-width: 540px;
		text-decoration: none;
		margin: 35px auto;
		width: 100%;
		text-transform: uppercase;
		border-radius:14px;
		text-align: center;
		padding: 17px 23px;
		color: #fff;
		background-color: rgb(18, 181, 40);
	}
	.'.$refclass.':hover{
		color: #fff;
		transform: scale(0.95); 
	}
	</style>
	';
}

add_action( 'wp_head', 'adbtn_css' );

//регистрация шорткодов для всех бк (отдает только url ссылки)
function reflink_1xbet()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_1xbet'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $shortcode_id;
		return $reflink;
}
add_shortcode('ref_1xbet', 'reflink_1xbet');

function reflink_betway()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_betway'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_betway', 'reflink_betway');

function reflink_22bet()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_22bet'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_22bet', 'reflink_22bet');

function reflink_betpt()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_betpt'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_betpt', 'reflink_betpt');

function reflink_bet9ja()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_bet9ja'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_bet9ja', 'reflink_bet9ja');

function reflink_betcity()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_betcity'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_betcity', 'reflink_betcity');

function reflink_betwinner()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_betwinner'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_betwinner', 'reflink_betwinner');

function reflink_betyetu()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_betyetu'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_betyetu', 'reflink_betyetu');

function reflink_betika()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_betika'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_betika', 'reflink_betika');

function reflink_fonbet()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_fonbet'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_fonbet', 'reflink_fonbet');

function reflink_ligastavok()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_ligastavok'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_ligastavok', 'reflink_ligastavok');

function reflink_marathonbet()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_marathonbet'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_marathonbet', 'reflink_marathonbet');

function reflink_melbet()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_melbet'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_melbet', 'reflink_melbet');

function reflink_parimatch()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_parimatch'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_parimatch', 'reflink_parimatch');

function reflink_wh()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_wh'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_wh', 'reflink_wh');

function reflink_winline()
{
	global $wpdb;
	global $client;
    $items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'bk_winline'" );
		$item = reset($items);
		$shortcode_id = $item->value;
		$reflink = $client->getOffer(array('offer_id' => $shortcode_id), '#');
		return $reflink;
}
add_shortcode('ref_winline', 'reflink_winline');


?>