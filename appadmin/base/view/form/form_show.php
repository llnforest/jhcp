<script type="text/javascript" charset="utf-8" src="__PublicAdmin__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PublicAdmin__/ueditor/ueditor.all.min.js"> </script>
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>基地名称</th>
                <td>
                    <input class="form-control text" type="text" name="title" value="{$info.title??''}" placeholder="基地名称">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>描述简介</th>
                <td>
                    <textarea class="form-control text" name="content" placeholder="描述简介">{$info.content??''}</textarea>
                </td>
            </tr>
            <tr>
                <th>基地排序</th>
                <td class="layui-form">
                    <input class="form-control text" type="text" name="sort" value="{$info.sort??''}" placeholder="基地排序">
                </td>
            </tr>
            <tr>
                <th>展示图片</th>
                <td>
                    <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'show'])}'}">
                        <i class="layui-icon">&#xe67c;</i>上传展示图片
                        <input class="image" type="hidden" name="url" value="{$info.url??''}">
                        <img class="mini-image {$info.url?'':'hidden'}" data-path="__ImagePath__" src="{$info.url?'__ImagePath__'.$info.url:''}">
                    </button>
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
                    <button type="button" class="btn btn-success form-post " >保存</button>
                    <a class="btn btn-default active" href="JavaScript:history.go(-1)">返回</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('content');
</script>

