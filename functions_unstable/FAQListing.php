<?php namespace ProcessWire;
function FAQListing($pageID, $class="")
{
  $faqItems = $pageID->faq;
  $class = $class ? " $class" : "";
  
  // if (!$faqItems) {
  //   return "";
  // }
  
  $out = "<div id='accordion-$pageID' class='faq-listing faqlisting-accordion accordion accordion-flush $class'>";

  foreach ($faqItems as $i => $item) {
    (int) $i++;
    $q = $item->question;
    $a = $item->answer;
    $id = $pageID->id;
    $out .= "<div class='accordion-item faqlisting-item rounded-3 overflow-hidden' data-aos='fade-up' data-aos-delay='200'>";
      $out .= "<div class='accordion-header faqlisting-header' id='heading-$id-$i'>";
        $out .= "<button class='accordion-button faqlisting-button collapsed fw-bold fs-xl-3 px-2 px-lg-3 ps-4' type='button' data-bs-toggle='collapse' data-bs-target='#collapse-$id-$i' aria-expanded='true' aria-controls='collapse-$id-$i'>";
          $out .= icon('question', 24, 'd-inline-flex bg-primary text-white rounded-circle me-3');
          $out .= $q;
        $out .= "</button>";
      $out .= "</div>";
      $out .= "<div id='collapse-$id-$i' class='accordion-collapse faqlisting-collapse collapse' aria-labelledby='heading-$id-$i' data-bs-parent='#accordion-$pageID'>";
        $out .= "<div class='accordion-body faqlisting-body fs-xl-3 my-4'>";
          $out .= $a;
        $out .= "</div>";
      $out .= "</div>";

    $out .= "</div>";
  }

  $out .= "</div>";

  return $out;
}