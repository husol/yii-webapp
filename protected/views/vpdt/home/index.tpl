<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Thông tin mới</div>
	<div class="admin_content">
		<table class="tablesorter">
		<thead>
		<tr>
			<th>Tên công việc</th>
			<th>Người gửi</th>
			<th>Ghi chú</th>
			<th>Thời gian</th>
		</tr>
		</thead>
		<tbody>
		<{if count($newWork) eq 0}>
		<tr>
			<td colspan="4" class="td_center">Không có tin mới</td>
		</tr>
		<{else}>
		<{foreach from=$newWork item=row}>
		<tr>
			<td><a href="index.php?r=vpdt/formWork&id=<{$row['id']}>"><{$row['work_name']}></a></td>
			<td><{$row['full_name']}></td>
			<td><{$row['note']}></td>
			<td class="td_center"><{$row['last_modified_time']}></td>
		</tr>
		<{/foreach}>
		<{/if}>
		</tbody>
		</table>
	</div>
	<div class="admin_title">Danh sách Công việc đã nhận</div>
	<div class="admin_content">
		<table class="tablesorter">
		<thead>
		<tr>
			<th>Tên công việc</th>
			<th>Người gửi</th>
			<th>Ghi chú</th>
			<th>Thời gian</th>
		</tr>
		</thead>
		<tbody>
		<{if count($receivedWork) eq 0}>
		<tr>
			<td colspan="4" class="td_center">Không có việc</td>
		</tr>
		<{else}>
		<{foreach from=$receivedWork item=row}>
		<tr>
			<td><a href="index.php?r=vpdt/formWork&id=<{$row['id']}>"><{$row['work_name']}></a></td>
			<td><{$row['full_name']}></td>
			<td><{$row['note']}></td>
			<td class="td_center"><{$row['last_modified_time']}></td>
		</tr>
		<{/foreach}>
		<{/if}>
		</tbody>
		</table>
		<{include file="../../panels/tablesorterPager.tpl"}>
	</div>
</div>
<{include file="../controls/admin_footer.tpl"}>