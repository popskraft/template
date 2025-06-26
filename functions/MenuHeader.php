<?php namespace ProcessWire;
function menuHeader($menuHeaderStructure, $menuItems)
{
  $dropDownClass = "dropdown-menu mb-3 text-center text-lg-start shadow";

  $out = "";

  foreach ($menuHeaderStructure as $pageID => $nestedChildren) {
    $itemTitle = $menuItems->get("id=$pageID")->pageref_select->title;
    $itemAltTitle = $menuItems->get("id=$pageID")->text_1;
    $itemUrl = $menuItems->get("id=$pageID")->pageref_select->url;
    $itemAltUrl = $menuItems->get("id=$pageID")->link;
    $itemTitle = $itemAltTitle ?: $itemTitle;
    $itemUrl = $itemAltUrl ?: $itemUrl;

    if (is_array($nestedChildren)) {

      $out .= "<li class='nav-item dropdown'>";
        $out .= "<span class='nav-link' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$itemTitle " . icon("chevron-down", 16, "d-inline-block text-gray me-n2", 0, 0, "mb-1") . "</span>";
        $out .= "<ul class='$dropDownClass'>";
        foreach ($nestedChildren as $pageID => $nestedChildren) {
          $itemTitle = $menuItems->get("id=$pageID")->pageref_select->title;
          $itemAltTitle = $menuItems->get("id=$pageID")->text_1;
          $itemUrl = $menuItems->get("id=$pageID")->pageref_select->url;
          $itemAltUrl = $menuItems->get("id=$pageID")->link;
          $itemTitle = $itemAltTitle ?: $itemTitle;
          $itemUrl = $itemAltUrl ?: $itemUrl;
          $out .= "<li><a class='level-2 dropdown-item text-nowrap' href='$itemUrl'>$itemTitle</a></li>";
        }
        $out .= "</ul>";
      $out .= "</li>";
      
    } else {
      
      $out .= "<li class='nav-item'><a class='nav-link link' href='$itemUrl'>$itemTitle</a></li>";

    }
  }

  return $out;
}