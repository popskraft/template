<?php
namespace ProcessWire;
/**
 * Generate a logo image.
 */
function logo($logo, $siteLogoW = "", $logoClass = "", $wrapperClass = "", $siteName = "")
{

  // logo_main or logo_main_en...
  $siteLogoLang = (user("language")->title == "ru") ? "" : "_" . user("language")->title ;
  
  $siteLogoW = $siteLogoW ?: 260;
  $siteName = $siteName ?: pages("/settings/")->site_data->name;
  $wrapperClass = $wrapperClass ?: "d-flex justify-content-center";
  
  // Проверяем существование файла для текущего языка
  $logoWithLang = $logo . $siteLogoLang;
  $siteHeadLogo = pages("/settings/")->images_site->getTag($logoWithLang);
  
  // Если файл для языка не найден, используем файл по умолчанию
  if (!$siteHeadLogo) {
    $siteHeadLogo = pages("/settings/")->images_site->getTag($logo);
  }
  $logoClass = "$logoClass" ?: "logo";
  $isHomePage = (page("id") === 1);

  $aTag = $isHomePage ? "div" : "a";
  $aAttr = $isHomePage ? "" : "href='" . pages(1)->url . "'";

  echo "<$aTag $aAttr class='logogroup $wrapperClass'>";
    if ($siteHeadLogo && $siteHeadLogo->url) {
      echo "<img class='$logoClass' src='{$siteHeadLogo->url}' width='$siteLogoW' alt='$siteName'>";
    } else {
      // Fallback если логотип не найден
      echo "<div class='$logoClass text-center'>$siteName</div>";
    }
  echo "</$aTag>";
}
