<?php

class UserModel
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "123456"; //If you are using XAMPP the default password is empty ""
    private $dbName = "clientDb";
    private $tableName = "clientTable";
    protected function Conn()
    {
        // creating the PDO object
        $pdo = new PDO("mysql:host={$this->host}", $this->user, $this->pass);

        // Creating DATABASE
        $dbQuery = "CREATE DATABASE IF NOT EXISTS {$this->dbName}";
        $dbRes = $pdo->query($dbQuery);
        if ($dbRes) {
            // echo "DB created";
            $pdo = new PDO("mysql:host={$this->host}; dbname={$this->dbName}", $this->user, $this->pass);
            $tableQuery = "CREATE TABLE IF NOT EXISTS {$this->tableName} (id INT NOT NULL AUTO_INCREMENT, name VARCHAR (255), email VARCHAR (320), zipcode INT(10), PRIMARY KEY (id));";
            $tableRes = $pdo->query($tableQuery);
            if ($tableRes) {
                // echo "Table created";
                // Setting the default fetch type to FETCH_ASSOC

                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $pdo;
            }
        }
    }
    protected function select()
    {
        $this->Conn();
        $selectQuery = "SELECT * FROM {$this->tableName}";
        $selectRes = $this->Conn()->query($selectQuery);
        return $selectRes->fetchAll();
    }
    protected function selectwithId($id)
    {
        $this->Conn();
        $selectQuery = "SELECT * FROM {$this->tableName} WHERE id = ?";
        $selectRes = $this->Conn()->prepare($selectQuery);
        $selectRes->execute([$id]);
        return $selectRes->fetch();
    }
    protected function insert($name, $email, $zip)
    {
        $this->Conn();
        $insertQuery = "INSERT INTO {$this->tableName} (name, email, zipcode) VALUES (?,?,?)";
        $insertRes = $this->Conn()->prepare($insertQuery);
        if ($insertRes->execute([$name, $email, $zip])) {
            return 1;
        } else {
            return 0;
        }
    }
    protected function update($newname, $newemail, $zip, $id)
    {
        $this->Conn();
        $updateQuery = "UPDATE {$this->tableName} SET name= ?, email=?, zipcode = ? WHERE id =?";
        $updateRes = $this->Conn()->prepare($updateQuery);
        if ($updateRes->execute([$newname, $newemail, $zip, $id])) {
            return 1;
        } else {
            return 0;
        }
    }
    protected function delete($id)
    {
        $this->Conn();
        $delQuery = "DELETE FROM {$this->tableName} WHERE id= ?";
        $delRes = $this->Conn()->prepare($delQuery);
        if ($delRes->execute([$id])) {
            return 1;
        } else {
            return 0;
        }
    }
}
