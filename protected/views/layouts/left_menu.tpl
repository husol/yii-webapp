<div id="left">
	<div class="left_sub">
		<div class="title1">Đăng nhập</div>
		<{if !isset($user)}>
		<div id="login">
			<form id="login_form" action="index.php?r=site/login" method="post" name="user_login">
				  <input id="username" class="input_txt" type="text" name="username" size="15" placeholder="Tên tài khoản" />
				  <input style="margin-top: 0px;" id="password" class="input_txt" type="password" name="password" size="15" placeholder="Mật khẩu" />
				  <div id="forget_pass"><a class="fancy" href="index.php?r=forgotpassword">Quên tài khoản hoặc mật khẩu?</a></div>
				  <div><a class="btn" href="javascript:void(0);" onmousedown="javascript:validateLogin();">Đăng nhập</a></div>
			</form>
		</div>
		<{else}>
		<div id="logout">
			Xin chào<br />
			<span class="showLoggedName"><a href="index.php?r=vpdt/account"><{$user->name}></a></span>
			<div class="spacer"></div>
			<a href="<{$this->createUrl('logout')}>">Thoát</a>
		</div>
		<{/if}>
	</div>
	<div class="left_sub">
		<div class="title1">Trực tuyến</div>
        <script type="text/javascript" src="https://secure.skypeassets.com/i/scom/js/skype-uri.js"></script>
		<{foreach from=$chat item=row}>
        <div style="text-align:center;font-weight: bold;margin-top: 5px;"><{$row['description']}></div>
        <div id="SkypeButton_Call_<{$row['nick']}>_1" style="text-align:center">
            <script type="text/javascript">
                Skype.ui({
                    "name": "chat",
                    "element": "SkypeButton_Call_<{$row['nick']}>_1",
                    "participants": ["<{$row['nick']}>"],
                    "imageSize": 32
                });
            </script>
        </div>
		<{/foreach}>
	</div>
	<div class="left_sub">
		<div class="title1">Công tác Tư tưởng</div>
		<div style="margin: 2px 3px 5px; text-align: center;">
			<a href="#">
				<img align="left" width="52" height="52" src="<{HUS::getBaseUrl()}>img/exam_icon.png" />
				<span style="font-size: 14px">Thi trắc nghiệm tìm hiểu Nghị quyết Đại hội Đoàn</span>
			</a>
			<div class="clr"></div>
			<a href="#">
				<img align="left" width="52" height="52" src="<{HUS::getBaseUrl()}>img/exam_icon.png" />
				<span style="font-size: 14px">Thi trắc nghiệm tìm hiểu 6 Bài học Lý luận Chính trị</span>
			</a>
		</div>
	</div>
	<div class="left_sub">
		<div class="title1">Bài đọc nhiều nhất</div>
		<div id="news_slide">
			<div class="jcarouse">
				<ul>
                    <{if $quickAction|@count > 0}>
					<{foreach from=$quickAction item=row}>
                        <li>
                            <div class="thumb">
                                <img width="50" height="50" src="<{HUS::getBaseUrl()}><{if is_null($row['urlImage'])}>img/no_image.png<{else}><{$row['urlImage']}><{/if}>">
                            </div>
                            <div class="info">
                                <a href="index.php?r=actions/detail&id=<{$row['id']}>"><{$row["title"]}></a>
                            </div>
                            <div class="clr"></div>
                        </li>
					<{/foreach}>
                    <{else}>
                        <li>
                            <div class="thumb">
                                <img width="50" height="50" src="<{HUS::getBaseUrl()}>img/no_image.png">
                            </div>
                            <div class="info">
                                <a href="#">Huyện Đoàn Trảng Bàng Tây Ninh</a>
                            </div>
                            <div class="clr"></div>
                        </li>
                    <{/if}>
				</ul>
			</div>
		</div>
	</div>
                
	<div class="left_sub">
		<div class="title1">Thăm dò ý kiến</div>
		<form name="ques_ans" method="POST" action="index.php?r=survey/vote">
			<p id="question"><{$activeQues['description']}></p>
			<p id="answer">
				<{foreach from=$answer item=row}>
				<input type="radio" name="answer" value="<{$row['id']}>" />&nbsp;<span><{$row['ans_des']}></span><br />
				<{/foreach}>
			</p>
			<input style="margin-left: 10px;" type="submit" value="Xác nhận" />&nbsp;&nbsp;&nbsp;<a class="fancy" href="index.php?r=survey">Xem kết quả</a>
		</form>
	</div>
	<div class="left_sub">
		<div class="title1">Liên kết - Thống kê</div>
		<select id="links" onchange="if (this.value != '') window.open(this.value, '_blank');">
			<option value="">-- Liên kết website --</option>
			<{foreach from=$link item=row}>
			<option value="<{$row['url']}>"><{$row['name']}></option>
			<{/foreach}>
		</select>
		<div id="counter">
			<label>Số lượt truy cập</label><br />
			<span><{$counter}></span>
		</div>
	</div>
</div>