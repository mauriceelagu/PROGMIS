<?php

//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @since 2008-03-04
 */
$path = "../../";
$data = "NA";
include $path . 'tcpdf/tcpdf.php';
require_once ($path . 'includes/auth.php');
require_once ($path . 'includes/config.php');
include "queryFunctions.php";

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf/examples/tcpdf_include.php');
// extend TCPF with custom functions
class MYPDF extends TCPDF {

    // Load table data from file
    public function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES . 'evidence-action.png';
        $this->Image($image_file, 15, 5, 28, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        // Title
        $this->Cell(110, 15, "CIFF REPORT", 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Colored table
    public function ColoredTable($header, $datatext) {
        $placeholder = "NA";

        $row1 = number_format(sumDonor('a_total_child', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row2 = number_format(numDistinctDonor('district_id', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row3 = number_format(numDistinctDonor('division_id', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row4 = number_format(sumDonor('a_trt_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row5 = number_format(sumDonor('a_trt_m', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row6 = number_format(sumDonor('a_trt_f', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row7 = number_format(sumDonor('a_6_18_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row8 = number_format(sumDonor('a_6_18_m', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row9 = number_format(sumDonor('a_6_18_f', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row10 = number_format(sumDonor('a_u5_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row11 = number_format(sumDonor('a_u5_m', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row12 = number_format(sumDonor('a_u5_f', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row13 = number_format(sumDonor('p_alb', 'p_bysch_with_donor', 'donor', 'CIFF'));
        $row14 = number_format(sumDonor('ap_total_child', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row15 = number_format(numDistinctDonor1('district_id', 'a_bysch_with_donor', 'Yes', 'donor', 'CIFF'));
        $row16 = number_format(numDistinctDonor1('division_id', 'a_bysch_with_donor', 'Yes', 'donor', 'CIFF'));
        $row17 = number_format(sumDonor('ap_trt_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row18 = number_format(sumDonor('ap_trt_m', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row19 = number_format(sumDonor('ap_trt_f', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row20 = number_format(sumDonor('ap_6_18_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row21 = number_format(sumDonor('ap_6_18_m', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row22 = number_format(sumDonor('ap_6_18_f', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row23 = percentage(sumDonor('a_trt_total', 'a_bysch_with_donor', 'donor', 'CIFF'), sumDonor('a_total_child', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row24 = number_format(sumDonor('a_trt_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $sum3 = sumDonor('p_pri_enroll', 'p_bysch_with_donor', 'donor', 'CIFF');
        $sum4 = sumDonor('p_ecd_enroll', 'p_bysch_with_donor', 'donor', 'CIFF');
        $sum5 = sumDonor('p_ecd_sa_enroll', 'p_bysch_with_donor', 'donor', 'CIFF');
        $row25 = number_format(($sum3 + $sum4 + $sum5) / 0.83);
        $row26 = number_format(sumDonor('p_pri_enroll', 'p_bysch_with_donor', 'donor', 'CIFF'));
        $sum6 = sumDonor('p_ecd_enroll', 'p_bysch_with_donor', 'donor', 'CIFF');
        $sum7 = sumDonor('p_ecd_sa_enroll', 'p_bysch_with_donor', 'donor', 'CIFF');
        $row27 = number_format($sum6 + $sum7);
        $row28 = number_format(numDonor('s_prog_sch_id', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row29 = number_format(numFlexibleDonor1('s_prog_sch_id', 's_bysch_with_donor', 's1_school_type', 'Public', 'donor', 'CIFF'));
        $row30 = number_format(numFlexibleDonor1('s_prog_sch_id', 's_bysch_with_donor', 's1_school_type', 'Private', 'donor', 'CIFF'));
        $row31 = number_format(numFlexibleDonor1('s_prog_sch_id', 's_bysch_with_donor', 's1_school_type', 'Other', 'donor', 'CIFF'));
        $row32 = number_format(numFlexibleDonor1('s_prog_sch_id', 's_bysch_with_donor', 's1_school_type', 'None', 'donor', 'CIFF'));
        $row33 = percentage((sumDonor('ap_ecd_total', 'a_bysch_with_donor', 'donor', 'CIFF') +
                sumDonor('ap_trt_total', 'a_bysch_with_donor', 'donor', 'CIFF')), sumDonor('ap_total_child', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $sum1 = sumDonor('ap_ecd_total', 'a_bysch_with_donor', 'donor', 'CIFF');
        $sum2 = sumDonor('ap_trt_total', 'a_bysch_with_donor', 'donor', 'CIFF');
        $row34 = number_format($sum1 + $sum2);
        $row35 = number_format(sumEstimatedDonor('p_pri_enroll/0.96', 'Y', 'CIFF'));
        $row36 = number_format(sumEstimatedDonor('p_pri_enroll', 'Y', 'CIFF'));
        $row37 = "** Removed **";
        $row38 = number_format(numDistinctPDonor('district_id', 'Y', 'CIFF'));
        $row39 = number_format(numJoin('ap_attached', 'Yes', 'p_sch_closed', 'No', 'CIFF'));
        $row40 = number_format(numFlexibleDonor12('p_sch_id', 'p_bysch_with_donor', 'p_sch_bilharzia', 'Y', 'p_sch_closed', 'No', 'donor', 'CIFF'));
        $row41 = number_format(numSchoolType('Public', 'CIFF'));
        $row42 = number_format(numSchoolType('Private', 'CIFF'));
        $row43 = number_format(numSchoolType('Other', 'CIFF'));
        $row44 = number_format(numSchoolType('Not specified', 'CIFF'));
        $row45 = number_format(sumPriRegistered('p_pri_enroll', 'p_bysch_with_donor', 'p_sch_bilharzia', 'Y', 'p_sch_closed', 'No', 'CIFF'));
        $row46 = number_format(sumDonor('p_pzq', 'p_bysch_with_donor', 'donor', 'CIFF'));
        $row47 = number_format(sumDonor('a_6_18_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row48 = number_format(sumDonor('a_6_18_m', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row49 = number_format(sumDonor('a_6_18_f', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row50 = number_format(sumDonor('a_6_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row51 = number_format(sumDonor('a_11_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row52 = number_format(sumDonor('a_15_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row53 = number_format(divisionValues(sumDonor('a_6_18_total', 'a_bysch_with_donor', 'donor', 'CIFF'), numDonor('school_id', 'a_bysch_with_donor', 'donor', 'CIFF')), 2, '.', '');
        $row54 = number_format(minimumDonor('a_6_18_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row55 = number_format(maximumDonor('a_6_18_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row56 = number_format(numFlexibleDonor('school_id', 'a_bysch_with_donor', 'a_2_18_total', 'ap_6_18_total', 0, 'donor', 'CIFF'));
        $row57 = number_format(sumDonor('ap_6_18_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row58 = number_format(sumDonor('ap_6_18_m', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row59 = number_format(sumDonor('ap_6_18_f', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row60 = number_format(sumDonor('ap_6_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row61 = number_format(sumDonor('ap_11_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row62 = number_format(sumDonor('ap_15_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row63 = number_format(sumDonor('a_u5_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row64 = number_format(sumDonor('a_u5_m', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row65 = number_format(sumDonor('a_u5_f', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row66 = number_format(sumDonor('a_2_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row67 = number_format(sumDonor('a_ecd_total', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row68 = number_format(numFlexibleDonor1('a_u5_total', 'a_bysch_with_donor', 'a_u5_total', 0, 'donor', 'CIFF'));
        $row69 = percentage(numDonor('school_no', 'attnt_bysch_with_donor', 'donor', 'CIFF'), numflexibleDonor1('p_sch_id', 'p_bysch_with_donor', 'p_sch_closed', 'No', 'donor', 'CIFF'));
        $row70 = number_format(numDonor('school_id', 'attnt_bysch_with_donor', 'donor', 'CIFF'));
        $row71 = number_format(numflexibleDonor1('p_sch_id', 'p_bysch_with_donor', 'p_sch_closed', 'No', 'donor', 'CIFF'));
        $row72 = number_format(numDistinctDonor('attnt_district_name', 'attnt_bysch_with_donor', 'donor', 'CIFF'));
        $row73 = number_format(numDistinctDonor('attnt_division_name', 'attnt_bysch_with_donor', 'donor', 'CIFF'));
        $row74 = number_format(numDistinctDonor('division_id', 'p_bysch_with_donor', 'donor', 'CIFF'));
        $row75 = number_format(numDonor('t1_name', 'attnt_bysch_with_donor', 'donor', 'CIFF') + num('t2_name', 'attnt_bysch_with_donor', 'donor', 'CIFF'));
        $row76 = percentage(numFlexibleDonor1('attnt_id', 'attnt_bysch_with_donor', 'attnt_total_drugs', '1', 'donor', 'CIFF'), numDistinctDonor('p_sch_id', 'p_bysch_with_donor', 'donor', 'CIFF'));
        $row77 = number_format(numFlexibleDonor1('attnt_id', 'attnt_bysch_with_donor', 'attnt_total_drugs', '1', 'donor', 'CIFF'));
        $row78 = number_format(sumDonor('mt_sessions', 'form_mt_with_donor', 'donor', 'CIFF'));
        $row79 = number_format(numDistinctDonor('attnt_id', 'attnt_bysch_with_donor', 'donor', 'CIFF'));
        $row80 = number_format(numDistinctFlexibleDonor('attnt_id', 'attnt_bysch_with_donor', 'attnt_sth', '1', 'donor', 'CIFF'));
        $row81 = number_format(numDistinctFlexibleDonor('attnt_id', 'attnt_bysch_with_donor', 'attnt_schisto', '1', 'donor', 'CIFF'));
        $row82 = number_format(numAttntFlexDonor('attnt_id', 'attnt_alb_tt', '1', 'attnt_pzq_tt', '0', 'attnt_sth', '1', 'donor', 'CIFF'));
        $row83 = number_format(numAttntFlexDonor('attnt_id', 'attnt_alb_tt', '0', 'attnt_pzq_tt', '0', 'attnt_sth', '1', 'donor', 'CIFF'));
        $row84 = number_format(numAttntFlexDonor('attnt_id', 'attnt_alb_tt', '1', 'attnt_pzq_tt', '1', 'attnt_schisto', '1', 'donor', 'CIFF'));
        $row85 = number_format(numAttntFlexDonor('attnt_id', 'attnt_alb_tt', '0', 'attnt_pzq_tt', '1', 'attnt_schisto', '1', 'donor', 'CIFF'));
        $row86 = number_format(numAttntFlexDonor('attnt_id', 'attnt_alb_tt', '1', 'attnt_pzq_tt', '0', 'attnt_schisto', '1', 'donor', 'CIFF'));
        $row87 = number_format(numAttntFlexDonor('attnt_id', 'attnt_alb_tt', '0', 'attnt_pzq_tt', '0', 'attnt_schisto', '1', 'donor', 'CIFF'));
        $row88a = numAttntFlex4Donor('school_id', 'attnt_total_drugs', '1', 'attnt_total_poles', '1', 'attnt_total_forms', '1', 'attnt_sch_treatment', '1', 'donor', 'CIFF');
        $row88b = numAttntFlex3Donor('school_id', 'attnt_total_drugs', '1', 'attnt_total_forms', '1', 'attnt_sch_treatment', '0', 'donor', 'CIFF');
        $row88c = ($row88a) + ($row88b);
        $row88 = percentage($row88c, sumDonor('school_no', 'attnt_bysch_with_donor', 'donor', 'CIFF'));
        $row89 = number_format(numDistinctDonor('attnt_id', 'attnt_bysch_with_donor', 'donor', 'CIFF'));
        $row90 = number_format(numDistinctDonor('school_id', 'attnt_bysch_with_donor', 'donor', 'CIFF'));
        $row91 = number_format($row88c);
        $row92 = number_format(numDistinctFlexibleDonor('school_id', 'attnt_bysch_with_donor', 'attnt_sth', '0', 'donor', 'CIFF'));
        $row93 = number_format(numDistinctFlexibleDonor('school_id', 'attnt_bysch_with_donor', 'attnt_sth', '1', 'donor', 'CIFF'));
        $row94 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '1', 'attnt_total_poles', '0', 'attnt_total_forms', '0', 'attnt_sch_treatment', '0', 'donor', 'CIFF'));
        $row95 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '0', 'attnt_total_poles', '0', 'attnt_total_forms', '1', 'attnt_sch_treatment', '0', 'donor', 'CIFF'));
        $row96 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '1', 'attnt_total_poles', '0', 'attnt_total_forms', '1', 'attnt_sch_treatment', '0', 'donor', 'CIFF'));
        $row97 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '0', 'attnt_total_poles', '0', 'attnt_total_forms', '0', 'attnt_sch_treatment', '0', 'donor', 'CIFF'));
        $row98 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '1', 'attnt_total_poles', '0', 'attnt_total_forms', '0', 'attnt_sch_treatment', '1', 'donor', 'CIFF'));
        $row99 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '0', 'attnt_total_poles', '0', 'attnt_total_forms', '1', 'attnt_sch_treatment', '1', 'donor', 'CIFF'));
        $row100 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '1', 'attnt_total_poles', '0', 'attnt_total_forms', '1', 'attnt_sch_treatment', '1', 'donor', 'CIFF'));
        $row101 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '0', 'attnt_total_poles', '0', 'attnt_total_forms', '0', 'attnt_sch_treatment', '1', 'donor', 'CIFF'));
        $row102 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '1', 'attnt_total_poles', '1', 'attnt_total_forms', '0', 'attnt_sch_treatment', '1', 'donor', 'CIFF'));
        $row103 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '0', 'attnt_total_poles', '1', 'attnt_total_forms', '0', 'attnt_sch_treatment', '1', 'donor', 'CIFF'));
        $row104 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '0', 'attnt_total_poles', '1', 'attnt_total_forms', '1', 'attnt_sch_treatment', '1', 'donor', 'CIFF'));
        $row105 = number_format(numAttntFlex4Donor('school_id', 'attnt_total_drugs', '1', 'attnt_total_poles', '1', 'attnt_total_forms', '1', 'attnt_sch_treatment', '1', 'donor', 'CIFF'));
        $row106a = number_format(numflexibleDonor2('attnt_id', 'attnt_bysch_with_donor', 't1_received_transport', 'Yes', 't2_received_transport', 'CIFF'));
        $row106 = percentage(numDistinctDonor('s_prog_sch_id', 's_bysch_with_donor', 'donor', 'CIFF'), numDistinctDonor('s_prog_sch_id', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row107 = number_format(numFlexibleDonor1('s_prog_sch_id', 's_bysch_with_donor', 's_deworming_day', '', 'donor', 'CIFF'));
        $row108 = number_format(NotEmpty('s_deworming_day', 's_bysch_with_donor', 'CIFF'));
        $row109 = number_format(numDistinctDonor('s_prog_sch_id', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row110 = number_format(numDistinctDonor('s_prog_sch_id', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row111 = reporting_on_school_divisionDonor('CIFF');
        $row112 = reporting_on_school_districtDonor('CIFF');
        $row113 = number_format(numDistinctDonor('s_district_id', 's_bysch_with_donor', 'donor', 'CIFF') + numDistinctDonor('district_id', 'a_bysch_with_donor', 'donor', 'CIFF') + numDistinctDonor('district_id', 'd_bysch_with_donor', 'donor', 'CIFF'));
        $row114 = number_format(numDistinctDonor('s_division_id', 's_bysch_with_donor', 'donor', 'CIFF') + numDistinctDonor('division_id', 'a_bysch_with_donor', 'donor', 'CIFF') + numDistinctDonor('division_id', 'd_bysch_with_donor', 'donor', 'CIFF'));
        $row115 = number_format(sumDonor('s_total_child', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row116 = number_format(sumDonor('a_total_child', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row117 = number_format(sumDonor('d_total_child', 'd_bysch_with_donor', 'donor', 'CIFF'));
        $row118 = number_format(numDistinctDonor('s_prog_sch_id', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row119 = number_format(numDistinctDonor('school_id', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row120 = $placeholder;
        $row121 = number_format(numDistinctDonor('s_prog_sch_id', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row122 = number_format(numDistinctDonor('district_name', 'a_bysch_with_donor', 'donor', 'CIFF'));
        $row123 = number_format(numDistinctDonor('district_name', 'd_bysch_with_donor', 'donor', 'CIFF'));
        $row124 = number_format(sumDonor('s_adult_total', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row125 = number_format(sumDonor('s_adult_total', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row126 = number_format(sumDonor('sp_adult_total', 's_bysch_with_donor', 'donor', 'CIFF'));
        $row127 = number_format(numFlexibleDonor1('attnt_id', 'attnt_bysch_with_donor', 'training_date_dd', '1', 'donor', 'CIFF'));
        $row128 = $placeholder;
        $row129 = $placeholder;

        // Colors, line width and bold font
        // $this->SetFillColor(249, 113, 139);
        $this->SetFillColor(224, 103, 127);
        $this->SetTextColor(0);
        // $this->SetDrawColor(249, 113, 139);
        $this->SetDrawColor(211, 211, 211);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(150, 35, 40, 45);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'L', 1);
        }
        $this->Ln();
        // Color and font restoration
        // $this->SetFillColor(224, 235, 255);
        $this->SetFillColor(247, 217, 223);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;

        $this->SetFont('helvetica', '', 9);



        $this->cell($w[0], 6, "No. of children dewormed for STH once", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row1, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of districts covered for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row2, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of divisions covered for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row3, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row4, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged children dewormed for STH (male)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row5, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged children dewormed for STH (female)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row6, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 6-18) children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row7, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 6-18) children dewormed for STH (male)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row8, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 6-18) children dewormed for STH (female)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row9, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of U5 children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row10, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of U5 children dewormed for STH (male)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row11, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of U5 children dewormed for STH (female)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row12, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of ALB estimated for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row13, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of children dewormed for Schisto once", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row14, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Sub-Counties covered for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row15, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of divisions covered for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row16, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged (including ECD) children dewormed for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row17, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged (including ECD) children dewormed for Schisto (Male)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row18, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged (including ECD) children dewormed for Schisto (Female)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row19, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 6-18) children dewormed for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row20, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 6-18) children dewormed for Schisto (Male)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row21, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 6-18) children dewormed for Schisto (Female)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row22, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Percentage of enrolled children aged 6+ receiving STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row23, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row24, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Estimated target population of STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row25, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "Estimated No. of 'Enrolled Primary School' children for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row26, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Estimated No. of 'Enrolled ECD' children for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row27, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools targeted for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row28, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of public schools for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row29, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of private schools for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row30, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of 'other' schools for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row31, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of 'no school type' schools for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row32, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Percentage enrolled children aged 6+ receiving Schisto Treatment once", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row33, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged (including ECD) children dewormed for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row34, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Estimated target population of Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row35, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "Estimated No. of 'Enrolled Primary School' children for SCHISTO", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row36, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Estimated No. of 'Enrolled ECD' children for SCHISTO", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row37, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of districts planned for SCHISTO", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row38, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools covered for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row39, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools targeted for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row40, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of public schools for SCHISTO", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row41, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of private schools for SCHISTO", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row42, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of 'other' schools for SCHISTO", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row43, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of 'no school type' schools for SCHISTO", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row44, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Enrolled Primary School Aged children registered for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row45, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "Estimated No. of PZQ tablets needed", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row46, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 6-18) children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row47, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 6-18) children dewormed for STH (male)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row48, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 6-18) children dewormed for STH (female)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row49, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 6-10) children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row50, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 11-14) children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row51, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 15-18) children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row52, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Average No of Non-enrolled Children Treated per school (6-18)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row53, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "Minimum No of Non-enrolled Children Treated per school (6-18)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row54, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Maximum No of Non-enrolled Children Treated per school (6-18)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row55, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of Schools that Treated NO Non-Enrolled Children (6-18)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row56, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 6-18) children dewormed for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row57, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 6-18) children dewormed for Schisto (Male)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row58, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 6-18) children dewormed for Schisto (Female)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row59, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 6-10) children dewormed for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row60, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 11-14) children dewormed for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row61, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non Enrolled (age 15-18) children dewormed for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row62, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of U5 children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row63, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of U5 children dewormed for STH (male)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row64, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of U5 children dewormed for STH (female)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row65, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Non-enrolled (age 2-5) children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row66, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of ECD children dewormed for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row67, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of Schools Treating NO Under 5s", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row68, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Percentage No of target schools attending teacher training sessions", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row69, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. target schools attending teacher training sessions", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row70, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools targeted for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row71, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of District attending teacher training", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row72, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of divisions attending teacher training", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row73, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of Divisions Planned", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row74, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of teachers trained", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row75, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "Percentage of TTS where Albendazole (& Praziquantel if necessary) are available on the day of Training", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row76, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of TTs with requiered drugs", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row77, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of TTS Planned", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row78, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No of TTS conducted", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row79, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of TTS conducted for STH Only", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row80, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No of TTS conducted for STH & Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row81, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of TTS (STH Only) where only Alb present", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row82, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No of TTS (STH Only) where no drugs present", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row83, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of TTS (STH & Schisto) where Alb & Prazi present", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row84, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No of TTS (STH & Schisto) where only Alb & Prazi present", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row85, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of TTS (STH & Schisto) where only Alb present", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row86, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No of TTS (STH & Schisto) where no drugs present", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row87, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "Percentage of schools attending teacher trainings receiving all critical materials for deworming day", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row88, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No of TTS conducted", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row89, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools attending teacher training", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row90, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools with critical materials present", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row91, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH Only)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row92, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto)", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row93, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH Only) with Drugs only", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row94, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH Only) with Forms only", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row95, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH Only) with Drugs & Forms", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row96, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;
        $this->cell($w[0], 6, "No. of schools attending teacher training (STH Only) with no critical Materials", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row97, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto) with Drugs only", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row98, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto) with Forms only", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row99, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto) with Drugs & Forms", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row100, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto) with no critical Materials", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row101, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto) with Drugs & Poles", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row102, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto) with Poles only", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row103, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto) with Poles & Forms", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row104, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of schools attending teacher training (STH & Schisto) with Drugs, Poles & Forms", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row105, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. TTs where funds are available", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row106a, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "Percentage of schools performing deworming on designated County deworming day", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row106, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No of schools that did not provide deworming date on Form S", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row107, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of schools that provided deworming date on Form S", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row108, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No of schools that performed Deworming Day on designated County deworming day", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row109, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "Total no of schools on form S", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row110, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "% divisions correctly (+/- 10%) reporting on school level coverage of total children dewormed", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row111, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "% Sub-Counties correctly (+/- 10%) reporting on school-level coverage of total children dewormed", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row112, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Sub-Counties returning form S, A & D in full", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row113, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Divisions returning form S, A & D in full", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row114, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of children dewormed for STH form S", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row115, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of children dewormed for STH form A", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row116, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of children dewormed for STH form D", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row117, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Schools dewormed for STH form S", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row118, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Schools dewormed for STH form A", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row119, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "% Sub-Counties submitting forms S,A,and D to National level within three months of deworming day", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row120, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Schools returning form S", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row121, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Sub-County returning form A", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row122, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Sub-County returning form D", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row123, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No of Adults treated", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row124, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Adult Treated for STH", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row125, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Adult Treated for Schisto", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row126, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Gok personnel at regional training", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row127, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;

        $this->cell($w[0], 6, "No. of Gok Sub-County personnel at Sub-County training", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row128, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = 0;

        $this->cell($w[0], 6, "No. of Gok divisional personnel at Sub-County training", 'LR', 0, 'L', $fill);
        $this->cell($w[1], 6, $row129, 'LR', 0, 'L', $fill);
        $this->Ln();
        $fill = !$fill;









        // }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF CIFF');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 011', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// column titles
$header = array('Indicator', 'Total');

// data loading
$datatext = $pdf->LoadData($path . 'tcpdf/examples/data/table_data_demo.txt');

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------
// close and output PDF document
$pdf->Output('Ciff Report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
