<?php
	$menu=$this->privileges->user_priv();
	
	//print_r("<pre>");
	//print_r($menu);
	//print_r("<pre>");
?>
<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<ul class="page-sidebar-menu">
				
			<li>
				&nbsp;
			</li>
			
			<?php 
				foreach($menu as $row){
			?>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-table"></i>
					<span class="title">
						<?php echo $row["group_menu_name"];?>
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<?php
							foreach($row["menu"] as $row2){
						?>
							<li>
								<a href="<?php echo site_url($row2["menu_url"]);?>">
								<?php echo $row2["menu_name"];?></a>
							</li>
						<?php
							}
						?>
					</ul>
				</li>
			<?php
				}
			?>
			
		</ul>
		<!-- END SIDEBAR MENU -->
</div>
				