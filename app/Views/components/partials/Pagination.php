<?php
$page = isset($page) ? $page : 1;
$uri = service('uri');
$segment = $uri->getSegment(1);
?>

<!-- Pagination -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= site_url($segment . '?page=' . ($page - 1)) ?>" tabindex="-1"
                aria-disabled="true">Previous</a>
        </li>

        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
            <a class="page-link" href="<?= site_url($segment . '?page=' . $i) ?>"><?= $i ?></a>
        </li>
        <?php endfor; ?>

        <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= site_url($segment . '?page=' . ($page + 1)) ?>">Next</a>
        </li>
    </ul>
</nav>