<?php
namespace Core;
use \Core\Database;
use \Core\SqlQuery;

class Model extends Database {


    protected $db = null;

    protected $sql = null;


    protected $table = '';

    protected $error = '';
    

    public function __construct() {

        $this->db = self::getInstance();    

        $this->sql = new SqlQuery($this->db);
        
    }

    public function getDB() {
        return $this->db->conn;
    }

    public function getSql() {
        return $this->sql;
    }

    public function getList(string $cond = null, array $data = [], string $orderBy = null, int $sort = 0, int $limit = -1, int $offset = 0) {
       
        $this->sql->select()
            ->from($this->table);
        
        if ($cond !== null) {
            $this->sql->where($cond, $data);
        }

        if ($orderBy !== null) {
            $this->sql->orderby($orderBy, $sort);
        }

        if ($limit > 0) {
            $this->sql->limit($limit, $offset);
        }
        
        if ($this->sql->exec()) {
            return $this->sql->fetchAll();
        } else {
            $this->error .= $this->sql->getErrorInfo();
        }

    }
    
    public function getBy(string $by, $data, string $orderBy = null, int $sort = 0) {

        return $this->getList($by . ' = :id', array(
            'id' => $data
        ), $orderBy, $sort);

    }

    public function insert(array $data) {

        $this->sql->insert($this->table, $this->sql->indexParamData($data)[0])
            ->values($this->sql->indexParamData($data)[1]);

        if ($this->sql->exec()) {
            return $this->sql->lastInsertId();
        } else {
            $this->error .= $this->sql->getErrorInfo();
        }


    }


    public function update(string $cond, array $condData, array $updateData) {

        $this->sql->update($this->table)
            ->set($updateData)
            ->where($cond, $condData);

        if ($this->sql->exec()) {
            return true;
        } else {
            $this->error .= $this->sql->getErrorInfo();
        }
        
    }


    public function delete(string $cond, array $data = []) {

        $this->sql->delete($this->table)
            ->where($cond, $data);

        if ($this->sql->exec()) {
            return true;
        } else {
            $this->error .= $this->sql->getErrorInfo();
        }
        

    }

    public function deleteBy(string $by, $data) {

        return $this->delete($by . ' = :id', [
            'id' => $data
        ]);

    }

    public function totalRowCount(string $cond = null, array $condData = []) {

        $this->sql->select(['*'], 'count')
            ->from($this->table);
        if ($cond !== null) {
            $this->sql->where($cond, $condData);
        }
        if ($this->sql->exec()) {
            return $this->sql->fetchColumn();
        } else {
            $this->error .= $this->sql->getErrorInfo();
        }
    }

    public function getErrorMessage() {
        return $this->error;
    } 

    public function exec(string $query, array $data) {
        $this->sql->setQuery($query);
        return $this->sql->exec($data);
    }

}

