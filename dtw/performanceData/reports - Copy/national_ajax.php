<?php
require_once ('../../includes/auth.php');
require_once ('../../includes/config.php');
include "func.NationalReport.php";

// handle the data that goes into the bars
if (isset($_POST['national_bar_data'])) {
	$info_type = $_POST['info_type'];
	// get the schools participated data (first bar)
	if ($info_type == 'schools_participated') {
		// count schools participated
		$school_participated=schoolsDewormed('STH');
		// count schools targeted
		// $school_targeted=getPlannedSchools($donor_selected);
		/*  @IMPORTANT make it static for now
			@IMPORTANT $school_targeted=getPlannedSchools();
		*/
		$school_targeted="11000";
		echo $school_participated . "," . $school_targeted;
		return;
	}

	// get dewormed data (second bar)
	if ($info_type == 'children_dewormed') {
		$children_dewormed = sumArgs('a_bysch','a_u5_total','a_trt_total','a_6_18_total');
		// sum p_pri_enroll, p_ecd_enroll, p_ecd_sa_enroll in p_bysch left join districts_donors where donor is the one selected
		//  this will get the corresponding districts in the donor table and add the schools\
		$children_targeted_plain = sumArgs('p_bysch','p_pri_enroll','p_ecd_enroll','p_ecd_sa_enroll');
		// @IMPORTANT make static form now
		// @IMPORTANT $children_targeted=ROUND($children_targeted_plain/0.83);
		$children_targeted= "5700000";
		echo $children_dewormed . "," . $children_targeted;
		return;	
	}
	
	// get the district data (third bar and currently broken)
	if ($info_type == 'districts_completed') {
		// count districts participated
		$districts_participated=districtsDewormed('STH');
		//  count districts PLanned
		// @IMPORTANT make static for now
		// @IMPORTANT $districts_planned=districtsPlanned('STH');
		$districts_planned=111;
		echo $districts_participated . "," . $districts_planned;
		return;
	}
	
	// get the schi dewormed data (fourth bar)
	if ($info_type == 'children_dewormed_schi') {
		$pzq_children_targeted=sumMoreFexible('p_pri_enroll','p_bysch','p_sch_bilharzia','Y');
		// we have to divide PZQ planned by 0.961 to rectify that fact that 
		// form p_bysc does not have non-enrolled children
		// @IMPORTANT make static for now
		// @IMPORTANT $pzq_children_targeted=round($pzq_children_targeted/0.961);
		$pzq_children_targeted =600000;
		$pzq_children_dewormed = sumArgs('a_bysch','ap_trt_total','ap_6_18_total','ap_ecd_total');
		
		echo $pzq_children_dewormed . "," . $pzq_children_targeted;
		return;
	}

		// get the district data (third bar and currently broken)
	if ($info_type == 'districts_completed_schi') {
		// count districts participated
		$districts_participated=districtsDewormed('PZQ');
		//  count districts PLanned
		// @IMPORTANT mae static for now
		// @IMPORTANT $districts_planned=districtsPlanned('PZQ');
		$districts_planned= 34;
		echo $districts_participated . "," . $districts_planned;
		return;
	}
}

