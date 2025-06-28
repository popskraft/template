<?php namespace ProcessWire;
// Отображение блоков на странице
function blocks($infoBlocks="")
{
  $infoBlocks = $infoBlocks ?: page("blocks") ;
  if (isset($infoBlocks) && count($infoBlocks)) {
    foreach ($infoBlocks as $blockID) {
      $blockID = ($blockID->blocks_selectblock) ? $blockID->blocks_selectblock : $blockID;
      include "includes/blocks/{$blockID->blocks_type->value}.php";
    }
  }
}
