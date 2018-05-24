<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;


use admin\index\controller\BaseController;
use model\BaseCategoryModel;
use model\BaseHornorModel;
use model\BaseNewsModel;
use model\BaseProductModel;
use think\Validate;


class Category extends BaseController{

    private $roleValidate = ['name|案例分类' => 'require','type|所属标签'=>'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //案例分类列表页
    public function index(){
        $orderBy  = 'type asc,sort asc';
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseCategoryModel::order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    //添加案例分类
    public function categoryAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseCategoryModel::create($this->param),'category/index','add');
        }
        return view('categoryAdd');
    }

    //修改案例分类
    public function categoryEdit(){
        $data['info'] = BaseCategoryModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'category/index','edit');
        }
        return view('categoryEdit',$data);
    }

    // 删除案例分类
    public function categoryDelete(){
        if($this->request->isPost()) {
            $result = BaseCategoryModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            if(empty(BaseProductModel::get(['cate_id' => $this->id])) && empty(BaseNewsModel::get(['cate_id'=>$this->id])))
                return operateResult($result->delete(),'category/index','del');
            else return ['code' => 0,'msg' => '该案例分类已经应用，不能删除'];
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序案例分类
    public function inputCategory(){
        if($this->request->isPost()) {
            $result = BaseCategoryModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}