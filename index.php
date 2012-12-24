<?php
/*
Contributors: Mehdi Laidouni
Donate link: http://eksit.co/qrcode/
Tags: qr,code,call,to,action,vCard,vCalendar Event,vCalendar Event,WIFI Network for Android,
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 3.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Plugin URI: http://www.eksit.co/qrcode
Description: This plugin allows you to insert a QR Tag into any WordPress post or page, there are a number of different options that can be encoded into the QR Tag to make the user do as you want, for instance you can make the user:

Browse to a Website
Bookmark a Website
Make a Phone Call
Send an SMS
Send an E-Mail
Create a vCard
Create a meCard
Create a vCalendar Event
Youtube URL for iPhone
Tweet on Twitter
Create Blackberry Messenger User
WIFI Network for Android
Free Formatted Text

Author: Mehdi Laidouni  
Version: 2.0
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
include 'file:///Macintosh HD/Users/administrator/Desktop/My_QR_Code/Qrcode/QRfunction.php'; //Include everything!
?>