<{if $total > 0}>
<table style="margin-top: 50px;">
	<tr>
		<td><{$result[1]['des']}></td>
		<td width="300px"><div style="background-color: red; width: <{$result[1]['no']/$total*100}>%; border: 1px solid #000000; height: 15px;"></div></td>
		<td><{$result[1]['no']}> bình chọn (<{($result[1]['no']/$total*100)|string_format:"%.2f"}>%)</td>
	</tr>
	<tr>
		<td><{$result[2]['des']}></td>
		<td><div style="background-color: green; width: <{$result[2]['no']/$total*100}>%; border: 1px solid #000000; height: 15px;"></div></td>
		<td><{$result[2]['no']}> bình chọn (<{($result[2]['no']/$total*100)|string_format:"%.2f"}>%)</td>
	</tr>
	<tr>
		<td><{$result[3]['des']}></td>
		<td><div style="background-color: blue; width: <{$result[3]['no']/$total*100}>%; border: 1px solid #000000; height: 15px;"></div></td>
		<td><{$result[3]['no']}> bình chọn (<{($result[3]['no']/$total*100)|string_format:"%.2f"}>%)</td>
	</tr>
	<tr>
		<td><{$result[4]['des']}></td>
		<td><div style="background-color: blueviolet; width: <{$result[4]['no']/$total*100}>%; border: 1px solid #000000; height: 15px;"></div></td>
		<td><{$result[4]['no']}> bình chọn (<{($result[4]['no']/$total*100)|string_format:"%.2f"}>%)</td>
	</tr>
	<tr>
		<td><{$result[5]['des']}></td>
		<td><div style="background-color: #7C7878; width: <{$result[5]['no']/$total*100}>%; border: 1px solid #000000; height: 15px;"></div></td>
		<td><{$result[5]['no']}> bình chọn (<{($result[5]['no']/$total*100)|string_format:"%.2f"}>%)</td>
	</tr>
</table>
<{/if}>
<div class="spacer"></div>
<p>Tổng cộng: <{$total}> bình chọn</p>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="formbtn">
	<a id="return" href="javascript:window.location.reload(true);" class="btn">Đóng</a>
</div>