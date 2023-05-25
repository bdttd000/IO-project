<?php

require_once 'paginationButton.php';

function Pagination(string $pageName, int $pageNumber, int $pageCount): string
{
    $previousPage = [
        'link' => $pageName . '?page=' . ($pageNumber - 1),
        'value' => '<img src="public/img/sidebar/arrow-left.svg" alt="arrow-left">',
    ];

    $actualPage = [
        'link' => 'javascript:void(0)',
        'value' => '<span>Strona ' . $pageNumber . '</span>',
    ];

    $nextPage = [
        'link' => $pageName . '?page=' . ($pageNumber + 1),
        'value' => '<img src="public/img/sidebar/arrow-right.svg" alt="arrow-right">',
    ];

    $randomPage = [
        'link' => $pageName . '?page=' . rand(1, $pageCount),
        'value' => '<img src="public/img/sidebar/random-meme.svg" alt="random-meme">',
    ];

    $output = '<div class="pagination flex flex-center">';

    if ($pageNumber != 1) {
        $output .= PaginationButton($previousPage);
    }

    $output .= PaginationButton($actualPage);

    if ($pageNumber != $pageCount) {
        $output .= PaginationButton($nextPage);
    }

    $output .= PaginationButton($randomPage);

    $output .= '</div>';

    return $output;
}