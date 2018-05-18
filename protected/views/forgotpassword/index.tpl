<script type="text/javascript">
	$(document).ready(function () {
		$('#forgotpassform').bValidator();
	});
	function validateForm(){
		var email = $('#email').val();
		var dataRepsEmail = callAjaxJquery('Users','checkEmail',{id: 'null',email: email});
		if (dataRepsEmail.content == 'No'){
			$('#alertEmail').show();
			return false;
		} else {
			$('#alertEmail').hide();
			$('#forgotpassform').submit();
		}
	}
</script>

<form class="form" id="forgotpassform" name="forgotpassform" method="post" action="index.php?r=forgotpassword/mailpass">
<div class="formheader">Quên tên tài khoản hoặc mật khẩu</div>
<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
<p>
	<label class="required">Địa chỉ email đăng ký<span class="required_star"> * </span></label>
	<input data-bvalidator="required,email" type="text" name="email" id="email" maxlength="200" style="width:230px" value="">
	<span id="alertEmail" style="display: none;color: red">Email này không tồn tại trong hệ thống</span>
</p>
<div class="spacer"></div>
<div class="formbtn">
	<a id="validate" href="javascript:validateForm();" class="btn">Gửi</a>
	<a id="return" href="javascript:window.location.reload(true);" class="btn">Đóng</a>
</div>
</form>