<?php

function Button($content): string
{
    $output = "<button class='button drop-shadow-animate' type='" .
        $content['type']
        . "'>" .
        $content['value']
        . "</button>"
    ;

    return $output;
}