<ul class="nav nav-tabs">
    {if condition="checkPath('feedback/index')"}
    <li class="active"><a href="{:Url('feedback/index')}">留言列表</a></li>
    {/if}
</ul>
 <div>
     <div class="cf well form-search row">

         <form  method="get">
             <div class="fl">
                 <div class="btn-group">
                     <input name="name" value="{:input('name')}" placeholder="姓名" class="form-control"  type="text">
                 </div>
                 <div class="btn-group">
                     <input name="phone" value="{:input('phone')}" placeholder="手机" class="form-control"  type="text">
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
                <th width="80">姓名</th>
                <th width="80">手机</th>
                <th width="80">邮箱</th>
                <th width="80">地址</th>
                <th width="80">内容</th>
                <th width="80">留言时间<span order="create_time" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.name}</td>
                    <td>{$v.phone}</td>
                    <td>{$v.email}</td>
                    <td>{$v.address}</td>
                    <td>{if $v.content}<span class="span-primary" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top"
                                                 data-content="{$v.content}">明细</span>{/if}</td>
                    <td>{$v.create_time}</td>
                    <td>
                        {if condition="checkPath('feedback/feedbackDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('feedback/feedbackDelete',['id'=>$v['id']])}">删除</a>
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