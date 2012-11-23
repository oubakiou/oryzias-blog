<?php
class Controller_Admin_Image_Delete extends Controller_Parent_Admin
{
    function exec()
    {
        if (!$image = $this->Db_Image->getById($this->g['id'])) {
            $this->r('/admin/image/');
        }
        
        if ($this->p) {
            $this->Vld_ImageDelete->setData(['csrfToken'=>$this->p['csrfToken']]);
            if ($this->Vld_ImageDelete->isValid()) {
                if ($this->Db_Image->delete($image['id'])) {
                    $this->r('/admin/image/?delete=1');
                } else {
                    $this->template->assign('error', ['errorList'=>['削除に失敗しました']]);
                }
            } else {
                $this->template->assign('error', $this->Vld_ImageDelete->getError());
            }
        }

    }
}