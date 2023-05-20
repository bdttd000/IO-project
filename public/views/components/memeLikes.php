<?php

function MemeLikes($content): string
{
    $output = '<div class="meme-likes-and-buttons drop-shadow">
    <a class="flex flex-center drop-shadow-animate meme-likes-symbol meme-likes-symbol-minus" href="#">&#8722;</a>
    <div class="meme-likes"> <h3 class="meme-likes-number">'
    . $content . '</h3>
    </div> <a class="flex flex-center drop-shadow-animate meme-likes-symbol meme-likes-symbol-plus" href="#">&#43;</a> 
    </div>';

    return $output;
}