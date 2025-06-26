<?php
namespace ProcessWire;

function sectionStaff($staff, $positions)
{
  $out = "";
  $totalPositions = count($positions);

  foreach ($positions as $i => $position) {
    $persones = $staff->find("people_whois=$position, sort=sort");

    if (count($persones)) {
      $out .= "<div class='sectionStaff row'>";
        $out .= "<div class='col-lg'>";
          $out .= "<div class='display-3 text-uppercase text-gray my-4 sticky-top' data-aos='fade-up'>$position->title</div>";
        $out .= "</div>";
        $out .= "<div class='col-lg-9'>";
        if ($position->value === "head") {
          $out .= rowPersones($persones);
        } else {
          $out .= rowPersones($persones, "g-2 row-cols-2 row-cols-xxl-3", 147);
        }
        $out .= "</div>";
      $out .= "</div>";

      // Add the divider only if it's not the last element
      if ($i < $totalPositions - 1) {
        $out .= "<div class='divider pt-2 mb-4 bg-lighter rounded'></div>";
      }
    }
  }

  return $out;
}
