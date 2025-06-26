<?php namespace ProcessWire;

function sectionContactsFilipok($siteData="") 
{
  $siteSettingsPage = pages("/settings/");
  $siteData = $siteData ?: $siteSettingsPage->site_data;
  $postalCode = $siteData->postalCode;
  $addressRegion = $siteData->addressRegion;
  $addressLocality = $siteData->addressLocality;
  $streetAddress = $siteData->streetAddress;
  $phoneMain = $siteData->phone_main;
  $email = $siteData->email;
  $addressMap = $siteData->address_map;
  $website = $siteData->website;
  
  
  $out = "<div class='sectionContacts mainContainer row' edit='$siteSettingsPage.site_data,site_texts'>";
    $out .= "<div class='col-lg mb-5'>";
      $out .= phone($phoneMain, 'd-block text-primary mb-3 fs-1 fs-lg-2', 1, 'rounded-circle me-3 p-2 border border-primary text-primary', 22);
      $out .= "<div class='display-5 mt-4 mb-2 text-dark'>" . caption('email') . "</div>";
      $out .= "<div class='fs-3'><a href='mailto:$email'>$email</a></div>";
    $out .= "</div>";
    $out .= "<div class='col-lg mb-5'>";
      $out .= "<div class='display-5 mt-4 mb-3 text-dark'>" . caption('contacts_title_address') . "</div>";
      $out .= "<div class='fs-3'>$postalCode,&nbsp;$addressRegion, $addressLocality, $streetAddress</div>";
      $out .= "<div class='maplink mt-3'><a class='link' href='$addressMap'>" . caption('show_on_map') . "</a></div>";
      $out .= "<div class='display-5 mt-4 mb-2 text-dark'>" . caption('contacts_title_website') . "</div>";
      $out .= "<div class='fs-3'><a href='$website'>$website</a></div>";
    $out .= "</div>";
  $out .= "</div>";


  $out .= "<div class='sectionContacts branches row' edit='$siteSettingsPage.site_data,site_texts'>";

  // Define branches array with their data
  $branches = [];
  $i = 1;
  
  // Collect all branch data into an array
  while ($siteData->get("branch_{$i}_name")) {
    $branchMap = $siteSettingsPage->codes->get("map_{$i}");
    
    $branches[] = [
      'name' => $siteData->get("branch_{$i}_name"),
      'street' => $siteData->get("branch_{$i}_streetAddress"),
      'postal' => $siteData->get("branch_{$i}_postalCode"),
      'map_url' => $siteData->get("branch_{$i}_address_map"),
      'map_embed' => $branchMap ?: null,
      'days' => $siteData->get("branch_{$i}_openingHouseDays"),
      'saturday' => $siteData->get("branch_{$i}_openingHouseS"),
      'sunday' => $siteData->get("branch_{$i}_openingHouseV")
    ];
    $i++;
  }
  
  // Loop through branches using foreach
  foreach ($branches as $branch) {
    $out .= "<div class='branch col-lg-6 mb-5'>";
      $out .= "<div class='shadow bg-white border rounded p-3 p-lg-4'>";
    
        // Branch name
        $out .= "<div class='display-5 mt-4 mb-3 text-dark'>{$branch['name']}</div>";
        
        // Address section
        $out .= "<div class='fs-4 mb-3'>{$branch['street']}<br>{$branch['postal']}, {$addressRegion}, {$addressLocality}</div>";
        
        if ($branch['map_url']) {
          $out .= "<div class='mb-4'><a class='maplink' href='{$branch['map_url']}'>" . caption('show_on_map') . "</a></div>";
        }
        
        // Opening hours section
        $out .= "<div class='display-6 mb-2 text-dark'>" . caption('contacts_title_openinghours') . "</div>";
        if ($branch['days']) $out .= "<div class='fs-4 mb-1'><strong>" . caption('weekdays') . ":</strong> {$branch['days']}</div>";
        if ($branch['saturday']) $out .= "<div class='fs-4 mb-1'><strong>" . caption('saturday') . ":</strong> {$branch['saturday']}</div>";
        if ($branch['sunday']) $out .= "<div class='fs-4 mb-3'><strong>" . caption('sunday') . ":</strong> {$branch['sunday']}</div>";
        
        // Add map if available
        if ($branch['map_embed']) {
          $out .= "<div class='map mt-4'>";
          $out .= "<div class='contacts-map overflow-hidden rounded' style='height: 450px;'>{$branch['map_embed']}</div>";
          $out .= "</div>";
        }
    
      $out .= "</div>";
    $out .= "</div>"; // Close branch
  }
  
  $out .= "</div>"; // Close row
  
  return $out;
}