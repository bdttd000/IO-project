<?php

function MemeLikes(int $likes, int $memeid): string
{
    $SessionController = new SessionController();
    $userInfo = $SessionController->unserializeUser();

    $output = '<div class="meme-likes-and-buttons drop-shadow">';

    if (isset($userInfo) && $userInfo->getUserID()) {
        $output .= '
        <div 
            data-likes-action="addDislike" 
            data-meme-id="' . $memeid . '" 
            class="flex flex-center drop-shadow-animate meme-likes-symbol meme-likes-symbol-minus like-button"
        >
            &#8722;
        </div>
        ';
    } else {
        $output .= '
        <a 
        href="login"
        class="flex flex-center drop-shadow-animate meme-likes-symbol meme-likes-symbol-minus like-button"
        >&#8722</a>
        ';
    }

    $output .= '<div class="meme-likes"><h3 data-meme-id=' . $memeid . ' class="meme-likes-number">' . $likes . '</h3></div>';

    if (isset($userInfo) && $userInfo->getUserID()) {
        $output .= '
        <div 
            data-likes-action="addLike"
            data-meme-id="' . $memeid . '" 
            class="flex flex-center drop-shadow-animate meme-likes-symbol meme-likes-symbol-plus like-button"
        >
            &#43;
        </div>
        ';
    } else {
        $output .= '
        <a 
            href="login"
            class="flex flex-center drop-shadow-animate meme-likes-symbol meme-likes-symbol-plus like-button"
        >
            &#8722
        </a>
        ';
    }

    $output .= '</div>';

    return $output;
}