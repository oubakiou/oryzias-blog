<?php
class Controller_Admin_Image_Index extends Controller_Parent_Admin
{

    function exec()
    {
        $this->template->assign('imageList', $this->Db_Image->getImageList());
        $this->template->assign('allowFileSize', Oryzias\Config::get('image.uploadImgMaxSize'));
        
        if($this->p){
            $this->Vld_ImageUpload->setData($this->p['data']);
            if($this->Vld_ImageUpload->isValid()){
                $data = $this->Vld_ImageUpload->getData();
                if($this->Db_Image->create($data, $this->f['image'])){
                    $this->r('/admin/image/?upload=1');
                }else{
                    $this->template->assign('error', array('errorList'=>$this->Db_Image->image->getError()));
                }
            }else{
                $this->template->assign('error', $this->Vld_ImageUpload->getError());
            }
        }
    }
}