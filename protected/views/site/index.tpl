<{include file="../layouts/header.tpl"}>
<{include file="../layouts/left_menu.tpl"}>
<div id="right">
	<div id="slides_show">
		<img src="<{HUS::getBaseUrl()}>js/jquery/slides/img/new-ribbon.png" width="112" height="112" alt="New Ribbon" id="ribbon">
		<div id="slides">
			<div class="slides_container">
				<{foreach from=$newAction item=row}>
				<div class="slide">
					<a href="index.php?r=actions/detail&id=<{$row['id']}>" title="<{$row['title']}>"><img src="<{HUS::getBaseUrl()}><{$row['urlImage']}>" width="620" height="270" alt="<{$row['title']}>"></a>
					<div class="caption">
						<p><{$row['summary']}></p>
					</div>
				</div>
				<{/foreach}>
			</div>
			<a href="#" class="prev"><img src="<{HUS::getBaseUrl()}>js/jquery/slides/img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
			<a href="#" class="next"><img src="<{HUS::getBaseUrl()}>js/jquery/slides/img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
		</div>
		<img src="<{HUS::getBaseUrl()}>js/jquery/slides/img/example-frame.png" alt="Example Frame" id="frame">
	</div>
	<!-- New Actions -->
	<div class="title2">Bài viết mới nhất</div>
	<div class='data'>
		<ul>
			<{foreach from=$newestAction item=row}>
			<li>
				<div class='spacer'></div>
				<a href='index.php?r=actions/detail&id=<{$row['id']}>'><strong><{$row['title']}></strong></a>
			</li>
			<li>
				<img align="left" style="width:100px;height:100px;margin-right:5px;" src="<{HUS::getBaseUrl()}><{if is_null($row['urlImage'])}>img/no_image.png<{else}><{$row['urlImage']}><{/if}>" />
				<span><{$row['summary']}></span>
			</li>
			<li>
				<span style="float:right;margin-right:20px;"><a href="index.php?r=actions/detail&id=<{$row['id']}>">Chi tiết >></a></span>
				<div class='spacer'></div>
			</li>
			<{/foreach}>
		</ul>
	</div>
	<!-- End  New Actions -->
</div>
<div class="clear"></div>
<{include file="../layouts/footer.tpl"}>