<script type="text/javascript">
	var filesize = new Array();
	var maxFileSize = 10; // Unit is MB
	filesize[0] = false;filesize[1] = false;filesize[2] = false;
	$(document).ready(function () {
			$('#file0').bind('change', function() {
				if (this.files[0].size > maxFileSize*1024*1024){
					filesize[0] = true;
					showMessageBubble('name','error','Tập tin đính kèm phải < 10 MB.');
					return false;
				} else {filesize[0] = false;}
			});
			$('#file1').bind('change', function() {
				if (this.files[0].size > maxFileSize*1024*1024){
					filesize[0] = true;
					showMessageBubble('name','error','Tập tin đính kèm phải < 10 MB.');
					return false;
				} else {filesize[1] = false;}
			});
			$('#file2').bind('change', function() {
				if (this.files[0].size > maxFileSize*1024*1024){
					filesize[2] = true;
					showMessageBubble('name','error','Tập tin đính kèm phải < 10 MB.');
					return false;
				} else {filesize[2] = false;}
			});
		$('#workform').bValidator();
	});

	function validateForm(){
		for(var i=0;i<3;i++){
			if (filesize[i]) {
				showMessageBubble('name','error','Tập tin đính kèm phải < 10 MB.');
				return false;
			}
		}
		$('#workform').submit();
	}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
<{if isset($view) and $view == 1}>
	<div class="admin_title">Xem công việc</div>
<{elseif isset($formWork)}>
	<div class="admin_title">Xem / Sửa công việc</div>
<{else}>
	<div class="admin_title">Tạo công việc</div>
<{/if}>
	<div class="admin_content">
		<form class="form" id="workform" name="workform" method="post" enctype=multipart/form-data action="index.php?r=vpdt/formWork/addEdit">
		<div class="formheader">Công việc</div>
		<div class="formmessage">Các trường đánh dấu<span class="required_star"> * </span> là bắt buộc.</div>
		<p>
			<label class="required">Tên công việc<span class="required_star"> * </span></label>
			<input data-bvalidator="required" type="text" name="name" id="name" maxlength="300" style="width:300px" <{if isset($view) and $view == 1}>disabled<{/if}> value="<{if isset($formWork)}><{$formWork['work']['work_name']}><{/if}>">
		</p>
		<p>
			<label class="not-required">Ghi chú</label>
			<textarea <{if isset($view) and $view == 1}>disabled<{/if}> name="note" rows="3" cols="35"><{if isset($formWork)}><{$formWork['work']['note']}><{/if}></textarea>
		</p>
		<p>
			<label class="not-required">Nội dung</label>
			<textarea <{if isset($view) and $view == 1}>disabled<{/if}> name="contentWork" rows="10" cols="50"><{if isset($formWork)}><{$formWork['work']['description']}><{/if}></textarea>
		</p>
		<{if !isset($view) or (isset($view) and $view != 1)}>
		<p>
			<label class="required">Người nhận công việc<span class="required_star"> * </span></label>
			<select data-bvalidator="required" size="10" multiple="multiple" name="toUsers[]">
				<{foreach from=$listUser item=row}>
				<option <{if isset($formWork['ToUser']) AND in_array($row['id'],$formWork['ToUser'])}> selected="selected" <{/if}> value="<{$row['id']}>"><{$row['name']}></option>
				<{/foreach}>
			</select>
		</p>
		<{/if}>
		<{if isset($formWork)}>
		<p>
			<label>Tập tin đã đính kèm</label>
			<{if count($formWork['file']) eq 0}> Không có
			<{else}>
			<{foreach from=$formWork['file'] item=row}>
			<a class="item" target="_blank" href="index.php?r=vpdt/formWork/download&id=<{$row['id']}>" title="<{$Hus->lang('_LB_DOWNLOAD')}>">
				<img src="<{$Hus->getIconOfFile(<{$row['name']}>)}>" alt="<{$Hus->lang('_LB_DOWNLOAD')}>" />
				<span class="captionIcon"><{$row['name']}></span>
			</a>&nbsp;&nbsp;
			<{/foreach}>
			<{/if}>
		</p>
		<{/if}>
		<{if !isset($view) or (isset($view) and $view != 1)}>
		<p><fieldset style="text-align: center">
			<legend>Tập tin đính kèm</legend>
			<label>Tập tin 1: </label>
			<input id="file0" name="files[]" type="file" maxlength="300" size="50"/><br />
			<label>Tập tin 2: </label>
			<input id="file1" name="files[]" type="file" maxlength="300" size="50"/><br />
			<label>Tập tin 3: </label>
			<input id="file2" name="files[]" type="file" maxlength="300" size="50"/>
			<div class="spacer"></div>
			<{if isset($formWork)}>(Bỏ trống để giữ các tập tin đính kèm hiện tại)<{/if}>
		</fieldset></p>
		<{/if}>
		<input type="hidden" name="id" value="<{if isset($formWork)}><{$formWork['work']['id']}><{/if}>"/>
		<div class="spacer"></div>
		<div class="formbtn">
			<{if !isset($view) or (isset($view) and $view != 1)}>
			<a id="validate" href="javascript:validateForm();" class="btn">Lưu</a>
			<{/if}>
			<{if isset($formWork)}>
			<a id="return" href="javascript:window.history.back();" class="btn">Trở lại</a>
			<{/if}>
		</div>
		</form>
	</div>
</div>
<{include file="../controls/admin_footer.tpl"}>
