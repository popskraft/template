<?php namespace ProcessWire;

/**
* CLEAN STRING 
* ========================================
*/
function clean($string)
{
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

/**
 *  TRUNCATE
 *  ========================================
*/
function truncate($text, $maxLetters)
{
  // Ensure the text is encoded in UTF-8
  $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');

  if (mb_strlen($text, 'UTF-8') <= $maxLetters) {
    return $text;
  }

  return mb_substr($text, 0, $maxLetters, 'UTF-8') . '...';
}

/**
* SUMMARIZE HOOK 
* ========================================
* https://processwire.com/blog/posts/pw-3.0.28/
* Generate a summary of 'body', max 300 characters (default)
* $summary = $page->summarize('body');
* Generate a summary of 'body', max 500 characters
* $summary = $page->summarize('body', 500);
* Same as above, but uses 'summary' if available, 'body' if not
* $summary = $page->summarize('text_summary|body', 500); 
*/

$wire->addHook('Page::summarize', function($event) {
  $fieldName = $event->arguments(0);
  if(!$fieldName) throw new WireException("No field provided"); {
    // get max length or use 300 as default if none provided
    $maxLength = (int) $event->arguments(1);
  }
  if(!$maxLength) $maxLength = 300; {
    $page = $event->object;
    $value = $page->get($fieldName);
  }
  if(!$value || !strlen($value)) {
    // requested value is blank, nothing more to do
    $event->return = "";

    return;
  }
  // get beginning of value, without any HTML in it (if any)
  $value = mb_substr(strip_tags($value), 0, $maxLength);
  // if output formatting on, make sure value is entity encoded
  if($page->of()) {
    $value = $event->sanitizer->entities1($value);
  }
  if($value && strlen($value) >= $maxLength) {
    // limit length of returned value between words
    // by truncating to the last space character
    $value = substr($value, 0, strrpos($value, ' '));
    // append an ellipsis to indicate there is more
    $value .= '&hellip;';
  }
  $event->return = $value;
}); // END Summarize hook

/**
* HEX COLOR TO RGBA IN _HEAD.PHP 
* ========================================
*/
function hex2rgb($color, $alpha = false)
{
  $default = 'rgb(255,255,255)';
  if (empty($color) || $color === null)
    return $default;
  if ($color[0] == '#')
    $color = substr($color, 1);
  if (strlen($color) == 6)
    $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
  elseif (strlen($color) == 3)
    $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
  else
    return $default;
  $rgb = array_map('hexdec', $hex);
  if ($alpha) {
    if (abs($alpha) > 1)
      $alpha = 1.0;
      $output = 'rgba(' . implode(",", $rgb) . ',' . $alpha . ')';
  } else {
      $output = 'rgb(' . implode(",", $rgb) . ')';
  }
  return $output;
} // END HEX color to RGBA