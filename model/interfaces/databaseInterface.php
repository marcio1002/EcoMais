<?php
interface Database
{
    public function __construct($host, $user, $password, $database);
    public function connect();
    public function connectionClose();
    public function addRegistry($table, array $columns, array $values);
    public function showRegistry($table, array $values, $where, $option = 1);
    public function updateRegistry($table, $where, array $values, $option = 1);
    public function deleteRegistry($table, $where);
}
?>