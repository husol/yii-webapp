<script type="text/javascript">
	$(document).ready(function () {
		$('#surveyform').bValidator();
	});
	function validateForm(){
		$('#surveyform').submit();
	}
</script>
<form class="form" id="surveyform" name="surveyform" method="post" action="index.php?r=vpdt/survey/addEdit">
<div class="formheader">Thăm dò ý kiến</div>
<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
<p>
	<label class="required">Câu hỏi<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="question" id="question" maxlength="300" style="width:400px" value="<{if isset($question)}><{$question->description}><{/if}>">
</p>
<p>
	<label class="required">Đáp án 1<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="answer1" id="answer1" maxlength="300" style="width:300px" value="<{if isset($result)}><{$result[1]}><{/if}>">
</p>
<p>
	<label class="required">Đáp án 2<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="answer2" id="answer2" maxlength="300" style="width:300px" value="<{if isset($result)}><{$result[2]}><{/if}>">
</p>
<p>
	<label class="required">Đáp án 3<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="answer3" id="answer3" maxlength="300" style="width:300px" value="<{if isset($result)}><{$result[3]}><{/if}>">
</p>
<p>
	<label class="required">Đáp án 4<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="answer4" id="answer4" maxlength="300" style="width:300px" value="<{if isset($result)}><{$result[4]}><{/if}>">
</p>
<p>
	<label class="required">Đáp án 5<span class="required_star"> * </span></label>
	<input data-bvalidator="required" type="text" name="answer5" id="answer5" maxlength="300" style="width:300px" value="<{if isset($result)}><{$result[5]}><{/if}>">
</p>
<{if isset($question)}>
<input type="hidden" name="id" value="<{$question->id}>" />
<{/if}>
<div class="spacer"></div>
<div class="formbtn">
	<a id="validate" href="javascript:validateForm();" class="btn">Lưu</a>
	<a id="return" href="javascript:window.location.reload(true);" class="btn">Đóng</a>
</div>
</form>
