<?php

require_once('Db.php');

class ReceiptDetail
{
	private $dbh;

    private $table = 'receipts_detail';

    private $values;

    public $messages;

	public function __construct()
	{
		$this->dbh = Db::getInstance();
	}

	public function all()
	{
        $receipts = [];

        try {
            $query = 'SELECT * FROM receipts_detail';

            $stmt = $this->dbh->prepare($query);
            $stmt->execute();

            $receipts = $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->messages[] = '取得に失敗しました。' . $e->getMessage();
        }

		return $receipts;
	}

    public function find($receiptId)
    {
        $details = [];

        try {
            $query = 'SELECT * FROM receipts_detail WHERE receipt_id = :receipt_id';
            $prepare = [ ':receipt_id' => $receiptId ];

            $stmt = $this->dbh->prepare($query);
            $stmt->execute($prepare);

            $details = $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->messages[] = '取得に失敗しました。' . $e->getMessage();
        }

		return $details;

    }

    public function create($data)
    {
        $status = $this->validate($data);

        if (!$status) return;

        $this->insert();
    }

    private function validate($data)
    {
        foreach ($data as $item) {
            if (!preg_match("/\A[0-9]+\z/", $item['amount'])) {
                $this->messages[] = '金額は正しく入力してください。';
                return false;
            }
        }

        foreach ($data as $item) {
            $tmp = [];

            foreach ($item as $k => $v) {
                $tmp[$k] = $v;
            }

            $this->values[] = $tmp;
        }

        return true;
    }

    private function insert()
    {
        try {
            $query = 'INSERT INTO receipts_detail(receipt_id, serial, item_name, quantity, amount, purchased_at, paymented_at, payment_type, payment_count, is_payed, category_id, memo) ' . 
                     'VALUES (:receipt_id, :serial, :item_name, :quantity, :amount, :purchased_at, :paymented_at, :payment_type, :payment_count, :is_payed, :category_id, :memo)';

            foreach ($this->values as $items) {
                $prepare = [];

                foreach ($items as $k => $v) {
                    $prepare[':' . $k] = $v;
                }

                $stmt = $this->dbh->prepare($query);
                $stmt->execute($prepare);
            }

            $this->messages[] = '明細を作成しました。';
        } catch (PDOException $e) {
            $this->messages[] = '明細作成に失敗しました。' . $e->getMessage();

            return false;
        }

        return true;
    }

    public function getNextSerial(string $receiptId)
    {
        $nextSerial = null;

        try {
            $query = 'SELECT MAX(serial) + 1 AS serial FROM receipts_detail WHERE receipt_id = :receipt_id';
            $prepare = [ 
                ':receipt_id' => $receiptId
            ];

            $stmt = $this->dbh->prepare($query);
            $stmt->execute($prepare);

            $result = $stmt->fetchAll();
            $nextSerial = $result[0]['serial'];
        } catch (PDOException $e) {
            $this->messages[] = 'データの取得に失敗しました。' . $e->getMessage();
        }

        return $nextSerial;
    }
}
