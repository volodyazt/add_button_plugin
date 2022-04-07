<?php 
/*
 * Plugin Name: Keitaro Custom Integration
 * Description: Add buttons before headings and in the end of article content
 * Author:      v.v.
 */
require_once dirname(__FILE__) . '/to_db.php';
require_once dirname(__FILE__) . '/btn.php';
register_activation_hook(__FILE__, 'addbtn_install');

//создаем таблицу в бд при активации плагина (если ранее не была создана)

function addbtn_install(){
  global $wpdb;
  
  require_once(ABSPATH.'wp-admin/includes/upgrade.php');

  dbDelta("CREATE TABLE IF NOT EXISTS `{$wpdb -> prefix}addbtn_table` (
    `id` INT(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255),
    `value` VARCHAR(255),
    `value_pages` VARCHAR(255),
    `value_main` VARCHAR(255),
    `value_shortcode` VARCHAR(255),
    UNIQUE KEY id (id)
  ) {$wpdb -> get_charset_collate()};");  

//записываем тестовое значение в токен - при пустом значении имеем ошибку keitaro
  	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'token',
	    'value' => 'c9zmgp1zqqqyn8q76mc5k4s3yv1l1gqy')
	);
}

add_action('admin_menu', 'addbtn_menu');

//добавляем пункт меню в админке Настройки -> Addbtn 
function addbtn_menu() {
  add_options_page('Addbtn Options', 'Addbtn', 8, __FILE__, 'addbtn_options');
}

