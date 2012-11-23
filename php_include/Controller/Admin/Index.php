<?php
class Controller_Admin_Index extends Controller_Parent_Admin
{
    function exec()
    {
        //ブログ一覧の取得
        $blogList = $this->Db_Blog->search(['ignorePublic'=>true]);
        if ($blogList) {
            $this->assign('blogList', $blogList['data']);
            $this->assign('paginator', $blogList['paginator']);
        }
    }
}
