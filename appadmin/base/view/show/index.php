<ul class="nav nav-tabs">
    {if condition="checkPath('show/index')"}
    <li class="active"><a href="{:Url('show/index')}">基地列表</a></li>
    {/if}
    {if condition="checkPath('show/showAdd')"}
    <li><a href="{:Url('show/showAdd')}">添加基地</a></li>
    {/if}
</ul>
 <div>
     <div class="cf well form-search row">

         <form  method="get">
             <div class="fl">
                 <div class="btn-group">
                     <input name="title" value="{:input('title')}" placeholder="基地名称" class="form-control"  type="text">
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
                <th width="80">基地名称</th>
                <th width="80">排序<span order="sort" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.title}</td>
                    <td>
                        {if condition="checkPath('show/inputShow')"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('show/inputShow')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td>
                        {if condition="checkPath('show/showEdit',['id'=>$v['id']])"}
                            <a  href="{:url('show/showEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('show/showDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('show/showDelete',['id'=>$v['id']])}">删除</a>
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