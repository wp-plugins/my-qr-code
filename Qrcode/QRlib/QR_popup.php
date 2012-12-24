<?php
require_once('file:///Macintosh HD/Users/administrator/wp-load.php');
header('Content-Type: text/html; charset=' . get_bloginfo('charset'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<title><?php _e('Insert QR Code') ?></title>
<script type="text/javascript" src="../Js/tiny_mce_popup.js?ver=3223"></script>
<script type="text/javascript" src="../Js/pastetext.js"></script>
<?php
wp_admin_css( 'global', true );
wp_admin_css( 'wp-admin', true );
?>
<style type="text/css">
	#wrap {
		padding: 0 15px;
		font-size: 12px;
		width: 90%;
		margin: 0 auto;
	} #wrap div {
		font-size: 11px;
	} #wrap input {
		margin-bottom: 5px;
	}
</style>
</head>

    <body style="height: auto; width: auto;">
<div id="wrap">
<h3>Select Short Tag</h3>
    <form name="autoresponder" onsubmit="return PasteTextDialog.insert()" action="">
    	<div >Qr Short Code:<br/><br/>
        <?php
            global $wpdb;
            $sql="SELECT qr_tagname,qr_id FROM ".$wpdb->prefix."qr_tagdata";
            $Tagname=$wpdb->get_results($sql);
            if($Tagname)
            {
                echo '<select id="ar_code" name="ar_code" onchange="ajax_image();">';
                foreach ($Tagname as $TagName)
                {
                    echo "<option value=$TagName->qr_id>$TagName->qr_tagname</option>";
                }
                echo '</select><br/><br/>';
            }
            else
            {
                echo '<p><font color="red">No Tag</font></p>';
                echo "<p id=ar_code name=ar_code></p>";
            }
        ?>
        <input type="submit" name="insert" value="{#insert}" id="insert" />
        </div>
    </form>
</div>

</body>
</html>
