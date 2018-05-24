<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace admin\base\controller;


use admin\index\controller\BaseController;
use model\BaseCategoryModel;
use model\BaseProductImageModel;
use model\BaseProductModel;
use think\Config;
use think\Validate;


class Product extends BaseController{

    private $roleValidate = ['title|产品标题' => 'require','description|文章描述' => 'require','cate_id|新闻分类' => 'require'];
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //产品列表页
    public function index(){
        $orderBy  = 'sort asc';
        $where  = getWhereParam(['a.title'=>'like','a.cate_id'],$this->param);
        if(!empty($this->param['order'])) $orderBy = $this->param['order'].' '.$this->param['by'];

        $data['list'] = BaseProductModel::alias('a')
            ->join('tp_base_category b','a.cate_id = b.id','left')
            ->where($where)
            ->field('a.*,b.name')
            ->order($orderBy)
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $data['page']   = $data['list']->render();
        $data['cateList'] = BaseCategoryModel::where(['type'=>1])->order('sort asc')->select();
        return view('index',$data);
    }

    //添加产品
    public function productAdd(){
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0, 'msg' => $validate->getError()];
            $product = BaseProductModel::create($this->param);
            if($product){
                $imgList = json_decode($this->param['img_data'],true);
                if(count($imgList) > 0){
                    foreach($imgList as &$item){
                        $item['product_id'] = $product['id'];
                    }
                    $imgModel = new BaseProductImageModel();
                    $imgModel->saveAll($imgList);
                }
            }
            return operateResult($product,'product/index','add');
        }
        $data['cateList'] = BaseCategoryModel::where(['type'=>1])->order('sort asc')->select();
        return view('productAdd',$data);
    }

    //修改产品
    public function productEdit(){
        $data['info'] = BaseProductModel::get($this->id);
        if(!$data['info']) $this->error(lang('sys_param_error'));
        if($this->request->isPost()){
            $validate = new Validate($this->roleValidate);
            if(!$validate->check($this->param)) return ['code' => 0,'msg' => $validate->getError()];
            $product = $data['info']->save($this->param);
            if($product){
                BaseProductImageModel::where(['product_id'=>$this->id])->delete();
                $imgList = json_decode($this->param['img_data'],true);
                if(count($imgList) > 0){
                    foreach($imgList as &$item){
                        $item['product_id'] = $this->id;
                    }
                    $imgModel = new BaseProductImageModel();
                    $imgModel->saveAll($imgList);
                }
            }

            return operateResult($product,'product/index','edit');
        }
        $data['cateList'] = BaseCategoryModel::where(['type'=>1])->order('sort asc')->select();
        $data['imgList'] = BaseProductImageModel::where(['product_id'=>$this->id])->order('sort asc')->select();
        return view('productEdit',$data);
    }

    // 删除产品
    public function productDelete(){
        if($this->request->isPost()) {
            $result = BaseProductModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            @unlink(Config::get('upload.path').$result['url']);
            return operateResult($result->delete(),'product/index','del');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

    // 排序产品
    public function inputProduct(){
        if($this->request->isPost()) {
            $result = BaseProductModel::get($this->id);
            if (empty($result)) return ['code' => 0, 'msg' => lang('sys_param_error')];
            $data = [$this->param['name'] => $this->param['data']];
            return inputResult($result->save($data),'sort');
        }
        return ['code'=>0,'msg'=>lang('sys_method_error')];
    }

}