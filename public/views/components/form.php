<?php

function Form($content): string
{
    $output = "<form class='flex flex-column flex-center form-login' action='" .
        $content['action']
        . "' method='" .
        $content['method']
        . "'>";

    $output .= $content['content'];

    $output .= "</form>";

    return $output;
}