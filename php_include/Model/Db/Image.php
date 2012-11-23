<?php
class Model_Db_Image extends Model_Db_Parent_Common
{
    public function __construct()
    {
        parent::__construct();
        $this->image = new Oryzias\Image;
        $this->uploadImgPath = Oryzias\Config::get('image.uploadImgPath');
        $this->uploadImgUrl = Oryzias\Config::get('image.uploadImgUrl');
    }
    
    public function create($data, $file)
    {
        if (!$this->image->checkFile($file)) {
            return false;
        }
        
        //DB保存
        if (!$data['name']) {
            $data['name'] = date('Ymdhis');
        }
        $data['ext'] = $this->image->getExt();
        
        if (!$id = $this->insert($data)) {
            return false;
        }
        
        //PC
        if (!$this->image->saveResizeImage($this->getPathForPc($id, $data['ext']), 1200, 800)) {
            return false;
        }
        
        //SP
        if (!$this->image->saveResizeImage($this->getPathForSp($id, $data['ext']), 480, 320)) {
            return false;
        }
        
        //サムネイル
        if (!$this->image->saveResizeImage($this->getPathForThumbnail($id, $data['ext']), 192, 320)) {
            return false;
        }
        
        //URLを保存
        $updateData['id'] = $id;
        $updateData['urlForPc'] = $this->getUrlForPc($id, $data['ext']);
        $updateData['urlForSp'] = $this->getUrlForPc($id, $data['ext']);
        $updateData['urlForThumbnail'] = $this->getUrlForPc($id, $data['ext']);
        $this->replaceByKey($updateData);
        
        return true;
    }
    
    public function delete($id)
    {
        if (!$image = $this->getImage($id)) {
            return false;
        }
    
        if (!unlink($image['pathForPc'])) {
            return false;
        }
    
        if (!unlink($image['pathForSp'])) {
            return false;
        }
    
        if (!unlink($image['pathForThumbnail'])) {
            return false;
        }
    
        return $this->deleteById($id);
    }
    
    public function getImage($id)
    {
        if ($image = $this->getById($id)) {
            $image['pathForPc'] = $this->getPathForPc($image['id'], $image['ext']);
            $image['pathForSp'] = $this->getPathForSp($image['id'], $image['ext']);
            $image['pathForThumbnail'] = $this->getPathForThumbnail($image['id'], $image['ext']);
            return $image;
        }else{
            return false;
        }
    }
    
    public function getImageFileName($imageId, $ext)
    {
        return $imageId . '.' . $ext;
    }
    
    public function getPathForPc($imageId, $ext)
    {
        $dir = $this->uploadImgPath . 'pc/';
        return $dir . $this->getImageFileName($imageId, $ext);
    }
    
    public function getPathForSp($imageId, $ext)
    {
        $dir = $this->uploadImgPath . 'sp/';
        return $dir . $this->getImageFileName($imageId, $ext);
    }
    
    public function getPathForThumbnail($imageId, $ext)
    {
        $dir = $this->uploadImgPath . 'thumbnail/';
        return $dir . $this->getImageFileName($imageId, $ext);
    }
    
    public function getUrlForPc($imageId, $ext)
    {
        $url = $this->uploadImgUrl . 'pc/';
        return $url . $this->getImageFileName($imageId, $ext);
    }
    
    public function getUrlForSp($imageId, $ext)
    {
        $url = $this->uploadImgUrl . 'sp/';
        return $url . $this->getImageFileName($imageId, $ext);
    }
    
    public function getUrlForThumbnail($imageId, $ext)
    {
        $url = $this->uploadImgUrl . 'thumbnail/';
        return $url . $this->getImageFileName($imageId, $ext);
    }
    
    //画像一覧取得
    public function getImageList()
    {
        $sql = $this->buildSelect([
                'select'=>'id',
                'orderBy'=>'createdAt DESC',
        ]);
        
        if ($idList = $this->fetchAll($sql)) {
            foreach ($idList as $v) {
                $result[] = $this->getImage($v['id']);
            }
            return $result;
        } else {
            return false;
        }
    }
}
