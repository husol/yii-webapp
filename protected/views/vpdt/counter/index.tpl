<script type="text/javascript">
$(document).ready(function () {
	if ($_GET['success'] == 1){
		showMessageBubble('name','success','Cập nhật Bộ đếm thành công.');
		return false;
	}
	$('#counterform').bValidator();
});
function validateForm(){
	$('#counterform').submit();
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Cập nhật Bộ đếm</div>
	<div class="admin_content">
		<form class="form" id="counterform" name="counterform" method="post" action="index.php?r=vpdt/counter/edit">
		<div class="formheader">Xem hoặc chỉnh sửa Số người truy cập bên dưới</div>
		<div class="formmessage">Bấm nút 'Cập nhật' nếu có thay đổi.</div>
		<p>
			<label class="required">Số người truy cập<span class="required_star"> * </span></label>
			<input data-bvalidator="required,number" type="text" name="counter" id="counter" maxlength="80" style="width:100px" value="<{$counter['count']}>">
		</p>
		<div class="spacer"></div>
		<div class="formbtn">
			<a id="validate" href="javascript:validateForm();" class="btn">Cập nhật</a>
		</div>
		</form>
	</div>
</div>
<{include file="../controls/admin_footer.tpl"}>