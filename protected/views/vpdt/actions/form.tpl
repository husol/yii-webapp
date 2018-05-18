<script type="text/javascript">
	var filesize = false;
	var maxFileSize = 5; // Unit is MB
	$(document).ready(function () {
		$('#image').bind('change', function() {
			filesize = (this.files[0].size > maxFileSize*1024*1024);
		});
		$('#actionform').bValidator();
	});
	function validateForm(){
		if (filesize){
			$('#alert').show();
		} else {
			$('#alert').hide();
		}
		$("#actionform").submit();
	}
</script>
<form class="form" id="actionform" name="actionform" method="post" enctype="multipart/form-data" action="index.php?r=vpdt/actions/addEdit">
<div class="formheader">Hoạt động</div>
<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
<p>
	<label class="required">Tên hoạt động<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="name" id="name" maxlength="200" style="width:300px" value="<{if isset($action)}><{$action->title}><{/if}>">
</p>
<p>
	<label class="required">Tóm tắt<span class="required_star"> * </span></label>
	<textarea data-bvalidator="required" name="summary" rows="3" cols="35"><{if isset($action)}><{$action->summary}><{/if}></textarea>
</p>
<{if isset($action)}>
<p>
	<label>Hình ảnh đại diện</label>
	<img width="100" height="100" src="<{if is_null($action->urlImage)}><{HUS::getBaseUrl()}>img/no_image.png<{else}><{$action->urlImage}><{/if}>" /><br />
</p>
<p>
	<label>Ảnh đại diện mới (< 5 MB)</label>
	<input data-bvalidator="extension[jpg:png:gif]" data-bvalidator-msg="Chọn tập tin có kiểu .gif, .jpg hoặc .png" type="file" name="image" id="image" maxlength="500" style="width:230px">
	(Bỏ trống để giữ ảnh hiện tại)
	<span id="alert" style="display:none; color: red;">Hình ảnh phải < 5 MB.</span>
</p>
<{else}>
<p>
	<label>Ảnh đại diện</label>
	<input data-bvalidator="extension[jpg:png:gif]" data-bvalidator-msg="Chọn tập tin có kiểu .gif, .jpg hoặc .png" type="file" name="image" id="image" maxlength="500" style="width:230px">
</p>
<{/if}>
<p>
	<label class="non-required">Nội dung</label><br />
	<textarea data-bvalidator="required" id="contentAction" name="contentAction"><{if isset($action)}><{$action->content}><{/if}></textarea>
	<script type="text/javascript">CKEDITOR.replace('contentAction');</script>
</p>
<p>
	<label>Tình trạng</label>
	<select name="reviewed">
		<option <{if isset($action)and $action->reviewed == 0}>selected="selected"<{/if}> value="0">Chưa duyệt</option>
		<option <{if isset($action)and $action->reviewed == 1}>selected="selected"<{/if}> value="1">Duyệt</option>
	</select>
</p>
<input type="hidden" name="id" value="<{if isset($action)}><{$action->id}><{/if}>"/>
<div class="spacer"></div>
<div class="formbtn">
	<a id="validate" href="javascript:validateForm();" class="btn">Lưu</a>
	<a id="return" href="javascript:window.location.reload(true);" class="btn">Đóng</a>
</div>
</form>