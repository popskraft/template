<?php namespace ProcessWire;
function menuFooter($menuFooterStructure, $menuItems, $class="")
{
  $class = $class ?: "d-inline-block link mb-2" ;
  $out = "";
  foreach ($menuFooterStructure as $pageID => $nestedChildren) {
      $itemTitle = $menuItems->get("id=$pageID")->pageref_select->title;
      $itemAltTitle = $menuItems->get("id=$pageID")->text_1;
      $itemUrl = $menuItems->get("id=$pageID")->pageref_select->url;
      $itemAltUrl = $menuItems->get("id=$pageID")->link;
      $itemTitle = $itemAltTitle ?: $itemTitle;
      $itemUrl = $itemAltUrl ?: $itemUrl;

      $out .= "<a class='$class' href='$itemUrl'>$itemTitle</a><br>";
    }
  return $out;
}