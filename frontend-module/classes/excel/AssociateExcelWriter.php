<?php
/**
 * Description of AssociateExcelWriter
 * @author i100121
 */
class AssociateExcelWriter extends ExcelWriter {

	
    public function __construct(){

		$this->setupDefaults();
		$this->filename = "Associates";
		$this->sheetname = "Associates";
        $this->EXCEL_HEADER = array(
            'A'=>array('name'=>"NAME",   'width'=>25),
            'B'=>array('name'=>"LAST", 'width'=>15),
            'C'=>array('name'=>"EMAIL", 'width'=>20),
            'D'=>array('name'=>"PHONE", 'width'=>20),
            'E'=>array('name'=>"ACTIVE STATUS",  'width'=>15),
            'F'=>array('name'=>"LAST_ACTIVE",  'width'=>15),
            'G'=>array('name'=>"CREATED_DATE",  'width'=>15),
        );
        
		$this->writeReportProperties();
        $this->writeHeaderRows();
        
	}

	function write($data){
		//
		$sheet = $this->getActiveSheet();
        // Writting Data Rows
		if(is_array($data)){
			foreach ($data as $record){
				$col = 0;
				$row = $this->getRowNumber();
				//
				$sheet->setCellValueByColumnAndRow(0,$row,$record['hr_name']);
                $sheet->setCellValueByColumnAndRow(1,$row,$record['hr_lname']);
				$sheet->setCellValueByColumnAndRow(2,$row,$record['hr_emailid']);
                $sheet->setCellValueByColumnAndRow(3,$row,$record['hr_mobile']);
				$sheet->setCellValueByColumnAndRow(4,$row,( $record['isactive'] == 'Y' ? "Yes" : "No" ));
				$sheet->setCellValueByColumnAndRow(5,$row,'');
				$sheet->setCellValueByColumnAndRow(6,$row,'');
			}
		}
	}
}
?>