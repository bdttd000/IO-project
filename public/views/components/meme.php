<?php

function Meme($content): string 
{
    $output = '
    <div class="meme">

    <div class="meme-content">
    <div class="meme-title-and-likes">';
    $output .= '<div class="meme-title drop-shadow"><h3 class="meme-title-content">';
    $output .= $content['title'];
    $output .= '</h3></div>';
    $output .= MemeLikes($content['likes']);
    $output .= '</div>';

    $output .= '<div class="meme-user-date-favorite">';
    $output .= '<div class="meme-user-info">';
    $output .= '<img src="'.$content['avatar'].'" class="meme-user-avatar">';
    $output .= '<div class="meme-user-name"><h3>';
    $output .= $content['username'];
    $output .= '</h3></div>';
    $output .= '</div>';
    $output .= '<div class="meme-date"><h3>';
    $output .= $content['meme-date'];
    $output .= '</h3></div>';
    $output .= '<p id="meme-favorite-button">&#9825</p>';
    $output .= '</div>';

    $output .= '<div class="meme-photo-container">';
    $output .= '<img class="meme-photo drop-shadow" src="'.$content['image'].'">';
    $output .= '</div>';

    $commentArray = [
        'number' => 1,
        'avatar' => 'public/img/meme/plus-solid.svg',
        'username' => 'Username',
        'meme-date' => '14.05.2023',
        'comment' => 'Test',
    ];
    $commentArray2 = [
        'number' => 2,
        'avatar' => 'public/img/meme/plus-solid.svg',
        'username' => 'Username2',
        'meme-date' => '15.05.2023',
        'comment' => 'Test drugi komentarz',
    ];
    $commentArray3 = [
        'number' => 3,
        'avatar' => 'public/img/meme/plus-solid.svg',
        'username' => 'Username3',
        'meme-date' => '16.05.2023',
        'comment' => 'Test trzeci komentarz ',
    ];
   
    $output .= '<div>';
    $output .= MemeComment($commentArray);
    $output .= MemeComment($commentArray2);
    $output .= MemeComment($commentArray3);
    $output .= '</div>';

    $output .= $content['button'];

    $output .= '</div></div>';

    return $output;
}