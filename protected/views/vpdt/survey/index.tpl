<script type="text/javascript">
function openConfirm(id, question){
	var r=confirm("Bạn có chắc muốn xóa câu hỏi \"" + question + "\" ?");
	if (r==true)
	{
	  window.location.href = "index.php?r=vpdt/survey/delete&id="+id;
	}
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Danh sách Câu hỏi khảo sát</div>
	<div class="admin_add">
		[<a class="fancy" href="index.php?r=vpdt/survey/form">Thêm</a>]
	</div>
	<div class="admin_content">
		<table class="tablesorter">
		<thead>
		<tr>
			<th>Hiện trạng</th>
			<th>Câu hỏi</th>
			<th>Người viết</th>
			<th>Thao tác</th>
		</tr>
		</thead>
		<tbody>
		<{if count($question) eq 0}>
		<tr>
			<td colspan="4">Không có câu hỏi</td>
		</tr>
		<{else}>
		<{foreach from=$question item=row}>
		<tr>
			<td>
				<{if $row['active']==1}>
					Đã chọn
				<{else}>
					<a href="index.php?r=vpdt/survey/setQuestion&id=<{$row['id']}>">Chọn câu hỏi này</a>
				<{/if}>
			</td>
			<td><{$row['description']}></td>
			<td><{$row['full_name']}></td>
			<td class="td_center">
				<a class="fancy" href="index.php?r=vpdt/survey/form&id=<{$row['id']}>">Xem / Sửa</a>&nbsp;|
				<a href="javascript:openConfirm(<{$row['id']}>,'<{$row['description']}>');">Xóa</a>
			</td>
		</tr>
		<{/foreach}>
		<{/if}>
		</tbody>
		</table>
		<{include file="../../panels/tablesorterPager.tpl"}>
	</div>
</div>
<{include file="../controls/admin_footer.tpl"}>