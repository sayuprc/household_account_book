<?php

namespace models;

class  Model
{
    protected $dbh;

	protected $table = '';

	protected $primaryKey = [];

	protected $query = '';

	protected $select = '';

	protected $where = '';

	protected $order = '';

	protected $prepare = [];

    protected $message = '';

    public function __construct()
    {
        $this->dbh = Db::getInstance();
    } 

    public function all()
    {
        return $this->select()->get();
    }

	public function get(): ?array
	{
        $this->query = sprintf("%s %s %s", $this->select, $this->where, $this->order);

        $data = $this->dbh->execute($this->query, $this->prepare);

        $this->resetQuery();

        return $data;
	}

	protected function select(string $columns = '*')
	{
		$this->select = sprintf("SELECT %s FROM %s", $columns, $this->table);

		return $this;
	}

	protected function where(array $where)
	{
		return $this;
	}

	protected function order(string $order, string $sort = '')
	{
        $this->order = sprintf("ORDER BY %s %s", $order, $sort);

		return $this;
	}

	protected function first()
	{
	}

    private function resetQuery()
    {
        $this->query = '';
        $this->select = '';
        $this->where = '';
        $this->order = '';
    }

	protected function take()
	{

	}

	protected function find()
	{

	}

    protected function insert()
    {
    }

    protected function update()
    {

    }

    protected function delete()
    {

    }
}