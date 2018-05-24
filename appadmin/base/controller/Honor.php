<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;


use admin\index\controller\BaseController;
use model\BaseHonorModel;
use think\Config;
use think\Validate;


class Honor extends BaseController{

    private $roleValidate = ['title|荣誉名称' => 'require','url|展示图片' => 'require','get_date|获奖日期' => 'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //获奖列表页
    public function index(){
        $orderBy  = 'sort asc';
        $where  = getWhereParam(['title'=>'like'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseHonorModel::where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加获奖
    public function honorAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseHonorModel::create($this->param),'honor/index','add');
        }
        return view('honorAdd');
    }

    //修改获奖
    public function honorEdit(){
        $data['info'] = BaseHonorModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'honor/index','edit');
        }
        return view('honorEdit',$data);
    }

    // 删除获奖
    public function honorDelete(){
        if($this->request->isPost()) {
            $result = BaseHonorModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            @unlink(Config::get('upload.path').$result['url']);
            return operateResult($result->delete(),'honor/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序获奖
    public function inputHonor(){
        if($this->request->isPost()) {
            $result = BaseHonorModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}