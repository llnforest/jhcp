<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;


use admin\index\controller\BaseController;
use model\BaseFeedbackModel;


class Feedback extends BaseController{

    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //留言列表页
    public function index(){
        $orderBy  = '';
        $where  = getWhereParam(['name'=>'like','phone'=>'like'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseFeedbackModel::where($where)
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        return view('index',$data);
    }

    // 删除留言
    public function feedbackDelete(){
        if($this->request->isPost()) {
            $result = BaseFeedbackModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            return operateResult($result->delete(),'feedback/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}