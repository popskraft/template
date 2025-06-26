<?php
namespace ProcessWire;

function pager($items) {
  $out = $items->renderPager(
    array(
      'numPageLinks' => 5,
      'previousItemLabel' => icon("arrow-left-circle"),
      'nextItemLabel' => icon("arrow-right-circle"),
      'listMarkup' => "<div class='MarkupPagerNav mt-5 d-flex justify-content-center align-items-center text-center'>{out}</div>",
      'itemMarkup' => "<span class='pagination-item p-2 {class}'>{out}</span>",
      'linkMarkup' => "<a class='pagination-link text-dark' href='{url}'>{out}</a>",
      'currentItemClass' => "active"
    )
  );

  return $out;
}
