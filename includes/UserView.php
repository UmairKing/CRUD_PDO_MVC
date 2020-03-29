<?php

class UserView extends UserModel
{
    public function getUsers()
    {
        return $rows = $this->select();
    }
    public function getUserWithId($id)
    {
        return $row = $this->selectwithId($id);
    }
}
