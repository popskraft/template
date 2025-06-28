<?php namespace ProcessWire;

function sectionContacts($siteData="") 
{
  $siteSettingsPage = pages("/settings/");
  $siteData = $siteData ?: $siteSettingsPage->site_data;
  $postalCode = $siteData->postalCode;
  $addressRegion = $siteData->addressRegion;
  $addressLocality = $siteData->addressLocality;
  $streetAddress = $siteData->streetAddress;
  $openingHouseDays = $siteData->openingHouseDays;
  $openingHouseWE = $siteData->openingHouseWE;
  $phoneMain = $siteData->phone_main;
  $email = $siteData->email;
  $addressMap = $siteData->address_map;
  $map = $siteSettingsPage->codes->map;
  $website = $siteData->website;
  
  $out = "<div class='sectionContacts contacts-section row' edit='$siteSettingsPage.site_data,site_texts'>";
  
    $out .= "<div class='contacts-section-col col-lg mb-5'>";

      $out .= phone($phoneMain, 'd-block text-primary mb-3 fs-1 fs-lg-2', 1, 'rounded-circle me-3 p-2 border border-primary text-primary', 22);
      
      $out .= "<div class='contacts-section-title display-5 mt-4 mb-3 text-dark'>" . caption('contacts_title_address') . "</div>";
      $out .= "<div class='contacts-section-address fs-3'>$postalCode,&nbsp;$addressRegion, $addressLocality,&nbsp;$streetAddress</div>";
      $out .= "<div class='contacts-section-maplink fs-3'><a class='link' href='$addressMap'>" . caption('show_on_map') . "</a></div>";

      $out .= "<div class='contacts-section-title display-5 mt-4 mb-3 text-dark'>" . caption('contacts_title_openinghours') . "</div>";
      $out .= "<div class='contacts-section-hours fs-3'>$openingHouseDays</div>";
      $out .= "<div class='contacts-section-hours-weekend fs-3'>$openingHouseWE</div>";

      $out .= "<div class='contacts-section-title display-5 mt-4 mb-2 text-dark'>" . caption('email') . "</div>";
      $out .= "<div class='contacts-section-email fs-3'><a href='mailto:$email'>$email</a></div>";
      
      $out .= "<div class='contacts-section-title display-5 mt-4 mb-2 text-dark'>" . caption('contacts_title_website') . "</div>";
      $out .= "<div class='contacts-section-website fs-3'><a href='$website'>$website</a></div>";

    $out .= "</div>";
    
    $out .= "<div class='contacts-section-map-col col-lg-7'>";
      $out .= $map ? "<div class='contacts-section-map contacts-map overflow-hidden border shadow rounded'>$map</div>" : "" ;
    $out .= "</div>";

  $out .= "</div>";
  
  return $out;
}
