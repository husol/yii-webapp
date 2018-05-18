<{include file="../layouts/header.tpl"}>
<{include file="../layouts/left_menu.tpl"}>
<script type="text/javascript">
	$(document).ready(function () {
		$('#contactform').bValidator();
	});
	function validateForm(){
		$("#slider").slider({value:0});
		$('#sliderdiv').fadeIn();
		$('#validate').hide();
		$('#contactform').submit();
	}
</script>
<div id="right">
	<form class="form" id="contactform" name="contactform" method="post" action="index.php?r=contact/send">
	<div class="formheader">Liên hệ</div>
	<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
	<p>
		<label class="required">Họ và tên<span class="required_star"> * </span></label>
		<input data-bvalidator="required" type="text" name="full_name" id="full_name" maxlength="80" style="width:230px">
	</p>
	<p>
		<label class="required">Email của bạn<span class="required_star"> * </span></label>
		<input data-bvalidator="required,email" type="text" name="email_address" id="email_address" maxlength="100" style="width:230px">
	</p>
	<p>
		<label class="not-required">Công tác tại</label>
		<input type="text" name="work_place" id="work_place" maxlength="100" style="width:230px">
	</p>
	<p>
		<label class="not-required">Số điện thoại</label>
		<input type="text" name="telephone_number" id="telephone_number" maxlength="100" style="width:230px">
	</p>
	<p>
		<label class="required">Tin nhắn của bạn<span class="required_star"> * </span></label>
		<textarea data-bvalidator="required" style="width:230px;height:160px" name="message" id="message" maxlength="2000"></textarea>
	</p>
	<div class="spacer"></div>
	<div id="sliderdiv" class="sliderdiv">
		<label style="color:red; width: 250px;">Kéo thanh trượt bên dưới để xác nhận</label>
		<div class="spacer"></div>
		<div id="slider" style="width: 320px; float:left; margin: 10px 0 0 7px; display: inline;"></div>
	</div>
	<div class="spacer"></div>
	<div class="formbtn">
		<a id="validate" style="display:none;" href="javascript:validateForm();" class="btn">Gửi</a>
		<a href="javascript:location.reload(true);" class="btn">Xóa</a>
	</div>
	</form>
	<iframe width="687" height="544" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=huyen+doan+trang+bang+tay+ninh&amp;aq=&amp;sll=11.032632,106.358825&amp;sspn=0.007287,0.009645&amp;ie=UTF8&amp;hq=huyen+doan&amp;hnear=tt.+Tr%E1%BA%A3ng+B%C3%A0ng,+Trang+Bang+District,+Tay+Ninh+province,+Vietnam&amp;t=m&amp;fll=11.030568,106.360971&amp;fspn=0.007287,0.009645&amp;st=115703629269948245352&amp;rq=1&amp;ev=zo&amp;split=1&amp;ll=11.031579,106.359608&amp;spn=0.011436,0.01472&amp;z=16&amp;output=embed"></iframe><br /><small><a target="_blank" href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=huyen+doan+trang+bang+tay+ninh&amp;aq=&amp;sll=11.032632,106.358825&amp;sspn=0.007287,0.009645&amp;ie=UTF8&amp;hq=huyen+doan&amp;hnear=tt.+Tr%E1%BA%A3ng+B%C3%A0ng,+Trang+Bang+District,+Tay+Ninh+province,+Vietnam&amp;t=m&amp;fll=11.030568,106.360971&amp;fspn=0.007287,0.009645&amp;st=115703629269948245352&amp;rq=1&amp;ev=zo&amp;split=1&amp;ll=11.031579,106.359608&amp;spn=0.011436,0.01472&amp;z=16" style="color:#0000FF;text-align:left">View Larger Map</a></small>
</div>
<div class="clear"></div>
<{include file="../layouts/footer.tpl"}>