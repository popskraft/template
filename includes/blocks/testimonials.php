<?php namespace ProcessWire;
echo blockHeader($bID, "flickity-viewport-visible overflow-hidden", "container-xxl");
echo testimonialsSlider($bID->pageref_testimonials);
echo blockFooter($bID);