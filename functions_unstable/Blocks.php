<?php namespace ProcessWire;
// Отображение блоков на странице
function blocks($infoBlocks="")
{
  $infoBlocks = $infoBlocks ?: page("blocks") ;
  if (isset($infoBlocks) && count($infoBlocks)) {
    foreach ($infoBlocks as $blockId) {
      $blockId = ($blockId->blocks_selectblock) ? $blockId->blocks_selectblock : $blockId;
      include "includes/blocks/{$blockId->blocks_type->value}.php";
    }
  }
}
