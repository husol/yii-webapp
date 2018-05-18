<div id="admin_header">
	<div id="banner">
		<embed height="120" width="952" type="application/x-shockwave-flash" allowscriptaccess="always" wmode="transparent" allowfullscreen="false" scale="noborder" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" quality="high" src="<{HUS::getBaseUrl()}>img/admin_banner.swf" title="Huyện Đoàn Trảng Bàng"/>
	</div>
	<div id="logout">
		Xin chào <span class="showLoggedName"><{$loggedUser->name}></span> | <a href="index.php?r=site/logout">Thoát</a>
	</div>
	<div id="time"><{$smarty.now|date_format:'Ngày %d tháng %m năm %Y'}></div>
	<div id="alert"><marquee scrollamount="2">
		<{foreach from=$alertWork item=row}>
		[Thông tin mới: <{$row['work_name']}>]&nbsp;&nbsp;
		<{/foreach}>
	</marquee></div>
</div>