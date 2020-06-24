<?php /*
  Name:             servervars
  Copyright:        Copyright (C) 2005 Tavultesoft Pty Ltd.
  Documentation:
  Description:
  Create Date:      17 Oct 2009

  Modified Date:    17 Oct 2009
  Authors:          mcdurdin
  Related Files:
  Dependencies:

  Bugs:
  Todo:
  Notes:
  History:          17 Oct 2009 - mcdurdin - Alter help base dir
*/
  if(!empty($_SERVER['DOCUMENT_ROOT']) && file_exists($_SERVER['DOCUMENT_ROOT'].'/cdn/deploy/cdn.php')) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/cdn/deploy/cdn.php');
  }

  // Major stable and beta versions
  global $stable_version_int, $beta_version_int;
  $stable_version_int = 13;
  $beta_version_int = 13;

  $stable_version = $stable_version_int . '.0';
  $beta_version = $beta_version_int . '.0';

  function betaTier() {
      global $stable_version_int, $beta_version_int;
      return $beta_version_int > $stable_version_int;
  }

  require_once(__DIR__ . '/../2020/KeymanHosts.php');

  use \Keyman\Site\com\keyman\KeymanHosts;
  // TODO refactor away global variable
  $KeymanHosts = Keyman\Site\com\keyman\KeymanHosts::Instance();

  // Alpha and Beta signup links
  global $playstore_signup_link, $testflight_alpha_link, $testflight_beta_link;
  $playstore_signup_link = "https://play.google.com/apps/testing/com.tavultesoft.kmapro";
  $testflight_alpha_link = "https://testflight.apple.com/join/vnCV2EiH";
  $testflight_beta_link = "https://testflight.apple.com/join/9W4XIoxQ";


  function cdn($file) {
    global $cdn, $KeymanHosts;
    $use_cdn = $KeymanHosts->Tier() == KeymanHosts::TIER_PRODUCTION || (isset($_REQUEST['cdn']) && $_REQUEST['cdn'] == 'force');
    if($use_cdn) {
      if($cdn && isset($cdn['/'.$file])) {
        return "/cdn/deploy{$cdn['/'.$file]}";
      }
    }
    return "/cdn/dev/{$file}";
  }
?>