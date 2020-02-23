<?php
interface DatabaseInterface
{
    public function __construct(string $host,string $user,string $password,string $database);
    public function connectionClose();
    public function add(string $table, array $columns, array $values);
    public function show(string $table, array $values,string $where,int $option = 1);
    public function update(string $table,string $where, array $values);
    public function delete(string $table,string $where);
}
?>