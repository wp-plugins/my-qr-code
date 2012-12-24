<?php

$myPluginName = $pluginname;
define('QRgen_Url', WP_CONTENT_URL . '/plugins/' . plugin_basename(dirname(__FILE__)) . '/');
define('QRgen_Dir', WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)) . '/');
register_activation_hook(__FILE__, 'QR_wpCreatetable');
add_filter('mce_external_plugins', "QR_wpTinyregister");
add_filter('mce_buttons', 'QR_wpTinybutton', 0);

if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
	QR_wpCreatetable();
}

function QR_wpCreatetable() {
	global $wpdb;
	$qrTablename = $wpdb->prefix . "qr_tagdata";
	$sql = "DROP TABLE IF EXISTS `" . $qrTablename . "`";
	$wpdb->query($sql);
	$sql = "CREATE TABLE " . $qrTablename . " (
              qr_id INT NOT NUll AUTO_INCREMENT,
              qr_tagname VARCHAR(500),
              qr_action VARCHAR(300),
              qr_tagdata LONGTEXT,
              qr_image VARCHAR(300),
			  qr_align VARCHAR(300),
              primary key(qr_id)
          );";
	$wpdb->query($sql);
}

if ($checkConfirmationKey) {
	if (get_option("Qr_pluginStatus") == $confirmationkey) {
		add_action("admin_menu", "QR_wpMenu");
	} else {
		add_action("admin_menu", "QR_wpMailmenu");
	}
} else {
	add_action("admin_menu", "QR_wpMenu");
}

function QR_wpMenu() {
	global $myPluginName;
	add_menu_page(__($myPluginName), __($myPluginName), "edit_themes", "qrnewtag", "QR_wpNewtag", "");
	add_submenu_page("qrnewtag", __("New Tag"), __("New Tag"), "edit_themes", "qrnewtag", "QR_wpNewtag");
	add_submenu_page("qrnewtag", __("Tags"), __("Tags"), "edit_themes", "qrtaglist", "QR_wpTaglist");
	wp_enqueue_script("qrScript", QRgen_Url . "Js/qrscript.js");
	wp_enqueue_style("qrStyle", QRgen_Url . "css/qrstyle.css");
}

function QR_wpMailmenu() {
	global $myPluginName;
	add_menu_page(__($myPluginName), __($myPluginName), "edit_themes", "qrnewtag", "QR_wpMail", "");
	add_submenu_page("qrnewtag", __("New Tag"), __("New Tag"), "edit_themes", "qrnewtag", "QR_wpMail");
	add_submenu_page("qrnewtag", __("Tags"), __("Tags"), "edit_themes", "qrtaglist", "QR_wpMail");
	wp_enqueue_style("qrStyle", QRgen_Url . "css/qrstyle.css");
}

function QR_wpMail() {
	global $confirmationkey, $Form_code;
	if (isset($_POST["vi_submit"]) && $_POST["vi_submit"] == "Install") {
		if ($confirmationkey != md5($_POST["vi_install_Key"])) {
			$message = "Confirmation Key Invalid";
		} else {
			if (!get_option("Qr_pluginStatus"))
				add_option("Qr_pluginStatus", md5($_POST["vi_install_Key"]));
			else
				update_option("Qr_pluginStatus", md5($_POST["vi_install_Key"]));
			echo "<SCRIPT language=JavaScript>window.location='admin.php?page=qrnewtag'</SCRIPT>";
		}
	}
	include("Qrmail.php");
}

