<?php
class Controller_404 extends Controller_Parent_Common{
    public function execute(){
        header('Status: 404 Not Found', true, 404);
    }
}