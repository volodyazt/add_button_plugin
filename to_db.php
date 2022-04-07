<?php 
//присваиваем полученные из формы значения переменным
if (!empty($_POST)) {
$token = $_POST['token'];
$refclass = $_POST['refclass'];
$reftext = $_POST['reftext'];
$reftext_alt = $_POST['reftext_alt'];
$reftext_second = $_POST['reftext_second'];
$reftext_alt_second = $_POST['reftext_alt_second'];
$amp = $_POST['multilang'];
$amp = $_POST['lang_code'];
$amp = $_POST['amp'];
$auto_btn = $_POST['auto_btn'];
$bk_1xbet = $_POST['bk_1xbet'];
$bk_1xbet_pages = $_POST['bk_1xbet_pages'];
$bk_1xbet_id = $_POST['bk_1xbet_id'];
$bk_betway = $_POST['bk_betway'];
$bk_betway_pages = $_POST['bk_betway_pages'];
$bk_betway_id = $_POST['bk_betway_id'];
}

global $wpdb;

// записываем значения из формы в бд
function write_db_token() {
  $db_wr = $_POST['token'];
global $wpdb;
$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'token'" );
$item = reset($items);
$db = $item->name;

	if ($db == 'token') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'token', 'value' => $db_wr ),
		array( 'name' => 'token' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'token',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['token'])) {
  write_db_token();
}

function write_db_refclass() {
  $db_wr = $_POST['refclass'];
global $wpdb;
$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'refclass'" );
$item = reset($items);
$db = $item->name;

	if ($db == 'refclass') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'refclass', 'value' => $db_wr ),
		array( 'name' => 'refclass' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'refclass',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['refclass'])) {
  write_db_refclass();
}

function write_db_reftext() {
  $db_wr = $_POST['reftext'];
global $wpdb;
$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'reftext'" );
$item = reset($items);
$db = $item->name;

	if ($db == 'reftext') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'reftext', 'value' => $db_wr ),
		array( 'name' => 'reftext' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'reftext',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['reftext'])) {
  write_db_reftext();
}

function write_db_reftext_alt() {
	$db_wr = $_POST['reftext_alt'];
	global $wpdb;
	$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'reftext_alt'" );
	$item = reset($items);
	$db = $item->name;

	if ($db == 'reftext_alt') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'reftext_alt', 'value' => $db_wr ),
		array( 'name' => 'reftext_alt' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'reftext_alt',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['reftext_alt'])) {
  write_db_reftext_alt();
}

function write_db_multilang() {
	$db_wr = $_POST['multilang'];
	if ($db_wr == "off") {
		$db_wr = 'off';
	} else {
		$db_wr = 'on';
	}

	global $wpdb;
	$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'multilang'" );
	$item = reset($items);
	$db = $item->name;

	if ($db == 'multilang') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'multilang', 'value' => $db_wr ),
		array( 'name' => 'multilang' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'multilang',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['multilang']) ) {
    write_db_multilang();
}

function write_db_lang_code() {
	$db_wr = $_POST['lang_code'];
	global $wpdb;
	$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'lang_code'" );
	$item = reset($items);
	$db = $item->name;

	if ($db == 'lang_code') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'lang_code', 'value' => $db_wr ),
		array( 'name' => 'lang_code' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'lang_code',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['lang_code'])) {
  write_db_lang_code();
}

function write_db_reftext_second() {
  $db_wr = $_POST['reftext_second'];
global $wpdb;
$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'reftext_second'" );
$item = reset($items);
$db = $item->name;

	if ($db == 'reftext_second') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'reftext_second', 'value' => $db_wr ),
		array( 'name' => 'reftext_second' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'reftext_second',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['reftext_second'])) {
  write_db_reftext_second();
}

function write_db_reftext_alt_second() {
  $db_wr = $_POST['reftext_alt_second'];
global $wpdb;
$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'reftext_alt_second'" );
$item = reset($items);
$db = $item->name;

	if ($db == 'reftext_alt_second') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'reftext_alt_second', 'value' => $db_wr ),
		array( 'name' => 'reftext_alt_second' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'reftext_alt_second',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['reftext_alt_second'])) {
  write_db_reftext_alt_second();
}

function write_db_amp() {
	$db_wr = $_POST['amp'];
	if ($db_wr == "off") {
		$db_wr = 'off';
	} else {
		$db_wr = 'on';
	}

	global $wpdb;
	$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'amp'" );
	$item = reset($items);
	$db = $item->name;

	if ($db == 'amp') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'amp', 'value' => $db_wr ),
		array( 'name' => 'amp' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'amp',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['amp']) ) {
    write_db_amp();
}

