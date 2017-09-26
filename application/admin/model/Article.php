<?php
namespace app\admin\model;
use think\Model;
class Article extends Model
{
	protected $autoWriteTimestamp = true;
	
	public function cate(){
		return $this->belongsTo('cate','cateid');
	}



}
