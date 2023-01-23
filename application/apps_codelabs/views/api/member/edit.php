
<?php
	$row=$get_data;
	echo form_open('api_member/edit');
?>
	<table>
		<tr>
			<td>MEMBER_USERNAME</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_USERNAME",$row["member_username"]);?>
				<?php echo form_hidden("MEMBER_NO",$row["member_no"]);?>
			</td>
		</tr>
		<tr>
			<td>MEMBER_PASSWORD</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_PASSWORD");?>
			</td>
		</tr>
		<tr>
			<td>MEMBER_PASSWORD_NEW</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_PASSWORD_NEW");?>
			</td>
		</tr>
		<tr>
			<td>MEMBER_NO</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_NO",$row["member_no"]);?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="submit"></td>
		</tr>
	</table>

<?php
	echo form_close();
?>