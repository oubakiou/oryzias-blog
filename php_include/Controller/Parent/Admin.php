<?php
abstract class Controller_Parent_Admin extends Controller_Parent_Common
{
    protected function init()
    {
        parent::init();
        if (!isset($this->s['admin'])) {
            $this->r('/admin/login');
        }
    }
}