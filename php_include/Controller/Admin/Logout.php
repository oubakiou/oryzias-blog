<?php
class Controller_Admin_Logout extends Controller_Parent_Admin
{
    function exec()
    {
        $this->s['admin'] = false;
        setcookie(session_name(), '', time()-42000, '/');
        session_destroy();
        $this->r('/admin/login');
    }
}
