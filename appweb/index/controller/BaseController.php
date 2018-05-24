<?php
namespace web\index\controller;


use model\BaseCategoryModel;
use model\BaseInfoModel;
use model\BaseShowModel;
use think\Config;
use think\Controller;
use think\Request;


class BaseController extends Controller
{
    protected $data;
    protected $request;
    protected $param;
    protected $id;
    protected $imgHost;

    //构造函数
    public function __construct()
    {
        $this->request = Request::instance();
        $this->param = $this->request->param();

        $this->id = !empty($this->param['id'])?$this->param['id']:'';
        $this->imgHost = Config::get('upload.img_url');

        if(!Config::get('sys_open')){
            return die(json_encode(['code' =>1001,'msg'=>'系统维护升级中，请稍候再试！']));
        }

        //页面通用
        $this->data['info'] = BaseInfoModel::get(1);
        $this->data['productCate'] = BaseCategoryModel::where(['type'=>1])->order('sort asc')->select();
        $this->data['newsCate'] = BaseCategoryModel::where(['type'=>2])->order('sort asc')->select();
        $this->data['showCate'] = BaseShowModel::order('sort asc')->field('title,id')->select();

        parent::__construct();
    }


}