function write_db_auto_btn() {
	$db_wr = $_POST['auto_btn'];
	if ($db_wr == "off") {
		$db_wr = 'off';
	} else {
		$db_wr = 'on';
	}

	global $wpdb;
	$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'auto_btn'" );
	$item = reset($items);
	$db = $item->name;

	if ($db == 'auto_btn') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'auto_btn', 'value' => $db_wr ),
		array( 'name' => 'auto_btn' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'auto_btn',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['auto_btn'])) {
  write_db_auto_btn();
}


function write_db_morebk() {
	$db_wr = $_POST['morebk'];
	if ($db_wr == "off") {
		$db_wr = 'off';
	} else {
		$db_wr = 'on';
	}

	global $wpdb;
	$items = $wpdb->get_results( "SELECT name FROM wp_addbtn_table WHERE name = 'morebk'" );
	$item = reset($items);
	$db = $item->name;

	if ($db == 'morebk') {
		$wpdb->update( 'wp_addbtn_table',
		array( 'name' => 'morebk', 'value' => $db_wr ),
		array( 'name' => 'morebk' )
	);
	} else {

	$wpdb->insert('wp_addbtn_table', array(
	    'name' => 'morebk',
	    'value' => $db_wr)
	);
	}
}
if (isset($_POST['morebk'])) {
  write_db_morebk();
}


function write_db_bk_1xbet() {
	$db_wr = $_POST['bk_1xbet'];
	$db_wr_id = $_POST['bk_1xbet_id'];
	$db_wr_pages = $_POST['bk_1xbet_pages'];
	$db_wr_main = $_POST['bk_1xbet_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;
	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_1xbet',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_1xbet]'));
  }

}

if (isset($_POST['bk_1xbet'])) {
  write_db_bk_1xbet();
}

function write_db_bk_betway() {
	$db_wr = $_POST['bk_betway'];
	$db_wr_id = $_POST['bk_betway_id'];
	$db_wr_pages = $_POST['bk_betway_pages'];
	$db_wr_main = $_POST['bk_betway_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_betway',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_betway]'));
  }

}

if (isset($_POST['bk_betway'])) {
  write_db_bk_betway();
}

function write_db_bk_22bet() {
	$db_wr = $_POST['bk_22bet'];
	$db_wr_id = $_POST['bk_22bet_id'];
	$db_wr_pages = $_POST['bk_22bet_pages'];
	$db_wr_main = $_POST['bk_22bet_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_22bet',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_22bet]'));
  }

}

if (isset($_POST['bk_22bet'])) {
  write_db_bk_22bet();
}

function write_db_bk_betpt() {
	$db_wr = $_POST['bk_betpt'];
	$db_wr_id = $_POST['bk_betpt_id'];
	$db_wr_pages = $_POST['bk_betpt_pages'];
	$db_wr_main = $_POST['bk_betpt_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_betpt',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_betpt]'));
  }

}

if (isset($_POST['bk_betpt'])) {
  write_db_bk_betpt();
}

function write_db_bk_bet9ja() {
	$db_wr = $_POST['bk_bet9ja'];
	$db_wr_id = $_POST['bk_bet9ja_id'];
	$db_wr_pages = $_POST['bk_bet9ja_pages'];
	$db_wr_main = $_POST['bk_bet9ja_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_bet9ja',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_bet9ja]'));
  }

}

if (isset($_POST['bk_bet9ja'])) {
  write_db_bk_bet9ja();
}

function write_db_bk_betcity() {
	$db_wr = $_POST['bk_betcity'];
	$db_wr_id = $_POST['bk_betcity_id'];
	$db_wr_pages = $_POST['bk_betcity_pages'];
	$db_wr_main = $_POST['bk_betcity_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_betcity',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_betcity]'));
  }

}

if (isset($_POST['bk_betcity'])) {
  write_db_bk_betcity();
}

function write_db_bk_betwinner() {
	$db_wr = $_POST['bk_betwinner'];
	$db_wr_id = $_POST['bk_betwinner_id'];
	$db_wr_pages = $_POST['bk_betwinner_pages'];
	$db_wr_main = $_POST['bk_betwinner_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_betwinner',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_betwinner]'));
  }

}

