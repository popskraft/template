<?php namespace ProcessWire;
echo blockHeader($blockId, "flickity-viewport-visible overflow-hidden", "container-xxl");
echo testimonialsSlider($blockId->pageref_testimonials);
echo blockFooter($blockId);