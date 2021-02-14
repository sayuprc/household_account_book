<?php

require_once('Receipt.php');

$rp = new Receipt();
$nextid = $rp->getNextId();

if ($nextid === null) {
    $nextid = 1;
}

if (isset($_POST['receipt_id']) && isset($_POST['total_amount'])) {
    $params = $_POST;
    $status = $rp->create($params);

    if ($status) {
        header('Location: create_detail.php?receipt_id=' . $nextid);
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシート作成</title>
</head>
<body>
    <header>
        <a href="/index.php">一覧</a>
    </header>
    <?php if (!empty($rp->messages)): ?>
        <?php foreach($rp->messages as $message): ?>
            <?= $message; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="hidden" name="receipt_id" value="<?= $nextid; ?>">
        レシート名: <input type="text" name="receipt_name"><br>
        合計金額: <input type="text" name="total_amount"><br>
        購入日: <input type="date" name="purchased_at"><br>
        <input type="submit" value="作成">
    </form>
</body>
</html>