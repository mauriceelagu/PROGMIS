<?php
include ('header.php');
?>

<div class="row">

    <div class="col-md-2">

        <div class="sidebar">
            <?php require_once ('includes/left_bar.php'); ?>
        </div>
    </div>

    <div class="col-md-10">
        
        <form method="POST" action="file:///C|/Users/EvidenceAction1/Documents/IS/Database Back-ups/PROGMIS/perfomance/export/exp_peop.php">
        <div class="btn-group pull-right">
                    <input class="btn btn-primary" type="submit" name="" value="Export CSV">
             
        </div>
        <br>
        <br>

        <div class="table-responsive">

            <h3>People Served</h3>
            <p class="text_title">The People Served Table gives the average number of people served per dispenser across program geographies. 
                Information on the number of households using a waterpoint is collected during verification activities and the number of people 
                per household is estimated based on monthly evaluations of randomly selected households. </p>

            <table class="table table-bordered table-striped table-hover" style="width: 50%; float: left;"> 
                <tr>
                    <th Style = "width:18%"></th>
                    <th Style = "width:30%">No of dispenser</th>
                    <th Style = "width:30%">No of Households per dispenser</th>
                </tr>
            </table>
      <table class="table table-bordered table-striped table-hover" style="width: 50%; "> 
                <tr>
                    <th Style = "width:30%">No of People /Households</th>
                    <th Style = "width:30%">People Served/CD</th>
                    <th Style = "width:20%">Total People Served/CD</th>
                </tr>
            </table>
          <table style="width: 100%; "></table>
            
            <?php
            $query_country_ = "SELECT * FROM admin_countries";
            $result_country_ = mysqli_query($mysqli, $query_country_) or die(mysqli_query($mysqli));
            while($row_country_ = mysqli_fetch_assoc($result_country_)){
                $country_val_ = $row_country_["id"]; 
                $country_name_ = $row_country_["country"];?>
                <input type="hidden" name="rec_country[]" value="<?php echo $country_val_;?>" />
                <input type="hidden" name="rec_country_name[]" value="<?php echo $country_name_;?>" />
                <div class="heading">
                    <table class="table table-bordered table-striped table-hover" style="width: 50%; float: left;">
                        <tr  style="cursor:pointer; ">
                            <th Style = "width:18%"><?php echo $country_name_; ?> <b style="color:#3276B1; float: right;"> + </b></th>
                            <th Style = "width:30%"><?php
                                $query_tot_ken = "SELECT * FROM dispenser_database WHERE program !='' AND country=$country_val_";
                                $result_tot_ken = mysqli_query($mysqli, $query_tot_ken) or die(mysqli_query($mysqli));
                                $deno_tot_ken = mysqli_affected_rows($mysqli);
                                echo number_format($deno_tot_ken);//country value: number of dispensers
                                ?></th>
                            <th Style = "width:30%"><?php
                                $query1_tot_ken = "SELECT SUM(avg_users) AS num FROM dsw_per_verification WHERE country=$country_val_";
                                $result1_tot_ken = mysqli_query($mysqli, $query1_tot_ken) or die(mysqli_query($mysqli));
                                $row_num_tot_ken = mysqli_fetch_assoc($result1_tot_ken);
                                $nume_tot_ken = $row_num_tot_ken['num'];
                                if ($deno_tot_ken == 0) {
                                    echo "";
                                } else {
                                    $ans_tot_ken = round(($nume_tot_ken / $deno_tot_ken), 0);
                                    echo $ans_tot_ken;
                                }
                                ?></th>
                        </tr>
                    </table>
              <table class="table table-bordered table-striped table-hover" style="width: 50%; "> 
                        <tr>
                            <th Style = "width:30%"><?php
                            $query2_tot_ken = "SELECT c302b_hhold_ppl FROM dsw_per_adoption_rates WHERE c302b_hhold_ppl !='' AND country=$country_val_";
                            $result2_tot_ken = mysqli_query($mysqli, $query2_tot_ken) or die(mysqli_query($mysqli));
                            $deno2_tot_ken = mysqli_affected_rows($mysqli);
                            $query12_tot_ken = "SELECT SUM(c302b_hhold_ppl) AS num FROM dsw_per_adoption_rates  WHERE country=$country_val_";
                            $result12_tot_ken = mysqli_query($mysqli, $query12_tot_ken) or die(mysqli_query($mysqli));
                            $row_num2_tot_ken = mysqli_fetch_assoc($result12_tot_ken);
                            $nume2_tot_ken = $row_num2_tot_ken['num'];
                            if ($deno2_tot_ken == 0) {
                                echo "";
                            } else {
                                $ans_tot_ken = round(($nume2_tot_ken / $deno2_tot_ken), 0);
                                echo $ans_tot_ken;
                            }
                                ?></th>
                            <th Style = "width:30%"><?php
                                if ($deno_tot_ken == 0) {
                                    echo "0";
                                } else if ($deno2_tot_ken == 0) {
                                    echo "0";
                                } else {
                                    echo number_format(round(($nume_tot_ken / $deno_tot_ken) * ($nume2_tot_ken / $deno2_tot_ken)));
                                }
                                ?></th>
                            <th Style = "width:20%"><?php
                                if ($deno_tot_ken == 0) {
                                    echo "0";
                                } else if ($deno2_tot_ken == 0) {
                                    echo "0";
                                } else {
                                    echo number_format(round(($nume_tot_ken / $deno_tot_ken) * ($nume2_tot_ken / $deno2_tot_ken)*$deno_tot_ken));
                                }
                                ?></th>
                        </tr>
                    </table>
          </div>
                <div class="content">
                    <table class="table table-bordered table-striped table-hover" style="width: 50%; float: left;">
                        <?php
                        $field = 'program';
                        $res1_ken = mysqli_query($mysqli, "SELECT DISTINCT $field FROM `dsw_per_verification`  WHERE country=$country_val_ ORDER BY program ");
                        while ($row = mysqli_fetch_assoc($res1_ken)) {
                            ?>
                            <tr> <?php $prog = $row["program"]; ?>
                                <th Style = "width:22%"><?php echo $prog; ?></th>
                                <td Style = "width:30%"><?php
                                    $query_ken = "SELECT pple_per_hh FROM dispenser_database WHERE program_name like '$prog' AND pple_per_hh !=''";
                                    $result_ken = mysqli_query($mysqli, $query_ken) or die(mysqli_query($mysqli));
                                    $deno_ken = mysqli_affected_rows($mysqli);
                                    echo number_format($deno_ken);
									//program: number of dispensers (actual)
                                    ?></td>
                                <td Style = "width:30%"><span style="width:36%">
                                  <?php
                                    $query1_ken = "SELECT SUM(hh_per_wpt) AS num FROM dispenser_database WHERE program_name like '$prog'";
                                    $result1_ken = mysqli_query($mysqli, $query1_ken) or die(mysqli_query($mysqli));
                                    $row_num_ken = mysqli_fetch_assoc($result1_ken);
                                    $nume_ken = $row_num_ken['num'];
                                    if ($deno_ken == 0) {
                                        echo "";
                                    } else {
                                        $ans_ken = round(($nume_ken / $deno_ken), 0);
                                        echo $ans_ken;
										//program: number of hhould per dispenser
                                    }
                                    ?>
                                </span></td> 
                                <td Style = "width:30%">&nbsp;</td>
                                <td Style = "width:30%">&nbsp;</td>
                            </tr> 
                        <?php }
                        ?>               
                    </table>
                </div>
                <table style="width: 100%; "></table>
            <?php } ?>

        </div>
        </form>
    </div>

</div>

</div>

</body>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".content").hide();
        //toggle the componenet with class msg_body
        jQuery(".heading").click(function()
        {
            jQuery(this).next(".content").slideToggle(400);

        });
    });
</script>

</html>    
<?php
mysqli_close($mysqli);
?>