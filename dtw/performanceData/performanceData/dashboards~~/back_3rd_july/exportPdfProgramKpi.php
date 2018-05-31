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

$data="N/a";
include 'tcpdf/tcpdf.php';
require_once ('includes/config.php');
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
		foreach($lines as $line) {
			$data[] = explode(';', chop($line));
		}
		return $data;
	}

	 //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'evidence-action.png';
        $this->Image($image_file, 15, 5, 28, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        // Title
        $this->Cell(110, 15, 'PROGRAM KPI REPORT', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

	// Colored table
	public function ColoredTable($header,$datatext) {
		$data ="NA";

		$row1=number_format(numDistinctPlain('district_id','a_bysch'));
		$row2=number_format(numDistinctPlain('division_id','a_bysch'));
		$row3=number_format(num('school_id','a_bysch'));
		$row4=number_format(num('p_sch_id','p_bysch'));
		$row5=number_format(numFlexible('s_prog_sch_id','s_bysch','s1_school_type','Public'));
		$row6=number_format(numFlexible('s_prog_sch_id','s_bysch','s1_school_type','Private'));
		$row7=number_format(numFlexible('s_prog_sch_id','s_bysch','s1_school_type','Other'));
		$row8=number_format(numFlexible('s_prog_sch_id','s_bysch','s1_school_type','None'));
		$row9=number_format(EstimatedTotalSTH());
		$row10=number_format(sumPlain('p_pri_enroll','p_bysch'));
		$row11=number_format(sumPlain('p_ecd_enroll','p_bysch'));
		$row12=number_format(sumPlain('p_ecd_sa_enroll','p_bysch'));
		$row13=number_format(sumPlain('p_alb','p_bysch'));
		$row14=number_format(sumSTH());
		$row15=number_format(sumUnder5());
		$row16=number_format(sumPlain('a_treated_b','a_bysch'));
		$row17=number_format(sumNonEnrolled6andover('STH'));
		$row18=number_format(sumNonEnrolledGender('a_6','a_bysch'));
		$row19=number_format(sumNonEnrolledGender('a_11','a_bysch'));
		$row20=number_format(sumNonEnrolledGender('a_15','a_bysch'));
		$row21=number_format(sumNonEnrolledGender('a_2','a_bysch'));
		$row22=number_format(sumArgs('a_bysch','a_ecd_m','a_ecd_f'));
		$row23=number_format(numDistinct('district_id','a_bysch','Yes'));
		$row24=number_format(numDistinct('school_id','a_bysch','Yes'));
		$row25=number_format(numSchoolTypeS('Public','Yes'));
		$row26=number_format(numSchoolTypeS('Private','Yes'));
		$row27=number_format(numSchoolTypeS('Other','Yes'));
		$row28=number_format(numSchoolTypeS('Not specified','Yes'));
		$row29=number_format(numDistinctP('district_id','Y'));
		$row30=number_format(numDistinctP('p_sch_id','Y'));
		$row31=number_format(EstimatedTotalSHISTO());
		$row32=number_format(sumEstimated('p_pri_enroll','Y'));
		$row33=number_format(sumEstimated('p_ecd_enroll','Y'));
		$row34=number_format(sumEstimated('p_ecd_sa_enroll','Y'));
		$row35=number_format(sumSHISTO());
		$row36=number_format(sumMaleFormAP());
		$row37=number_format(sumFemaleFormAP());
		$row38=number_format(sumArgs('a_bysch','ap_trt_m','ap_trt_f','ap_ecd_f','ap_ecd_m'));
		$row39=number_format(sumArgs('a_bysch','ap_ecd_f','ap_ecd_m'));
		$row40=number_format(sumNonEnrolled6andover('SHISTO'));
		$row41=number_format(sumNonEnrolledGender('ap_6','a_bysch'));
		$row42=number_format(sumNonEnrolledGender('ap_11','a_bysch'));
		$row43=number_format(sumNonEnrolledGender('ap_15','a_bysch'));
		$row44=number_format(attntWithCriticalMaterials());
		$row45=number_format(attntNoCriticalMaterials());
		$row46=number_format(numFlexible('school_id','attnt_bysch','attnt_total_poles','1'));
		$row47=number_format(numFlexible('school_id','attnt_bysch','attnt_total_drugs','1'));
		$row48=$data;
		$row49=$data;
		$row50=$data;
		$row51=$data;
		$row52=$data;
		$row53=$data;
		$row54=$data;
		$row55=$data;
		$row56=$data;
		$row57=$data;
		$row58=$data;
		
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
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
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
		
		$this->cell($w[0],6,'No. of districts covered for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row1,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of divisions covered for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row2,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of schools treated for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row3,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of schools targeted for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row4,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of public schools for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row5,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of private schools for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row6,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of other schools for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row7,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of no school type schools for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row8,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'Estimated target population of STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row9,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'Estimated No. of Enrolled Primary School children for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6,  $row10,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'Estimated No. of Enrolled ECD children for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6,  $row11,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'Estimated No. of Stand-alone ECD children for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6,  $row12,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of ALB estimated for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6,  $row13,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of  children dewormed for STH once','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row14,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of U5 children dewormed for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row15,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of Enrolled Primary School Aged children dewormed for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row16,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of Non-enrolled (age 6-18) children dewormed for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row17,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of Non-enrolled (age 6-10) children dewormed for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row18,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of Non-enrolled (age 11-14) children dewormed for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row19,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of Non-enrolled (age 15-18) children dewormed for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row20,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of Non Enrolled (age 2-5) children dewormed for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row21,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of ECD children dewormed for STH','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row22,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of districts covered for Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row23,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of schools covered for Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row24,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of public schools for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row25,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of private schools for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row26,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of other schools for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row27,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of no school type schools for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row28,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of districts planned for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row29,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of schools planned (baseline) for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row30,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'Estimated target population of Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row31,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'Estimated No. of Enrolled Primary School children for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row32,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'Estimated No. of Enrolled ECD children for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row33,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'Estimated No. of Stand-alone ECD children for SCHISTO','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row34,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of children dewormed for Schisto once','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row35,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of children dewormed for Schisto (Male)','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row36,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of children dewormed for Schisto (Female)','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row37,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of Enrolled Primary School Aged (including ECD) children dewormed for Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row38,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of ECD children dewormed for Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row39,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of Non Enrolled (age 6-18) children dewormed for Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row40,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of Non Enrolled (age 6-10) children dewormed for Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row41,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of Non Enrolled (age 11-14) children dewormed for Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row42,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of Non Enrolled (age 15-18) children dewormed for Schisto','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row43,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of schools with critical materials present','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row44,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of schools with no critical materials present','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row45,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of schools with poles','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row46,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of TTs with requiered drugs','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row47,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. TTs where funds are available','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row48,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of Gok district personnel at regional training','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row49,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of Gok divisional personnel at regional training','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row50,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of tablets picked by DMHO - ALB','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row51,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of tablets picked by DMHO - PZQ','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row52,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of district returning form ATTNR','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row53,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of district returning form ATTNT','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row54,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of district returning form S','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row55,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of district returning form A','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row56,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;

		$this->cell($w[0],6,'No. of district returning form D','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row57,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill=!$fill;

		$this->cell($w[0],6,'No. of district returning form Tabs','LR', 0, 'L', $fill);
		$this->cell($w[1],6, $row58,'LR', 0, 'L', $fill);
		$this->Ln();
		$fill = 0;





			



		// }
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 011');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
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
$datatext = $pdf->LoadData('tcpdf/examples/data/table_data_demo.txt');

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('PROGRAM_KPI_REPORT.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
