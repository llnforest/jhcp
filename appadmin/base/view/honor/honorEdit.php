<ul class="nav nav-tabs">
    {if condition="checkPath('honor/index')"}
    <li><a href="{:Url('honor/index')}">荣誉列表</a></li>
    {/if}
    {if condition="checkPath('honor/honorAdd')"}
    <li><a href="{:Url('honor/honorAdd')}">添加荣誉</a></li>
    {/if}
    {if condition="checkPath('honor/honorEdit',['id'=>$info.id])"}
    <li class="active"><a href="{:Url('honor/honorEdit',['id'=>$info.id])}">修改荣誉</a></li>
    {/if}
</ul>
 <form  class="form-horizontal" action="{:url('honor/honorEdit',['id'=>$info.id])}" method="post">
    {include file="form:form_honor" /}
</form>