function QR_wpOptionvalue($value) {
	$data = "";
	switch ($value) {
		case 'site':
			$data = $_POST['txt_site'];
			break;
		case 'bkm':
			$data = 'MEBKM:TITLE:' . $_POST['txt_sitetitle'] . ';URL:' . $_POST['txt_site'];
			break;
		case 'call':
			$data = 'TEL:' . $_POST['txt_phone'];
			break;
		case 'sms':
			$data = 'SMSTO:' . $_POST['txt_phone'] . ':' . $_POST['txt_smsbody'];
			break;
		case 'mail':
			$data = 'SMTP:' . $_POST['txt_mailre'] . ':' . $_POST['txt_mailsub'] . ':' . $_POST['txt_smsbody'];
			break;
		case 'vcard':
			$data = "BEGIN:VCARD \r";
			$data.="VERSION:" . $_POST['rd_version'] . "\r";
			$data.="N:" . $_POST['txt_lname'] . ";" . $_POST['txt_fname'] . ";" . $_POST['txt_mname'] . ";;\r";
			if ($_POST['rd_vtype'] == 'C') {
				$data.="ORG:" . $_POST['txt_org'] . ";\r";
				$data.="FN:" . $_POST['txt_org'] . "\r";
				$data.="X-ABShowAs:COMPANY \r";
				$data.="TITLE:" . $_POST['txt_vtitle'] . "\r";
				$data.="EMAIL;type=INTERNET;type=WORK:" . $_POST['txt_vemail'] . "\r";
				$data.="TEL;type=CELL:" . $_POST['txt_mphone'] . "\r";
				$data.="TEL;type=WORK:" . $_POST['txt_wphone'] . "\r";
				$data.="TEL;type=HOME:" . $_POST['txt_hphone'] . "\r";
				$data.="ADR;type=WORK:;;" . $_POST['txt_wstreet'] . ";" . $_POST['txt_wcity'] . ";" . $_POST['txt_wstate'] . ";" . $_POST['txt_wzip'] . ";" . $_POST['txt_wcountry'] . "\r";
				$data.="ADR;type=HOME:;;" . $_POST['txt_hstreet'] . ";" . $_POST['txt_hcity'] . ";" . $_POST['txt_hstate'] . ";" . $_POST['txt_hzip'] . ";" . $_POST['txt_hcountry'] . "\r";
				$data.="BDAY;value=date:" . $_POST['sel_year'] . "-" . $_POST['sel_month'] . "-" . $_POST['sel_date'] . "\r";
				$data.="URL;type=WORK:" . $_POST['txt_workweb'] . "\r";
				$data.="URL;type=HOME:" . $_POST['txt_homeweb'] . "\r";
			} else {

				$data.="FN:" . $_POST['txt_fname'] . " " . $_POST['txt_mname'] . " " . $_POST['txt_lname'] . "\r";
				$data.="ORG:" . $_POST['txt_org'] . ";\r";
				$data.="TITLE:" . $_POST['txt_vtitle'] . "\r";
				$data.="EMAIL;INTERNET;WORK:" . $_POST['txt_vemail'] . "\r";
				$data.="TEL;CELL:" . $_POST['txt_mphone'] . "\r";
				$data.="TEL;WORK:" . $_POST['txt_wphone'] . "\r";
				$data.="TEL;HOME:" . $_POST['txt_hphone'] . "\r";
				$data.="ADR;WORK:;;" . $_POST['txt_wstreet'] . ";" . $_POST['txt_wcity'] . ";" . $_POST['txt_wstate'] . ";" . $_POST['txt_wzip'] . ";" . $_POST['txt_wcountry'] . "\r";
				$data.="ADR;HOME:;;" . $_POST['txt_hstreet'] . ";" . $_POST['txt_hcity'] . ";" . $_POST['txt_hstate'] . ";" . $_POST['txt_hzip'] . ";" . $_POST['txt_hcountry'] . "\r";
				$data.="BDAY;value=date:" . $_POST['sel_year'] . "-" . $_POST['sel_month'] . "-" . $_POST['sel_date'] . "\r";
				$data.="URL;WORK:" . $_POST['txt_workweb'] . "\r";
				$data.="URL;HOME:" . $_POST['txt_homeweb'] . "\r";
			}
			$data.='END:VCARD';
			break;
		case 'mecard':
			$data = 'MECARD:N:' . $_POST['txt_fname'] . ',' . $_POST['txt_lname'] . ';';
			$data.='TEL:' . $_POST['txt_mphone'] . ';TEL-AV:' . $_POST['txt_videocall'] . ';';
			$data.='EMAIL:' . $_POST['txt_vemail'] . ';URL:' . $_POST['txt_mweb'] . ';';
			$data.='BDAY:' . $_POST['sel_year'] . $_POST['sel_month'] . $_POST['sel_date'] . ';';
			$data.='BDAY:' . $_POST['sel_year'] . $_POST['sel_month'] . $_POST['sel_date'] . ';';
			$data.='ADR:,,' . $_POST['txt_hstreet'] . ',' . $_POST['txt_hcity'] . ',' . $_POST['txt_hstate'] . ',' . $_POST['txt_hzip'] . ',' . $_POST['txt_hcountry'] . ';;';
			break;
		case 'vevent':
			$data = "BEGIN:VEVENT \r";
			$data.="SUMMARY:" . $_POST['txt_eventsum'] . "\r";
			$data.="DESCRIPTION:" . $_POST['txt_eventdes'] . "\r";
			$data.="LOCATION:" . $_POST['txt_eventloc'] . "\r";
			if ($_POST['rd_eventday'] == 'yes') {
				$data.='DTSTART:' . $_POST['sel_syear'] . $_POST['sel_smonth'] . $_POST['sel_sdate'] . 'T' . $_POST['sel_shour'] . $_POST['sel_smin'] . '00';
			} else {
				$data.='DTSTART:' . $_POST['sel_syear'] . $_POST['sel_smonth'] . $_POST['sel_sdate'];
			}
			$data.="\rEND:VEVENT";
			break;
		case 'youtube':
			$data = 'youtube://' . $_POST['txt_youid'];
			break;
		case 'tweet':
			$data = 'http://twitter.com/home?status=' . $_POST['txt_twitext'];
			break;
		case 'bbm':
			$data = 'bbm:' . $_POST['txt_bbmpin'] . $_POST['txt_fname'] . ' ' . $_POST['txt_lname'];
			break;
		case 'wifi':
			$data = 'WIFI:S:' . $_POST['txt_ssid'] . ';T' . $_POST['sel_nettype'] . ';P' . $_POST['txt_wpsw'];
			break;
		case 'text':
			$data = $_POST['txt_ftext'];
			break;
	}
	return $data;
}

