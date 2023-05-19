<?php

function ButtonRedirect($content): string
{
    $output = "<a class='text-center' href='" .
        $content['link']
        . "'><button class='button drop-shadow-animate'>" .
        $content['value']
        . "</button></a>"
    ;

    return $output;
}


?>