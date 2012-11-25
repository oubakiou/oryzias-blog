<?php
class Model_Db_Blog extends Model_Db_Parent_Common
{
    //新規作成
    public function edit($data)
    {
        $data['bodyHtmlPc'] = $this->markDownToHtml($data['bodyMarkdown']);
        $data['bodyHtmlSp'] = $this->replaceImageUrlForSp($data['bodyHtmlPc']);
        
        $tags = $data['tags'];
        unset($data['tags']);
        
        if (!$data['keyImageId']) {
            $data['keyImageId'] = null;
        }
        
        if (!$id = $this->replaceByKey($data)) {
            return false;
        }
        
        $dbBlogTag = new Model_Db_BlogTag;
        if (!$dbBlogTag->replaceTag($id, $tags)) {
            return false;
        }
        return true;
    }
    
    //markdownからHTMLへの変換
    public function markDownToHtml($markDownText)
    {
        require_once('markdown.php');
        $htmlText = Markdown($markDownText);
        return $htmlText;
    }
    
    //スマートフォン用画像へパスを変換
    public function replaceImageUrlForSp($body)
    {
        $body = str_replace('/img/up/pc/', '/img/up/sp/', $body);
        return $body;
    }
    
    //ブログ取得
    public function getBlogById($id, $isSmartPhone = false)
    {
        if (!$blog = $this->getById($id)) {
            return false;
        }
        
        //タグ情報付与
        $dbBlogTag = new Model_Db_BlogTag;
        $blog['tags'] = $dbBlogTag->getTagListByBlogId($id);
        
        //画像情報付与
        if (isset($blog['keyImageId'])) {
            $dbImage = new Model_Db_Image();
            $blog['keyImage'] = $dbImage->getImage($blog['keyImageId']);
        }
        
        if ($isSmartPhone) {
            //スマートフォン向けに画像調整
            $blog['body'] = $blog['bodyHtmlSp'];
            if (isset($blog['keyImage']['urlForSp'])) {
                $blog['keyImageUrl'] = $blog['keyImage']['urlForSp'];
            }
        } else {
            //PC向けに画像調整
            $blog['body'] = $blog['bodyHtmlPc'];
            if (isset($blog['keyImage']['urlForPc'])) {
                $blog['keyImageUrl'] = $blog['keyImage']['urlForPc'];
            }
        }
        
        return $blog;
    }
    
    //ブログの一覧をページャー付きで取得
    public function search($cond = [], $perPage = 10, $currentPage = 1, $isSmartPhone = false)
    {
        $sqlParts = [
            'select' => 'b.id',
            'from' =>'Blog AS b',
            'leftJoin' => [
                'BlogTag AS bt', 'bt.blogId = b.id',
                'Image AS i', 'b.keyImageId = i.id'
            ],
            'groupBy'=>'b.id',
            'orderBy'=>'b.createdAt DESC',
        ];
        $params = [];
        
        if (isset($cond['id'])) {
            $sqlParts['where'][] = 'b.Id = :id';
            $params[':id'] = $cond['id'];
        }
        
        if (isset($cond['tagId'])) {
            $sqlParts['where'][] = 'bt.tagId = :tagId';
            $params[':tagId'] = $cond['tagId'];
        }
        
        if (!isset($cond['ignorePublic'])) {
            $sqlParts['where'][] = 'b.isPublic = 1';
        }
        
        $sql = $this->buildSelect($sqlParts);
        $result = $this->fetchAllWithPaginator($sql, $params, $perPage, $currentPage);
        if ($result['data']) {
            foreach ($result['data'] as $k=>$v) {
                $result['data'][$k] = $this->getBlogById($v['id']);
            }
            return $result;
        } else {
            return false;
        }
    }
}