<?php
namespace ProcessWire;

function testimonialsSlider($bTestimonials)
{
  $colClass = "w-90 w-sm-50 w-lg-33 w-xl-25";

  $out = "";
  
  if (isset($bTestimonials) && count($bTestimonials)) {
      
    $out .= "<div class='testimonialsslider-row testimonials-slider' data-flickity='{
      \"cellAlign\": \"center\",
      \"groupCells\": true,
      \"contain\": true,
      \"freeScroll\": true,
      \"pageDots\": true,
      \"freeScroll\": true,
      \"freeScrollFriction\": 0.03,
      \"prevNextButtons\": false 
    }'>";

    foreach ($bTestimonials as $i => $testimonial) {
      $personName = $testimonial->title;
      $picture = $testimonial->images_thumbnail;
      $position = $testimonial->text_1;
      $text = $testimonial->summarize('text_body_light',200);
      (int) $i++;
      
      $out .= "<div class='testimonialsslider-row-item testimonialSlider-item me-2 $colClass' edit='$testimonial.title,text_1,text_body_light,images_thumbnail'>";
        $out .= "<div class='testimonialsslider-row-content content d-flex flex-column justify-content-between p-3 p-lg-5 min-vh-40 rounded bg-lighter' data-aos='flip-right'>";
        
          $out .= "<div>";
            $out .= image(pages("/settings/")->images_site->getTag('5stars'), 90, null, 1);
            $out .= "<div class='testimonialsslider-row-person d-flex mt-3'>";
            $out .= image($picture->first, 64, 64, 1, null, "testimonialsslider-row-image img-fluid semicorner shadow-sm rounded-3 mb-3 me-3");
              $out .= "<div class='testimonialsslider-row-person-info'>";
                $out .= "<div class='testimonialsslider-row-name display-6 mt-3 mb-2 text-primary-dark'>$personName</div>";
                $out .= "<div class='testimonialsslider-row-position fs-5 text-gray'>$position</div>";
              $out .= "</div>";
            $out .= "</div>";
          $out .= "</div>";
          
          $out .= "<div class='testimonialsslider-row-text-container'>";
            $out .= "<div class='testimonialsslider-row-text fs-5 text-gray'>";
            $out .= $text;
            $out .= "</div>";
            if (strlen($text) > 190) {
              $out .= "<a href='#' class='testimonialsslider-row-link link fs-5 text-nowrap mt-2' data-bs-toggle='modal' data-bs-target='#testimonials-$i'>". caption("all_testimonial")."</a>";
            }
          $out .= "</div>";

        $out .= "</div>";
      $out .= "</div>";
    }
    $out .= "</div>";
    
    // Modal window if long text exists
    foreach ($bTestimonials as $i => $modal) {
      $personName = $modal->title;
      $textFull = $modal->text_body_light;
      (int) $i++;
      if (strlen($text) > 190) {
        $out .= "<div class='testimonialsslider-row-modal modal fade shadow' id='testimonials-$i' tabindex='-1' aria-labelledby='testimonialsLabel-$i' aria-hidden='true'>";
          $out .= "<div class='modal-dialog modal-lg modal-dialog-centered'>";
            $out .= "<div class='modal-content'>";
              $out .= "<div class='modal-header'>";
                $out .= "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
              $out .= "</div>";
              $out .= "<div class='modal-body px-lg-6'>";
              $out .= "<div class='text-dark'>$position</div>";
                $out .= "<div class='modal-title display-5 my-4 text-dark' id='testimonialsLabel-$i'>$personName</div>";
                $out .= $textFull;
              $out .= "</div>";
              $out .= "<div class='modal-footer'>";
                $out .= "<button type='button' class='btn btn-link' data-bs-dismiss='modal'>". caption("close")."</button>";
              $out .= "</div>";
            $out .= "</div>";
          $out .= "</div>";
        $out .= "</div>";
      }
    }
  }

  return $out;
}