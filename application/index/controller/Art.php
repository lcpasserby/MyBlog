<?php
namespace app\index\controller;
use app\admin\model\Article as ArtModel;
use app\index\controller\Base;
class Art extends Base
{
    public function lst()
    {
      $mo = new ArtModel();
    	$list =$mo->order('create_time desc')->paginate(6);
      $this->assign([
        'list'=>$list,
    ]);
        return $this->fetch();
    }

    public function detail($id)
    {
      
      $res = db('article')->where('id',intval($id))->find();
      $pre = db('article')->where('id','<',intval($id))->order('id desc')->limit(1)->find();
      $next = db('article')->where('id','>',intval($id))->order('id asc')->limit(1)->find();
      $type = db('cate')->where('id',$res['cateid'])->find();
      $this->assign([
        'art'=>$res,
        'pre'=>$pre,
        'next'=>$next,
        'catetype' => $type,
    ]);
      return $this->fetch();
    }

}
