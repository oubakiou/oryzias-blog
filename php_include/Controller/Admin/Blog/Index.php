<?php
class Controller_Admin_Blog_Index extends Controller_Parent_Admin
{
    function exec()
    {
        if (isset($this->g['id'])) {
            //編集時
            if (!$data = $this->Db_Blog->getBlogById($this->g['id'])) {
                $this->r('/admin/');
            }
            $data['tags'] = $this->Db_Tag->unFormatTag($data['tags']);
        } else {
            //新規作成時
            $data = $this->Vld_Blog->getData();
        }
        
        if ($this->p) {
            $this->Vld_Blog->setData($this->p['data']);
            
            if ($this->Vld_Blog->isValid()) {
                $data = $this->Vld_Blog->getData();
                
                if ($this->Db_Blog->edit($data)) {
                    $this->r('/admin/?blogedit=1');
                } else {
                    $this->assign('error', ['errorList'=>['保存に失敗しました']]);
                }
            }else{
                $this->assign('error', $this->Vld_Blog->getError());
            }
        }
        
        $this->template->assign('data', $data);
        
        //キービジュアル選択用
        $imageListValues[] = '';
        $imageListLabels[] = 'なし';
        if ($imageList = $this->Db_Image->getImageList()) {
            foreach ($imageList as $image) {
                $imageListValues[] = $image['id'];
                $imageListLabels[] = $image['name'];
            }
        }
        $this->assign('imageListValues', $imageListValues);
        $this->assign('imageListLabels', $imageListLabels);
        
    }
}