<button onmousedown="javascript:downloadData();">Tải dữ liệu</button>
<button id="closeBtn" style="display: none;" onmousedown="javascript:window.location.reload(true);">Đóng</button>
<div>View log:</div>
<div id="log" style="color:blue;"></div>
<script type="text/javascript">
$(document).ready(function(){
	$('#log').load('<{HUS::getBaseUrl()}>backup/backup_log.html');
});
function downloadData(){
	$('#closeBtn').show();
	window.location.href="<{HUS::getBaseUrl()}>backup/backup_<{$year}>_<{$month}>.zip";
}
</script>