<?php
class Controller_Index extends Controller_Parent_Common{

    public function exec(){
        $this->template->assign('phpVersion', phpversion());
        $this->template->assign('loadedExtensions', get_loaded_extensions(false));
        $this->template->assign('serverParams', $_SERVER);
    }

}