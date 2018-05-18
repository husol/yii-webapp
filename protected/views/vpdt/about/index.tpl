<script type="text/javascript">
$(document).ready(function () {
	if ($_GET['success'] == 1){
		showMessageBubble('name','success','Cập nhật Giới thiệu thành công.');
		return false;
	}
});
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Cập nhật Giới thiệu</div>
	<div class="admin_content">
		<form class="form" id="aboutform" name="aboutform" method="post" action="index.php?r=vpdt/about/edit">
		<div class="formheader">Xem hoặc chỉnh sửa trang Giới thiệu bên dưới</div>
		<div class="formmessage">Bấm nút 'Cập nhật' nếu có thay đổi.</div>
		<textarea id="about" name="about"><{$about['content']}></textarea>
		<script type="text/javascript">CKEDITOR.replace('about');</script>
		<div class="spacer"></div>
		<div class="formbtn">
			<a id="validate" href="javascript:$('#aboutform').submit();" class="btn">Cập nhật</a>
		</div>
		</form>
	</div>
</div>
<{include file="../controls/admin_footer.tpl"}>