<{include file="../layouts/header.tpl"}>
<{include file="../layouts/left_menu.tpl"}>
<div id="right">
	<div class='spacer'></div>
	<h2><{$action->title}></h2>
	<div class="spacer"></div>
	<img style="margin-left: 120px; height: 200px; width: 400px;" src="<{$action->urlImage}>" />
	<div class="spacer"></div>
	<div style="margin-bottom:20px"><strong><{$action->summary}></strong></div>
	<{$action->content}>
	<div class="spacer"></div>
	<div style="text-align:center"><{HUS::getBackLink("<< Trở về")}></div>
	<div class="spacer"></div>
	<span style="float:left;margin:5px">Lần cập nhật cuối: <{$action->last_modified_time}></span>
	<span style="float:right;margin:5px">Người viết bài: <{$action->full_name}></span>
</div>
<div class="clear"></div>
<{include file="../layouts/footer.tpl"}>