<ul class="nav nav-tabs">
    {if condition="checkPath('category/index')"}
    <li><a href="{:Url('category/index')}">分类列表</a></li>
    {/if}
    {if condition="checkPath('category/categoryAdd')"}
    <li><a href="{:Url('category/categoryAdd')}">添加分类</a></li>
    {/if}
    {if condition="checkPath('category/categoryEdit',['id'=>$info.id])"}
    <li class="active"><a href="{:Url('category/categoryEdit',['id'=>$info.id])}">修改分类</a></li>
    {/if}
</ul>
 <form  class="form-horizontal" action="{:url('category/categoryEdit',['id'=>$info.id])}" method="post">
    {include file="form:form_category" /}
</form>
