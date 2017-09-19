<?php
namespace app\index\controller;
use app\admin\model\Article as ArtModel;
use app\index\controller\Base;
class Art extends Base
{
    public function lst()
    {
      $mo = new ArtModel();
    	$list =$mo->order('time desc')->paginate(6,true);
      $this->assign([
        'list'=>$list,
    ]);
        return $this->fetch();
    }

    public function detail($id)
    {
      $min = db('article')->min('id');
      $max = db('article')->max('id');
      $preid = $id-1;
      $nextid= $id+1;

      $res = db('article')->find($id);
      if(!$res)
      {
        $res = db('article')->where('id',$min)->find();
      }
      db('article')->where('id',$id)->setInc('click');
     
      while(!$pre=db('article')->where('id',$preid)->find())
      {
            $preid=$preid-1;
            if($preid<$min){
              break;
            }

      }
      while(!$next=db('article')->where('id',$nextid)->find())
      {
            $nextid=$nextid+1;
             if($nextid>$max){
              break;
            }
      }
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
