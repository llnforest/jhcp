<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace web\index\controller;

use chromephp\chromephp;
use model\BaseFeedbackModel;
use model\BaseNewsModel;
use model\BaseInfoModel;
use model\BaseProductModel;
use model\BaseShowModel;
use think\Controller;
use think\Request;
use think\Validate;


class Api extends Controller {
    protected $post;
    protected $request;
    //构造函数
    public function __construct()
    {
        $this->request = Request::instance();
        $this->post = $this->request->post();
        parent::__construct();
    }

    //提交个人信息
    public function submitFeedback(){
        $roleValidate = ['name|姓名' => 'require','phone|电话'=>'contact','info|留言内容'=>'require'];
        $validate = new Validate($roleValidate);
        if(!$validate->check($this->post)) return ['code' => 0, 'msg' => $validate->getError()];
        if(!empty(BaseFeedbackModel::where(['name'=>$this->post['name'],'phone'=>$this->post['phone'],'info'=>$this->post['info']])->find())){
            return ['code' => 1, 'msg' => '我们已成功收到您的留言'];
        }
        if(BaseFeedbackModel::create($this->post)){
            return ['code' => 1, 'msg' => '我们已成功收到您的留言'];
        } else {
            return ['code' => 0, 'msg' => '网络异常，请稍后再试'];
        }
    }


}