<?php namespace ProcessWire;

/**
 *  Socials group
 *  ========================================
 *  socials($socials, $iconClass, $outerClass, $linkClass)
*/
function socials($socials = "", $linkClass="", $iconClass = "", $iconSize = "", $caption = "")
{
  $out = "";
  $iconSize = $iconSize ?: 22;
  $iconClass  = $iconClass ?: 'me-2 ms-n1';

  if ($socials) {

    $socials = fieldExplode($socials);
    
    $brands = [
      "facebook.com" => "facebook",
      "instagram.com" => "instagram",
      "twitter.com" => "twitter",
      "x.com" => "x",
      "youtube.com" => "youtube",
      "vk.com" => "vk",
      "pinterest.com" => "pinterest",
      "pin.it" => "pinterest",
      "skype.com" => "skype",
      "linkedin.com" => "linkedin-in",
      // "dribbble.com" => "dribbble",
      // "behance.com" => "behance",
      // "medium.com" => "medium",
      // "blogger.com" => "blogger",
      // "trello.com" => "trello",
      // "amazon.com" => "amazon",
      // "flickr.com" => "flickr",
      // "flipboard.com" => "flipboard",
      // "quora.com" => "quora",
      // "reddit.com" => "reddit-alien",
      // "tumblr.com" => "tumblr",
      // "wa.me" => "whatsapp",
      // "t.me" => "telegram",
      // "viber.com" => "viber",
    ];

    foreach ($socials as $socUrl) {
      foreach ($brands as $key => $iconName) {
        if (strpos($socUrl, $key)) { 
          $out .= "<div class='d-flex align-items-center'>";
            $out .= iconCaption($socUrl, $caption, $iconName, $linkClass, $iconClass, $iconSize);
            $out .= "<a class='$linkClass' rel='nofollow' title='$iconName' href='$socUrl' target='_blank'>$iconName</a>";
          $out .= "</div>";
        }
      }
    }
  }

  return $out;
}