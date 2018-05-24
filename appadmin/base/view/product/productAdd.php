<ul class="nav nav-tabs">
    {if condition="checkPath('product/index')"}
    <li><a href="{:Url('product/index')}">产品列表</a></li>
    {/if}
    {if condition="checkPath('product/productAdd')"}
    <li class="active"><a href="{:Url('product/productAdd')}">添加产品</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('product/productAdd')}" method="post">
    {include file="form:form_product" /}
</form>
