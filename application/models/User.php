<?php

/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 8/5/16
 * Time: 7:13 PM
 */
class User extends CI_Model
{
    private $table = 'user';

    /**
     * add new user in database
     * @param $username
     * @param $password
     * @return bool
     */
    public function addUser($username, $password)
    {
        if(!is_string($username) OR !is_string($password) OR empty($username) OR empty($password))
        {
            return false;
        }

        //check if user already registered in database
        if($this->userExist($username, $password))
            return false;

        $date = DATE("d-m-y");
        $number_of_login = 0;

        return $this->db->set(array('username' => $username, 'password' => $password, 'lastLogin' => $date, 'numberOfLogin' => $number_of_login))
            ->insert($this->table);

    }

    /**
     * check if user exists in database
     * @param $username
     * @param $password
     * @return bool
     */

    public function userExist($username, $password)
    {
        if(!is_string($username) OR !is_string($password) OR empty($username) OR empty($password))
        {
            return false;
        }
        $result = $this->db->select('username')
            ->from($this->table)
            ->where("username = '$username' AND password = '$password'")
            ->limit(1)
            ->get()
            ->result();

        if(isset($result[0]->username) && $username == $result[0]->username)
            return true;
        else
            return false;


    }

    /**
     * Delete user from database
     * @param $username
     * @return bool
     */
    public function deleteUser($username)
    {
        if(!is_string($username) OR empty($username) )
        {
            return false;
        }

        return $this->db->query("DELETE FROME $this->table WHERE username = '$username");

    }

    /**
     * update data can be only password and username
     * option set in interface
     * @param $update_data
     * @param $field
     */

    public function updateUser($old_data, $update_data, $field)
    {
        if(!is_string($update_data) OR !is_string($field) OR !is_string($old_data) OR empty($old_data) OR empty($update_data) OR empty($field))
            return false;


        return $this->db->query("UPDATE $this->table SET $field = '$update_data ' WHERE $field = '$old_data'");

    }

    public function getUserInformation($username)
    {
        if(!is_string($username) OR empty($username))
            return false;

        $result = $this->db->select("*")
            ->from($this->table)
            ->where("username='$username'")
            ->limit(1)
            ->get()
            ->result();

        return $result;

    }
}