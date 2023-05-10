<?php

function Textarea($content): string
{
    $output = "<textarea class='textarea' name='" .
        $content['name']
        . "' placeholder='" .
        $content['placeholder']
        . "'>";

    if (isset($content['value'])) {
        $output .= $content['value'];
    }

    $output .= "</textarea>";

    return $output;
}