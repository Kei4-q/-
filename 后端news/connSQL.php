<?php

class connSQL
{
    public $conn;

    public function __construct()
    {
        $num = func_num_args();
        $arr = func_get_args();
        if ($num == 1)
            $this->init($arr[0]);
    }

    protected function init($datebase)
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $port = 3306;
        $this->conn = new mysqli($host, $user, $password, $datebase, $port);
        $this->conn->set_charset("utf8");
    }

    public function __destruct()
    {
        if ($this->conn instanceof mysqli)
            $this->conn->close();
        else
            echo "数据库关闭失败";
    }
}

class querySQL
{
    public $data;
    public $conn;

    public function __construct()
    {
        $num = func_num_args();
        $arr = func_get_args();
        if ($num == 1)
            $this->init($arr[0]);
        else if ($num == 2)
            $this->init_query($arr[0], $arr[1]);
        else
            $this->exception();
    }

    private function init($conn)
    {
        $signal = 0;
        if ($conn instanceof connSQL)
            if ($conn->conn instanceof mysqli) {
                $this->conn = $conn->conn;
                $signal = 1;
            }
        if ($signal == 0)
            $this->exception();
    }

    public function exception()
    {
        echo "存在错误";
        return null;
    }

    private function init_query($conn, $query)
    {
        $this->init($conn);
        $this->query($query, 1);
    }

    public function query($query, $signal = 0)
    {
        if ($this->conn instanceof mysqli) {
            $this->data = $this->conn->query($query);
            if ($signal == 0)
                return $this->data;
        }
        return null;
    }

    public function __destruct()
    {
        if ($this->data instanceof mysqli_result)
            $this->data->free_result();
    }

    public function getCount()
    {
        if ($this->data instanceof mysqli_result)
            return $this->data->num_rows;
        else
            return $this->exception();
    }

    public function getArray()
    {
        if ($this->data instanceof mysqli_result)
            return $this->data->fetch_assoc();
        else
            return $this->exception();
    }

    public function getAffectedRows()
    {
        if ($this->conn instanceof mysqli)
            return $this->conn->affected_rows;
        else
            return $this->exception();
    }

    public function getError()
    {
        if ($this->conn instanceof mysqli)
            return $this->conn->error;
        else
            return $this->exception();
    }
}
