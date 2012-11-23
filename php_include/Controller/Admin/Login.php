<?php
class Controller_Admin_Login extends Oryzias\Controller
{
    public function exec()
    {
        if ($this->p) {
            $this->Vld_Login->setData($this->p['data']);
            if ($this->Vld_Login->isValid()) {
                session_regenerate_id(true);
                $this->s['admin'] = true;
                $this->r('/admin/');
            } else {
                $this->assign('error', $this->Vld_Login->getError());
            }
        }
        
        $this->assign('data', $this->Vld_Login->getData());
    }
}