//получаем значения для формы в админке из бд
function addbtn_options() {
	global $wpdb;
	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'token'" );
	$item = reset($items);
	$db_token = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'refclass'" );
	$item = reset($items);
	$db_refclass = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'reftext'" );
	$item = reset($items);
	$db_reftext = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'reftext_alt'" );
	$item = reset($items);
	$db_reftext_alt = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'multilang'" );
	$item = reset($items);
	$db_amp = $item->value;
	if ($db_amp == 'on') {
		$db_multilang_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'lang_code'" );
	$item = reset($items);
	$db_lang_code = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'reftext_second'" );
	$item = reset($items);
	$db_reftext_second = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'reftext_alt_second'" );
	$item = reset($items);
	$db_reftext_alt_second = $item->value;

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'amp'" );
	$item = reset($items);
	$db_amp = $item->value;
	if ($db_amp == 'on') {
		$db_amp_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'auto_btn'" );
	$item = reset($items);
	$db_auto_btn = $item->value;
	if ($db_auto_btn == 'on') {
		$db_auto_btn_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value FROM wp_addbtn_table WHERE name = 'morebk'" );
	$item = reset($items);
	$db_morebk = $item->value;
	if ($db_morebk == 'on') {
		$db_morebk_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_1xbet'" );
	$db_1xbet_pages = $items;
	$db_1xbet_pages = implode(',', array_column($db_1xbet_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_1xbet_id = $item->value;
	$db_bk_1xbet_shortcode = $item->value_shortcode;
	$db_bk_1xbet_main = $item->value_main;
	if ($db_bk_1xbet_main == 'on') {
		$db_1xbet_main_checked = 'checked';
	}


	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_betway' ORDER BY 'value_pages' DESC" );
	$db_betway_pages = $items;
	$db_betway_pages = implode(',', array_column($db_betway_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_betway_id = $item->value;
	$db_bk_betway_shortcode = $item->value_shortcode;
	$db_bk_betway_main = $item->value_main;
	if ($db_bk_betway_main == 'on') {
		$db_betway_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_22bet' ORDER BY 'value_pages' DESC" );
	$db_22bet_pages = $items;
	$db_22bet_pages = implode(',', array_column($db_22bet_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_22bet_id = $item->value;
	$db_bk_22bet_shortcode = $item->value_shortcode;
	$db_bk_22bet_main = $item->value_main;
	if ($db_bk_22bet_main == 'on') {
		$db_22bet_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_betpt' ORDER BY 'value_pages' DESC" );
	$db_betpt_pages = $items;
	$db_betpt_pages = implode(',', array_column($db_betpt_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_betpt_id = $item->value;
	$db_bk_betpt_shortcode = $item->value_shortcode;
	$db_bk_betpt_main = $item->value_main;
	if ($db_bk_betpt_main == 'on') {
		$db_betpt_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_bet9ja' ORDER BY 'value_pages' DESC" );
	$db_bet9ja_pages = $items;
	$db_bet9ja_pages = implode(',', array_column($db_bet9ja_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_bet9ja_id = $item->value;
	$db_bk_bet9ja_shortcode = $item->value_shortcode;
	$db_bk_bet9ja_main = $item->value_main;
	if ($db_bk_bet9ja_main == 'on') {
		$db_bet9ja_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_betcity' ORDER BY 'value_pages' DESC" );
	$db_betcity_pages = $items;
	$db_betcity_pages = implode(',', array_column($db_betcity_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_betcity_id = $item->value;
	$db_bk_betcity_shortcode = $item->value_shortcode;
	$db_bk_betcity_main = $item->value_main;
	if ($db_bk_betcity_main == 'on') {
		$db_betcity_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_betwinner' ORDER BY 'value_pages' DESC" );
	$db_betwinner_pages = $items;
	$db_betwinner_pages = implode(',', array_column($db_betwinner_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_betwinner_id = $item->value;
	$db_bk_betwinner_shortcode = $item->value_shortcode;
	$db_bk_betwinner_main = $item->value_main;
	if ($db_bk_betwinner_main == 'on') {
		$db_betwinner_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_betyetu' ORDER BY 'value_pages' DESC" );
	$db_betyetu_pages = $items;
	$db_betyetu_pages = implode(',', array_column($db_betyetu_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_betyetu_id = $item->value;
	$db_bk_betyetu_shortcode = $item->value_shortcode;
	$db_bk_betyetu_main = $item->value_main;
	if ($db_bk_betyetu_main == 'on') {
		$db_betyetu_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_betika' ORDER BY 'value_pages' DESC" );
	$db_betika_pages = $items;
	$db_betika_pages = implode(',', array_column($db_betika_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_betika_id = $item->value;
	$db_bk_betika_shortcode = $item->value_shortcode;
	$db_bk_betika_main = $item->value_main;
	if ($db_bk_betika_main == 'on') {
		$db_betika_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_fonbet' ORDER BY 'value_pages' DESC" );
	$db_fonbet_pages = $items;
	$db_fonbet_pages = implode(',', array_column($db_fonbet_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_fonbet_id = $item->value;
	$db_bk_fonbet_shortcode = $item->value_shortcode;
	$db_bk_fonbet_main = $item->value_main;
	if ($db_bk_fonbet_main == 'on') {
		$db_fonbet_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_ligastavok' ORDER BY 'value_pages' DESC" );
	$db_ligastavok_pages = $items;
	$db_ligastavok_pages = implode(',', array_column($db_ligastavok_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_ligastavok_id = $item->value;
	$db_bk_ligastavok_shortcode = $item->value_shortcode;
	$db_bk_ligastavok_main = $item->value_main;
	if ($db_bk_ligastavok_main == 'on') {
		$db_ligastavok_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_marathonbet' ORDER BY 'value_pages' DESC" );
	$db_marathonbet_pages = $items;
	$db_marathonbet_pages = implode(',', array_column($db_marathonbet_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_marathonbet_id = $item->value;
	$db_bk_marathonbet_shortcode = $item->value_shortcode;
	$db_bk_marathonbet_main = $item->value_main;
	if ($db_bk_marathonbet_main == 'on') {
		$db_marathonbet_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_melbet' ORDER BY 'value_pages' DESC" );
	$db_melbet_pages = $items;
	$db_melbet_pages = implode(',', array_column($db_melbet_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_melbet_id = $item->value;
	$db_bk_melbet_shortcode = $item->value_shortcode;
	$db_bk_melbet_main = $item->value_main;
	if ($db_bk_melbet_main == 'on') {
		$db_melbet_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_parimatch' ORDER BY 'value_pages' DESC" );
	$db_parimatch_pages = $items;
	$db_parimatch_pages = implode(',', array_column($db_parimatch_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_parimatch_id = $item->value;
	$db_bk_parimatch_shortcode = $item->value_shortcode;
	$db_bk_parimatch_main = $item->value_main;
	if ($db_bk_parimatch_main == 'on') {
		$db_parimatch_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_wh' ORDER BY 'value_pages' DESC" );
	$db_wh_pages = $items;
	$db_wh_pages = implode(',', array_column($db_wh_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_wh_id = $item->value;
	$db_bk_wh_shortcode = $item->value_shortcode;
	$db_bk_wh_main = $item->value_main;
	if ($db_bk_wh_main == 'on') {
		$db_wh_main_checked = 'checked';
	}

	$items = $wpdb->get_results( "SELECT value, value_pages, value_main, value_shortcode FROM wp_addbtn_table WHERE name = 'bk_winline' ORDER BY 'value_pages' DESC" );
	$db_winline_pages = $items;
	$db_winline_pages = implode(',', array_column($db_winline_pages, 'value_pages'));
	$item = reset($items);
	$db_bk_winline_id = $item->value;
	$db_bk_winline_shortcode = $item->value_shortcode;
	$db_bk_winline_main = $item->value_main;
	if ($db_bk_winline_main == 'on') {
		$db_winline_main_checked = 'checked';
	}

//выводим форму в админке со значениями
  echo '<form action="" method="post" class="addbtn_form">
    <h2>Settings Addbtn plugin</h2>
    <table>
	    <tr>
	    	<td><label for="token">Keitaro token:</label></td>
	    	<td><input type="text" id="token" name="token" value="'. $db_token .'"></td>
	    </tr>

	    <tr>
	    	<td><label for="refclass">Class button (refclass):</label></td>
	    	<td><input type="text" id="refclass" name="refclass" value="'. $db_refclass .'"></td>
	    </tr>

	    <tr>
	    	<td><label for="reftext">Text for button (reftext):</label></td>
	    	<td><input type="text" id="reftext" name="reftext" value="'. $db_reftext .'"></td>
	    </tr>

	    <tr>
	    	<td><label for="reftext_alt">Alternative text for button (reftext_alt):</label></td>
	    	<td><input type="text" id="reftext_alt" name="reftext_alt" value="'. $db_reftext_alt .'"></td>
	    </tr>

	    <tr>
	    	<td><label for="multilang">Multilanguage:</label></td>
	    	<td><input type="hidden" name="multilang" value="off">
	    	<input type="checkbox" id="multilang" name="multilang" '. $db_multilang_checked .'></td>
	    </tr>

	    <tr>
	    	<td><label for="lang_code">Language code. Input code for second language (en_EN, fr_FR):</label></td>
	    	<td><input type="text" id="lang_code" name="lang_code" value="'. $db_lang_code .'"></td>
	    </tr>


	    <tr>
	    	<td><label for="reftext_second">Second language text for button (reftext):</label></td>
	    	<td><input type="text" id="reftext_second" name="reftext_second" value="'. $db_reftext_second .'"></td>
	    </tr>

	    <tr>
	    	<td><label for="reftext_alt_second">Second language alternative text for button (reftext_alt):</label></td>
	    	<td><input type="text" id="reftext_alt_second" name="reftext_alt_second" value="'. $db_reftext_alt_second .'"></td>
	    </tr>

	    <tr>
	    	<td><label for="amp">AMP:</label></td>
	    	<td><input type="hidden" name="amp" value="off">
	    	<input type="checkbox" id="amp" name="amp" '. $db_amp_checked .'></td>
	    </tr>

	    <tr>
	    	<td><label for="auto_btn">Autocreating Button:</label></td>
	    	<td><input type="hidden" name="auto_btn" value="off">
	    	<input type="checkbox" id="auto_btn" name="auto_btn" '. $db_auto_btn_checked .'></td>
	    </tr>
	    <tr>
	    	<td><label for="morebk">MultiBK (more than one bookmaker):</label></td>
	    	<td><input type="hidden" name="morebk" value="off">
	    	<input type="checkbox" id="morebk" name="morebk" '. $db_morebk_checked .'></td>
	    </tr>
    </table>

    <table>
    	<tr>
    		<th>Bookmaker</th>
    		<th>id pages</th>
    		<th>id keitaro</th>
    		<th>Show on the main</th>
    		<th>Shortcode</th>
    	</tr>
    	<tr>
    		<td><label for="bk_1xbet">1xbet:</label></td>
		    <td><input type="hidden" name="bk_1xbet" value="bk_1xbet">
		    <input type="text" id="bk_1xbet" name="bk_1xbet_pages" value="'. $db_1xbet_pages .'"></td>
			<td><input type="text" name="bk_1xbet_id" value="'. $db_bk_1xbet_id .'"></td>
			<td><input type="hidden" name="bk_1xbet_main" value="off">
		    <input type="checkbox" id="bk_1xbet_main" name="bk_1xbet_main" '. $db_1xbet_main_checked .'> </td>
		    <td>'. $db_bk_1xbet_shortcode .'</td>
		</tr>
	    <tr>
	    	<td><label for="bk_betway">Betway:</label></td>
		    <td><input type="hidden" name="bk_betway" value="bk_betway">
		    <input type="text" id="bk_betway" name="bk_betway_pages" value="'. $db_betway_pages  .'"></td>
			<td><input type="text" name="bk_betway_id" value="'. $db_bk_betway_id .'"></td>
			<td><input type="hidden" name="bk_betway_main" value="off">
		    <input type="checkbox" id="bk_betway_main" name="bk_betway_main" '. $db_betway_main_checked .'> </td>
		    <td>'. $db_bk_betway_shortcode .'</td>
		    </tr>
	    <tr>
	    	<td><label for="bk_22bet">22bet:</label></td>
		    <td><input type="hidden" name="bk_22bet" value="bk_22bet">
		    <input type="text" id="bk_22bet" name="bk_22bet_pages" value="'. $db_22bet_pages  .'"></td>
			<td><input type="text" name="bk_22bet_id" value="'. $db_bk_22bet_id .'"></td>
			<td><input type="hidden" name="bk_22bet_main" value="off">
		    <input type="checkbox" id="bk_22bet_main" name="bk_22bet_main" '. $db_22bet_main_checked .'> </td>
		    <td>'. $db_bk_22bet_shortcode .'</td>
		</tr>
	    <tr>
	    	<td><label for="bk_betpt">Bet.pt:</label></td>
		    <td><input type="hidden" name="bk_betpt" value="bk_betpt">
		    <input type="text" id="bk_betpt" name="bk_betpt_pages" value="'. $db_betpt_pages  .'"></td>
			<td><input type="text" name="bk_betpt_id" value="'. $db_bk_betpt_id .'"></td>
			<td><input type="hidden" name="bk_betpt_main" value="off">
		    <input type="checkbox" id="bk_betpt_main" name="bk_betpt_main" '. $db_betpt_main_checked .'> </td>
		    <td>'. $db_bk_betpt_shortcode .'</td>
	    </tr>
	    <tr>
	    	<td><label for="bk_bet9ja">Bet9ja:</label></td>
		    <td><input type="hidden" name="bk_bet9ja" value="bk_bet9ja">
		    <input type="text" id="bk_bet9ja" name="bk_bet9ja_pages" value="'. $db_bet9ja_pages  .'"></td>
			<td><input type="text" name="bk_bet9ja_id" value="'. $db_bk_bet9ja_id .'"></td>
			<td><input type="hidden" name="bk_bet9ja_main" value="off">
		    <input type="checkbox" id="bk_bet9ja_main" name="bk_bet9ja_main" '. $db_bet9ja_main_checked .'> </td>
		    <td>'. $db_bk_bet9ja_shortcode .'</td>
	    </tr>
	    <tr>
	    	<td><label for="bk_betcity">Betcity:</label></td>
		    <td><input type="hidden" name="bk_betcity" value="bk_betcity">
		    <input type="text" id="bk_betcity" name="bk_betcity_pages" value="'. $db_betcity_pages  .'"></td>
			<td><input type="text" name="bk_betcity_id" value="'. $db_bk_betcity_id .'"></td>
			<td><input type="hidden" name="bk_betcity_main" value="off">
		    <input type="checkbox" id="bk_betcity_main" name="bk_betcity_main" '. $db_betcity_main_checked .'> </td>
		    <td>'. $db_bk_betcity_shortcode .'</td>
	    </tr>
	    <tr>
	    	<td><label for="bk_betwinner">Betwinner:</label></td>
		    <td><input type="hidden" name="bk_betwinner" value="bk_betwinner">
		    <input type="text" id="bk_betwinner" name="bk_betwinner_pages" value="'. $db_betwinner_pages  .'"></td>
			<td><input type="text" name="bk_betwinner_id" value="'. $db_bk_betwinner_id .'"></td>
			<td><input type="hidden" name="bk_betwinner_main" value="off">
		    <input type="checkbox" id="bk_betwinner_main" name="bk_betwinner_main" '. $db_betwinner_main_checked .'> </td>
		    <td>'. $db_bk_betwinner_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_betyetu">Betyetu:</label></td>
		    <td><input type="hidden" name="bk_betyetu" value="bk_betyetu">
		    <input type="text" id="bk_betyetu" name="bk_betyetu_pages" value="'. $db_betyetu_pages  .'"></td>
			<td><input type="text" name="bk_betyetu_id" value="'. $db_bk_betyetu_id .'"></td>
			<td><input type="hidden" name="bk_betyetu_main" value="off">
		    <input type="checkbox" id="bk_betyetu_main" name="bk_betyetu_main" '. $db_betyetu_main_checked .'> </td>
		    <td>'. $db_bk_betyetu_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_betika">Betika:</label></td>
		    <td><input type="hidden" name="bk_betika" value="bk_betika">
		    <input type="text" id="bk_betika" name="bk_betika_pages" value="'. $db_betika_pages  .'"></td>
			<td><input type="text" name="bk_betika_id" value="'. $db_bk_betika_id .'"></td>
			<td><input type="hidden" name="bk_betika_main" value="off">
		    <input type="checkbox" id="bk_betika_main" name="bk_betika_main" '. $db_betika_main_checked .'> </td>
		    <td>'. $db_bk_betika_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_fonbet">Fonbet:</label></td>
		    <td><input type="hidden" name="bk_fonbet" value="bk_fonbet">
		    <input type="text" id="bk_fonbet" name="bk_fonbet_pages" value="'. $db_fonbet_pages  .'"></td>
			<td><input type="text" name="bk_fonbet_id" value="'. $db_bk_fonbet_id .'"></td>
			<td><input type="hidden" name="bk_fonbet_main" value="off">
		    <input type="checkbox" id="bk_fonbet_main" name="bk_fonbet_main" '. $db_fonbet_main_checked .'> </td>
		    <td>'. $db_bk_fonbet_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_ligastavok">Ligastavok:</label></td>
		    <td><input type="hidden" name="bk_ligastavok" value="bk_ligastavok">
		    <input type="text" id="bk_ligastavok" name="bk_ligastavok_pages" value="'. $db_ligastavok_pages  .'"></td>
			<td><input type="text" name="bk_ligastavok_id" value="'. $db_bk_ligastavok_id .'"></td>
			<td><input type="hidden" name="bk_ligastavok_main" value="off">
		    <input type="checkbox" id="bk_ligastavok_main" name="bk_ligastavok_main" '. $db_ligastavok_main_checked .'> </td>
		    <td>'. $db_bk_ligastavok_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_marathonbet">Marathonbet:</label></td>
		    <td><input type="hidden" name="bk_marathonbet" value="bk_marathonbet">
		    <input type="text" id="bk_marathonbet" name="bk_marathonbet_pages" value="'. $db_marathonbet_pages  .'"></td>
			<td><input type="text" name="bk_marathonbet_id" value="'. $db_bk_marathonbet_id .'"></td>
			<td><input type="hidden" name="bk_marathonbet_main" value="off">
		    <input type="checkbox" id="bk_marathonbet_main" name="bk_marathonbet_main" '. $db_marathonbet_main_checked .'> </td>
		    <td>'. $db_bk_marathonbet_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_melbet">Melbet:</label></td>
		    <td><input type="hidden" name="bk_melbet" value="bk_melbet">
		    <input type="text" id="bk_melbet" name="bk_melbet_pages" value="'. $db_melbet_pages  .'"></td>
			<td><input type="text" name="bk_melbet_id" value="'. $db_bk_melbet_id .'"></td>
			<td><input type="hidden" name="bk_melbet_main" value="off">
		    <input type="checkbox" id="bk_melbet_main" name="bk_melbet_main" '. $db_melbet_main_checked .'> </td>
		    <td>'. $db_bk_melbet_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_parimatch">Parimatch:</label></td>
		    <td><input type="hidden" name="bk_parimatch" value="bk_parimatch">
		    <input type="text" id="bk_parimatch" name="bk_parimatch_pages" value="'. $db_parimatch_pages  .'"></td>
			<td><input type="text" name="bk_parimatch_id" value="'. $db_bk_parimatch_id .'"></td>
			<td><input type="hidden" name="bk_parimatch_main" value="off">
		    <input type="checkbox" id="bk_parimatch_main" name="bk_parimatch_main" '. $db_parimatch_main_checked .'> </td>
		    <td>'. $db_bk_parimatch_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_wh">William Hill:</label></td>
		    <td><input type="hidden" name="bk_wh" value="bk_wh">
		    <input type="text" id="bk_wh" name="bk_wh_pages" value="'. $db_wh_pages  .'"></td>
			<td><input type="text" name="bk_wh_id" value="'. $db_bk_wh_id .'"></td>
			<td><input type="hidden" name="bk_wh_main" value="off">
		    <input type="checkbox" id="bk_wh_main" name="bk_wh_main" '. $db_wh_main_checked .'> </td>
		    <td>'. $db_bk_wh_shortcode .'</td>
	    </tr>
		<tr>
	    	<td><label for="bk_winline">Winline:</label></td>
		    <td><input type="hidden" name="bk_winline" value="bk_winline">
		    <input type="text" id="bk_winline" name="bk_winline_pages" value="'. $db_winline_pages  .'"></td>
			<td><input type="text" name="bk_winline_id" value="'. $db_bk_winline_id .'"></td>
			<td><input type="hidden" name="bk_winline_main" value="off">
		    <input type="checkbox" id="bk_winline_main" name="bk_winline_main" '. $db_winline_main_checked .'> </td>
		    <td>'. $db_bk_winline_shortcode .'</td>
	    </tr>

  		<tr>
  			<td><input type="submit" value="Send"></td>
  		</tr>
  	</table>	
 </form>';
}

// css стили для страницы в админке
function admin_css() {
	 global $refclass;
	echo '<style>
			.addbtn_form table td:first-child {
			font-weight: 600;
		}
		.addbtn_form table td {
			padding: 5px 10px;
		}
		.addbtn_form table td:nth-child(4) {
			text-align: center;
		}
		.addbtn_form table {
			margin-bottom: 25px;
		}
		</style>
	';
}
admin_css();

?>