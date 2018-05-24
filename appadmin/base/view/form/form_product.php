<script type="text/javascript" charset="utf-8" src="__PublicAdmin__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PublicAdmin__/ueditor/ueditor.all.min.js"> </script>
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>产品分类</th>
                <td>
                    <div class="layui-form select">
                        <select name="cate_id" class="form-control">
                            {foreach $cateList as $item}
                            <option value="{$item.id}" {if input('cate_id') == $item.id}selected{/if}>{$item.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>产品名称</th>
                <td>
                    <input class="form-control text" type="text" name="title" value="{$info.title??''}" placeholder="产品名称">
                </td>
            </tr>
            <tr>
                <th>内容简介</th>
                <td>
                    <textarea class="form-control text" type="text" name="content" placeholder="内容简介">{$info.content??''}</textarea>
                </td>
            </tr>
            <tr>
                <th>产品排序</th>
                <td>
                    <input class="form-control text" type="text" name="sort" value="{$info.sort??''}" placeholder="产品排序">
                </td>
            </tr>
            <tr>
                <th>展示图片</th>
                <td>
                    <div class="img-wrap">
                        {if isset($imgList)}
                        {foreach $imgList as $item}
                        <div class="img-block">
                            <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'product'])}'}">
                                <i class="layui-icon">&#xe67c;</i>上传图片
                                <input class="image" type="hidden" name="url" value="{$item.url??''}">
                                <img class="mini-image" data-path="__ImagePath__" src="__ImagePath__{$item.url}">
                            </button>
                            <input type="text" class="form-control img-sort" placeholder="排序" value="{$item.sort??''}">
                            <button class="layui-btn layui-btn-primary layui-btn-sm img-delete">
                                <i class="layui-icon">&#xe640;</i>
                            </button>
                        </div>
                        {/foreach}
                        {else}
                        <div class="img-block">
                            <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'product'])}'}">
                                <i class="layui-icon">&#xe67c;</i>上传图片
                                <input class="image" type="hidden" name="url" value="">
                                <img class="mini-image hidden" data-path="__ImagePath__" src="">
                            </button>
                            <input type="text" class="form-control img-sort" placeholder="排序">
                            <button class="layui-btn layui-btn-primary layui-btn-sm img-delete">
                                <i class="layui-icon">&#xe640;</i>
                            </button>
                        </div>
                        {/if}
                    </div>
                    <div class="img-block clone">
                        <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'product'])}'}">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                            <input class="image" type="hidden" name="url" value="">
                            <img class="mini-image hidden" data-path="__ImagePath__" src="">
                        </button>
                        <input type="text" class="form-control img-sort" placeholder="排序">
                        <button class="layui-btn layui-btn-primary layui-btn-sm img-delete">
                            <i class="layui-icon">&#xe640;</i>
                        </button>
                    </div>
                    <div class="add-img-btn">
                        <i class="layui-icon">&#xe654;</i>
                    </div>
                </td>
            </tr>
            <tr>
                <th>描述内容</th>
                <td>
                    <script id="content" name="description" type="text/plain" style="width:850px;height:400px;">{$info.description??''}</script>
                    </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input id="img_data" type="hidden" name="img_data" value="">
                    <button type="button" class="btn btn-success form-post " >保存</button>
                    <a class="btn btn-default active" href="JavaScript:history.go(-1)">返回</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('content');
    $(function(){
        $(".add-img-btn").click(function(){
            var _clone = $(".clone").clone(true,true).removeClass("clone");
            $(".img-wrap").append(_clone);
            return false;
        })

        $(".img-delete").click(function(){
            $(this).parents('.img-block').remove();
        })

        $(".form-post").click(function(){
            var sublist = [];
            $(".img-wrap .img-block").each(function(index,item){
                var url = $(item).find(".image").val();
                if(url == '') return;
                var sort = $(item).find(".img-sort").val().trim();
                sublist.push({'url':url,sort:sort});
            })
            $("#img_data").val(JSON.stringify(sublist));
        })
    })
</script>

