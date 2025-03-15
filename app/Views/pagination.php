<div class="divider"></div>
    <?php if (!$keyword) : ?>
    <div class="group-action data-subtitle" id="pagination">
        <?php
        $start = ($currentPage - 1) * $perpage + 1;
        $end = min($start + $perpage - 1, $total);
        ?>
        <span>Showing <?= $start ?> to <?= $end ?> of <?= $total ?> entries</span>
        
        <ul class="pagination ">
        <?php if ($currentPage > 1): ?>
        <li><a href="?page=<?= $currentPage - 1 ?>">Prev</a></li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li><a href="?page=<?= $i ?>" class="<?= ($i == $currentPage) ? 'active' : '' ?>"><?= $i ?></a></li>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <li><a href="?page=<?= $currentPage + 1 ?>">Next</a></li>
    <?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>