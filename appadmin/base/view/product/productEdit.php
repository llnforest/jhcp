<ul class="nav nav-tabs">
    {if condition="checkPath('product/index')"}
    <li><a href="{:Url('product/index')}">产品列表</a></li>
    {/if}
    {if condition="checkPath('product/productAdd')"}
    <li><a href="{:Url('product/productAdd')}">添加产品</a></li>
    {/if}
    {if condition="checkPath('product/productEdit',['id'=>$info.id])"}
    <li class="active"><a href="{:Url('product/productEdit',['id'=>$info.id])}">修改产品</a></li>
    {/if}
</ul>
 <form  class="form-horizontal" action="{:url('product/productEdit',['id'=>$info.id])}" method="post">
    {include file="form:form_product" /}
</form>
