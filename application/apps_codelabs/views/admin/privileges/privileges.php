<?php
	//print_r("<pre>");
	//print_r($user_privileges);
	//print_r("</pre>");
	//if(!isset($user_privileges)){
		//$user_privileges=array("menu_view" => "");
	//}
	
	
	//print_r("<pre>");
	//print_r($user_privileges);
	//print_r("</pre>");
	
	
	
?>
<?php
	//echo $this->uri->segment('3');
	echo form_open();
?>
				
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Menu Name</th>
							<th>View</th>
							<th>Add</th>
							<th>Edit</th>
							<th>Delete</th>
							<th>Other</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$n=0;
							foreach($menu_privileges as $row)
							{
						?>
						<tr>
							<td colspan='6' style="padding-left:10px;"><?php echo $row['group_menu_name'];?></td>
						</tr>
							<?php
								$no=0;
								foreach($row["menu"] as $row2)
								{
							?>
							<tr>
								<td style="padding-left:30px;"><?php echo $row2["menu_name"];?></td>
								<td align="center">
									<?php
										if($row2['menu_view']==1){
											//if($)
											if(!empty($user_privileges[$n]["menu"][$no]["menu_view"])){
												echo "<input type='checkbox' name='view_".$row2["menu_id"]."' value='1' checked>";
											}
											else{
												echo "<input type='checkbox' name='view_".$row2["menu_id"]."' value='1'>";
											}
											
										}else{
											echo "-";
										}
									?>
								</td>
								<td align="center">
									<?php
										if($row2['menu_add']==1){
											
											if(!empty($user_privileges[$n]["menu"][$no]["menu_add"])){
												echo "<input type='checkbox' name='add_".$row2["menu_id"]."' value='1' checked>";
											}else{
												echo "<input type='checkbox' name='add_".$row2["menu_id"]."' value='1'>";
											}
											
										}else{
											echo "-";
										}
									?>
								</td>
								<td align="center">
									<?php
										if($row2['menu_edit']==1){
											
											if(!empty($user_privileges[$n]["menu"][$no]["menu_edit"])){
												echo "<input type='checkbox' name='edit_".$row2["menu_id"]."' value='1' checked>";
											}else{
												echo "<input type='checkbox' name='edit_".$row2["menu_id"]."' value='1'>";
											}
											
										}else{
											echo "-";
										}
									?>
								</td>
								<td align="center">
									<?php
										if($row2['menu_delete']==1){
											if(!empty($user_privileges[$n]["menu"][$no]["menu_delete"])){
												echo "<input type='checkbox' name='delete_".$row2["menu_id"]."' value='1' checked>";
												
											}else{
												echo "<input type='checkbox' name='delete_".$row2["menu_id"]."' value='1'>";
											}
											
										}else{
											echo "-";
										}
									?>			
								</td>
								<td align="center">
									<?php
										if($row2['menu_other']==1){
											if(!empty($user_privileges[$n]["menu"][$no]["menu_other"])){
												echo "<input type='checkbox' name='other_".$row2["menu_id"]."' value='1' checked>";
												
											}else{
												echo "<input type='checkbox' name='other_".$row2["menu_id"]."' value='1'>";
											}
											
										}else{
											echo "-";
										}
									?>			
								</td>
							</tr>
							<?php
								$no++;
								}
							?>
							
						<?php
							$n++;
							}
						?>
					</tbody>
				<table>
					
					<div align="right">
						<input type="submit" value="Save Changes" class="btn blue">
					</div>
					
				<br>
				<input type="button" value="Back" onclick="window.location.href='<?php echo site_url("admin_privileges");?>'" class="btn default" >

<?php
	echo form_close();
?>

