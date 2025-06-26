<?php
namespace ProcessWire;
/**
 * Generate a logo image.
 */
function logo($logo, $siteLogoW = "", $logoClass = "", $wrapperClass = "", $siteName = "")
{

  // logo_main or logo_main_en...
  $siteLogoLang = (user("language")->title == "ru") ? "" : "_" . user("language")->title ;
  
  $logo = $logo . $siteLogoLang ;
  $siteLogoW = $siteLogoW ?: 260;
  $siteName = $siteName ?: pages("/settings/")->site_data->name;
  $wrapperClass = $wrapperClass ?: "d-flex justify-content-center";
  $siteHeadLogo = pages("/settings/")->images_site->getTag($logo);
  $logoClass = "$logoClass" ?: "logo";
  $isHomePage = (page("id") === 1);

  $aTag = $isHomePage ? "div" : "a";
  $aAttr = $isHomePage ? "" : "href='" . pages(1)->url . "'";

  echo "<$aTag $aAttr class='logogroup $wrapperClass'>";
    echo "<img class='$logoClass' src='$siteHeadLogo->url' width='$siteLogoW' alt='$siteName'>";
  echo "</$aTag>";
}
