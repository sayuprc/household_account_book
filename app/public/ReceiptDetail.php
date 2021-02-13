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
            $query = 'SELECT * FROM receipts';

            $stmt = $this->dbh->prepare($query);
            $stmt->execute();

            $receipts = $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->messages[] = '取得に失敗しました。';
        }

		return $receipts;
	}

    public function create($data)
    {
        $status = $this->validate($data);

        if (!$status) return;

        $this->insert($data);
    }

    private function validate($data)
    {
        if (!preg_match("/\A[0-9]+\z/", $data['total_amount'])) {
            $this->messages[] = '合計金額は正しく入力してください。';
            return false;
        }

        foreach ($data as $key => $val) {
            if ($key === 'purchased_at') {
                $this->values[$key] = preg_replace("/-/", '/', $val);
            } else {
                $this->values[$key] = $val;
            }
        }

        return true;
    }

    private function insert()
    {
        try {
            $query = 'INSERT INTO receipts(receipt_id, receipt_name, total_amount, purchased_at, created_at) ' . 
                     'VALUES (:receipt_id, :receipt_name, :total_amount, :purchased_at, now())';

            foreach ($this->values as $key => $val) {
                $prepare[':' . $key] = $val;
            }

            $stmt = $this->dbh->prepare($query);
            $stmt->execute($prepare);

            $this->messages[] = 'レシート作成しました。';
        } catch (PDOException $e) {
            $this->messages[] = 'レシート作成に失敗しました。';

            return false;
        }

        return true;
    }

    public function getNextSerial(string $receiptId)
    {
        $nextSerial = null;

        try {
            $query = 'SELECT MAX(serial) + 1 AS serial FROM receipts_details WHERE receipt_id = :receipt_id';

            $stmt = $this->dbh->prepare($query);
            $stmt->execute([ ':recepit_id' => $receiptId ]);

            $result = $stmt->fetchAll();
            $nextSerial = $result[0]['serial'];
        } catch (PDOException $e) {
            $this->messages[] = 'データの取得に失敗しました。';
        }

        return $nextSerial;
    }
}
