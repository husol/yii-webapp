<script language="javascript" type="text/javascript">
    $(function(){
        var activeIndex = $.cookies.get('accordionIndex');
        $("#accordion").accordion({active:activeIndex});
    });
</script>
<div id="admin_left">
	<div id="accordion">
		<h3 onfocus="javascript:$.cookies.set('accordionIndex',0);">CÔNG CỤ</h3>
		<div>
			<ul>
				<li><a href="index.php?r=vpdt/home">Trang chủ</a></li>
				<li><a target="_blank" href="<{HUS::getBaseUrl()}>files/help.pdf">Hướng dẫn sử dụng</a></li>
			</ul>
		</div>
		<{if $loggedUser->role == 0}>
		<h3 onfocus="javascript:$.cookies.set('accordionIndex',1);">QUẢN TRỊ</h3>
		<div>
			<ul>
				<li><a href="index.php?r=vpdt/users">Thành viên</a></li>
				<li><a href="index.php?r=vpdt/actions">Hoạt động</a></li>
				<li><a href="index.php?r=vpdt/works">Công việc</a></li>
				<li><a href="index.php?r=vpdt/topics">Chủ đề tháng</a></li>
				<li><a href="index.php?r=vpdt/survey">Thăm dò ý kiến</a></li>
				<li><a href="index.php?r=vpdt/chats">Trực tuyến</a></li>
				<li><a href="index.php?r=vpdt/counter">Bộ đếm</a></li>
				<li><a href="index.php?r=vpdt/about">Giới thiệu</a></li>
				<li><a href="index.php?r=vpdt/links">Liên kết website</a></li>
			</ul>
		</div>
		<{/if}>
		<h3 onfocus="javascript:$.cookies.set('accordionIndex',2);">CÔNG VIỆC</h3>
		<div>
			<ul>
				<li><a href="index.php?r=vpdt/formWork">Tạo mới công việc</a></li>
				<li><a href="index.php?r=vpdt/sentWorks">Công việc đã tạo</a></li>
			</ul>
		</div>
		<h3 onfocus="javascript:$.cookies.set('accordionIndex',3);">TÀI KHOẢN CỦA BẠN</h3>
		<div>
			<ul>
				<li><a href="index.php?r=vpdt/account">Thông tin của bạn</a></li>
				<li><a href="index.php?r=vpdt/changePass">Thay đổi mật khẩu</a></li>
			</ul>
		</div>
		<{if $loggedUser->role == 0}>
		<h3 onfocus="javascript:$.cookies.set('accordionIndex',4);">DỌN DẸP DỮ LIỆU</h3>
		<div>
			<ul>
				<li><a href="index.php?r=vpdt/cleaner">Sao lưu và dọn dẹp</a></li>
			</ul>
		</div>
		<{/if}>
	</div>
</div>