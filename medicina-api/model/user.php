<?php

require __DIR__ . "/base.php";
require __DIR__ . " /../common/errorHandler.php";

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

$table_name = "`user`";
class User extends BaseController
{
    public function getUser($id)
    {
        $sql = sprintf(
            "SELECT name, email
            FROM user
            WHERE id = %d;",
            $this->conn->real_escape_string($id)
        );

        $result = $this->conn->query($sql);

        $this->SendOutput($result, JSON_OK);
    }

    public function getArchiveUser(){
        $query = "SELECT u.name, u.surname, u.email
                from `user` u"; 
        
        $stmt = $this->conn->query($query);
    
        return $stmt;
    }

    protected function getUserFromEmail($email)
    {

        $sql = sprintf(
            "SELECT id
            from `user` u
            where u.email = %s
            order by u.id desc
            limit 1; ",
            $this->conn->real_escape_string($email)
        );

        $result = $this->conn->query($sql);

        return $result;
    }

    public function getLastUserIdFromEmail($email)
    {
            $sql = sprintf(
                "SELECT id
        from `user` u
        where u.email = '%s'
        order by u.id desc
        limit 1 ",
                $this->conn->real_escape_string($email)
            );
    
            $result = $this->conn->query($sql);
    
            $this->SendOutput($result, JSON_OK);
    }


    public function deleteUser($id)
    {
        $sql = sprintf(
            "UPDATE user 
            SET active = 0 
            WHERE id = %d",
            $this->conn->real_escape_string($id)
        );

        $result = $this->conn->query($sql);
        return $result;
    }
    public function login($email, $password)
    {
        $sql = sprintf("SELECT email, password, id
        FROM `user`
        where 1=1 ");
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($this->conn->real_escape_string($email) == $this->conn->real_escape_string($row["email"]) && $this->conn->real_escape_string($password) == $this->conn->real_escape_string($row["password"])) {
                return $this->conn->real_escape_string($row["id"]);
            }
        }

        return false;
    }

    public function changePassword($email, $password, $newPassword)
    {
        if ($this->login($email, $password) == false) {
            return false;
        }

        $sql = sprintf(
            "UPDATE user 
            SET password = '%s'
            WHERE email = '%s' AND password = '%s'",
            $this->conn->real_escape_string($newPassword),
            $this->conn->real_escape_string($email),
            $this->conn->real_escape_string($password)
        );

        $result = $this->conn->query($sql);

        return $result;
    }
    public function addUser($name, $surname,$email,  $password)
    {

        $sql = sprintf(
            "INSERT INTO user ( name, surname, email,  password)
        VALUES ('%s', '%s', '%s',  '%s')",
             $this->conn->real_escape_string($name),
             $this->conn->real_escape_string($surname),
            $this->conn->real_escape_string($email),
            $this->conn->real_escape_string($password)
        );

        $result = $this->conn->query($sql);
        return $result;
    }
    public function getAutentication($id)
    {
        $sql = sprintf(
            "SELECT name
            FROM privileges
            WHERE user = %d;",
            $this->conn->real_escape_string($id)
        );

        $result = $this->conn->query($sql);

        $this->SendOutput($result, JSON_OK);
    }
    public function addPrivileges($user, $name)
    {

        $sql = sprintf(
            "INSERT INTO `privileges` ( user, name)
        VALUES ('%d', '%s')",
             $this->conn->real_escape_string($user),
             $this->conn->real_escape_string($name),
        );
        $result = $this->conn->query($sql);
        return $result;
    }
}
?>