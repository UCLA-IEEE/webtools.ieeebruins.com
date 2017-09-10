<?php

class Model
{
    public $db = null;
    public $tableName = '';

    public function __construct($db, $params=array())
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }

        foreach ($params as $field => $value) {
            if (property_exists($this, $field)) {
                $this->$field = "'" . $value . "'";
            }
        }
    }

    public function find()
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ';';
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function remove()
    {
        $sql = 'DELETE FROM ' . $this->tableName . ';';
        $query = $this->db->prepare($sql);

        return $query->execute();
    }

    public function save()
    {
        $sql = 'INSERT INTO ' . $this->tableName . ' VALUES (';
        foreach ($this->fieldNames as $field) {
            $sql = $sql . $this->$field . ',';
        }
        $sql = trim($sql, ',');
        $sql = $sql . ');';

        $query = $this->db->prepare($sql);

        return $query->execute();
    }
}
