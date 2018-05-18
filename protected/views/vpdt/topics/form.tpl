<script type="text/javascript">
	$(document).ready(function () {
		$('#topicform').bValidator();
	});
	function validateForm(){
		$('#topicform').submit();
	}
</script>
<form class="form" id="topicform" name="topicform" method="post" action="index.php?r=vpdt/topics/addEdit">
<div class="formheader">Chủ đề tháng</div>
<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
<p>
	<label class="required">Chủ đề<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="name" id="name" maxlength="500" style="width:650px;" value="<{if isset($topic)}><{$topic->name|escape:html}><{/if}>" />
</p>
<input type="hidden" name="id" value="<{if isset($topic)}><{$topic->id}><{/if}>"/>
<div class="spacer"></div>
<div class="formbtn">
	<a id="validate" href="javascript:validateForm();" class="btn">Lưu</a>
	<a id="return" href="javascript:window.location.reload(true);" class="btn">Đóng</a>
</div>
</form>