if (isset($_POST['bk_betwinner'])) {
  write_db_bk_betwinner();
}

function write_db_bk_betyetu() {
	$db_wr = $_POST['bk_betyetu'];
	$db_wr_id = $_POST['bk_betyetu_id'];
	$db_wr_pages = $_POST['bk_betyetu_pages'];
	$db_wr_main = $_POST['bk_betyetu_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_betyetu',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_betyetu]'));
  }

}

if (isset($_POST['bk_betyetu'])) {
  write_db_bk_betyetu();
}

function write_db_bk_betika() {
	$db_wr = $_POST['bk_betika'];
	$db_wr_id = $_POST['bk_betika_id'];
	$db_wr_pages = $_POST['bk_betika_pages'];
	$db_wr_main = $_POST['bk_betika_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_betika',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_betika]'));
  }

}

if (isset($_POST['bk_betika'])) {
  write_db_bk_betika();
}

function write_db_bk_fonbet() {
	$db_wr = $_POST['bk_fonbet'];
	$db_wr_id = $_POST['bk_fonbet_id'];
	$db_wr_pages = $_POST['bk_fonbet_pages'];
	$db_wr_main = $_POST['bk_fonbet_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_fonbet',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_fonbet]'));
  }

}

if (isset($_POST['bk_fonbet'])) {
  write_db_bk_fonbet();
}

function write_db_bk_ligastavok() {
	$db_wr = $_POST['bk_ligastavok'];
	$db_wr_id = $_POST['bk_ligastavok_id'];
	$db_wr_pages = $_POST['bk_ligastavok_pages'];
	$db_wr_main = $_POST['bk_ligastavok_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_ligastavok',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_ligastavok]'));
  }

}

if (isset($_POST['bk_ligastavok'])) {
  write_db_bk_ligastavok();
}

function write_db_bk_marathonbet() {
	$db_wr = $_POST['bk_marathonbet'];
	$db_wr_id = $_POST['bk_marathonbet_id'];
	$db_wr_pages = $_POST['bk_marathonbet_pages'];
	$db_wr_main = $_POST['bk_marathonbet_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_marathonbet',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_marathonbet]'));
  }

}

if (isset($_POST['bk_marathonbet'])) {
  write_db_bk_marathonbet();
}

function write_db_bk_melbet() {
	$db_wr = $_POST['bk_melbet'];
	$db_wr_id = $_POST['bk_melbet_id'];
	$db_wr_pages = $_POST['bk_melbet_pages'];
	$db_wr_main = $_POST['bk_melbet_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_melbet',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_melbet]'));
  }

}

if (isset($_POST['bk_melbet'])) {
  write_db_bk_melbet();
}

function write_db_bk_parimatch() {
	$db_wr = $_POST['bk_parimatch'];
	$db_wr_id = $_POST['bk_parimatch_id'];
	$db_wr_pages = $_POST['bk_parimatch_pages'];
	$db_wr_main = $_POST['bk_parimatch_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_parimatch',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_parimatch]'));
  }

}

if (isset($_POST['bk_parimatch'])) {
  write_db_bk_parimatch();
}

function write_db_bk_wh() {
	$db_wr = $_POST['bk_wh'];
	$db_wr_id = $_POST['bk_wh_id'];
	$db_wr_pages = $_POST['bk_wh_pages'];
	$db_wr_main = $_POST['bk_wh_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_wh',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_wh]'));
  }

}

if (isset($_POST['bk_wh'])) {
  write_db_bk_wh();
}

function write_db_bk_winline() {
	$db_wr = $_POST['bk_winline'];
	$db_wr_id = $_POST['bk_winline_id'];
	$db_wr_pages = $_POST['bk_winline_pages'];
	$db_wr_main = $_POST['bk_winline_main'];
	if ($db_wr_main == "off") {
		$db_wr_main = 'off';
	} else {
		$db_wr_main = 'on';
	}
	global $wpdb;

	$wpdb->delete( 'wp_addbtn_table', array( 'name' => $db_wr ) );

	$lines = explode(",", $db_wr_pages);
	foreach ($lines as $page_number) {
      $wpdb->insert('wp_addbtn_table', array('name' => 'bk_winline',
			'value' => $db_wr_id,   
			'value_pages' => $page_number, 
			'value_main' => $db_wr_main,
			'value_shortcode' => '[ref_winline]'));
  }

}

if (isset($_POST['bk_winline'])) {
  write_db_bk_winline();
}

?>

