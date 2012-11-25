<?php
class Controller_Tag_BlogList extends Controller_Parent_Public
{
    public function exec()
    {
        if (!isset($this->g['tagId'])) {
            $this->r('/notfound');
        }
        
        $articleList = $this->Db_Blog->search(['tagId'=>$this->g['tagId']]);
        if ($articleList['data']) {
            $this->template->unEscapedAssign('articleList', $articleList['data']);
            $this->template->unEscapedAssign('paginator', $articleList['paginator']);
        }
        $this->assign('title', $this->Db_Tag->getNameById($this->g['tagId']));
        $this->template->setTemplate('Search');
    }
}
