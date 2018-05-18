<script type="text/javascript">
$(document).ready(function(){
    $("#dateCleaner").datepicker({
        dateFormat: 'mm/yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: new Date(new Date().getFullYear(), new Date().getMonth()-1, 31),

        onClose: function() {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month, 1)));
        },
        beforeShow: function() {
            var selDate = $(this).val();
            if (selDate.length > 0) {
               var year = selDate.substring(selDate.length - 4, selDate.length);
               var month = jQuery.inArray(selDate.substring(0, selDate.length - 5), new Array("01","02","03","04","05","06","07","08","09","10","11","12"));
               $(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
               $(this).datepicker('setDate', new Date(year, month, 1));
            }
         }
    });
 
    $("#dateCleaner").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
});

function runCleaner(dateCleaner){
	var data = callAjaxJquery("Files","runCleaner",{dateCleaner:dateCleaner});
	var log = data.content;
	if (log == "SUCCEED") {
		popupCenter("index.php?r=vpdt/cleaner/box&dateCleaner="+dateCleaner, 600, 400,true);
	} else if (log == "YES") {
		$('#msg').load('<{HUS::getBaseUrl()}>backup/backup_log.html');
		alert('Không có dữ liệu đến tháng '+dateCleaner);
	}
	else {
		$('#msg').load('<{HUS::getBaseUrl()}>backup/backup_log.html');
		alert('Quá trình sau lưu và dọn dẹp dữ liệu bị lỗi. Bạn cần liên hệ Husol Support để xử lý. Xin cảm ơn!');
	}
}

function startCleaner(){
    if ($("#dateCleaner").val() == "") {
        showMessageBubble("dateCleaner","error","Bạn phải nhập tháng năm cho việc sao lưu và dọn dẹp dữ liệu.");
	} else {
		var dateCleaner = $("#dateCleaner").val();
		var r=confirm("Bạn có chắc muốn sao lưu và xóa dữ liệu từ tháng \"" + dateCleaner + "\" trở về trước ?");
		if (r==true) {
			$('#msg').show();
			runCleaner(dateCleaner);
		}
	}
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Sao lưu và dọn dẹp dữ liệu</div>
	<div class="admin_content">
            <{$contentOfSpaceStatus}><br />
            <p><font color="blue">Chú ý:</font> Bạn nên sao lưu và dọn dẹp dữ liệu khi thanh trạng thái màu <font color="red">đỏ</font></p>
            <div class="spacer"></div>
            <label>Sao lưu và dọn dẹp dữ liệu đến tháng</label> <input type="text" id="dateCleaner" style="width: 100px" readonly="true" />
            <input id="startBtn" type="button" value="Bắt đầu" onmousedown="javascript:startCleaner();"/>
			<div class="spacer"></div>
			<div id="msg" style="color:blue;float: left; display: none;">
				<img src="<{HUS::getBaseUrl()}>img/loading.gif" />
				Vui lòng đợi vài phút. Đang xử lý dữ liệu ...
			</div>
	</div>
</div>
<{include file="../controls/admin_footer.tpl"}>