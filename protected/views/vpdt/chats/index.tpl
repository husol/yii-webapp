<script type="text/javascript">
function openConfirm(id, link){
	var r=confirm("Bạn có chắc muốn xóa nick \"" + link + "\" ?");
	if (r==true)
	{
	  window.location.href = "index.php?r=vpdt/online/delete&id="+id;
	}
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Danh sách Nick Chat</div>
	<div class="admin_add">
		[<a class="fancy" href="index.php?r=vpdt/chats/form">Thêm</a>]
	</div>
	<div class="admin_content">
		<table class="tablesorter">
		<thead>
		<tr>
			<th>Thứ tự</th>
			<th>Tên người dùng</th>
			<th>Nick</th>
			<th>Mô tả</th>
			<th>Thao tác</th>
		</tr>
		</thead>
		<tbody>
		<{if count($chat) eq 0}>
		<tr>
			<td colspan="5" class="td_center">Không có Nick Chat</td>
		</tr>
		<{else}>
		<{foreach from=$chat item=row}>
		<tr>
			<td class="td_center"><{$row['no_order']}></td>
			<td><{$row['name']}></td>
			<td><{$row['nick']}></td>
			<td><{$row['description']}></td>
			<td class="td_center">
				<a class="fancy" href="index.php?r=vpdt/chats/form&id=<{$row['id']}>">Xem / Sửa</a>&nbsp;|
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