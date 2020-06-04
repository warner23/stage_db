<?php

include_once 'WISite.php';
include_once 'WIAdmin.php';
include_once 'WIModules.php';
include_once 'WIDashboard.php';
include_once 'WIAdminChat.php';
include_once 'WIPage.php';
include_once 'WIImage.php';
include_once 'WITopic.php';
include_once 'WIPlugin.php';
include_once 'WIMedia.php';
include_once 'WITheatres.php';
include_once 'WIPeople.php';
include_once 'WIActor.php';
include_once 'WICompany.php';
include_once 'WIShows.php';
include_once 'WIFeatures.php';
include_once 'WICast.php';
include_once 'WICrew.php';
include_once 'WIPermissions.php';
//include_once 'WICSV.php';




/*
spl_autoload_register(function($class)
{
	include_once $class . '.php';
});
 
$site         = new WISite();
  
  */   

$mod          = new WIModules();
$dashboard    = new WIDashboard();
$chat         = new WIAdminChat();
$page         = new WIPage();
$site         = new WISite();
$img          = new WIImage();
$topic        = new WITopic();
$plug         = new WIPlugin();
$permissions = new WIPermissions();
?>
