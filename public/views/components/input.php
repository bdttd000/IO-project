<?php

function Input($content): string
{
    $output = "<input class='input' type='" .
        $content['type']
        . "' name='" .
        $content['name']
        . "' placeholder='" .
        $content['placeholder']
        . "'";

    if (isset($content['value'])) {
        $output .= " value='" .
            $content['value'] . "'";
    }

    $output .= ">";

    return $output;
}