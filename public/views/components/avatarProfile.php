<?php

function AvatarPofile($content = null): string
{
    if (!$content) {
        $content = 'unknown.png';
    }

    $output = "<img class='avatarProfile' src='public/uploads/avatars/" . $content . "' alt='Users photo'></img>";

    return $output;
}