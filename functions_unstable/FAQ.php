<?php namespace ProcessWire;

function FAQ($pageID="", $class="")
{
  $pageID = $pageID ?: page();
  $class = $class ?: "";
  $features = $pageID->faq;
  $output = "<div class='accordion accordion-flush faq-accordion $class' id='accordion-$pageID'>";
  
  foreach ($features as $i => $item) {
    (int) $i++;
    $output .= "<div class='accordion-item faq-accordion-item'>";
    
      $output .= "<div class='accordion-header faq-accordion-header' id='heading-$item-$i'>";
        $output .= "<button class='accordion-button faq-accordion-button collapsed fw-bold fs-3' type='button' data-bs-toggle='collapse' data-bs-target='#collapse-$item-$i' aria-expanded='true' aria-controls='collapse-$item-$i'>";
          $output .= icon('question', 24, 'd-inline-flex bg-secondary text-white rounded-circle ms-n2 me-3') . $item->question;
        $output .= "</button>";
      $output .= "</div>";

      $output .= "<div id='collapse-$item-$i' class='accordion-collapse faq-accordion-collapse collapse' aria-labelledby='heading-$item-$i' data-bs-parent='#accordion-$pageID'>";
        $output .= "<div class='accordion-body faq-accordion-body fs-lg-3 my-4 ps-4'>";
          $output .= $item->answer;
        $output .= "</div>";
      $output .= "</div>";

    $output .= "</div>";
  }

  $output .= "</div>";
  
  return $output;
}