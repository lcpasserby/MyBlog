<?php
namespace app\index\controller;
use app\index\controller\Base;
use app\admin\model\Article as ArticleModel;
class Search extends Base
{
    public function lst()
    {
      $k = input('get.keywords');
      $art = new ArticleModel();
    	$list =  $art->where('keywords|title','like','%'.$k.'%' )->order('update_time desc')->paginate(5,false,$config=['query'=>array('keywords'=>$k)]);
      $this->assign([
        'list'=>$list,
        'num' => count($list),
        'keywords'=>$k,
    ]);

        return $this->fetch();
    }

}
