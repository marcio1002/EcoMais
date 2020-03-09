<?php
interface DatabaseInterface
{
    public function __construct(string $host,string $user,string $password,string $database);
    public function connectionClose();
    public function add(string $table, array $columns, array $val);
    public function show(string $table, array $val,string $prewhere,array $where, int $option);
    public function update(string $table,string $prewher,array $where,array $preVal, array $val);
    public function delete(string $table,string $where,array $val);
}
?>