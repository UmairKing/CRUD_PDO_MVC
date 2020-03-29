<?php

class UserContoller extends UserModel
{
    public function Continsert($name, $email, $zip)
    {
        return $this->insert($name, $email, $zip);
    }
    public function Contupdate($name, $email, $zip, $id)
    {
        return $this->update($name, $email, $zip, $id);
    }
    public function Contdelete($id)
    {
        return $this->delete($id);
    }
}
