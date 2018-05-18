<span style="float: left; font-size: medium; margin: 10px 60px 0px 20px;"><{$smarty.now|date_format:'Ngày %d tháng %m năm %Y'}></span>
<div id="menu">
	<ul>
		<li>
			<a <{if $Yii->controller->id == 'site'}>class="activeMenu"<{/if}> style="border-left: none;"
				href="index.php">Trang chủ</a>
		</li>
		<li>
			<a <{if $Yii->controller->id == 'actions'}>class="activeMenu"<{/if}>
				href="index.php?r=actions">Tin hoạt động</a>
		</li>
		<li>
			<a <{if $Yii->controller->id == 'about'}>class="activeMenu"<{/if}>
				href="index.php?r=about">Giới thiệu</a>
		</li>
		<li>
			<a <{if $Yii->controller->id == 'contact'}>class="activeMenu"<{/if}>
				href="index.php?r=contact">Liên hệ</a>
		</li>
	</ul>
</div>