<?php namespace ProcessWire;

function sectionPerson($pageID="")
{
  $pageID = $pageID ?: page();
  $anketa = $pageID->person_anketa;
  $anketaArray = [
    $anketa->label("about") => $anketa->about,
    $anketa->label("education") => $anketa->education,
    $anketa->label("schoolforme") => $anketa->schoolforme,
    $anketa->label("pupulsforme") => $anketa->pupulsforme, 
    $anketa->label("ihonor") => $anketa->ihonor,
    $anketa->label("hobby") => $anketa->hobby,
  ];

  $out = "";
  $out .= "<div class='sectionPerson-anketa mt-lg-4' edit='images_main,title,text_longtitle,text_1,person_anketa'>";
  foreach ($anketaArray as $key => $item) {
    if ($item) {
    $out .= "<div class='sectionPerson-item row mb-3 pb-3 border-bottom'>";
      $out .= "<div class='col-lg'>";
        $out .= "<h2 class='display-6'>$key</h2>";
      $out .= "</div>";
      $out .= "<div class='col-lg-8'>";
          $out .= $item;
      $out .= "</div>";
    $out .= "</div>";
    }
  }
  $out .= "</div>";
  
  return $out;
}