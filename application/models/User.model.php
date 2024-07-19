<?php
class User extends Model
{
    function login($username, $password)
    {
        $query = "select id, username, is_admin from `" . $this->_table . "` where username = '" . $this->escape($username) . "' and password = '" . $this->escape(hash_password($password)) . "'";
        print_r($query);
        return $this->query($query, 1);
    }
    public function getOne($username)
    {
        $query = "select * from `" . $this->_table . "` where username = '" . $this->escape($username) . "'";
        return $this->query($query);
    }
    public function createOne($username, $password)
    {
        $query = "insert into " . $this->_table . "(username, password) value('" . $this->escape($username) . "','" . $this->escape($password) . "')";
        return $this->query($query);
    }
}
