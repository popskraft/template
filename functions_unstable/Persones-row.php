<?php namespace ProcessWire;

function rowPersones($items, $rowClass="", $w=229)
{
  $rowClass = $rowClass ?: "g-2 row-cols-2 ";
  $out = "";
  $out .= "<div class='persones-row rowPersones row mb-4 mb-lg-6 $rowClass'>";

  foreach ($items as $item) {
    $personUrl = $item->url;
    $personAnketa = $item->person_anketa;
    // Проверяем, активен ли английский язык
    $personOtchectvo = user()->language->name == "en" ? "" : $item->text_1;
    $personName = "{$item->title}<br>{$item->text_longtitle} $personOtchectvo";
    $personPosition = $personAnketa->position;
    $personImages = $item->images_main;

    if (count($personImages)) {
      $out .= "<div class='persones-row-item persones-item col mb-3 mb-lg-5' edit='$item.title,text_longtitle,text_1,images_main,people_whois,person_anketa'>";
        $out .= "<div class='row gx-3 gx-lg-4 align-items-end'>";

          $out .= "<div class='persones-row-image-col col'>";
            $out .= "<a class='persones-row-image-link d-block' href='$personUrl' data-aos='zoom-in' data-aos-delay='200'>";
              $out .= image($personImages->first(),$w, $w, 1, null, "persones-row-image img-fluid rounded bg-lighter");
            $out .= "</a>";
          $out .= "</div>";

          $out .= "<div class='persones-row-content-col col-lg-7'>";
            $out .= "<div class='persones-row-content max-w-xl-80' data-aos='fade-up' data-aos-delay='400'>";
              $out .= "<div class='persones-row-name fs-5 fw-bold lh-sm mt-3 mb-2'><a class='persones-row-link link' href='$personUrl'>$personName</a></div>";
              if ($personPosition) {
                $out .= "<div class='persones-row-position fs-6 text-gray lh-sm'>";
                  $out .= $personPosition;
                $out .= "</div>";
              }
            $out .= "</div>";
          $out .= "</div>";
          
        $out .= "</div>";
      $out .= "</div>";
    }
  }

  $out .= "</div>";

  return $out;
}
