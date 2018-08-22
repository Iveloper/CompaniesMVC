<?php

namespace Model;

use Model\BaseModel;
use App\FlashMessage;
use Exception;

class UserModel extends BaseModel {

    const active = 1;
    const tableName = 'users';

    public function __construct() {
        parent::__construct();
    }

    // Checks if the givern username and password have matching result in the database.
    public function auth($username, $password) {
        $checkpassword = "SELECT password FROM users WHERE username = '$username' AND active = " . self::active;
        $result = $this->db->fetchOne($checkpassword);
        if (password_verify($password, $result['password'])) {
            $query = "SELECT id, username, avatar FROM users WHERE username = '$username' AND password = '" . $result['password'] . "' AND active = " . self::active;
        } else {
            throw new Exception('Your username or password seems wrong!');
        }
        return $this->db->fetchOne($query);
    }

    public function personSave($data) {

        if (isset($data['id']) && $data['id']) {
            FlashMessage::setMessage('success', 'Your data has been updated!');
            return $this->db->update(self::tableName, $data);
        } else {
            $checkUsername = "SELECT id FROM " . self::tableName . " WHERE username = '" . $data['username'] . "'";
            $result = $this->db->fetchOne($checkUsername);

            if (empty($result)) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                FlashMessage::setMessage('success', 'Your data has been inserted!');
                return $this->db->insert(self::tableName, $data);
            } else {
                throw new Exception('There is already an user with this username.', 112);
            }
        }
    }

    public function selectUser() {
        $this->applyFilters();

        $sql = "select row, u.id, u.username, u.active, u.avatar from"
                . " (SELECT ROW_NUMBER() over (order by id) row, id, username, active, avatar from " . self::tableName . " )u";
        $sql .= $this->paginateSql;

        if (isset($_GET['searchUser']) && $_GET['searchUser']) {
            $sql .= $this->searchUser;
        }

        if (isset($_GET['order'])) {
            $sql .= $this->orderBySql;
        }
        $sort = $this->db->fetchAll($sql);

        $totalSql = "select count(id) as total "
                . "from " . self::tableName . " as u"
                . " where 1=1 ";
        $totalSql .= $this->searchUser;

        $totalRows = $this->db->fetchAll($totalSql);

        return [
            'sort' => $sort,
            'orderUser' => $this->order,
            'total' => $totalRows,
            'perPage' => $this->perPage
        ];
    }

    public function getUser($id) {
        return $this->db->find(self::tableName, $id);
    }

    public function deleteUser($id) {
        $getUsername = "SELECT username FROM " . self::tableName . " "
                . "WHERE id = $id";
        $username = $this->db->fetchOne($getUsername);
        FlashMessage::setMessage('danger', $username['username'] . ' has been unactivated!');
        $query = "UPDATE " . self::tableName . " "
                . "SET active = 0 "
                . "WHERE id = $id";
        return $this->db->fetchAll($query);
    }
                                                                    
    public function activateUser($id) {
        $getUsername = "SELECT username FROM " . self::tableName . " "
                . "WHERE id = $id";
        $username = $this->db->fetchOne($getUsername);
        FlashMessage::setMessage('success', $username['username'] . ' has been activated!');
        $query = "UPDATE " . self::tableName . " "
                . "SET active = 1 "
                . "WHERE id = $id";
        return $this->db->fetchAll($query);
    }

    public function getAvatar($avatarData, $data) {
        $info = getimagesize($avatarData['tmp_name']);
        $uploads_dir = "C:\wamp64\www\demo\public\uploads\avatars";
        $name = $avatarData['name'];
        move_uploaded_file($avatarData['tmp_name'], "$uploads_dir\ $name");

        $query = "UPDATE " . self::tableName . " "
                . "SET avatar = '$name' "
                . "WHERE id = " . $data['id'];


        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_JPEG) || ($info[2] == IMAGETYPE_PNG)) {
            FlashMessage::setMessage('success', 'Your avatar has been uploaded!');
            return $this->db->fetchAll($query);
        } else {
            FlashMessage::setMessage('danger', 'The uploaded file is not an image!');
        }
    }

}
