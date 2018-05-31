<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2013 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2013 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.9, 2013-06-02
 */

date_default_timezone_set('Europe/London');

include "../../includes/auth.php";
include "../../includes/config.php";
require_once("includes/class.batch-export.php");

//instaciate class
$batchExport = new batchExport();

//get districts
$districts = $batchExport->getDistricts();

// get all data
  $form_type=$_GET['batch'];


    $dara=$batchExport->getByFormType($form_type);


if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../../PHPExcel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


$B=2;
            foreach ($dara as $key => $value) {
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1','DISTIRCT NAME')
			->setCellValue('B1','DATE SENT')
			->setCellValue('C1','BATCH')
			->setCellValue('D1','FORM TYPE')
			->setCellValue('E1','N0. SENT')


			->setCellValue('A'.$B,$batchExport->getDistName($value['district_id']))
			->setCellValue('B'.$B,$value['date_sent'])
			->setCellValue('C'.$B,$value['batch'])
			->setCellValue('D'.$B,$value['type_of_form'])
			->setCellValue('E'.$B,$value['num_sent']);



			$B++;
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('BATCH TRACKING');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

ob_clean();

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="BATCH TRACKING FROM"'.$form_type.'".xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
