<script type="text/javascript">
function openConfirm(id, topic){
	var r=confirm("Bạn có chắc muốn xóa chủ đề \"" + topic + "\" ?");
	if (r==true)
	{
	  window.location.href = "index.php?r=vpdt/topics/delete&id="+id;
	}
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Danh sách Chủ đề tháng</div>
	<div class="admin_add">
		[<a class="fancy" href="index.php?r=vpdt/topics/form">Thêm</a>]
	</div>
	<div class="admin_content">
		<table id="myTable" class="tablesorter">
		<thead>
		<tr>
			<th>Hiện trạng</th>
			<th>Chủ đề</th>
			<th>Người viết</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<{if count($allTopics) eq 0}>
		<tr>
			<td colspan="4" class="td_center">Không có chủ đề</td>
		</tr>
		<{else}>
		<{foreach from=$allTopics item=row}>
		<tr>
			<td><{if $row['active']==1}>
				Đã chọn
				<{else}>
				<a href="index.php?r=vpdt/topics/setTopic&id=<{$row['id']}>">Chọn chủ đề này</a>
				<{/if}>
			</td>
			<td><{$row['topic_name']}></td>
			<td><{$row['full_name']}></td>
			<td class="td_center">
				<a class="fancy" href="index.php?r=vpdt/topics/form&id=<{$row['id']}>">Xem / Sửa</a>&nbsp;|
				<a href="javascript:openConfirm(<{$row['id']}>,'<{$row['topic_name']}>');">Xóa</a>
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