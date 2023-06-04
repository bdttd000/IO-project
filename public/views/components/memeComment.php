<?php

require_once "src/models/Comment.php";
require_once "src/repository/UserRepository.php";

function MemeComment(Comment $comment, bool $isEven): string
{
    $userRepository = new UserRepository();
    $user = $userRepository->getUserById($comment->getUserID());

    if ($isEven) {
        $output = '<div class="meme-comment-even">';
    } else {
        $output = '<div class="meme-comment-odd">';
    }

    $output .= '<div class="meme-user-date">';
    $output .= '<a href="profile?userid=' . $user->getUserID() . '" class="meme-user-info flex flex-row">';

    $output .= '<img src="public/uploads/avatars/';
    $output .= ($user->getAvatarUrl()) ? $user->getAvatarUrl() : 'unknown.png';
    $output .= '" class="comment-user-avatar">';
    $output .= '<div class="comment-user-name"><h4>';
    $output .= $user->getNickname();
    $output .= '</h4></div>';
    $output .= '</a>';

    $output .= '<div class="comment-meme-date"><h4>';
    $output .= $comment->getCreationDate();
    $output .= '</h4></div>';
    $output .= '</div>';
    $output .= '<p class="meme-comment-content">';
    $output .= $comment->getContent();
    $output .= '</p>';

    $output .= '</div>';
    return $output;
}