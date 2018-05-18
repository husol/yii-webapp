<script type="text/javascript">
	$(document).ready(function () {
		$('#linkform').bValidator();
	});
	function validateForm(){
		$('#linkform').submit();
	}
</script>
<form class="form" id="linkform" name="linkform" method="post" action="index.php?r=vpdt/links/addEdit">
<div class="formheader">Liên kết</div>
<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
<p>
	<label class="required">Tên liên kết<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="name" id="name" maxlength="200" style="width:300px" value="<{if isset($link)}><{$link->name}><{/if}>">
</p>
<p>
	<label class="required">Đường dẫn<span class="required_star"> * </span></label>
	<input data-bvalidator="required,url" type="text" name="url" id="url" maxlength="300" style="width:300px" value="<{if isset($link)}><{$link->url}><{/if}>">
</p>
<p>
	<label class="required">Thứ tự<span class="required_star"> * </span></label>
	<input data-bvalidator="required,number" type="text" name="order" id="order" maxlength="20" style="width:30px" value="<{if isset($link)}><{$link->no_order}><{/if}>">
</p>
<{if isset($link)}>
<input type="hidden" name="id" value="<{$link->id}>"/>
<{/if}>
<div class="spacer"></div>
<div class="formbtn">
	<a id="validate" href="javascript:validateForm();" class="btn">Lưu</a>
	<a id="return" href="javascript:window.location.reload(true);" class="btn">Đóng</a>
</div>
</form>