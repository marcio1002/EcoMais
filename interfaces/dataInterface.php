<?php
namespace Interfaces;

    interface DataInterface
    {

        /**
         * DESTRUCTOR 
         * 
         * Fecha a conexão se não for fechada manualmente
         * @return mixed
         */
        public function __destruct();

        /**
         * Abre a conexão
         * @return void
         */
        public function open():void;

        /**
         * Fecha a conexão
         * @return void
         */
        public function close():void;
        
        /**
         * @param string $table
         * Nome da tabela
         * @param string $columns
         * Os nomes das colunas
         * @param array $val
         * O(s) valor(es) para inserção
         * @return int 
         */
        public function add(string $table, string $columns, array $val):int;

        /**  
         * --- São  5 opções para selecionar sua busca --- 
         * 1: Busca simpres com select,
         * 2: Busca select com   manipulações de opções,
         * 3: Busca select com where  manipulações de opções,
         * 4: Busca select com valores definidos,
         * 5: Busca select com valores e manipulações de opções,
         * 6: Busca select com valores definidos e where  manipulações de opções.
         * 
         * @param string $table
         * Nome da tabela
         * @param string $columns
         * As colunas
         * @param string $prewhere
         * Uma pré verificação
         * @param array $where
         * O(s) valor(es) da pré verificação
         * @param int $option
         * As Opções de seleção
         * @return null|array
         */
        public function show(string $table, string $columns,string $prewhere,array $where, int $option): ?array;
       
        /**  
         * 
         * @param string $table 
         * Nome da tabela
         * @param string $prewhere
         * Uma pré verificação
         * @param array $where
         * O(s) valor(es) da pré verificação
         * @param string $preVal
         * Os pré valores 
         * 
         * exem: "nome_da_coluna = '?'"
         * @param array $val
         * O(s) valor(es)
         * @return int
         */
        public function update(string $table,string $prewhere,array $where,string $preVal, array $val):int;
        
        /**
         * @param string $table
         * Nome da tabela
         * @param string $where 
         * As validações para exclusão
         * 
         *  exem: id =  ?
         * @param array $val
         * O(s) valor(es)
         * @return int
         */
        public function delete(string $table,string $where,array $val):int;
    }
