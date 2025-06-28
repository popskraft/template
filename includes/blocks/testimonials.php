<?php namespace ProcessWire;
echo blockHeader($blockID, "flickity-viewport-visible overflow-hidden", "container-xxl");
echo testimonialsSlider($blockID->pageref_testimonials);
echo blockFooter($blockID);