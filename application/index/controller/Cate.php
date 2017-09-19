<?php
namespace app\index\controller;
use app\admin\model\Article as ArtModel;
use app\index\controller\Base;
class Cate extends Base
{
    public function lst($id)
    {
      $mo = new ArtModel();
    	$list =$mo->where('cateid',$id)->paginate(5);
      $type = db('cate')->where('id',$id)->find();
    	$this->assign([
        'list'=>$list,
        'catetype'=>$type,
    ]);
        return $this->fetch();
    }

}
