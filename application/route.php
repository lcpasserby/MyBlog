<?php
/**
 * 定义路由
 */

return [
   '/art' => 'index/art/lst',
   'detail/:id'=> 'index/art/detail',
   'cate/:id'=> 'index/cate/lst',
   'search/[:keywords]' => 'index/search/lst'

];
