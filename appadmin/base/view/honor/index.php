<ul class="nav nav-tabs">
    {if condition="checkPath('honor/index')"}
    <li class="active"><a href="{:Url('honor/index')}">荣誉列表</a></li>
    {/if}
    {if condition="checkPath('honor/honorAdd')"}
    <li><a href="{:Url('honor/honorAdd')}">添加荣誉</a></li>
    {/if}
</ul>
 <div>
     <div class="cf well form-search row">

         <form  method="get">
             <div class="fl">
                 <div class="btn-group">
                     <input name="title" value="{:input('title')}" placeholder="荣誉名称" class="form-control"  type="text">
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
                <th width="80">荣誉名称</th>
                <th width="80">获奖日期<span order="get_date" class="order-sort"> </span></th>
                <th width="80">排序<span order="sort" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.title}</td>
                    <td>{$v.get_date}</td>
                    <td>
                        {if condition="checkPath('honor/inputHonor')"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('honor/inputHonor')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td>
                        {if condition="checkPath('honor/honorEdit',['id'=>$v['id']])"}
                            <a  href="{:url('honor/honorEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('honor/honorDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('honor/honorDelete',['id'=>$v['id']])}">删除</a>
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