function QR_wpNewtag() {
	global $wpdb;
	$tagname = "";
	$tagaction = "";
	$newtagdata = "";
	include_once 'QRInclude.php';
	$QR_TEMP_DIR = QRgen_Dir . 'image/';
	if (!file_exists($QR_TEMP_DIR))
		mkdir($QR_TEMP_DIR);
	if (isset($_POST['submit'])) {
		$insertdata = "";
		$imangedata = QR_wpOptionvalue($_POST['selTagaction']);
		$filename = $QR_TEMP_DIR . 'Qr' . md5($imangedata . '|H|4') . '.png';
		QR_wpcode::png($imangedata, $filename, 'H', 4, 2);
		foreach ($_POST as $key => $value) {
			$insertdata.=$key . '=' . $value . '&%&';
		}
		if ($_POST['submit'] == "Add Tag") {
			$sql = "INSERT INTO " . $wpdb->prefix . "qr_tagdata(qr_tagname,qr_action,qr_tagdata,qr_image,qr_align)VALUES('" . $_POST['txtTagname'] . "','" . $_POST['selTagaction'] . "','" . $insertdata . "','" . basename($filename) . "','".$_POST['alignment']."')";
			$wpdb->query($sql);
		}
		if ($_POST['submit'] == "Update Tag" && isset($_REQUEST['tagedit'])) {
			$sql = "UPDATE " . $wpdb->prefix . "qr_tagdata SET qr_tagname='" . $_POST['txtTagname'] . "',qr_action='" . $_POST['selTagaction'] . "',qr_tagdata='" . $insertdata . "',qr_image='" . basename($filename) . "',qr_align='".$_POST['alignment']."' WHERE qr_id=" . $_REQUEST['tagedit'];
			$wpdb->query($sql);
		}
	}
	if (isset($_REQUEST['tagedit'])) {
		$sql = "SELECT * FROM " . $wpdb->prefix . "qr_tagdata WHERE qr_id='" . $_REQUEST['tagedit'] . "'";
		$QRdata = $wpdb->get_row($sql);
		$tagname = $QRdata->qr_tagname;
		$tagaction = $QRdata->qr_action;
		$tagalign=$QRdata->qr_align;
		$newtagdata = $QRdata->qr_tagdata;
		$newtagdata = explode('&%&', $newtagdata);
		$tagArray = array();
		foreach ($newtagdata as $tagdata) {
			$tagField = explode('=', $tagdata);
			$tagArray[$tagField[0]] = $tagField[1];
		}
		$filename = $QRdata->qr_image;
	}
	include_once 'QRaddtagTemplate.php';
}

