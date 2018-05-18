<script type="text/javascript">
function openConfirm(id, work){
	var r=confirm("Bạn có chắc muốn xóa công việc \"" + work + "\" ?");
	if (r==true)
	{
	  window.location.href = "index.php?r=vpdt/works/delete&id="+id;
	}
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Danh sách tất cả công việc</div>
	<div class="admin_content">
		<table class="tablesorter">
		<thead>
		<tr>
			<th>Tên công việc</th>
			<th>Người gửi</th>
			<th>Ghi chú</th>
			<th>Thời gian</th>
			<th>Thao tác</th>
		</tr>
		</thead>
		<tbody>
		<{if count($allWork) eq 0}>
		<tr>
			<td colspan="5" class="td_center">Không có công việc</td>
		</tr>
		<{else}>
		<{foreach from=$allWork item=row}>
		<tr>
			<td><{$row['work_name']}></td>
			<td><{$row['full_name']}></td>
			<td><{$row['note']}></td>
			<td class="td_center"><{$row['last_modified_time']}></td>
			<td class="td_center">
				<a href="index.php?r=vpdt/formWork&id=<{$row['id']}>">Xem / Sửa</a>&nbsp;|
				<a href="javascript:openConfirm(<{$row['id']}>,'<{$row['work_name']}>');">Xóa</a>
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