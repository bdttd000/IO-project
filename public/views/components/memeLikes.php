<?php

function MemeLikes($content): string 
{
    $output = '<div class="meme-likes-and-buttons"r>';
    $output .= '<button class="minus-button drop-shadow-animate" href="">';
    $output .= '<img src="public/img/meme/minus-solid.svg"/>';
    $output .= '</button>';
    $output .= '<div class="meme-likes drop-shadow">';
    $output .= '<h4>999</h4>';
    $output .= '</div><button class="plus-button drop-shadow-animate href=""">';
    $output .= '<img src="public/img/meme/plus-solid.svg" />';
    $output .= '</button></div>';

    return $output;
}