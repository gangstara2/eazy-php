<?php

/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */
namespace Models;

use Library\Core\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primary = 'id';

    public function __construct($co)
    {
        parent::__construct($co);
    }

    /**
     * TODO updateUser
     * @param mixed $post
     * @param int $id
     * @return mixed
     */
    public function updateUser($post, $id)
    {
        return $this->update(array(
            "nickname" => $post['nickname'],
            "mail" => $post['mail'],
            "password" => $post['password'],
            "id_role" => $post['role'],
            'fullname' => isset($post['fullname']) ? $post['fullname'] : '',
            'address' => isset($post['address']) ? $post['address'] : '',
            'city' => isset($post['city']) ? $post['city'] : '',
            'country' => isset($post['country']) ? $post['country'] : '',
        ), 'id = ' . $id);
    }

    /**
     * TODO insertUser
     * @param mixed $post
     * @return mixed
     */
    public function insertUser($post)
    {
        return $this->insert(array(
            "nickname" => $post['nickname'],
            "mail" => $post['mail'],
            "password" => md5($post['password']),
            "id_role" => $post['role'],
            'fullname' => isset($post['fullname']) ? $post['fullname'] : '',
            'address' => isset($post['address']) ? $post['address'] : '',
            'city' => isset($post['city']) ? $post['city'] : '',
            'country' => isset($post['country']) ? $post['country'] : '',
        ));
    }

    /**
     * TODO getUserByName
     * @param string $name
     * @return mixed
     */
    public function getUserByName($name)
    {
        return $this->fetchAll("nickname= '$name' ");
    }

    /**
     * TODO getUserByMail
     * @param string $mail
     * @return mixed
     */
    public function getUserByMail($mail)
    {
        return $this->fetchAll("mail= '$mail' ");
    }

    /**
     * TODO getUserLogin
     * @param string $name
     * param string $password
     * @return mixed
     */
    public function getUserLogin($login, $password)
    {
        return $this->fetchAll("nickname= '$login' and password= '$password' ");
    }

    /**
     * @param int $id
     * @return string $nickname
     */
    public function getUserNameById($id)
    {
        $result = $this->findById($id);
        return $result->nickname;
    }
}