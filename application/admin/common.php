<?php
   // 加密
define('SALT', 'admin');
function encrypt($data){
    return md5(SALT.md5($data).SALT);
}