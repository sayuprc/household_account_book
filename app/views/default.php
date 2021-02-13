<?php require_once('header.php'); ?>
    <div>
        <?php foreach ($params as $param): ?>
            <?= $param; ?><br>
        <?php endforeach; ?>

        指定なし
    </div>
<?php require_once('footer.php'); ?>