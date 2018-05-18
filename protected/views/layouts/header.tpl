<script type="text/javascript">
	function validateLogin() {
		if ($('#username').val() == '' || $('#password').val() == '') {
			showMessageBubble('username','error','Bạn chưa nhập Tên tài khoản hoặc Mật khẩu.');
			return false;
		}
		$('#login_form').submit();
	}

	function validateFormSearch(){
		if ($('#keyword').val() == "Tìm kiếm...") {
			showMessageBubble('keyword','error','Vui lòng nhập từ khóa cần tìm.');
		}
		$('#searchform').submit();
	}

	$(document).ready(function(){
        $("#login_form").keypress(function(e) {
	        if ( e.which == 13 ) {
	        	validateLogin();
				return false;
	        }
	    });

		var error = $_GET['error'];
		if (error == 1) {
			showMessageBubble('username','error','Tài khoản hoặc Mật khẩu không đúng.');
		}
		if (error == 2) {
			showMessageBubble('keyword','error','Vui lòng nhập từ khóa cần tìm.');
		}
		if (error == 3) {
			showMessageBubble('username','error','Email không tồn tại trong hệ thống.');
		}
    });
</script>
<div id="header">
	<div id="banner">
		<embed height="160" width="960" type="application/x-shockwave-flash" allowscriptaccess="always" wmode="transparent" allowfullscreen="false" scale="noborder" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" quality="high" src="<{HUS::getBaseUrl()}>img/banner.swf" title="Huyện �?oàn Trảng Bàng"/>
	</div>
	<div id="fly_title">
		<marquee behavior="scroll" direction="left"><{$activeTopic['name']}></marquee>
	</div>
	<{include file="./menu.tpl"}>
	<div id="search">
		<form id="searchform" name="searchform" method="GET" action="index.php">
			<input id="keyword" name="keyword" type="text" size="15" value="Tìm kiếm..." onFocus="if (this.value=='Tìm kiếm...') this.value = '';" onBlur="if (this.value == '') this.value = 'Tìm kiếm...';"/>
			<div><a href="javascript:validateFormSearch();" ><button style="margin-top:-2px;cursor:pointer;"><{$Hus->lang('_BT_SEARCH')}></button></a></div>
		</form>
		<a style="display:none;" href="javascript: setCookie('lang','vi',30); window.location.reload(true);"><img src="<{HUS::getBaseUrl()}>img/flag_vi.png" title="<{$Hus->lang('_TT_LANGUAGE_VI')}>" alt="<{$Hus->lang('_TT_LANGUAGE_VI')}>"/></a>
		<a style="display:none;" href="javascript: setCookie('lang','en',30); window.location.reload(true);"><img src="<{HUS::getBaseUrl()}>img/flag_en.png" title="<{$Hus->lang('_TT_LANGUAGE_EN')}>" alt="<{$Hus->lang('_TT_LANGUAGE_EN')}>"/></a>
	</div>
</div>
