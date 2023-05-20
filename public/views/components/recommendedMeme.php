<?php

function RecommendedMeme($content): string 
{
    $output = '<div class="recommended-meme-container flex flex-container flex-column flex-center">';
    $output .= '<div class="recommended-meme-photo-container flex flex-container flex-center">';
    $output .= '<img class="recommended-meme-photo drop-shadow" src="'.$content['image'].'">';
    $output .= '</div>';

    $output .= '<div class="recommended-meme-title flex flex-container flex-center"><h4>';
    $output .= $content['title'];
    $output .= '</h4></div></div>';
    return $output;
}