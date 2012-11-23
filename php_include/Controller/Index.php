<?php
class Controller_Index extends Controller_Parent_Public
{
    public function exec()
    {
        $this->assign('title', 'TOP');
        if ($articleList = $this->Db_Blog->search()) {
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
            $this->template->unEscapedAssign('paginator', $articleList['paginator']);
        }
        $this->template->setTemplate('Search');
    }
}
