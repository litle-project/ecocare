<br>
<br>
<h1><?php echo $title;?></h1>
<div class="container demo">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        How To Use This Feature?
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                      <ul>
                          <li><h3>Generate Month For Getting Working Days</h3></li>
                            <ol><p>1. Select button generate month</p></ol>
                            <ol><p>2. Insert Month & insert Year</p></ol>
                            <ol><p>3. Click Generate</p></ol>
                            <ol><p>4. Success, You was generate month in year that you insert!</p></ol>
                      </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        What The Function This Feature?
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <ul>
                          <li><h3>Ecocare Working Days</h3></li>
                            <ol><p>1. Ecocare has working days 6 days in 1 week, and it will simplify the system</p></ol>
                            <ol><p>2. Service schedule contracts will get the same date as the date on the system calendar based on the working day on ecocare</p></ol>
                            <ol><p>3. Schedule install on Sundays will be automatically switched to Monday</p></ol>
                      </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Why I Get Error in Schedule Date in Service Schedule?
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <ul>
                          <li><h3>Generate Working Days</h3></li>
                            <ol><p>1. Because the system cannot choose the working day on ecocare</p></ol>
                            <ol><p>2. Delete the existing contract, generate the month (min 1 year ahead) and create a new contract again</p></ol>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- panel-group -->
    <div class="form-actions fluid">
    <div class="col-md-12">
        <center>
            <button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
        </center>
    </div>
</div>