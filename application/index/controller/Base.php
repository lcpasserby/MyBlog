<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize()
    {
    	$list = db('links')->select();
      $art = db('article')->order('click desc')->limit(5)->select();
       $this->getNavCates();
    	$this->assign([
        'res'=>$list,
        'hotart'=>$art,
        'count'=>count($art),
    ]);

    }

    public function getNavCates()
    {
      $cateres = db('cate')->where('pid',0)->select();
      foreach ($cateres as $k => $v) {
        $children = db('cate')->where('pid',$v['id'])->select();
        if($children)
        {
          $cateres[$k]['children'] = $children;
        }else{
          $cateres[$k]['children'] = 0;
        }
      }
      $this->assign('cateres',$cateres);
    }


}
