<?php

function Card($content): string
{
    $output = '
    <div class="card">
    <div class="card-title drop-shadow"><h2>
    ';

    $output .= $content['title'];

    $output .= '</h2></div><div class="card-content">';

    $output .= $content['content'];

    $output .= '
    </div></div>
    ';

    return $output;
}