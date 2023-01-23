
<?php

	for($y=8; $y<22; $y++){
		
		if($y<10){
			$y = "0$y";
		}
		
		$time["$y:00"] = "$y:00";
	}
	
	//print_r($time);


	echo form_open('api_booking/add');
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
		
		<?php for($i=0; $i<3; $i++): ?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>BOOKING_TIME</td>
			<td>:</td>
			<td>
				<?php echo form_dropdown("BOOKING_TIMES",$time,"","class='time'");?>
			</td>
		</tr>
		<tr>
			<td>TREATMENT_NAME</td>
			<td>:</td>
			<td>
				<?php echo form_dropdown("TREATMENT_NAMES",array("" => "Please Select"),"","class='treatment' id='$i'");?>
			</td>
		</tr>
		<tr>
			<td>TREATMENT_PRICE</td>
			<td>:</td>
			<td>
				<label id="tpric<?php echo $i;?>"></label>
			</td>
		</tr>
		<tr>
			<td>STYLIST_NAME</td>
			<td>:</td>
			<td>
				<?php echo form_dropdown("STYLIST_NAMES",array("" => "Please Select"),"","id='stylist$i' class='stylist'");?>
			</td>
		</tr>
		
		<tr>
			<td>STYLIST_PRICE</td>
			<td>:</td>
			<td>
				<label id="spric<?php echo $i;?>"></label>
			</td>
		</tr>
		
		<tr>
			<td>TOTAL_PRICE</td>
			<td>:</td>
			<td>
				<label id="total<?php echo $i;?>"></label>
			</td>
		</tr>
		<?php endfor; ?>
		
		<tr>
			<td></td>
			<td></td>
			<td>
				BOOKING_TIME TO PASSING<input type="text" name="BOOKING_TIME" style="width:500px;height:40px"><br>
				TREATMENT_NAME TO PASSING<input type="text" name="TREATMENT_NAME" style="width:500px;height:40px"><br>
				STYLIST_NAME TO PASSING <input type="text" name="STYLIST_NAME" style="width:500px;height:40px">
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
			<input type="button" id="button" value="Proses">
			<br>
			<input type="submit" id="submit" value="submit">

			</td>
		</tr>
	</table>
<?php
	//echo $i;
	echo form_close();
?>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>
	$(document).ready(function(){
		$("#button").click(function(){
			// first get the elements into a list
			var times = $('.time option:selected');
			// next translate that into an array of just the values
			var vtimes = $.map(times, function(elt, i) { return $(elt).val();});
			var jtimes = vtimes.join("<>");
			$("input[name='BOOKING_TIME']").val(jtimes);
			//alert(jtimes);
			
			var treat = $('.treatment option:selected');
			var vtreat = $.map(treat, function(elt, i) { return $(elt).val();});
			var jtreat = vtreat.join("<>");
			$("input[name='TREATMENT_NAME']").val(jtreat);
			//alert(jtreat);
			
			var stylist = $('.stylist option:selected');
			var vstylist = $.map(stylist, function(elt, i) { return $(elt).val();});
			var jstylist = vstylist.join("<>");
			
			$("input[name='STYLIST_NAME']").val(jstylist);
			//alert(jstylist);
			
		});
		
		
		$("#branch").change(function(){
			var a = $(this).val();
			
			$.post( "<?php echo site_url("api_booking/get_treatment");?>",{ branch:a }, function( data ) {
			  $( ".treatment" ).html( data );
			});
			
			//alert(a);
			
		});
		$(".treatment").change(function(){
			var a = $( "#branch option:selected" ).val();
			var id = $(this).attr("id");
			var b = $(this).val();
			//alert(id);
			
			
			$.post( "<?php echo site_url("api_booking/get_stylist");?>",{ branch:a,treat:b }, function( data ) {
			  $("#stylist"+id).html( data );
			});
			
			$.post( "<?php echo site_url("api_booking/get_tpric");?>",{ treat:b }, function( data ) {
			  $("#tpric"+id).html( data );
			});
			
			
		});
		
		<?php for($x=0;$x<$i;$x++): ?>
		$("#stylist<?php echo $x;?>").change(function(){
			var a = $(this).val();
			var b = $("#tpric<?php echo $x;?>").html();
			//alert(a);
		
			$.post( "<?php echo site_url("api_booking/get_spric");?>",{ stylist:a }, function( data ) {
			  $("#spric<?php echo $x;?>").html( data );
			  var c = parseInt(data) + parseInt(b);
			  $("#total<?php echo $x;?>").html(c);
			});
			
		});
		<?php endfor; ?>
	});
</script>