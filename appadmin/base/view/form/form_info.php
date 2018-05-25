<script type="text/javascript" charset="utf-8" src="__PublicAdmin__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PublicAdmin__/ueditor/ueditor.all.min.js"> </script>
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>全国热线</th>
                <td>
                    <input class="form-control text" type="text" name="contact" value="{$info.contact??''}" placeholder="全国热线">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>企业官网</th>
                <td class="layui-form">
                    <input class="form-control text" type="text" name="web_site" value="{$info.web_site??''}" placeholder="企业官网">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>企业地址</th>
                <td class="layui-form">
                    <input class="form-control text" type="text" name="address" value="{$info.address??''}" placeholder="企业地址">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>版权归属</th>
                <td>
                    <input class="form-control text" type="text" name="power" value="{$info.power??''}" placeholder="版权归属">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>备案信息</th>
                <td>
                    <input class="form-control text" type="text" name="case_info" value="{$info.case_info??''}" placeholder="备案信息">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>QQ号码</th>
                <td>
                    <input class="form-control text" type="text" name="qq" value="{$info.qq??''}" placeholder="QQ号码">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>地图坐标</th>
                <td>
                    <input class="form-control text" type="text" name="map_point" value="{$info.map_point??''}" placeholder="地图坐标">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>邮编号码</th>
                <td class="layui-form">
                    <input class="form-control text" type="text" name="email_num" value="{$info.email_num??''}" placeholder="邮编号码">
                </td>
            </tr>
            <tr>
                <th>传真号码</th>
                <td class="layui-form">
                    <input class="form-control text" type="text" name="fax" value="{$info.fax??''}" placeholder="传真号码">
                </td>
            </tr>

            <tr>
                <th>logo图片</th>
                <td>
                    <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'info'])}'}">
                        <i class="layui-icon">&#xe67c;</i>上传logo图片
                        <input class="image" type="hidden" name="logo_url" value="{$info.logo_url??''}">
                        <img class="mini-image {$info.logo_url?'':'hidden'}" data-path="__ImagePath__" src="{$info.logo_url?'__ImagePath__'.$info.logo_url:''}">
                    </button>
                </td>
            </tr>
            <tr>
                <th>微信二维码</th>
                <td>
                    <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'info'])}'}">
                        <i class="layui-icon">&#xe67c;</i>上传二维码图片
                        <input class="image" type="hidden" name="qr_url" value="{$info.qr_url??''}">
                        <img class="mini-image {$info.qr_url?'':'hidden'}" data-path="__ImagePath__" src="{$info.qr_url?'__ImagePath__'.$info.qr_url:''}">
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
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('content');
</script>

