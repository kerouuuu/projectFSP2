<?php
function table_Paging($page, $total_pages) {
    $pagination_html = '<div class="pagination">';
    if ($page > 1) {
        $pagination_html .= '<a href="tableteam.php?page=1">First</a>';
    }
    if ($page > 1) {
        $pagination_html .= '<a href="tableteam.php?page=' . ($page - 1) . '">Previous</a>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $page) ? 'class="active"' : '';
        $pagination_html .= '<a href="tableteam.php?page=' . $i . '" ' . $active_class . '>' . $i . '</a>';
    }
    if ($page < $total_pages) {
        $pagination_html .= '<a href="tableteam.php?page=' . ($page + 1) . '">Next</a>';
    }
    if ($page < $total_pages) {
        $pagination_html .= '<a href="tableteam.php?page=' . $total_pages . '">Last</a>';
    }
    $pagination_html .= '</div>';
    return $pagination_html;
}
?>
