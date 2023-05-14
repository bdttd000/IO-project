<?php

function Meme($content): string 
{
    $output = '
    <div class="meme">

    <div class="meme-content">
    <div class="meme-title-and-likes">';
    $output .= '<div class="meme-title drop-shadow">';
    $output .= $content['title'];
    $output .= '</div>';
    $output .= '<div class="meme-likes-and-buttons">';
    $output .= '<img src="public/img/meme/minus-solid.svg" class="minus-button">';
    $output .= '<div class="meme-likes">';
    $output .= $content['likes'];
    $output .= '</div><img src="public/img/meme/plus-solid.svg" class="plus-button">';
    $output .= '</div></div>';

    $output .= '<div class="meme-user-date-favorite">';
    $output .= '<div class="user-info">';
    $output .= '<img src="public/img/meme/plus-solid.svg" class="user-avatar">';
    $output .= '<div class="user-name">';
    $output .= $content['username'];
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="meme-date">';
    $output .= $content['meme-date'];
    $output .= '</div>';
    $output .= '<img src="public/img/sidebar-favorites/plus-solid.svg" class="meme-favorite">';
    $output .= '</div>';

    $output .= '<div class="meme-photo-container">';
    $output .= '<div class="meme-photo">';
    $output .= '<img src="public/img/meme/1023.jpg">';
    $output .= '</div></div>';

    $commentArray = [
        'number' => 1,
        'avatar' => 'avatar',
        'username' => 'Username',
        'meme-date' => '14.05.2023',
        'comment' => 'Test',
    ];
    $commentArray2 = [
        'number' => 2,
        'avatar' => 'avatar',
        'username' => 'Username2',
        'meme-date' => '15.05.2023',
        'comment' => 'Test drugi komentarz',
    ];
    $commentArray3 = [
        'number' => 3,
        'avatar' => 'avatar',
        'username' => 'Username3',
        'meme-date' => '16.05.2023',
        'comment' => 'Test trzeci komentarz ',
    ];
   
    $output .= memeComment($commentArray);
    $output .= memeComment($commentArray2);
    $output .= memeComment($commentArray3);

    $output .= $content['button'];

    $output .= '</div></div>';

    return $output;
}