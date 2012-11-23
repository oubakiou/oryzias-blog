<?php
class Controller_About extends Controller_Parent_Public
{
    public function execute()
    {
        $this->assign('title', 'このブログについて');
    }
}