<script type="text/javascript">
function openConfirm(id, action){
	var r=confirm('Bạn có chắc muốn xóa hoạt động \"' + action + '\" ?');
	if (r==true)
	{
	  window.location.href = "index.php?r=vpdt/actions/delete&id="+id;
	}
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Danh sách Hoạt động</div>
	<div class="admin_add">
		[<a class="fancy" href="index.php?r=vpdt/actions/form">Thêm</a>]
	</div>
	<div class="admin_content">
		<table class="tablesorter">
		<thead>
		<tr>
			<th>Tiêu đề</th>
			<th>Duyệt</th>
			<th>Số lần xem</th>
			<th>Người viết</th>
			<th>Lần sửa cuối</th>
			<th>Thao tác</th>
		</tr>
		</thead>
		<tbody>
		<{if count($action) eq 0}>
		<tr>
			<td colspan="6" class="td_center">Không có hoạt động</td>
		</tr>
		<{else}>
		<{foreach from=$action item=row}>
		<tr>
			<td><{$row['title']}></td>
			<td class="td_center">
				<{if $row['reviewed'] == 1}>
					Đã duyệt
				<{else}>
					Chưa duyệt
				<{/if}>
			</td>
			<td class="td_center"><{$row['viewedNumber']}></td>
			<td><{$row['full_name']}></td>
			<td class="td_center"><{$row['last_modified_time']}></td>
			<td class="td_center">
				<a class="fancy" href="index.php?r=vpdt/actions/form&id=<{$row['id']}>">Xem / Sửa</a>&nbsp;|
				<a href="javascript:openConfirm(<{$row['id']}>,'<{$row['title']|escape:'quotes'|escape:'htmlall'}>');">Xóa</a>
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