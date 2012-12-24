<?php
/*
Plugin Name: My QR Code Plugin
Plugin URI: http://www.eksit.co/qrcode
Description: You can use these in your sales pitch to your "Local Offline businesses", you can add the QR Code tag to ANY NEW or EXISTING post or page by clicking the 'Add Tag' widget to insert the short code that displays the 'QR Tag' where you want it to be displayed in your post, click to publish or update the post to finish the procedure.
My QR Code allows you to insert a QR Tag into any WordPress post or page, there are a number of different options that can be encoded into the QR Tag to make the user do as you want..., for instance you can make the user.

**Current add-ons**

* Browse to a Website
* Bookmark a Website
* Make a Phone Call
* Send an SMS
* Send an E-Mail
* Create a vCard
* Create a meCard
* Create a vCalendar Event
* Youtube URL for iPhone
* Tweet on Twitter
* Create Blackberry Messenger User
* WIFI Network for Android
* Free Formatted Text

If you have suggestions for a new add-on, feel free to email me at mrdimeh@eksit.co. Want regular updates? Follow me on Twitter!  http://twitter.com/mrdimeh

Author: Mehdi Laidouni  
Version: 1.5
Author URI: http://www.eksit.co
License: GPL2
*/


/* Rebrandable Options */
$pluginslug = 'My-QR-Code-Plugin'; // This should be the plugin's main folder name. For example `wp-content/plugins/{$pluginslug}/`.
$pluginname = 'My QR Code Plugin'; // This is the name of the plugin that is displayed publicly. This should be the same as above in the plugin's headers.
$pluginurl = 'http://www.eksit.co/qrcode'; // This is the URL to the plugin's main website. This variable is needed for displaying it on the site since I can't get the header information, and is the same as the plugin's headers above.
$helplink = 'More info'; // This is the text of the 'help' link.
$helpurl = 'http://www.eksit.co/qrcode'; // This is the URL to the 'help' website.
$confirmationkey = "d41d8cd98f00b204e9800998ecf8427e";  // This is the Plugin  Confirmation Key
$checkConfirmationKey=False;
$Form_code = '';   // This is the Plugin Form Code

/* End Rebrandable Options */
include 'Qrcode/QRfunction.php'; //Include everything!
?>