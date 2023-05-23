<?php

function Pagination(string $pageName, int $pageNumber, int $pageCount): string
{
    $output = '<div class="pagination">';

    if ($pageNumber != 1) {
        $output .= '<a href="' . $pageName . '?page=' . ($pageNumber - 1) . '">Previous page</a>';
    }

    $output .= '<div>Actual page ' . $pageNumber . '</div>';

    if ($pageNumber != $pageCount) {
        $output .= '<a href="' . $pageName . '?page=' . ($pageNumber + 1) . '">Next page</div>';
    }

    $output .= '</div>';

    return $output;
}