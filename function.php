<?php
class crud_api
{
    public $hostname;
    public $username;
    public $password;
    public $dbname;

    function __construct($hostname,$username,$password,$dbname)
    {
        $this->conn = mysqli_connect($hostname,$username,$password,$dbname);
        
        if(!$this->conn)
        {
            echo "ERROR:Database could not connect ".mysqli_connect_error();
            exit();
        }
    }


    function data_insert($sql_stmt)
    {
        $insert = mysqli_query($this->conn, $sql_stmt);
        return $insert;
    }

    function data_fetch($sql_fetch)
    {
        $insert = mysqli_query($this->conn, $sql_fetch);
        return $insert;
    }

    function delete($sql_delete)
    {
        $delete = mysqli_query($this->conn, $sql_delete);
        return $delete;
    }

    function truncate($sql_trunc)
    {
        $delete = mysqli_query($this->conn, $sql_trunc);
        return $delete;
    }

    function get_edit($sql_edit)
    {
        $edit = mysqli_query($this->conn, $sql_edit);
        return $edit;
    }

    function save_edit($sql_save_edit)
    {
        $save_edit = mysqli_query($this->conn, $sql_save_edit);
        return $save_edit;
    }
}
?>