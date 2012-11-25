<?php
abstract class Controller_Parent_Public extends Controller_Parent_Common
{
    public function init()
    {
        parent::init();
        $this->assign('blogTitle', Oryzias\Config::get('blog.title'));
        $this->assign('blogDescription', Oryzias\Config::get('blog.description'));
        $this->assign('blogLogo', Oryzias\Config::get('blog.logoUrl'));
        $this->assign('blogAuthorName', Oryzias\Config::get('blog.authorName'));
        $this->assign('blogBaseUrl', 'http://' . $_SERVER['HTTP_HOST'] . '/');
        
        if (Oryzias\Config::get('disqus.enabled')) {
            $this->assign('discusShortName', Oryzias\Config::get('disqus.shortName'));
        }
        
        //新着
        if (!isset($this->g['page'])) {
            $this->g['page'] = 1;
        }
        $recentBlogList = $this->Db_Blog->search([], 10, $this->g['page']);
        $this->assign('recentBlogList', $recentBlogList['data']);
        
        //タグ一覧
        if ($tagList = $this->Db_Tag->getTagList(10)) {
            $this->assign('tagList', $tagList['data']);
        }
    }
}