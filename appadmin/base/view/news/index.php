<ul class="nav nav-tabs">
    {if condition="checkPath('news/index')"}
    <li class="active"><a href="{:Url('news/index')}">新闻列表</a></li>
    {/if}
    {if condition="checkPath('news/newsAdd')"}
    <li><a href="{:Url('news/newsAdd')}">添加新闻</a></li>
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
                <th width="80">作者</th>
                <th width="80">次数</th>
                <th width="80">排序<span order="a.sort" class="order-sort"> </span></th>
                <th width="80">创建时间<span order="a.create_time" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.title}</td>
                    <td>{$v.name}</td>
                    <td>{$v.author}</td>
                    <td>{$v.view_count}</td>
                    <td>
                        {if condition="checkPath('news/inputNews')"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('news/inputNews')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td>{$v.create_time}</td>
                    <td>
                        {if condition="checkPath('news/newsEdit',['id'=>$v['id']])"}
                        <a  href="{:url('news/newsEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('news/newsDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('news/newsDelete',['id'=>$v['id']])}">删除</a>
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