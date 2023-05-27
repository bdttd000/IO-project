<?php

function MemeLikes(int $likes, int $memeid): string
{
    $SessionController = new SessionController();
    $userInfo = $SessionController->unserializeUser();

    $output = '<div class="meme-likes-and-buttons drop-shadow">
    <div data-likes-action="like" class="flex flex-center drop-shadow-animate meme-likes-symbol meme-likes-symbol-minus like-button" href="';

    if (isset($userInfo) && $userInfo->getUserID()) {
        $output .= 'addDislike?memeid=' . $memeid . '&userid=' . $userInfo->getUserID();
    } else {
        $output .= 'login';
    }

    $output .= '">&#8722;</div><div class="meme-likes"> <h3 class="meme-likes-number">' . $likes . '</h3></div> 
    <div data-likes-action="dislike" class="flex flex-center drop-shadow-animate meme-likes-symbol meme-likes-symbol-plus like-button" href="';

    if (isset($userInfo) && $userInfo->getUserID()) {
        $output .= 'addLike?memeid=' . $memeid . '&userid=' . $userInfo->getUserID();
    } else {
        $output .= 'login';
    }

    $output .= '">&#43;</div> 
    </div>';

    return $output;
}