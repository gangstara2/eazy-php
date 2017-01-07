<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Library\Core;

use PDO;

class Model
{
    public $insertedId;
    protected $table;
    protected $primary;
    private $db;

    public function __construct($co)
    {
        $this->db = $co;
    }

    /**
     * findById() return all fields selected of an element id
     * @param int $value_primary
     * @param string $fields
     * @return mixed
     */
    public function findById($value_primary, $fields = '*')
    {
        if (!empty($value_primary)) {
            $q = "SELECT $fields FROM `" . $this->table . "` WHERE `" . $this->primary . "`='$value_primary'";
            $sql = $this->db->prepare($q);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_OBJ);
            return $sql->fetchAll();
        }
        return false;
    }


    /**
     * fetchAll() return all element of table with selected criteria
     * @param mixed $where
     * @param string $fields
     * @return array
     */
    public function fetchAll($where = 1, $fields = '*')
    {
        $q = "SELECT $fields FROM `" . $this->table . "` WHERE $where";
        $sql = $this->db->prepare($q);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_OBJ);
        return $sql->fetchAll();
    }


    public function makeQuery($sql)
    {
        $q = $this->db->prepare($sql);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_OBJ);
        return $q->fetchAll();
    }

    /**
     * function fetchByClause()
     * @param string $clause
     * @param string $fields
     * @return $array
     */
    public function fetchByClause($clause = 'WHERE 1', $fields = '*')
    {
        $q = "SELECT $fields FROM `" . $this->table . "` $clause ";
        $sql = $this->db->prepare($q);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_OBJ);
        return $sql->fetchAll();
    }

    /**
     * insert() allows to add an occurence inside table
     * @param array $data
     * @return boolean
     */
    public function insert($data)
    {
        $fieldsList = '';
        $valuesList = '';

        foreach ($data as $k => $v) {
            $fieldsList .= "`$k`, ";
            $valuesList .= $this->db->quote($v) . ", ";
        }
        $fieldsList = substr($fieldsList, 0, -2);
        $valuesList = substr($valuesList, 0, -2);

        $query = "INSERT INTO `" . $this->table . "` ($fieldsList) VALUES ($valuesList)";
        $sql = $this->db->prepare($query);
        $sql->execute();
        if ($sql) {
            $this->insertedId = $this->db->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    /**
     * update() allows to update data with selected criteria
     * @param array $data
     * @param string $where
     * @return boolean
     */
    public function update($data, $where)
    {
        if (!empty($where)) {
            $fieldsListAndValue = '';
            foreach ($data as $k => $v) {
                $fieldsListAndValue .= "`$k`=" . $this->db->quote($v) . ", ";
            }
            $fieldsListAndValue = substr($fieldsListAndValue, 0, -2);

            $q = "UPDATE " . $this->table . " SET $fieldsListAndValue WHERE $where";
            $sql = $this->db->prepare($q);
            return $sql->execute();
        }
        return false;
    }

    /**
     * delete() allows you to delete an occurrence of the table with his id
     * @param mixed $value_primary
     * @return boolean
     */
    public function delete($value_primary)
    {
        if (!empty($value_primary)) {
            $query = "DELETE FROM `" . $this->table . "` WHERE `" . $this->primary . "`='$value_primary' LIMIT 1";
            $sql = $this->db->prepare($query);
            return $sql->execute();
        }
        return false;
    }

    /**
     * delete() allows you to delete all occurrences
     * @param string $where
     * @return boolean
     */
    public function massDelete($where)
    {
        if (!empty($where)) {
            $query = "DELETE FROM `" . $this->table . "` WHERE $where";
            $sql = $this->db->prepare($query);
            return $sql->execute();
        }
        return false;
    }

    /**
     * string hasher with blowfish encryption
     * @param string $input
     * @param int $rounds
     * @param string $salt
     * @return string hashed password
     */
    public function blowfishHasher($input, $rounds = 7, $salt = "ptm")
    {
        $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        for ($i = 0; $i < 22; $i++) {
            $salt .= $salt_chars[array_rand($salt_chars)];
        }
        return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
    }

    /**
     * Password/Token validator.
     * @param string $password_entered
     * @param string $password_hash
     * @return bool
     */
    public function validHasher($password_entered, $password_hash)
    {
        if (crypt($password_entered, $password_hash) == $password_hash) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * this function is for generate slug url
     * @param string $str
     * @return string $str
     */
    public function slugify($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }


    public function getRowCount($column)
    {
        $sql = "SELECT count('$column') FROM $this->table";
        $rows = $this->db->query($sql);
        $rs = $rows->fetchColumn();
        return $rs;
    }
}