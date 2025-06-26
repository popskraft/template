<?php
// Optional main output file, called after rendering page’s template file. 
// This is defined by $config->appendTemplateFile in /site/config.php, and
// is typically used to define and output markup common among most pages.
// 	
// When the Markup Regions feature is used, template files can prepend, append,
// replace or delete any element defined here that has an "id" attribute. 
// https://processwire.com/docs/front-end/output/markup-regions/

namespace ProcessWire;

/**
 *  Preload function files from functions/ directory
 *  ========================================
 */
$funDirectory = 'functions/';
if ($handle = opendir($funDirectory)) {
  while (false !== ($file = readdir($handle))) {
    if ('.' === $file)
      continue;
    if ('..' === $file)
      continue;
    include_once $funDirectory . $file;
  }
  closedir($handle);
}

/**
 *  Предустановленные переменные для сайта в целом, а также настроек главной страницы
 *  ========================================
 */
$home = pages('/'); // home page
$isHome = page()->is('/'); // if the page is home
$rootUrl = $config->urls->httpRoot;


/**
 *  Languages
 *  ========================================
 */
$alternateLinks = "";
foreach ($languages as $language) {
  $langIndex = ($language->title == "ru") ? "" : $language->title;
  $alternateLinks .= '<link rel="alternate" hreflang="' . $language->title . '" href="' . $rootUrl . $langIndex . '">';
}

/**
 *  Настройки страницы — источник — главная страница в админке
 *  ========================================
 */
$siteSettings = pages('/settings/');
$siteImgs = $siteSettings->images_site; // Изображения сайта: лого, OG обложка и т.п.
$siteData = $siteSettings->site_data; // Данные компании на всем сайте, основные настройки на главной странице

$siteCodes = $siteSettings->codes; // Коды на всем сайте
$siteCodeHeader = $siteCodes->code_header ?: "";
$siteCodeBody = $siteCodes->code_body ?: "";
$siteCodeFooter = $siteCodes->code_footer ?: "";

$siteEmail = $siteData->email; // Основной email
$sitePhoneMain = $siteData->phone_main; // Основной телефон
$sitePhone2 = $siteData->phone_2; // 2 телефон
$siteWhatsApp = $siteData->whatsapp; // WhatsApp
$siteTelegram = $siteData->telegram; // Telegram

$socials = $siteSettings->socials;

/**
 * SEO Maestro Setup
 * https://processwire.com/modules/seo-maestro/
 * ========================================
 */
$seoMaestro = page("seo_maestro");

// Hook to modify SEO data
$wire->addHookAfter("SeoMaestro::renderSeoDataValue", function (HookEvent $event) {
  $group = $event->arguments(0);
  $name = $event->arguments(1);
  $value = $event->arguments(2);

  if ($group === "meta" && $name === "description") {
    $pageDescription = page()->summarize("text_summary|text_body|text_body_light", 320)
      ?: pages('/settings/')->site_data->description;
    $event->return = addslashes($value ?: $pageDescription);
  }

  if ($group === "opengraph" && $name === "image") {
    $OGImageUrl = $value ?: pages('/settings/')->images_site->getTag("og_image")->url;
    $event->return = $OGImageUrl;
  }
});


/**
 *  SHORT ICON and FAVICON
 *  ========================================
 */
$shortIcon = "";
$appleIcon = "";
$iconShortIcon = pages('/settings/')->images_site->getTag("favicon");

if ($iconShortIcon) {
  $shortIcon = $iconShortIcon->size(180, 180)->url;
  $shortIcon = "<link rel='shortcut icon' href='$shortIcon'>";
}
if ($iconAppleIcon = $siteImgs->getTag("apple_icon")) {
  $appleIcon = $iconAppleIcon->size(180, 180)->url;
  $appleIcon = "<link rel='apple-touch-icon' href='$appleIcon'>";
}

/**
 *  Variables Mostly for SEO (@ShemaOrh.php)
 *  ========================================
 */
$pagehttpUrl = page()->httpUrl;
$pageMetaTitle = addslashes($seoMaestro->meta->title);
$pageMetaDescription = addslashes($seoMaestro->meta->description);
$pagePrimaryImageURL = $seoMaestro->opengraph->image;
$datePublished = date('c', page()->published);
$dateModified = date('c', page()->modified);
$telephone = $sitePhoneMain;
$email = $siteEmail;
$locale = $seoMaestro->opengraph->locale ?: "ru_RU";
$legalName = addslashes($siteData->get("legalName|name"));
$founderName = $siteData->founderName;
$slogan = addslashes($siteData->slogan);
$siteName = addslashes($siteData->name);
$siteLogoUrl = $siteImgs->getTag("logo_schemaorg|logo_main")->url;
$siteDescription = addslashes($siteData->description);
$streetAddress = addslashes($siteData->streetAddress);
$addressLocality = addslashes($siteData->addressLocality);
$addressRegion = addslashes($siteData->addressRegion);
$addressCountry = addslashes($siteData->addressCountry);
$postalCode = $siteData->postalCode;
$addressMap = $siteData->address_map;

/**
 *  Menu
 *  ========================================
*/

// Menu Header
$menuHeader = pages("/settings/")->menu_header;
$menuHeaderStructure = $menuHeader->getDepthStructure();

// Menu Footer
$menuFooter = pages("/settings/")->menu_footer;
$menuFooterStructure = $menuFooter->getDepthStructure();
$menuFooter2 = pages("/settings/")->menu_footer2;
$menuFooterStructure2 = $menuFooter2->getDepthStructure();
$menuFooter3 = pages("/settings/")->menu_footer3;
$menuFooterStructure3 = $menuFooter3->getDepthStructure();