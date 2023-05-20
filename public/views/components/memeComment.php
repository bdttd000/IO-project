<?php

function MemeComment($content): string 
{
    if ($content['number'] % 2) {
        $output = '<div class="meme-comment-even">';    
    } else {
        $output = '<div class="meme-comment-odd">';    
    }
    
    $output .= '<div class="meme-user-date">';
    $output .= '<div class="meme-user-info flex flex-row">';
    $output .= '<img src="'.$content['avatar'].'" class="comment-user-avatar">';
    $output .= '<div class="comment-user-name"><h4>';
    $output .= $content['username'];
    $output .= '</h4></div>';
    $output .= '</div>';
    
    $output .= '<div class="comment-meme-date"><h4>';
    $output .= $content['meme-date'];
    $output .= '</h4></div>';
    $output .= '</div>';
    $output .= '<p class="meme-comment-content">';
    $output .= $content['comment'];
    $output .= '</p>';

    $output .= '</div>';
    return $output;
}