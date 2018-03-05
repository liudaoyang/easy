<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        if (file_exists(APP_PATH .'index/view/index/index2.html')) {
            return $this->fetch('index2');
        }
        return $this->fetch('index');
    }

}
