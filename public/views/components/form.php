<?php

function Form($content): string
{
    $output = "<form class='flex flex-column flex-center form-login' action='" .
        $content['action']
        . "' method='" .
        $content['method']
        . "' enctype='multipart/form-data'"
        . "' id='" . $content['id'] ."'>";

    $output .= $content['content'];

    $output .= "</form>";

    return $output;
}