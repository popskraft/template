<?php namespace ProcessWire;

/**
 * BUTTONS 
 * ========================================
 */
function button($btnLink="", $btnCaption="", $btnClass="", $attr="")
{
  $btnClass = $btnClass ?: "btn btn-lg btn-secondary my-2";

  // Caption
  if (!$btnCaption && $btnLink) {
    $btnCaption = caption("more");
  } else if (!$btnCaption && !$btnLink) {
    $btnCaption = caption("default_cta");
  }

  if ($btnLink) {
    $attr = $attr ?: "";
    $attr = strval($attr);
    $out = "<a class='$btnClass' href='$btnLink' $attr>$btnCaption</a>";
  } else if (!$btnLink && $btnCaption) {
    $attr = $attr ?: "data-bs-toggle=modal data-bs-target=#contact";
    $attr = strval($attr);
    $out = "<button type='button' class='$btnClass' $attr>$btnCaption</button>";
  }
  return $out;

}

function buttonGroup($buttons="", $outClass="", $btnClass="")
{
  $outClass = $outClass ?: "d-block py-2";
  
  if (!count($buttons)) {
    return "";
  }

  $out = "<span class='button-group $outClass'>";
  if ($buttons) {
    foreach ($buttons as $button) {
      $btnLink = $button->link;
      $btnCaption = $button->label;
      $btnClass = $button->class;

      if ($btnClass == "primary") {
        $btnClass = "btn btn-lg btn-secondary my-3 me-2";
      } else if ($btnClass == "dark") {
        $btnClass = "btn btn-lg btn-primary-dark my-3 me-2";
      } else {
        $btnClass = "btn btn-lg btn-link my-1 me-2";
      }
      $btnAttribute = $button->attribute;
      $out .= button($btnLink, $btnCaption, $btnClass, $btnAttribute);
    }
  }
  $out .= "</span>";

  return $out;
}