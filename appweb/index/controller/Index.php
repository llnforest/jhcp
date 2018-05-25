<?php
/**
 * author: Lynn
 * since: 2018/3/23 13:05
 */
namespace web\index\controller;

use chromephp\chromephp;
use model\BaseBannerModel;
use model\BaseHonorModel;
use model\BaseNewsModel;
use model\BaseProductImageModel;
use model\BaseProductModel;
use model\BaseShowModel;


class Index extends BaseController{
    protected $config_page = 12;
    //构造函数
    public function __construct()
    {
        parent::__construct();
    }

    //官网列表页
    public function index(){
        $this->data['productList'] = BaseProductModel::alias('a')
            ->join('tp_base_product_image b','a.id = b.product_id','left')
            ->where(['a.is_recommend' => 0])
            ->field('a.id,a.title,a.content,b.url')
            ->order('a.sort asc,b.sort asc')
            ->group('b.product_id')
            ->limit(8)->select();//产品列表
        $this->data['recommendProductList'] = BaseProductModel::alias('a')
            ->join('tp_base_product_image b','a.id = b.product_id','left')
            ->where(['a.is_recommend' => 1])
            ->field('a.id,a.title,a.content,b.url')
            ->order('a.sort asc,b.sort asc')
            ->group('b.product_id')
            ->limit(4)->select();//产品列表
        $newsList = BaseNewsModel::alias('a')
            ->join('tp_base_category b','a.cate_id = b.id','left')
            ->field('a.id,a.title,a.content,a.url,a.create_time,a.cate_id')
            ->order('b.sort asc,a.sort asc')
            ->select();
        $this->data['newsList'] = [];
        foreach($newsList as $v){
            $this->data['newsList'][$v['cate_id']][] = $v;
        }
        $this->data['showList'] = BaseShowModel::order('sort asc')->limit(4)->select();//展示列表
        $this->data['bannerList'] = BaseBannerModel::order('sort asc')->select();//banner
        $this->data['nav'] = 'index';
        return view('index',$this->data);
    }

    //公司简介
    public function about(){
        $this->data['nav'] = 'our';
        return view('about',$this->data);
    }

    //在线留言
    public function message(){
        $this->data['nav'] = 'our';
        return view('message',$this->data);
    }

    //产品中心
    public function product(){
        $page = !empty($this->param['page'])?$this->param['page']:0;
        $where  = getWhereParam(['a.title'=>'like','a.cate_id'],$this->param);
        $where['is_recommend'] = 0;
        $this->data['list'] = BaseProductModel::alias('a')
            ->where($where)
            ->field('a.id,a.title,a.content,a.view_count,b.url')
            ->join('tp_base_product_image b','a.id = b.product_id','left')
            ->order('a.sort asc,b.sort asc')
            ->group('b.product_id')
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $this->data['page']   = $this->data['list']->render();
        $this->data['nav'] = 'product';
        $this->data['cate_id'] = !empty($this->param['cate_id'])?$this->param['cate_id']:'';
        return view('product',$this->data);
    }

    //产品详情
    public function productDetail(){
        $where  = getWhereParam(['a.id'],$this->param);
        $this->data['productInfo'] = BaseProductModel::alias('a')
            ->join('tp_base_category b','a.cate_id = b.id','left')
            ->where($where)
            ->field('a.*,b.name')
            ->find();
        $this->data['imgList'] = BaseProductImageModel::where(['product_id'=>$this->id])->order('sort asc')->limit(6)->select();
        $this->data['recommend'] = BaseProductModel::alias('a')
            ->join('tp_base_product_image b','a.id = b.product_id','left')
            ->where(['a.id'=>['neq',$this->id],'a.is_recommend'=>0])
            ->field('a.id,a.title,b.url')
            ->group('b.product_id')
            ->order('rand()')
            ->limit('5')
            ->select();
        BaseProductModel::where(['id'=>$this->id])->setInc('view_count',1);
        $this->data['nav'] = 'product';
        return view('productDetail',$this->data);
    }

    //展示详情
    public function show(){
        $where  = getWhereParam(['id'],$this->param);
        $this->data['showInfo'] = BaseShowModel::where($where)->find();
        $this->data['id'] = $this->id;
        $this->data['nav'] = 'show';
        return view('show',$this->data);
    }

    //资质荣誉
    public function honor(){
        $page = !empty($this->param['page'])?$this->param['page']:0;
        $this->data['list'] = BaseHonorModel::order('sort asc')
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $this->data['page']   = $this->data['list']->render();
        $this->data['nav'] = 'honor';
        return view('honor',$this->data);
    }

    //新闻中心
    public function news(){
        $page = !empty($this->param['page'])?$this->param['page']:0;
        $where  = getWhereParam(['title'=>'like','cate_id'],$this->param);
        $this->data['list'] = BaseNewsModel::where($where)
            ->order('sort asc')
            ->paginate($this->config_page,'',['query'=>$this->param]);
        $this->data['page']   = $this->data['list']->render();
        $this->data['recommend'] = BaseNewsModel::order('rand()')->limit(5)->select();
        $this->data['cate_id'] = !empty($this->param['cate_id'])?$this->param['cate_id']:'';
        $this->data['nav'] = 'news';
        return view('news',$this->data);
    }

    //新闻详情
    public function newsDetail(){
        $this->data['newsInfo'] = BaseNewsModel::get($this->id);
        BaseNewsModel::where(['id'=>$this->id])->setInc('view_count',1);
        $this->data['recommend'] = BaseNewsModel::order('rand()')->limit(5)->select();
        $where = getWhereParam(['cate_id'],$this->param);
        $newsList = BaseNewsModel::where($where)->order('sort asc')->select();
        foreach($newsList as $k => $v){
            if($v['id'] == $this->id){
                $sort = $k;
                break;
            }
        }
        if(!empty($newsList[$k-1])) $this->data['prev'] = $newsList[$k-1];
        if(!empty($newsList[$k+1])) $this->data['next'] = $newsList[$k+1];
        $this->data['cate_id'] = !empty($this->param['cate_id'])?$this->param['cate_id']:'';
        $this->data['nav'] = 'news';
        return view('newsDetail',$this->data);
    }

    //联系我们
    public function contact(){
        $this->data['nav'] = 'contact';
        return view('contact',$this->data);
    }

}