<?php
interface Database
{
    public function __construct(string $host,string $user,string $password,string $database);
    public function connect();
    public function connectionClose();
    public function addRegistry(string $table, array $columns, array $values);
    public function showRegistry(string $table, array $values,string $where,int $option = 1);
    public function updateRegistry(string $table,string $where, array $values,int $option = 1);
    public function deleteRegistry(string $table,string $where);
}
?>