<?php
class Controller_Detail extends Controller_Parent_Public
{
    public function exec()
    {
        if (isset($this->g['page'])) {
            $this->g['page'] = 1;
        }
        if ($articleList = $this->Db_Blog->search(['id'=>$this->g['id'], 1, $this->g['page']])) {
            foreach ($articleList['data'] as $k=>$v) {
                if ($this->isSmartPhone()) {
                    $articleList['data'][$k]['body'] = $v['bodyHtmlSp'];
                    if (isset($v['keyImage']['urlForPc'])) {
                        $articleList['data'][$k]['keyImageUrl'] = $v['keyImage']['urlForPc'];
                    }
                } else {
                    $articleList['data'][$k]['body'] = $v['bodyHtmlPc'];
                    if (isset($v['keyImage']['urlForSp'])) {
                        $articleList['data'][$k]['keyImageUrl'] = $v['keyImage']['urlForSp'];
                    }
                }
            }
            $this->template->unEscapedAssign('articleList', $articleList['data']);
        }
        
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
