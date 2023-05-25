<?php

require_once 'src/repository/MemeRepository.php';

function RecommendedMeme(): string
{
    $memeRepository = new MemeRepository();
    $bestWeek = $memeRepository->getBestMemes(3, 7);
    $bestMonth = $memeRepository->getBestMemes(3, 30);

    $output = '<aside class="recommended-memes-aside flex flex-column">';


    $output .= '<div class="recommended-meme-sticky"><div class="recommended-memes flex flex-center flex-column">';
    $output .= '<div class="recommended-meme-box flex flex-center flex-column drop-shadow">';
    $output .= '<div class="recommended-meme-title"><h2>Naj tygodnia</h2></div>';
    foreach ($bestWeek as $meme) {
        $output .= '<div class="recommended-meme-card"><img src="public/uploads/memes/';
        $output .= $meme['photourl'];
        $output .= '" alt="photo-url" />';
        $output .= '<div class="flex flex-center">' . $meme['title'] . '</div>';
        $output .= '</div>';
    }

    $output .= '</div></div></div>';

    $output .= '<div class="recommended-meme-sticky"><div class="recommended-memes flex flex-center flex-column">';
    $output .= '<div class="recommended-meme-box flex flex-center flex-column drop-shadow">';
    $output .= '<div class="recommended-meme-title"><h2>Naj miesiąca</h2></div>';
    foreach ($bestMonth as $meme) {
        $output .= '<div class="recommended-meme-card"><img src="public/uploads/memes/';
        $output .= $meme['photourl'];
        $output .= '" alt="photo-url" />';
        $output .= '<div class="flex flex-center">' . $meme['title'] . '</div>';
        $output .= '</div>';
    }

    $output .= '</div></div></div>';

    $output .= '</aside>';

    return $output;
}