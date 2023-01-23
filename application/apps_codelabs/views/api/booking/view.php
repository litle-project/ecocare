
<?php
	echo form_open('api_booking/cancel_sample');
?>
	<table>
		<tr>
			<td>MEMBER_ID</td>
			<td>:</td>
			<td>
				<?php echo form_input("MEMBER_ID");?>
			</td>
		</tr>
		<tr>
			<td>BRANCH_NAME</td>
			<td>:</td>
			<td>
				<?php echo form_dropdown("BRANCH_NAME",$branch,"","id='branch'");?>
			</td>
		</tr>
		<tr>
			<td>BOOKING_DATE</td>
			<td>:</td>
			<td>
				<?php echo form_input("BOOKING_DATE");?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="GET BOOKING"></td>
		</tr>
	</table>

<?php
	echo form_close();
?>	
	<br>
	<br>
	
	<?php
		if(isset($book)){
		
		//print_r($book);
	?>
	<table border=1;>
		<tr>
			<td>TIME</td>
			<td>TREATMENT</td>
			<td>TREATMENT PRICE</td>
			<td>STYLIST</td>
			<td>STYLIST PRICE</td>
			<td>TOTAL PRICE</td>
			<td>BOOKING_STATUS</td>
			<td>CANCEL</td>
		</tr>
		<?php
			foreach($book as $row){
		?>
		<tr>
			<td><?php echo $row->BOOKING_TIME;?></td>
			<td><?php echo $row->BOOKING_TREATMENT_NAME;?></td>
			<td><?php echo $row->BOOKING_TREATMENT_PRICE;?></td>
			<td><?php echo $row->BOOKING_STYLIST_NAME;?></td>
			<td><?php echo $row->BOOKING_STYLIST_PRICE;?></td>
			<td><?php echo $row->BOOKING_TOTAL_PRICE;?></td>
			<td><?php echo $row->BOOKING_STATUS;?></td>
			<td><a href="<?php echo site_url("api_booking/cancel_book?BOOKING_DETAIL_ID=".$row->BOOKING_DETAIL_ID."");?>">cancel</a></td>
		</tr>
		<?php
			}
		?>
	</table>
	<?php
		}
	?>
	