function QR_wpTaglist() {
	global $wpdb, $myPluginName;
	if (isset($_REQUEST['tagdelete'])) {
		$Sql = "DELETE FROM " . $wpdb->prefix . "qr_tagdata WHERE qr_id='" . $_REQUEST['tagdelete'] . "'";
		$wpdb->query($Sql);
	}
	$sql = "SELECT * FROM " . $wpdb->prefix . "qr_tagdata";
	$tagdata = $wpdb->get_results($sql);
	echo '<div class="wrap metabox-holder has-right-sidebar">
			<h2>' . $myPluginName . '</h2>
			<div class="wrap nosubsub" style="margin-top:20px;">
               <table cellspacing="0" class="widefat post fixed" style="margin-top:10px;">
               <thead><tr>
                            <th width="5%">TagID</th>
                            <th >Tag Name</th>
                            <th width="30%">Tag Action</th>
                            <th style="width:200px">Action</th>
                    </tr></thead><tbody>
                    ';
	foreach ($tagdata as $QRtagdata) {
		echo '<tr>';
		echo '<td>' . $QRtagdata->qr_id . '</td>';
		echo '<td>' . $QRtagdata->qr_tagname . '</td>';
		echo '<td>' . QR_wpActionvalue($QRtagdata->qr_action) . '</td>';
		echo '<td><b>[&nbsp;<a href="admin.php?page=qrnewtag&&tagedit=' . $QRtagdata->qr_id . '">Edit</a>&nbsp;|&nbsp;<a href="admin.php?page=qrtaglist&&tagdelete=' . $QRtagdata->qr_id . '">Delete</a>]</b></td>';
		echo '</tr>';
	}
	echo '</tbody></table></div></div>';
}

function QR_wpShorttag($tagArray) {
	global $wpdb;
	$content = "";
	$sql = "SELECT qr_image,qr_tagname,qr_align FROM " . $wpdb->prefix . "qr_tagdata WHERE qr_id='" . $tagArray['codeid'] . "'";
	$QRimage = $wpdb->get_row($sql);
	if ($QRimage) {
		$QRimagesrc = QRgen_Url . 'image/' . $QRimage->qr_image;
		$content.= '<p>';
		$content.='<image class="'.$QRimage->qr_align.'"  src="' . $QRimagesrc . '" alt="' . $QRimage->qr_tagname . '">';
		$content.='</p>';
	}
	return $content;
}

add_shortcode('qrcode', 'QR_wpShorttag');

function QR_wpActionvalue($value) {
	switch ($value) {
		case 'site':
			return 'Browse to a Website';
			break;
		case 'bkm':
			return 'Bookmark a Website';
			break;
		case 'call':
			return 'Make a Phone Call';
			break;
		case 'sms':
			return 'Send an SMS';
			break;
		case 'mail':
			return 'Send an E-Mail';
			break;
		case 'vcard':
			return '*UPDATED* Create a vCard';
			break;
		case 'mecard':
			return '*UPDATED* Create a meCard';
			break;
		case 'vevent':
			return 'Create a vCalendar Event';
			break;
		case 'youtube':
			return 'Youtube URL for iPhone';
			break;
		case 'tweet_fetch':
			return 'Encode Latest Tweet of a User';
			break;
		case 'tweet':
			return 'Tweet on Twitter';
			break;
		case 'twitter_embed':
			return 'Twitter Profile Image Overlay';
			break;
		case 'bbm':
			return 'Create Blackberry Messenger User';
			break;
		case 'wifi':
			return 'WIFI Network for Android';
			break;
		case 'text':
			return 'Free Formatted Text';
			break;
	}
}

function QR_wpTinybutton($buttons) {
	array_push($buttons, "separator", "qrcodeplugin");
	return $buttons;
}

function QR_wpTinyregister($plugin_array) {
	$url = QRgen_Url . "Js/qrtinty.js";
	$plugin_array["qrcodeplugin"] = $url;
	return $plugin_array;
}

?>