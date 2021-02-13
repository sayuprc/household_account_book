<?php require_once('header.php'); ?>
    <div>
        <a href="/receipt/create">レシート作成</a>
    </div>
    <div>
        <?php if (!empty($data['receipts'])): ?>
        <?php else: ?>
            データがありません。
        <?php endif; ?>
    </div>
<?php require_once('footer.php'); ?>