<?php
class Controller_About extends Controller_Parent_Public
{
    public function exec()
    {
        $this->assign('title', 'このブログについて');
    }
}