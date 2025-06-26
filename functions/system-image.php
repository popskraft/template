<?php

namespace ProcessWire;

function image(
  $imgSrc,
  $width = null,
  $height = null,
  $x2 = false,
  $quality = null,
  $imgClass = null,
  $lazyLoad = false,
  $alt = null,
  $advancedImage = true,
  $attr = null
) {
  $out = "";

  if (!$imgSrc) {
    return $out;
  }

  // Default values
  $quality = $quality ?: 95;
  $imgClass = $imgClass ?: "img-fluid";
  $lazyLoad = $lazyLoad ? "loading='lazy' decoding='async'" : "";
  $alt = $alt ?: ($imgSrc->description ?: page("text_longtitle|title"));
  $attr = $attr ?: "data-aos='fade-in'";

  // Handle SVG images
  if (pathinfo($imgSrc->url, PATHINFO_EXTENSION) === "svg") {
    $SVGw = $width ? "width='$width'" : "";
    $SVGh = $height ? "height='$height'" : "";

    // Dynamically calculate height for SVG if not provided
    if (!$height && $width && file_exists($imgSrc->filename)) {
      $svgContent = file_get_contents($imgSrc->filename);
      if (preg_match('/viewBox="([\d\s\.]+)"/', $svgContent, $matches)) {
        $viewBox = explode(" ", $matches[1]);
        if (count($viewBox) === 4) {
          $aspectRatio = ($viewBox[3] - $viewBox[1]) / ($viewBox[2] - $viewBox[0]);
          $SVGh = "height='" . ceil($width * $aspectRatio) . "'";
        }
      }
    }

    $out .= "<img class='$imgClass' src='{$imgSrc->url}' $SVGw $SVGh alt='$alt'>";
    return $out;
  }

  // Original dimensions
  $originalWidth = $imgSrc->width;
  $originalHeight = $imgSrc->height;

  // Calculate width and height based on rules
  if ($height !== null && $width === null) {
    // Height is set, calculate width proportionally
    $width = ceil($height * ($originalWidth / $originalHeight));
  } elseif ($width !== null && $height === null) {
    // Width is set, calculate height proportionally
    $height = ceil($width * ($originalHeight / $originalWidth));
  } elseif ($width === null && $height === null) {
    // Both are null, use original dimensions
    $width = $originalWidth;
    $height = $originalHeight;
  }

  // Double dimensions for high-density displays
  if ($x2) {
    $width *= 2;
    $height *= 2;
  }

  // Generate main image
  $imgNormal = $imgSrc->size($width, $height, $quality);
  $url = $imgNormal->webpUrl;
  $w = $imgNormal->width;
  $h = $imgNormal->height;

  // Calculate width and height for output, considering high-density displays
  $wWidth = $x2 ? intdiv($width, 2) : $width;
  $hHeight = $x2 ? intdiv($height, 2) : $height;

  // Responsive image handling
  if ($advancedImage) {
    // Define responsive breakpoints while maintaining aspect ratio
    $mobileWidth = min($width, 640);
    $tabletWidth = min($width, 1240);
    $mobileHeight = ceil($mobileWidth * ($originalHeight / $originalWidth));
    $tabletHeight = ceil($tabletWidth * ($originalHeight / $originalWidth));

    // If both width and height are explicitly set, do not maintain aspect ratio
    if ($width !== null && $height !== null) {
      $mobileHeight = $height * ($mobileWidth / $width);
      $tabletHeight = $height * ($tabletWidth / $width);
    }

    // Generate resized images
    $imgMobile = $imgSrc->size($mobileWidth, $mobileHeight, $quality);
    $imgTablet = $imgSrc->size($tabletWidth, $tabletHeight, $quality);

    // Generate srcset
    $srcset = "{$imgMobile->webpUrl} {$mobileWidth}w, {$imgTablet->webpUrl} {$tabletWidth}w, $url {$w}w";

    // Define sizes attribute
    $sizes = "(max-width: 640px) {$mobileWidth}px, (max-width: 1240px) {$tabletWidth}px, 100vw";

    // Render responsive image with WebP
    $out .= "<img class='$imgClass' $lazyLoad src='$url' srcset='$srcset' sizes='$sizes' width='$wWidth' height='$hHeight' alt='$alt' $attr>";
  } else {
    // Basic image handling
    $out .= "<img class='$imgClass' $lazyLoad src='$url' width='$wWidth' height='$hHeight' alt='$alt' $attr>";
  }

  return $out;
}

function imageCaption($imgSrc, $class = "image-caption")
{
  if ($imgSrc && $imgSrcDesc = $imgSrc->description) {
    return "<span class='$class'>$imgSrcDesc</span>";
  }
  return "";
}
