<?php namespace ProcessWire;
echo blockHeader($blockID, "", "cover", 1);
echo pageMenu($blockID->pageref_pages);
echo blockFooter($blockID);