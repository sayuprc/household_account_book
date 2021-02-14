<?php

require_once('Receipt.php');
require_once('ReceiptDetail.php');

$rp = new Receipt();
$rdp = new ReceiptDetail();

if (!isset($_GET['receipt_id'])) {
    header('Location: index.php');
}

$receiptId = $_GET['receipt_id'];

$receipt = $rp->find($receiptId);
$details = $rdp->find($receiptId);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細表示</title>
</head>
<body>
    <div>
        <?php if (!empty($receipt)): ?>
            レシート名: <?= $receipt['receipt_name']; ?><br>
            合計金額: <?= number_format($receipt['total_amount']); ?>円<br>
            購入日: <?= $receipt['purchased_at']; ?>
        <?php endif; ?>
    </div>
    <div>
        <?php if (!empty($details)): ?>
            <?php foreach ($details as $detail): ?>
                <div>
                    商品名: <?= $detail['item_name']; ?><br>
                    数量: <?= $detail['quantity']; ?><br>
                    金額: <?= number_format($detail['amount']); ?>円<br>
                    支払日: <?= $detail['paymented_at']; ?><br>
                    支払い方法: 
                    <select disabled="disabled">
                        <option <?php if ($detail['payment_type'] === 1) :?>selected="selected"<?php endif; ?>>クレジットカード</option>
                        <option <?php if ($detail['payment_type'] === 2) :?>selected="selected"<?php endif; ?>>現金</option>
                    </select><br>
                    支払い回数: <?= $detail['payment_count']; ?><br>
                    支払状況:
                    <select disabled="disabled">
                        <option <?php if ($detail['is_payed'] === 0) :?>selected="selected"<?php endif; ?>>未決済</option>
                        <option <?php if ($detail['is_payed'] === 1) :?>selected="selected"<?php endif; ?>>決済済</option>
                    </select><br>
                    カテゴリ: 
                    <select disabled="disabled">
                        <option <?php if ($detail['category_id'] === 0) :?>selected="selected"<?php endif; ?>>未設定</option>
                    </select><br>
                    備考: <textarea disabled="disabled"><?= $detail['memo']; ?></textarea>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>