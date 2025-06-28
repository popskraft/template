<?php namespace ProcessWire;
echo blockHeader($blockId, "", "cover", 1);
echo pageMenu($blockId->pageref_pages);
echo blockFooter($blockId);