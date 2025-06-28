<?php
namespace ProcessWire;

function langSwitcher()
{
  $siteOptions = pages("/settings/")->options_site;
  // remember what language is set to
  $savedLanguage = user()->language;
  $out = "";
  $count = count(languages());
  $i = 0;
  $out .= "<div class='langswitcher lang-switcher mb-4 mb-lg-n1'>";
  
  foreach (languages() as $language) {
    // if this page isn't viewable (active) for the language, skip it
    if (!page()->viewable($language))
      continue;

    // set the user's language
    user()->language = $language;

    $divider = ($i < $count - 1) ? "<span class='langswitcher-divider divider border-start py-2'></span>" : "";

    $langStart = ($language->id == $savedLanguage->id) ? "<span class='langswitcher-item lang-switcher-item fw-bold text-uppercase text-primary mx-2'>" : "<a class='langswitcher-item lang-switcher-item fw-bold text-uppercase text-gray-light link mx-2' href='". page()->url ."'>";
    $langEnd = ($language->id == $savedLanguage->id) ? "</span>$divider" : "</a>$divider";

    $out .= "$langStart $language->title $langEnd";

    $i++;
  }

  $out .= "</div>";

  // restore the original language setting
  user()->language = $savedLanguage;

  if (isset($siteOptions) && !$siteOptions->has(1)) {
    return $out;
  }
}