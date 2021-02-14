<?php

require_once('ReceiptDetail.php');

if (empty($_GET['receipt_id'])) {
    header('Location: index.php');
}

$rdp = new ReceiptDetail();

$receiptId = $_GET['receipt_id'];
$nextSerial = $rdp->getNextSerial($receiptId);
if ($nextSerial === null) {
    $nextSerial = 1;
}

if (isset($_POST['isCreate']) && $_POST['isCreate'] === '1') {
    $params = $_POST;
    unset($params['isCreate']);
    $status = $rdp->create($params);

    if ($status) {
        header('Location: index.php');
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>明細作成</title>
</head>
<body>
    <header>
        <a href="index.php">一覧</a>
    </header>
    <?php if (!empty($rdp->messages)): ?>
        <?php foreach($rdp->messages as $message): ?>
            <?= $message; ?><br>
        <?php endforeach; ?>
    <?php endif; ?>
    <button onclick="add()">明細追加</button>
    <form action="" method="POST" id="form">
        <input type="hidden" name="isCreate" value="1">
        <input type="submit" value="作成">
        <div class="item_<?= $nextSerial; ?>">
            <input type="hidden" name="<?= $nextSerial; ?>[receipt_id]" value="<?= $receiptId; ?>"><br>
            <input type="hidden" name="<?= $nextSerial; ?>[serial]" value="<?= $nextSerial; ?>"><br>
            品名: <input type="text" name="<?= $nextSerial; ?>[item_name]"><br>
            個数: <input type="text" name="<?= $nextSerial; ?>[quantity]"><br>
            料金: <input type="text" name="<?= $nextSerial; ?>[amount]"><br>
            購入日: <input type="date" name="<?= $nextSerial; ?>[purchased_at]"><br>
            支払日: <input type="date" name="<?= $nextSerial; ?>[paymented_at]"><br>
            支払方法: 
            <select name="<?= $nextSerial; ?>[payment_type]">
                <option value="1">クレジットカード</option>
                <option value="2">現金</option>
            </select><br>
            支払回数: <input type="text" name="<?= $nextSerial; ?>[payment_count]"><br>
            支払状態: 
            <select name="<?= $nextSerial; ?>[is_payed]">
                <option value="0">未支払</option>
                <option value="1">支払済</option>
            </select><br>
            カテゴリー: 
            <select name="<?= $nextSerial; ?>[category_id]">
                <option value="0">未設定</option>
            </select><br>
            備考: <textarea name="<?= $nextSerial; ?>[memo]"></textarea><br>
        </div>
    </form>
    <script>
        let form = document.getElementById('form');
        let currentSerial = <?= $nextSerial; ?>;
        let current = document.getElementsByClassName('item_' + currentSerial)[0];

        let nextSerial = ++currentSerial;
        function add() {
            let next = current.cloneNode(true);

            Array.prototype.forEach.call(next.children, function(e) {
                let name = e.name;
                if (typeof name !== 'undefined') {
                    e.name = name.replace(/[0-9]+/, nextSerial);
                }
            });

            next.className = 'item_' + nextSerial;

            nextSerial++;

            form.appendChild(next);
        }
    </script>
</body>
</html>