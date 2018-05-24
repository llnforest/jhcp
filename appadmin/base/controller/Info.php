<?php
/**
 * author: Lynn
 * since: 2018/3/23 12:05
 */
namespace admin\base\controller;

use admin\index\controller\BaseController;
use model\BaseInfoModel;
use think\Validate;


class Info extends BaseController{
    private $roleValidate = ['contact|全国热线' => 'require','web_site|企业官网' => 'require|url','address|企业地址' => 'require','power|版权归属'=>'require','case_info|备案信息'=>'require','logo_url|logo图片' => 'require','qr_url|二维码图片' => 'require'];
    //构造函数
    public function __construct(){
        parent::__construct();
    }

    //网站管理页
    public function index(){
        $this->id = $this->id ? $this->id : 1;
        $data['info'] = BaseInfoModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'info/index','edit');
        }
        return view('index',$data);
    }


}