<?php
class Controller_Admin_Blog_Delete extends Controller_Parent_Admin
{
    function exec()
    {
        if (!$data = $this->Db_Blog->getById($this->g['id'])) {
            $this->r('/admin/');
        }
        
        if ($this->p) {
            $this->Vld_BlogDelete->setData(['csrfToken'=>$this->p['csrfToken']]);
            if ($this->Vld_BlogDelete->isValid()) {
                if ($this->Db_Blog->deleteById($data['id'])) {
                    $this->r('/admin/?blogdelete=1');
                } else {
                    $this->assign('error', ['errorList'=>['削除に失敗しました']]);
                }
            } else {
                $this->assign('error', $this->Vld_PresentationDelete->getError());
            }
        }
    }
}
