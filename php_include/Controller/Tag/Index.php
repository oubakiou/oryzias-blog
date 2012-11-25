<?php
class Controller_Tag_Index extends Controller_Parent_Public
{
    public function exec()
    {
        //タグ一覧
        if ($tagList = $this->Db_Tag->getTagList(10)) {
            $this->assign('tagList', $tagList['data']);
            $this->template->unescapedAssign('paginator', $tagList['paginator']);
        }
        $this->assign('title', 'タグ一覧');
    }
}
