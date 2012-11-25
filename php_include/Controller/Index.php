<?php
class Controller_Index extends Controller_Parent_Public
{
    public function exec()
    {
        $page = 1;
        if (isset($this->g['page'])) {
            $page = $this->g['page'];
        }
        
        $this->assign('title', 'TOP');
        if ($articleList = $this->Db_Blog->search([], 10, $page, $this->isSmartPhone())) {
            $this->template->unEscapedAssign('articleList', $articleList['data']);
            $this->template->unEscapedAssign('paginator', $articleList['paginator']);
        }
        
        if (isset($this->g['output'])) {
            $output = $this->g['output'];
        } else {
            $output = 'html';
        }
        
        if ($output == 'rss') {
            header('Content-Type: text/xml; charset=utf-8');
            $this->template->setTemplate('Rss');
        } else {
            $this->template->setTemplate('Search');
        }
    }
}
