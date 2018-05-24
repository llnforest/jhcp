<ul class="nav nav-tabs">
    {if condition="checkPath('honor/index')"}
    <li><a href="{:Url('honor/index')}">荣誉列表</a></li>
    {/if}
    {if condition="checkPath('honor/honorAdd')"}
    <li class="active"><a href="{:Url('honor/honorAdd')}">添加荣誉</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('honor/honorAdd')}" method="post">
    {include file="form:form_honor" /}
</form>
