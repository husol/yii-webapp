<script type="text/javascript">
	var filesize = false;
	$(document).ready(function () {
		if ($_GET['success'] == 1){
			showMessageBubble('name','success','Thông tin vừa được cập nhật thành công.');
			return false;
		}
		$('#avatar').bind('change', function() {
			filesize = (this.files[0].size > 2*1024*1024);
		});
		$('#accountform').bValidator();
	});
	function validateForm(){
		if (filesize){
			showMessageBubble('avatar','error','Vui lòng chọn hình ảnh < 2 MB.');
			return false;
		}
		$("#accountform").submit();
	}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Thông tin của bạn</div>
	<div class="admin_content">
		<form class="form" id="accountform" name="accountform" method="post" enctype="multipart/form-data" action="index.php?r=vpdt/account/edit">
		<div class="formheader">Xem hoặc chỉnh sửa Thông tin của bạn bên dưới</div>
		<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc. Bấm nút 'Cập nhật' nếu có thay đổi.</div>
		<p>
			<label class="required">Họ và tên<span class="required_star"> * </span></label>
			<input data-bvalidator="required" type="text" name="name" id="name" maxlength="80" style="width:230px" value="<{$loggedUser->name}>">
		</p>
		<p>
			<label>Giới tính</label>
			<select name="sex">
				<option <{if $loggedUser->sex == 0}>selected="selected"<{/if}> value="0">Nữ</option>
				<option <{if $loggedUser->sex == 1}>selected="selected"<{/if}> value="1">Nam</option>
			</select>
		</p>
		<p>
			<label>Hình ảnh đại diện</label>
			<img width="100" height="100" src="<{if is_null($loggedUser->urlAvatar)}><{HUS::getBaseUrl()}>img/no_avatar.png<{else}><{$loggedUser->urlAvatar}><{/if}>" /><br />
		</p>
		<p>
			<label>Ảnh đại diện mới (< 2 MB)</label>
			<input data-bvalidator="extension[jpg:png:gif]" data-bvalidator-msg="Chọn tập tin có kiểu .gif, .jpg hoặc .png" type="file" name="avatar" id="avatar" maxlength="500" style="width:230px">
			(Bỏ trống để giữ ảnh hiện tại)
		</p>
		<p>
			<label class="required">Địa chỉ email<span class="required_star"> * </span></label>
			<input data-bvalidator="required,email" type="text" name="email" id="email" maxlength="200" style="width:230px" value="<{$loggedUser->email}>">
		</p>
		<p>
			<label class="not-required">Công tác tại</label>
			<input type="text" name="work_place" id="work_place" maxlength="300" style="width:230px" value="<{$loggedUser->work_place}>">
		</p>
		<p>
			<label class="not-required">Chức vụ</label>
			<input type="text" name="position" id="position" maxlength="200" style="width:150px" value="<{$loggedUser->position}>">
		</p>
		<p>
			<label class="not-required">Điện thoại bàn</label>
			<input type="text" name="phone" id="phone" maxlength="15" style="width:100px" value="<{$loggedUser->phone}>">
		</p>
		<p>
			<label class="not-required">Di động</label>
			<input type="text" name="mobile" id="mobile" maxlength="15" style="width:150px" value="<{$loggedUser->mobile}>">
		</p>
		<p>
			<label class="not-required">Địa chỉ</label>
			<input type="text" name="address" id="address" maxlength="500" style="width:300px" value="<{$loggedUser->address}>">
		</p>
		<div class="spacer"></div>
		<div class="formbtn">
			<a id="validate" href="javascript:validateForm();" class="btn">Cập nhật</a>
		</div>
		</form>
	</div>
</div>
<{include file="../controls/admin_footer.tpl"}>
