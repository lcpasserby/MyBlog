<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{
    public function catetree()
    {
      $data = $this->select();
      $res = $this->sort($data);
      return $res;
    }

  public function sort($data,$pid=0,$lv=0)
  {
     static $arr =array();
     foreach ($data as $k => $v) {
       if($v['pid'] == $pid)
       {
         $v['lv'] = $lv;
         $arr[] = $v;
         $this->sort($data,$v['id'],$lv+1);
       }
     }
        return $arr;
  }

  public function getchildrenid($id)
  {
    $cateres = $this->select();
    return $this->_getchildrenid($cateres,$id);
  }

  public function _getchildrenid($cateres,$pid)
  {
    static $arr=array();
    foreach ($cateres as $k => $v) {
      if($v['pid'] == $pid)
      {
        $arr[] = $v['id'];
        $this->_getchildrenid($cateres, $v['id']);
      }
    }
    return $arr;
  }
}