// FOR THE TWO TABLES AT THE BOTTOM
if (isset($_POST['national_table_data'])) {
	
	// $children_dewormed = $pzq_children_dewormed = 0;
	// $male_children_dewormed = $pzq_male_children_dewormed = 0;
	// $female_children_dewormed = $pzq_female_children_dewormed = 0;
	// $enrolled_children_dewormed = $pzq_enrolled_children_dewormed = 0;
	// $non_enrolled_children_dewormed = $pzq_non_enrolled_children_dewormed = 0;
	// $under_5 = $pzq_under_5 = 0;
	// $over_5 = $pzq_over_5 = 0;
	// $var_children_dewormed = '';
	$completed_teacher_sessions = getTeacherTrainingSession2('attnt_sth');
	$pzq_completed_teacher_sessions = getTeacherTrainingSession('attnt_schisto');
	$est_number_teachers_trained = 0;
	$pzq_est_number_teachers_trained = 0;
	$school_participated=schoolsDewormed('STH');
	// count schools targeted
	$school_targeted=getPlannedSchools();
	// count districts participated
	$districts_participated=districtsDewormed('STH');
	//////hardcodded////////////////////////////////////
  $districts_participated='111';
  $districts_participated_PZQ='34';
  /////////////////////////////////////////////////////
	//  count districts PLanned
	$districts_planned=districtsPlanned('STH');
	// Districts completed for PZQ
	$pzq_districts_completed=districtsPlanned('PZQ');
	// Schools participated for STH
	$pzq_schools_participated=schoolsDewormed('PZQ');
	// Children dewormed for STH
	$children_dewormed = sumArgs('a_bysch','a_u5_total','a_trt_total','a_6_18_total');
	$male_children_dewormed = sumArgs('a_bysch','a_ecd_m','a_2_m','a_6_m','a_11_m','a_15_m','a_trt_m');
	$female_children_dewormed = sumArgs('a_bysch', 'a_ecd_f','a_2_f','a_6_f','a_11_f','a_15_f','a_trt_f');
	$enrolled_children_dewormed = sumArgs('a_bysch','a_ecd_total','a_trt_total');
	$non_enrolled_children_dewormed = sumArgs('a_bysch','a_2_18_total');
	$under_5 = sumArgs('a_bysch','a_ecd_f','a_ecd_m','a_2_f','a_2_m');
	$over_5 = sumArgs('a_bysch','a_6_f','a_11_f','a_15_f','a_6_m','a_11_m','a_15_m','a_trt_total');
	// sum p_pri_enroll, p_ecd_enroll, p_ecd_sa_enroll in p_bysch left join districts_donors where donor is the one selected
	//  this will get the corresponding districts in the donor table and add the schools\
	$children_targeted_plain = sumArgs('p_bysch','p_pri_enroll','p_ecd_enroll','p_ecd_sa_enroll');
	$children_targeted=ROUND($children_targeted_plain/0.83);

	// Children dewormed for PZQ
	$pzq_enrolled_children_dewormed = sumArgs('a_bysch','ap_ecd_total','ap_trt_total');
	$pzq_non_enrolled_children_dewormed = sumArgs('a_bysch','ap_6_18_total');
	$pzq_children_targeted=sumMoreFexible('p_pri_enroll','p_bysch','p_sch_bilharzia','Y');
	// we have to divide PZQ planned by 0.961 to rectify that fact that 
	// form p_bysc does not have non-enrolled children
	$pzq_children_targeted=round($pzq_children_targeted/0.961);
	$pzq_children_dewormed = $pzq_enrolled_children_dewormed + $pzq_non_enrolled_children_dewormed;
	$pzq_children_dewormed = sumArgs('a_bysch','ap_trt_total','ap_6_18_total','ap_ecd_total');
	$pzq_male_children_dewormed = sumArgs('a_bysch','ap_ecd_m','ap_6_m','ap_11_m','ap_15_m','ap_trt_m');
	$pzq_female_children_dewormed = sumArgs('a_bysch','ap_ecd_f','ap_6_f','ap_11_f','ap_15_f','ap_trt_f');
	$pzq_enrolled_children_dewormed = sumArgs('a_bysch','ap_ecd_total','ap_trt_total');
	$pzq_non_enrolled_children_dewormed = sumArgs('a_bysch','ap_6_18_total');
	// there is no under 5 for PAQ
	$pzq_under_5 = "N/A";
	// $pzq_over_5 = sumArgs('a_bysch','ap_6_f','ap_11_f','ap_15_f','ap_6_m','ap_11_m','ap_15_m','ap_trt_total');
	$pzq_over_5 = sumArgs('a_bysch','ap_6_f','ap_11_f','ap_15_f','ap_6_m','ap_11_m','ap_15_m','ap_trt_total','ap_ecd_total');

	// Masters trained
	$sth_master_trainers_trained = $pzq_master_trainers_trained = 0;
	// $sth_district_division_moe = $pzq_district_division_moe = 0;
	// $sth_district_division_mophs = $pzq_district_division_mophs = 0;

	$district_num = CountDistinctPlain('district_id','a_bysch');
	$division_num = CountDistinctPlain('division_id','a_bysch');
	$sth_district_division_moe = (4*$district_num) + (3*$division_num);
	$sth_district_division_mophs = (3*$district_num) + (3*$division_num);
	$district_num_pzq = CountDistinctFlexible('district_id','a_bysch','ap_attached','Yes');
	$division_num_pzq = CountDistinctFlexible('division_id','a_bysch','ap_attached','Yes');
	$pzq_district_division_moe = (3*$district_num_pzq) + (4*$division_num_pzq);
	$pzq_district_division_mophs = $pzq_district_division_moe;
	// STH
	//get the teachers trained
	$est_number_teachers_trained= getAttntTeachersSTH();
	$pzq_est_number_teachers_trained = getAttntTeachers('attnt_schisto');
  
	$result = mysql_query("SELECT * FROM master_trainers") or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$sth_master_trainers_trained++;
		$ministry = $row["ministry"];
		if ($ministry == "MoE")
			$sth_district_division_moe++;			
		// if ($ministry == "MoPHS")
			// $sth_district_division_mophs++;
	}
	$pzq_master_trainers_trained = $sth_master_trainers_trained;
	
	echo '<!-- --------------------------- First Table --------------------------- -->
			<table border="1" cellpadding="1" cellspacing="1" width="50%" align="center" class="national_report_table">
			<tr><th>Statistics</th><th>STH</th><th>Schisto</th></tr>
			<tr><td>Sub-Counties planned</td><td class="left-align">' . $districts_participated . '</td><td class="left-align">' . $districts_participated_PZQ. '</td></tr>
			<tr><td>Schools reached</td><td class="left-align">' . number_format($school_participated) . '</td><td class="left-align">' . number_format($pzq_schools_participated) . '</td></tr>
			<tr><td>All Children dewormed</td><td class="left-align">' . number_format($children_dewormed) . '</td><td class="left-align">' . number_format($pzq_children_dewormed) . '</td></tr>
			<tr><td>Male children dewormed</td><td class="left-align">' . number_format($male_children_dewormed) . '</td><td class="left-align">' . number_format($pzq_male_children_dewormed) . '</td></tr>
			<tr><td>Female children dewormed</td><td class="left-align">' . number_format($female_children_dewormed) . '</td><td class="left-align">' . number_format($pzq_female_children_dewormed) . '</td></tr>
			<tr><td>Enrolled children dewormed</td><td class="left-align">' . number_format($enrolled_children_dewormed) . '</td><td class="left-align">' . number_format($pzq_enrolled_children_dewormed) . '</td></tr>
			<tr><td>Non-enrolled children dewormed</td><td class="left-align">' . number_format($non_enrolled_children_dewormed) . '</td><td class="left-align">' . number_format($pzq_non_enrolled_children_dewormed). '</td></tr>
	 	</table>
	 	<!-- --------------------------- Second Table --------------------------- -->
	 	<table border="1" cellpadding="1" cellspacing="1" width="50%" align="center" class="national_report_table">
			<tr><th>Statistics</th><th>STH</th><th>Schisto</th></tr>
			<tr><td>Children 5 and under dewormed</td><td class="left-align">' . number_format($under_5) . '</td><td class="left-align">' . $pzq_under_5 . '</td></tr>
			<tr><td>Children over 5 dewormed</td><td class="left-align">' . number_format($over_5) . '</td><td class="left-align">' . number_format($pzq_over_5) . '</td></tr>
			<tr><td>Master Trainers trained</td><td class="left-align">' . $sth_master_trainers_trained . '</td><td class="left-align">' . $pzq_master_trainers_trained . '</td></tr>
			<tr><td>Est. sub-county/ward MoEST personnel trained</td><td class="left-align">' . number_format($sth_district_division_moe) . '</td><td class="left-align">' . number_format($pzq_district_division_moe) . '</td></tr>
			<tr><td>Est. sub-county/ward MoH personnel trained</td><td class="left-align">' . number_format($sth_district_division_mophs) . '</td><td class="left-align">' . number_format($pzq_district_division_mophs) . '</td></tr>
			<tr><td>Completed teacher training sessions</td><td class="left-align">' . $completed_teacher_sessions . '</td><td class="left-align">' . $pzq_completed_teacher_sessions . '</td></tr>
			<tr><td>Est. number of teachers trained</td><td class="left-align">' . number_format($est_number_teachers_trained) . '</td><td class="left-align">' . number_format($pzq_est_number_teachers_trained) . '</td></tr>
	 	</table>';
}
// pie charts
if (isset($_POST['national_data'])) {
	$data_type = $_POST['data_type'];
	if ($data_type == 'sth_enrollment') {
		$enrolled_children_dewormed = sumArgs('a_bysch','a_ecd_total','a_trt_total');
		$non_enrolled_children_dewormed = sumArgs('a_bysch','a_2_18_total');
		echo $enrolled_children_dewormed . "," . $non_enrolled_children_dewormed;
		return;
	}
	if ($data_type == 'sth_age') {
		$under_5 = sumArgs('a_bysch','a_ecd_f','a_ecd_m','a_2_f','a_2_m');
		$over_5 = sumArgs('a_bysch','a_6_f','a_11_f','a_15_f','a_6_m','a_11_m','a_15_m','a_trt_total');
		echo $under_5 . "," . $over_5;
		return;
	}
	if ($data_type == 'sth_sex') {
		$male_children_dewormed = sumArgs('a_bysch','a_ecd_m','a_2_m','a_6_m','a_11_m','a_15_m','a_trt_m');
		$female_children_dewormed = sumArgs('a_bysch', 'a_ecd_f','a_2_f','a_6_f','a_11_f','a_15_f','a_trt_f');
		echo $male_children_dewormed . "," . $female_children_dewormed;
		return;
	}
	if ($data_type == 'schi_enrollment') {
		$pzq_enrolled_children_dewormed = sumArgs('a_bysch','ap_ecd_total','ap_trt_total');
		$pzq_non_enrolled_children_dewormed = sumArgs('a_bysch','ap_6_18_total');
		echo $pzq_enrolled_children_dewormed . "," . $pzq_non_enrolled_children_dewormed;
		return;
	}
	
	if ($data_type == 'schi_sex') {
		$pzq_male_children_dewormed = sumArgs('a_bysch','ap_ecd_m','ap_6_m','ap_11_m','ap_15_m','ap_trt_m');
		$pzq_female_children_dewormed = sumArgs('a_bysch','ap_ecd_f','ap_6_f','ap_11_f','ap_15_f','ap_trt_f');
		echo $pzq_male_children_dewormed . "," . $pzq_female_children_dewormed;
		return;
	}
}

?>

