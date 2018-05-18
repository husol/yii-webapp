<script type="text/javascript">
function openConfirm(id, username){
	var r=confirm("Bạn có chắc muốn xóa tài khoản \"" + username + "\" ?");
	if (r==true)
	{
	  window.location.href = "index.php?r=vpdt/users/delete&id="+id;
	}
}
</script>
<{include file="../controls/admin_header.tpl"}>
<{include file="../controls/admin_left_menu.tpl"}>
<div id="admin_right">
	<div class="admin_title">Danh sách Thành viên</div>
	<div class="admin_add">
		[<a class="fancy" href="index.php?r=vpdt/users/form">Thêm</a>]
	</div>
	<div class="admin_content">
		<table class="tablesorter">
		<thead>
		<tr>
			<th>Avatar</th>
			<th>Thông tin</th>
		</tr>
		</thead>
		<tbody>
		<{if count($user) eq 0}>
		<tr>
			<td class="td_center" colspan="6">Không có thành viên khác</td>
		</tr>
		<{else}>
		<{foreach from=$user item=row}>
		<tr>
			<td><img src="<{if isset($row['urlAvatar'])}><{$row['urlAvatar']}><{else}><{HUS::getBaseUrl()}>img/no_avatar.png<{/if}>" width="100" height="100" /></td>
			<td>Họ và tên: <{$row['name']}><br />
				Tài khoản: <{$row['username']}><br />
				Chức vụ: <{$row['position']}><br />
				Email: <{$row['email']}><br />
				Công tác: <{$row['work_place']}><br />
				Kích hoạt: <{if $row['active']==1}>Có<{else}>Không<{/if}><br />
				Lần truy xuất cuối: <{$row['last_login']}>
				<div style="float: right">
					<a class="fancy" href="index.php?r=vpdt/users/form&id=<{$row['id']}>">Xem / Sửa</a>&nbsp;|
					<a href="javascript:openConfirm(<{$row['id']}>,'<{$row['username']}>');">Xóa</a>
				</div>
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