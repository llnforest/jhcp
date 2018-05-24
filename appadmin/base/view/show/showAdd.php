<ul class="nav nav-tabs">
    {if condition="checkPath('show/index')"}
    <li><a href="{:Url('show/index')}">基地列表</a></li>
    {/if}
    {if condition="checkPath('show/showAdd')"}
    <li class="active"><a href="{:Url('show/showAdd')}">添加基地</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('show/showAdd')}" method="post">
    {include file="form:form_show" /}
</form>
