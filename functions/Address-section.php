<?php namespace ProcessWire;

function sectionAddress(
  $siteData = null,
  $class = null,
  $title = null,
  $email = null,
  $sitePhones = null,
  $streetAddress = null,
  $addressMap = null,
  $addressLocality = null,
  $postalCode = null,
  $addressCountry = null,
  $addressRegion = null
)
{
  // Получаем данные по умолчанию если не переданы
  $defaultSiteData = pages('/settings/')->site_data;
  
  $siteData = $siteData ?: $defaultSiteData;
  $class = $class ?: "col-12";
  $title = $title ?: caption("address");
  $email = $email ?: $defaultSiteData->email;
  $sitePhones = $sitePhones ?: "";
  $streetAddress = $streetAddress ?: "";
  $addressLocality = $addressLocality ? "$addressLocality," : "";
  $addressMap = $addressMap ? wire('sanitizer')->url($addressMap) : wire('sanitizer')->url($defaultSiteData->address_map ?: "");
  $postalCode = $postalCode ? "$postalCode," : "";
  $addressCountry = $addressCountry ? "$addressCountry," : "";
  $addressRegion = $addressRegion ? $addressRegion : "";
  
  $out = "";
  $out .= "<div class='sectionAddress fs-5 mb-3 $class'>";
  
    $out .= "<div class='sectionAddress-title display-5 mt-3 mb-2'>$title</div>"; 
  
    // Телефон отображается если есть данные
    if ($sitePhones) {
      // Преобразуем строку с телефонами в массив
      $phonesArray = fieldExplode($sitePhones, "br");
      
      $out .= "<div class='sectionAddress-phone'>";
        // Выводим каждый телефон через цикл foreach
        foreach ($phonesArray as $phoneNumber) {
          $phoneNumber = trim($phoneNumber); // Убираем лишние пробелы
          if ($phoneNumber) { // Проверяем что номер не пустой
            $out .= phone($phoneNumber, 'd-block text-primary mb-2 fs-2 fs-sm-3', 1, 'rounded-circle me-2 p-2 border border-primary text-primary', 12);
          }
        }
      $out .= "</div>";
    }
  
    // Адрес отображается если есть любые данные адреса
    if ($postalCode || $addressCountry || $addressRegion || $addressLocality || $streetAddress) {
      $out .= "<div class='sectionAddress-address address text-white'>";
        if ($postalCode || $addressLocality || $streetAddress) {
          $out .= "<div class='sectionAddress-address-locality'>$postalCode $addressLocality $streetAddress</div>";
        }
        if ($addressCountry || $addressRegion) {
          $out .= "<div class='sectionAddress-address-region'>$addressCountry $addressRegion</div>";
        }
      $out .= "</div>";
    }

    // Ссылка на карту отображается если есть URL карты
    if ($addressMap) {
      $out .= "<div class='sectionAddress-maplink maplink'>";
        $out .= "<a target='_blank' rel='nofollow' href='$addressMap' class='sectionAddress-maplink-link underline'>" . caption("show_on_map") . "</a>";
      $out .= "</div>";
    }

    // Email отображается если есть данные
    if ($email) {
      $out .= "<div class='sectionAddress-email email-company mt-2'>";
        $out .= "<a href='mailto:$email' rel='nofollow' class='sectionAddress-email-link link'>$email</a>";
      $out .= "</div>";
    }
  
  $out .= "</div>";
  
  return $out;
} 