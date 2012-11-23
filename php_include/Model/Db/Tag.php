<?php
class Model_Db_Tag extends Model_Db_Parent_Common
{
    public function formatTag($tagStr)
    {
        $tagStr = str_replace(array('　', ',', '、'), ' ', $tagStr);
        return explode(' ', $tagStr);
    }
    
    public function unFormatTag($tags)
    {
        if (!count($tags)) {
            return '';
        }
        foreach ($tags as $tag) {
            $result[] = $tag['name'];
        }
        return implode(' ', $result);
    }
    
    //無ければinsertしてidを返す
    public function getIdByName($name)
    {
        if (!trim($name)) {
            return false;
        }
        
        if ($id = $this->getByName($name)) {
            return $id['id'];
        }
        
        return $this->insert(['name'=>$name]);
    }
    
    public function getTagList($perPage=1000, $currentPage=1)
    {
        $sqlParts = [
            'select'=>'t.*',
            'from'=>'Tag as t',
            'join'=>['BlogTag AS bt', 'bt.tagId = t.id'],
            'groupBy'=>'t.id',
            'orderBy'=>'createdAt DESC',
        ];
        $sql = $this->buildSelect($sqlParts);
        if($result = $this->fetchAllWithPaginator($sql, [], $perPage, $currentPage)){
            return $result;
        }else{
            return false;
        }
    }
}