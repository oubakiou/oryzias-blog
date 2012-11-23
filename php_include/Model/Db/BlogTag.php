<?php
class Model_Db_BlogTag extends Model_Db_Parent_Common
{
    //ブログに付いてるタグ全削除
    public function deleteByBlogId($blogId)
    {
        $sql =
        'DELETE FROM BlogTag '.
        'WHERE blogId = :blogId';
        return $this->execute($sql, [':blogId'=>$blogId]);
    }
    
    //ブログにタグ付与
    public function insertTags($blogId, $tags)
    {
        $data['blogId'] = $blogId;
        
        $dbTag = new Model_Db_Tag();
        $tags = $dbTag->formatTag($tags);
        foreach ($tags as $tag) {
            if ($data['tagId'] = $dbTag->getIdByName($tag)) {
                if (!$this->insert($data)) {
                    return false;
                }
            }
        }
        return true;
    }
    
    //一旦削除して追加
    public function replaceTag($blogId, $tags)
    {
        if (!$this->deleteByBlogId($blogId)) {
            return false;
        }
        if (!$this->insertTags($blogId, $tags)) {
            return false;
        }
        return true;
    }
    
    public function getTagListByBlogId($blogId)
    {
        $sqlParts = [
            'select' => 't.*',
            'from'   => 'BlogTag AS bt',
            'join'   => ['Tag AS t', 't.id = bt.tagId'],
            'where'  => 'bt.blogId = :blogId',
        ];
        return $this->fetchAll($this->buildSelect($sqlParts), ['blogId'=>$blogId]);
    }
}