<script type="text/javascript">
	$(document).ready(function () {
		$('#chatform').bValidator();
	});
	function validateForm(){
		$('#chatform').submit();
	}
</script>
<form class="form" id="chatform" name="chatform" method="post" action="index.php?r=vpdt/chats/addEdit">
<div class="formheader">Trực tuyến</div>
<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
<p>
	<label class="required">Tên người dùng<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="name" id="name" maxlength="200" style="width:300px" value="<{if isset($chat)}><{$chat->name}><{/if}>">
</p>
<p>
	<label class="required">Nick<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="nick" id="nick" maxlength="200" style="width:300px" value="<{if isset($chat)}><{$chat->nick}><{/if}>">
</p>
<p>
	<label class="required">Mô tả<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="description" id="description" maxlength="200" style="width:300px" value="<{if isset($chat)}><{$chat->description}><{/if}>">
</p>
<p>
	<label class="required">Thứ tự<span class="required_star"> * </span></label>
	<input data-bvalidator="required,number" type="text" name="order" id="order" maxlength="20" style="width:30px" value="<{if isset($chat)}><{$chat->no_order}><{/if}>">
</p>
<input type="hidden" name="id" value="<{if isset($chat)}><{$chat->id}><{/if}>"/>
<div class="spacer"></div>
<div class="formbtn">
	<a id="validate" href="javascript:validateForm();" class="btn">Lưu</a>
	<a id="return" href="javascript:window.location.reload(true);" class="btn">Đóng</a>
</div>
</form>