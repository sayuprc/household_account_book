<?php

require_once('Receipt.php');

$rp = new Receipt();

$receipts = $rp->all();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一覧</title>
</head>
<body>
    <header>
        <a href="/create_receipt.php">レシート作成</a>
    </header>
    <?php if (!empty($receipts)): ?>
        <?php foreach($receipts as $receipt): ?>
            <a href="list.php?receipt_id=<?= $receipt['receipt_id']; ?>"><?= $receipt['receipt_name']; ?></a>
            <?= number_format($receipt['total_amount']); ?>円
        <?php endforeach; ?>
    <?php else: ?>
        データがありません。
    <?php endif; ?>
</body>
</html>