<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use app\admin\controller\Base;
class Cate extends Base
{
  // 前置操作
  protected $beforeActionList = [
       'delsoncate'  =>  ['only'=>'del'],
   ];

    public function lst()
    {
    	$list = new CateModel();
      $cateres = $list-> catetree();
    	$this->assign('list',$cateres);
        return $this->fetch();
    }

    public function add()
    {
      $list = new  CateModel();
      $res = $list-> catetree();
    	if(request()->isPost()){

			$data=[
    			'catename'=>input('catename'),
          'pid'   => input('pid'),
    		];
    		$validate = \think\Loader::validate('Cate');
    		if(!$validate->scene('add')->check($data)){
			   $this->error($validate->getError()); die;
			}
    		if(db('cate')->insert($data)){
    			return $this->success('添加栏目成功！','lst');
    		}else{
    			return $this->error('添加栏目失败！');
    		}
    		return;
    	}
         $this->assign('res',$res);
        return $this->fetch();
    }

    public function edit(){
      $list = new  CateModel();
      $res = $list-> catetree();

    	$id=input('id');
    	$cates=db('cate')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
    			'catename'=>input('catename'),
          'pid'=>input('pid'),
    		];
			$validate = \think\Loader::validate('cate');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
            $save=db('cate')->update($data);
    		if($save !== false){
    			$this->success('修改栏目成功！','lst');
    		}else{
    			$this->error('修改栏目失败！');
    		}
    		return;
    	}
    	$this->assign([
        'cates'=>$cates,
        'res' => $res,
    ]);
    	return $this->fetch();
    }

    public function del(){
    	$id=input('id');
    	if($id != 2){
    		if(db('cate')->delete(input('id'))){
    			$this->success('删除栏目成功！','lst');
    		}else{
    			$this->error('删除栏目失败！');
    		}
    	}else{
    		$this->error('初始化栏目不能删除！');
    	}

    }

    public function delsoncate()
    {
      $cateid = input('id');
        $list = new  CateModel();
        $childrenid = $list->getchildrenid($cateid);
        if($childrenid)
        {
          db('cate')->delete($childrenid);
        }
    }



}
