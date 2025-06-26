<?php namespace ProcessWire;

function prevNext($rowClass = null)
{
    // Навигация по соседним страницам
    $pagePrev = page()->prev;
    $pageNext = page()->next;
    $rowClass = (isset($rowClass)) ? $rowClass : "row-cols-1 row-cols-md-2 g-3 g-md-4 mx-auto mt-5 fs-6 fs-md-5";

    $out = "";

    if ($pagePrev->url || $pageNext->url) {
        $out .= "<div id=\"prevNext\" class=\"row $rowClass\">";
        
        // Previous Page
        $out .= "<div class=\"col py-3 border-bottom border-bottom-lg-0 border-end-lg text-gray\">";
        if ($pagePrev->url) {
            $out .= "<a class=\"d-inline-flex align-items-center justify-content-start text-gray\" href=\"" . $pagePrev->url . "\">";
            $out .= icon("arrow-left-circle", 24, "d-inline-flex me-3");
            $out .= "<span class='link'>";
            $out .= $pagePrev->title;
            $out .= "</span>";
            $out .= "</a>";
        }
        $out .= "</div>";

        // Next Page
        $out .= "<div class=\"col py-3 text-end text-gray\">";
        if ($pageNext->url) {
            $out .= "<a class=\"d-inline-flex align-items-center justify-content-end text-gray\" href=\"" . $pageNext->url . "\">";
            $out .= "<span class='link'>";
            $out .= $pageNext->title;
            $out .= "</span>";
            $out .= icon("arrow-right-circle", 24, "d-inline-flex ms-3");
            $out .= "</a>";
        }
        $out .= "</div>";

        $out .= "</div>";
    }

    return $out;
}