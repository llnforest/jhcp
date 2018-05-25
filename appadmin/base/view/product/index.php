<ul class="nav nav-tabs">
    {if condition="checkPath('product/index')"}
    <li class="active"><a href="{:Url('product/index')}">产品列表</a></li>
    {/if}
    {if condition="checkPath('product/productAdd')"}
    <li><a href="{:Url('product/productAdd')}">添加产品</a></li>
    {/if}
</ul>
 <div>
     <div class="cf well form-search row">
         <form  method="get">
             <div class="fl">
                 <div class="btn-group">
                     <input name="title" value="{:input('title')}" placeholder="标题" class="form-control"  type="text">
                 </div>
                 <div class="btn-group layui-form">
                     <select name="cate_id" class="form-control">
                         <option value="">全部分类</option>
                         {foreach $cateList as $item}
                         <option value="{$item.id}" {if input('cate_id') == $item.id}selected{/if}>{$item.name}</option>
                         {/foreach}
                     </select>
                 </div>
                 <div class="btn-group">
                     <button type="submit" class="btn btn-success">查询</button>
                 </div>
             </div>
         </form>
     </div>
        <table class="table table-hover table-bordered table-list" id="menus-table">
            <thead>
            <tr>
                <th width="80">标题</th>
                <th width="80">分类</th>
                <th width="80">推荐</th>
                <th width="80">排序<span order="a.sort" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.title}</td>
                    <td>{$v.name}</td>
                    <td class="layui-form">
                        {if condition="checkPath('product/switchProduct',['id'=>$v.id])"}
                        <input type="checkbox" data-name="is_recommend" data-url="{:url('product/switchProduct',['id'=>$v.id])}" lay-skin="switch" lay-text="是|否" {$v.is_recommend == 1 ?'checked':''} data-value="1|0">
                        {else}
                        {$v.is_recommend == 1?'<span class="blue">是</span>':'<span class="red">否</span>'}
                        {/if}
                    </td>
                    <td>
                        {if condition="checkPath('product/inputProduct')"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('product/inputProduct')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td>
                        {if condition="checkPath('product/productEdit',['id'=>$v['id']])"}
                        <a  href="{:url('product/productEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('product/productDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('product/productDelete',['id'=>$v['id']])}">删除</a>
                        {/if}
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
    <div class="text-center">
        {$page}
    </div>