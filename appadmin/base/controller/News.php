<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;


use admin\index\controller\BaseController;
use model\BaseCategoryModel;
use model\BaseNewsModel;
use think\Config;
use think\Validate;


class News extends BaseController{

    private $roleValidate = ['title|新闻标题' => 'require','description|文章描述' => 'require','cate_id|新闻分类' => 'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //新闻列表页
    public function index(){
        $orderBy  = 'sort asc';
        $where  = getWhereParam(['a.title'=>'like','a.cate_id'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseNewsModel::alias('a')
            ->join('tp_base_category b','a.cate_id = b.id','left')
            ->where($where)
            ->field('a.*,b.name')
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        $data['cateList'] = BaseCategoryModel::where(['type'=>2])->order('sort asc')->select();
        return view('index',$data);
    }

    //添加新闻
    public function newsAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            return operateResult(BaseNewsModel::create($this->param),'news/index','add');
        }
        $data['cateList'] = BaseCategoryModel::where(['type'=>2])->order('sort asc')->select();
        return view('newsAdd',$data);
    }

    //修改新闻
    public function newsEdit(){
        $data['info'] = BaseNewsModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            return operateResult($data['info']->save($this->param),'news/index','edit');
        }
        $data['cateList'] = BaseCategoryModel::where(['type'=>2])->order('sort asc')->select();
        return view('newsEdit',$data);
    }

    // 删除新闻
    public function newsDelete(){
        if($this->request->isPost()) {
            $result = BaseNewsModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            @unlink(Config::get('upload.path').$result['url']);
            return operateResult($result->delete(),'news/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序新闻
    public function inputNews(){
        if($this->request->isPost()) {
            $result = BaseNewsModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}