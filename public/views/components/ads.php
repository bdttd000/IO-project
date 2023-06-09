<?php

require_once 'src/models/Ad.php';

function Ads($ads): string
{
    $output = '<aside class="recommended-memes-aside flex flex-column left-aside">';

    foreach ($ads as $ad) {
        $output .= '<div class="recommended-meme-sticky"><div class="recommended-memes flex flex-center flex-column">';
        $output .= '<div class="recommended-meme-box flex flex-center flex-column drop-shadow">';
        $output .= '<div class="recommended-meme-title"><h2>' . $ad->getTitle() . '</h2></div>';

        $output .= '<div class="recommended-meme-card"><img src="public/uploads/ads/';
        $output .= $ad->getPhotoUrl();
        $output .= '">';
        $output .= '</div>';

        $output .= '</div></div></div>';
    }

    $output .= '</aside>';

    return $output;
}