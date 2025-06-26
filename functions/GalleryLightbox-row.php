<?php namespace ProcessWire;

/**
 * Render a gallery with lightbox.
 * 
 */
function galleryLightbox($galleryItems, $galleryRowClass = "", $galleryImgW = "", $galleryImgH = "", $captionClass = "", $lazyload = 1, $numStart = 0)
{
  $galleryRowClass = $galleryRowClass ?: "row-cols-2 row-cols-md-4 g-1 g-md-3";
  $galleryImgW = $galleryImgW ?: 400;
  $galleryImgH = $galleryImgH ?: floor(400 * .75);
  $captionClass = $captionClass ?: "gallery-image-caption trans-fast opacity-0 position-absolute d-inline-flex align-items-end text-end justify-content-end ms-1 ms-lg-3 ps-2 pt-2 bottom-0 start-0 end-0 fs-6 lh-sm rounded-top bg-white";

  if (empty($galleryItems)) {
    return ""; // Return early if there are no gallery items
  }
  $out = "<div class='galleryLightbox spotlight-group row align-images-center $galleryRowClass'>";
  $i = $numStart;
  foreach ($galleryItems as $galleryImage) {
    $i += 1;
    $galleryImageUrl = $galleryImage->height(800)->webpUrl;
    $galleryImageDescription = $galleryImage->description;
    $out .= "<div class='col'>";
      $out .= "<figure class='gallery-figure mb-0 position-relative overflow-hidden rounded hover-zoom'>";
        $out .= "<a class='spotlight' href='$galleryImageUrl'>";
          $out .= image($galleryImage, $galleryImgW, $galleryImgH, null, null, "img-full rounded", $lazyload);
          if ($galleryImageDescription) {
            $out .= "<div class='$captionClass'>";
              $out .= "<span>$galleryImageDescription</span>";
            $out .= "</div>";
          }
        $out .= "</a>";
      $out .= "</figure>";
    $out .= "</div>";
  }
  $out .= "</div>";
  return $out;
}
