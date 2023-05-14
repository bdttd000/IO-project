<?php

function memeComment($content): string 
{
    if ($content['number'] % 2) {
        $output = '<div class="meme-comment-even">';    
    } else {
        $output = '<div class="meme-comment-odd">';    
    }
    
    $output .= '<div class="meme-user-date">';
    $output .= '<div class="user-info">';
    $output .= '<img src="public/img/meme/plus-solid.svg" class="comment-user-avatar">';
    $output .= '<div class="comment-user-name">';
    $output .= $content['username'];
    $output .= '</div>';
    $output .= '</div>';
    
    $output .= '<div class="comment-meme-date">';
    $output .= $content['meme-date'];
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="comment-content">';
    $output .= $content['comment'];
    $output .= '</div>';

    $output .= '</div>';
    return $output;
}