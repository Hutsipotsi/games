<?php

function charFix($str) {
    $str = str_replace("&auml;", "ä", $str);
    $str = str_replace("&Auml;", "Ä", $str);
    $str = str_replace("&ouml;", "ö", $str);
    $str = str_replace("&Ouml;", "Ö", $str);

    return $str;
}

// EOF