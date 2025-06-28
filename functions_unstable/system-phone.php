<?php namespace ProcessWire;

// Phone link from phone source
function phone($phone, $class = '', $iconIsOn = '', $iconClass = '', $iconSize = 16)
{
  $out = '';

  $iconClass = $iconClass ?: 'rounded-circle p-2 me-2 ms-n1 border text-gray';
  $icon = ($iconIsOn) ? icon('phone', $iconSize, "d-inline-flex $iconClass") : '';

  if ($phone) {
    $phoneClean = preg_replace('/[^0-9,+]/', '', $phone);
    $out .= "<a class='$class me-2 phone-main d-inline-flex align-items-center text-nowrap' href='tel:$phoneClean'>{$icon}{$phone}</a>";
  }

  return $out;
}
