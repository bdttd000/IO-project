<?php

require_once "public/views/components/memeLikes.php";
require_once "public/views/components/buttonRedirect.php";
require_once "public/views/components/memeComment.php";

function Meme(Meme $meme): string
{
    $userRepository = new UserRepository();
    $user = $userRepository->getUserById($meme->getUserID());

    $buttonArray = [
        'link' => 'meme?memeid=' . $meme->getMemeID(),
        'value' => 'Zobacz więcej / Dodaj komentarz'
    ];

    $output = '
    <div class="meme">

    <div class="meme-content">
    <div class="meme-title-and-likes">';
    $output .= '<div class="meme-title drop-shadow"><a href="meme?memeid=' . $meme->getMemeID() . '" class="a-link"><h3 class="meme-title-content">';
    $output .= $meme->getTitle();
    $output .= '</h3></a></div>';
    $output .= MemeLikes($meme->getLikes(), $meme->getMemeID());
    $output .= '</div>';

    $output .= '<div class="meme-user-date-favorite">';
    $output .= '<a href="profile?userid=' . $user->getUserID() . '" class="meme-user-info a-link">';

    $output .= '<img src="public/uploads/avatars/';
    $output .= ($user->getAvatarUrl()) ? $user->getAvatarUrl() : 'unknown.png';
    $output .= '" class="meme-user-avatar">';

    $output .= '<div class="meme-user-name"><h3>';
    $output .= $user->getNickname();
    $output .= '</h3></div>';
    $output .= '</a>';
    $output .= '<div class="meme-date"><h3>';
    $output .= $meme->getCreationDate();
    $output .= '</h3></div>';
    $output .= '<p id="meme-favorite-button">&#9825</p>';
    $output .= '</div>';

    $output .= '<div class="meme-photo-container">';
    $output .= '<img class="meme-photo drop-shadow" src="public/uploads/memes/' . $meme->getPhotoUrl() . '">';
    $output .= '</div>';

    $output .= '<div>';

    $counter = 1;
    foreach ($meme->getComments() as $comment) {
        if ($counter > 2)
            continue;
        $output .= MemeComment($comment, (bool) ($counter % 2));
        $counter++;
    }
    $output .= '</div>';

    $output .= ButtonRedirect($buttonArray);



    $output .= '</div></div>';

    return $output;
}