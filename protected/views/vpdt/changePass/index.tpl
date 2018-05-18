<script type="text/javascript">
	$(document).ready(function () {
		if ($_GET['success'] == 0){
			showMessageBubble('name','error','Mật khẩu cũ không đúng.');
			return false;
		}
		if ($_GET['success'] == 1){
			showMessageBubble('name','success','Mật khẩu vừa được chuyển đổi thành công.');
			return false;
		}
		$('#changepassform').bValidator();
	});
	function validateForm(){
		$("#changepassform").submit();
	}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Thay đổi mật khẩu</div>
	<div class="admin_content">
		<form class="form" id="changepassform" name="changepassform" method="post" action="index.php?r=vpdt/changePass/edit">
		<div class="formheader">Nhập mật khẩu cũ và mới của bạn bên dưới</div>
		<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
		<p>
			<label class="required">Mật khẩu cũ<span class="required_star"> * </span></label>
			<input data-bvalidator="required,minlength[6]" type="password" name="old_password" id="old_password" maxlength="100" style="width:150px" value="">
		</p>
		<p>
			<label class="required">Mật khẩu mới<span class="required_star"> * </span></label>
			<input data-bvalidator="required,minlength[6]" type="password" name="new_password" id="new_password" maxlength="100" style="width:150px" value="">
		</p>
		<p>
			<label class="required">Nhập lại mật khẩu mới<span class="required_star"> * </span></label>
			<input data-bvalidator="required,equalto[new_password]" type="password" id="confirm_password" maxlength="100" style="width:150px" value="">
		</p>
		<div class="spacer"></div>
		<div class="formbtn">
			<a id="validate" href="javascript:validateForm();" class="btn">Cập nhật</a>
		</div>
		</form>
	</div>
</div>
<{include file="../controls/admin_footer.tpl"}>
