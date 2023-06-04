<?php

require_once 'src/repository/MemeRepository.php';

function RecommendedMeme(int $numberOfWeekMemes = 3, int $numberOfMonthMemes = 3): string
{
    $memeRepository = new MemeRepository();
    $bestWeek = $memeRepository->getBestMemes($numberOfWeekMemes, 7);
    $bestMonth = $memeRepository->getBestMemes($numberOfMonthMemes, 30);

    $output = '<aside class="right-aside recommended-memes-aside flex flex-column">';

    if ($numberOfWeekMemes > 0) {
        $output .= '<div class="recommended-meme-sticky"><div class="recommended-memes flex flex-center flex-column">';
        $output .= '<div class="recommended-meme-box flex flex-center flex-column drop-shadow">';
        $output .= '<div class="recommended-meme-title"><h2>Top tygodnia</h2></div>';
        foreach ($bestWeek as $meme) {
            $output .= '<a href="meme?memeid=' . $meme['memeid'] . '" class="recommended-meme-card"><img src="public/uploads/memes/';
            $output .= $meme['photourl'];
            $output .= '" alt="photo-url" />';
            $output .= '<div class="flex flex-center">' . $meme['title'] . '</div>';
            $output .= '</a>';
        }

        $output .= '</div></div></div>';
    }

    if ($numberOfMonthMemes > 0) {
        $output .= '<div class="recommended-meme-sticky"><div class="recommended-memes flex flex-center flex-column">';
        $output .= '<div class="recommended-meme-box flex flex-center flex-column drop-shadow">';
        $output .= '<div class="recommended-meme-title"><h2>Top miesiąca</h2></div>';
        foreach ($bestMonth as $meme) {
            $output .= '<a href="meme?memeid=' . $meme['memeid'] . '" class="recommended-meme-card"><img src="public/uploads/memes/';
            $output .= $meme['photourl'];
            $output .= '" alt="photo-url" />';
            $output .= '<div class="flex flex-center">' . $meme['title'] . '</div>';
            $output .= '</a>';
        }

        $output .= '</div></div></div>';
    }

    $output .= '</aside>';

    return $output;
}