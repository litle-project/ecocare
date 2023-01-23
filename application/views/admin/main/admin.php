<h1><?php echo $title;?></h1>
<br/><br/>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="col-md-3 col-sm-3 col-xs-6" style="padding:0 5px;">
            <div class="dashboard-stat blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349">1200</span>
                    </div>
                    <div class="desc"><b> New Feedbacks </b></div>
                </div>
                <div class="more">
                	<b>See Details</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6" style="padding:0 5px;">
            <div class="dashboard-stat green" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349">95</span>
                    </div>
                    <div class="desc"><b> New Feedbacks </b></div>
                </div>
                <div class="more">
                	<b>See Details</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6" style="padding:0 5px;">
            <div class="dashboard-stat yellow" href="#">
                <div class="visual">
                    <i class="fa fa-diamond"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349">3250</span>
                    </div>
                    <div class="desc"><b> New Feedbacks </b></div>
                </div>
                <div class="more">
                	<b>See Details</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6" style="padding:0 5px;">
            <div class="dashboard-stat red" href="#">
                <div class="visual">
                    <i class="fa fa-feed"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349">800</span>
                    </div>
                    <div class="desc"><b> New Feedbacks </b></div>
                </div>
                <div class="more">
                	<b>See Details</b>
                </div>
            </div>
        </div>

        <!-- <div class="clearfix"></div>

        <div class="col-md-6 col-sm-6 col-xs-12" style="padding:0 5px;">
			<div class="note note-success">
	            <h3><b>Success! Some Header Goes Here</b></h3>
	            <p> Duis mollis, est non commodo luctus, nisi erat mattis consectetur purus sit amet porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </p>
	        </div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0 5px;">
			<div class="note note-info">
	            <h3><b>Info! Some Header Goes Here</b></h3>
	            <p> Duis mollis, est non commodo luctus, nisi erat mattis consectetur purus sit amet porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </p>
	        </div>
		</div> -->
		<hr>
		<div class="row" style="margin:20px 0 50px;">
			<div class="col-lg-12">											
				<center >
					<div id="best_selling_product" style="height: 400px"></div>
				</center>
			</div>
			<div class="col-lg-12">										
				<center >
					<div id="evassigned" style="height: 400px; padding-top:40px;"></div>
				</center>
			</div>
			<div class="col-lg-12">											
				<center >
					<div id="evasubmitted" style="height: 400px; padding-top:40px;"></div>
				</center>
			</div>
            <div class="col-lg-12">                                         
                <center >
                    <div id="evatimesubmitted" style="height: 400px; padding-top:40px;"></div>
                </center>
            </div>
		</div>
		<hr>
	</div>
</div>
		
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<style type="text/css">
#container {
	height: 400px; 
	min-width: 310px; 
	max-width: 800px;
	margin: 0 auto;
}
</style>
<!-- <?php 
	// $data_best_sell = "[";
	// if(count($best_sell)>0){
		// foreach ($best_sell as $row) {
			// $data_best_sell .= "{";
			// $data_best_sell .= "name: '".$row["product_name"]."',";
			// $data_best_sell .= "y: ".$row["total"];
			// $data_best_sell .= "},";
		// }
	// }
	// $data_best_sell .= "]";
?> -->
<script>
$(function () {
    // Create the chart
    $('#best_selling_product').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Best-Selling Product'
        },
        subtitle: {
            text: 'Top Ten of Best-Selling Product'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total Product'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },

        series: [{
            name: 'Product',
            colorByPoint: true,
            data: <?php echo $data_best_sell?> 
            // data: [{
            //     name: 'Microsoft Internet Explorer',
            //     y: 1000
            // }, {
            //     name: 'Chrome',
            //     y: 980
            // }, {
            //     name: 'Firefox',
            //     y: 800
            // }, {
            //     name: 'Safari',
            //     y: 789
            // }, {
            //     name: 'Opera',
            //     y: 801
            // }, {
            //     name: 'Proprietary or Undetectable',
            //     y: 702
            // },]
        }]
    });
});
</script>
<!-- data: <?php //echo $data_aveassigned?> -->
<script>
    $(document).ready(function () {

        $("#from").datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: null,
            changeMonth: true,
            //minDate: 0,

            maxDate: 0,
            numberOfMonths: 2,
            onClose: function (selectedDate) {

                $("#to").datepicker("option", selectedDate);

            }

        });

        //jquery date picker configuration

        $("#to").datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: null,
            changeMonth: true,
            //minDate: 0,

            //maxDate:0,

            numberOfMonths: 2,
            onClose: function (selectedDate) {

                $("#from").datepicker("option", selectedDate);

            }

        });
    });
</script>
