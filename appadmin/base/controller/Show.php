<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;


use admin\index\controller\BaseController;
use model\BaseCaseCategoryModel;
use model\BaseShowModel;
use think\Config;
use think\Validate;


class Show extends BaseController{

    private $roleValidate = ['title|基地名称' => 'require','description|文章描述' => 'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //基地列表页
    public function index(){
        $orderBy  = 'sort asc';
        $where  = getWhereParam(['title'=>'like'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseShowModel::where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加基地
    public function showAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseShowModel::create($this->param),'show/index','add');
        }
        return view('showAdd');
    }

    //修改基地
    public function showEdit(){
        $data['info'] = BaseShowModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'show/index','edit');
        }
        return view('showEdit',$data);
    }

    // 删除基地
    public function showDelete(){
        if($this->request->isPost()) {
            $result = BaseShowModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            @unlink(Config::get('upload.path').$result['url']);
            return operateResult($result->delete(),'show/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序基地
    public function inputShow(){
        if($this->request->isPost()) {
            $result = BaseShowModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}