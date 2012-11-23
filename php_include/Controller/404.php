<?php
class Controller_404 extends Controller_Parent_Public
{
    public function execute()
    {
        header('Status: 404 Not Found', true, 404);
        $this->assign('title', '404');
    }
}