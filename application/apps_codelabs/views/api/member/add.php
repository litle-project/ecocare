
<?php
	echo form_open('api_member/add');
?>
	<table>
		<tr>
			<td>MEMBER_USERNAME</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_USERNAME");?>
			</td>
		</tr>
		<tr>
			<td>MEMBER_PASSWORD</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_PASSWORD");?>
			</td>
		</tr>
		<!--
		<tr>
			<td>MEMBER_PASSWORD_CONFIRM</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_PASSWORD_CONFIRM");?>
			</td>
		</tr>
		-->
		<tr>
			<td>MEMBER_NO</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_NO");?>
			</td>
		</tr>
		
		<tr>
			<td>IMEI</td>
			<td>:</td>
			<td>
				<?php echo form_input("IMEI");?>
			</td>
		</tr>
		
		<tr>
			<td>DEVICE</td>
			<td>:</td>
			<td>
				<?php echo form_input("DEVICE");?>
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