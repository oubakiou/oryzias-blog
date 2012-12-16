<?php
class Controller_Detail extends Controller_Parent_Public
{
    public function exec()
    {
        if (isset($this->g['page'])) {
            $this->g['page'] = 1;
        }
        $articleList = $this->Db_Blog->search(['id'=>$this->g['id']], 1, $this->g['page'], $this->isSmartPhone());
        
        if (!$articleList) {
            $this->r('notfound');
        }
        
        $this->template->unEscapedAssign('articleList', $articleList['data']);
        
        $this->assign('isDetail', true);
        $this->assign('title', $articleList['data'][0]['title']);
        if ($articleList['data'][0]['description']) {
            $description = $articleList['data'][0]['description'];
        } else {
            $description = $articleList['data'][0]['body'];
        }
        $this->assign('description', strip_tags($description));
        $this->template->setTemplate('Search');
    }
}
