<script type="text/javascript">
	$(document).ready(function () {
		$('#userform').bValidator();
	});
	function validateForm(){
		var id = $('#id').val();
		var username = $('#username').val();
		var email = $('#email').val();
		var dataRepsUsername = callAjaxJquery('Users','checkUsername',{id: id, username: username});
		if (dataRepsUsername.content == 'Yes'){
			$('#alertUsername').show();
			return false;
		} else {
			$('#alertUsername').hide();
		}
		var dataRepsEmail = callAjaxJquery('Users','checkEmail',{id: id,email: email});
		if (dataRepsEmail.content == 'Yes'){
			$('#alertEmail').show();
			return false;
		} else {
			$('#alertEmail').hide();
		}
		$('#userform').submit();
	}
</script>
<form class="form" id="userform" name="userform" method="post" action="index.php?r=vpdt/users/addEdit">
<div class="formheader">Thành viên</div>
<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
<p>
	<label class="required">Họ và tên<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="name" id="name" maxlength="80" style="width:230px" value="<{if isset($user)}><{$user->name}><{/if}>">
</p>
<p>
	<label class="required">Tên tài khoản<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="username" id="username" maxlength="100" style="width:230px" value="<{if isset($user)}><{$user->username}><{/if}>">
	<span id="alertUsername" style="display: none;color: red">Tên tài khoản không hợp lệ hoặc đã có người sử dụng</span>
</p>
<{if isset($user)}>
<p>
	<label class="not-required">Mật khẩu</label>
	<input data-bvalidator="minlength[6]" type="password" name="password" id="password" maxlength="200" style="width:230px" value=""> (Bỏ trống để giữ mật khẩu cũ)
</p>
<{else}>
<p>
	<label class="required">Mật khẩu<span class="required_star"> * </span></label>
	<input data-bvalidator="required,minlength[6]" type="password" name="password" id="password" maxlength="200" style="width:230px" value="">
</p>
<p>
	<label class="required">Nhập lại mật khẩu<span class="required_star"> * </span></label>
	<input data-bvalidator="required,equalto[password]" type="password" name="confirmpass" id="confirmpass" maxlength="200" style="width:230px" value="">
</p>
<{/if}>
<p>
	<label>Giới tính</label>
	<select name="sex">
		<option <{if isset($user) and $user->sex == 0}>selected="selected"<{/if}> value="0">Nữ</option>
		<option <{if isset($user) and $user->sex == 1}>selected="selected"<{/if}> value="1">Nam</option>
	</select>
</p>
<p>
	<label class="required">Địa chỉ email<span class="required_star"> * </span></label>
	<input data-bvalidator="required,email" type="text" name="email" id="email" maxlength="200" style="width:230px" value="<{if isset($user)}><{$user->email}><{/if}>">
	<span id="alertEmail" style="display: none;color: red">Email đã có người sử dụng</span>
</p>
<p>
	<label class="not-required">Công tác tại</label>
	<input type="text" name="work_place" id="work_place" maxlength="300" style="width:230px" value="<{if isset($user)}><{$user->work_place}><{/if}>">
</p>
<p>
	<label class="required">Chức vụ<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="position" id="position" maxlength="200" style="width:150px" value="<{if isset($user)}><{$user->position}><{/if}>">
</p>
<p>
	<label class="not-required">Điện thoại bàn</label>
	<input type="text" name="phone" id="phone" maxlength="15" style="width:100px" value="<{if isset($user)}><{$user->phone}><{/if}>">
</p>
<p>
	<label class="not-required">Di động</label>
	<input type="text" name="mobile" id="mobile" maxlength="15" style="width:150px" value="<{if isset($user)}><{$user->mobile}><{/if}>">
</p>
<p>
	<label class="not-required">Địa chỉ</label>
	<input type="text" name="address" id="address" maxlength="500" style="width:300px" value="<{if isset($user)}><{$user->address}><{/if}>">
</p>
<p>
	<label>Quyền hạn</label>
	<select name="role">
		<option <{if isset($user) and $user->role == 0}>selected="selected"<{/if}> value="0">Quản trị</option>
		<option <{if isset($user) and $user->role == 1}>selected="selected"<{/if}> value="1">Bình thường</option>
	</select>
</p>
<p>
	<label>Kích hoạt</label>
	<select name="active">
		<option <{if isset($user) and $user->active == 0}>selected="selected"<{/if}> value="0">Không</option>
		<option <{if isset($user) and $user->active == 1}>selected="selected"<{/if}> value="1">Có</option>
	</select>
</p>
<p>
	<label class="not-required">Ghi chú</label>
	<textarea name="note" rows="3" cols="35"><{if isset($user)}><{$user->note}><{/if}></textarea>
</p>
<{if isset($user)}>
<input type="hidden" id='id' name='id' value='<{$user->id}>'/>
<{/if}>
<div class="spacer"></div>
<div class="formbtn">
	<a id="validate" href="javascript:validateForm();" class="btn">Lưu</a>
	<a id="return" href="javascript:window.location.reload(true);" class="btn">Đóng</a>
</div>
</form>
