<ul class="nav nav-tabs">
    {if condition="checkPath('news/index')"}
    <li><a href="{:Url('news/index')}">新闻列表</a></li>
    {/if}
    {if condition="checkPath('news/newsAdd')"}
    <li class="active"><a href="{:Url('news/newsAdd')}">添加新闻</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('news/newsAdd')}" method="post">
    {include file="form:form_news" /}
</form>
