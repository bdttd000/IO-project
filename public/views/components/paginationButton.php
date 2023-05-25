<?php

function PaginationButton($content): string
{
    $output = "<a class='pagination-a text-center' href='" .
        $content['link']
        . "'><button class='pagination-button drop-shadow-animate'>" .
        $content['value']
        . "</button></a>"
    ;

    return $output;
}


?>