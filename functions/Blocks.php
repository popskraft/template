<?php namespace ProcessWire;
// Отображение блоков на странице
function blocks($infoBlocks="")
{
  $infoBlocks = $infoBlocks ?: page("blocks") ;
  if (isset($infoBlocks) && count($infoBlocks)) {
    foreach ($infoBlocks as $bID) {
      $bID = ($bID->blocks_selectblock) ? $bID->blocks_selectblock : $bID;
      include "includes/blocks/{$bID->blocks_type->value}.php";
    }
  }
}
