<script type="text/javascript">
function openConfirm(id, work){
	var r=confirm("Bạn có chắc muốn xóa công việc \"" + work + "\" ?");
	if (r==true)
	{
	  window.location.href = "index.php?r=vpdt/sentWorks/delete&id="+id;
	}
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Danh sách công việc đã tạo</div>
	<div class="admin_content">
		<table class="tablesorter">
		<thead>
		<tr>
			<th>Tên công việc</th>
			<th>Ghi chú</th>
			<th>Thời gian</th>
			<th>Thao tác</th>
		</tr>
		</thead>
		<tbody>
		<{if count($sentWork) eq 0}>
		<tr>
			<td colspan="4" class="td_center">Không có công việc</td>
		</tr>
		<{else}>
		<{foreach from=$sentWork item=row}>
		<tr>
			<td><{$row['name']}></td>
			<td><{$row['note']}></td>
			<td class="td_center"><{$row['last_modified_time']}></td>
			<td class="td_center">
				<a href="index.php?r=vpdt/formWork&id=<{$row['id']}>">Xem / Sửa</a>&nbsp;|
				<a href="javascript:openConfirm(<{$row['id']}>,'<{$row['name']}>');">Xóa</a>
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