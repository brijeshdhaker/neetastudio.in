<?php
/**
 *
 */
class JobApplicationExcelWriter extends ExcelWriter {
    
    public function __construct(){

		$this->setupDefaults();
		$this->filename = "Applications";
		$this->sheetname = "Results";
        $this->EXCEL_HEADER = array(
            'A'=>array('name'=>"Candidate Name",   'width'=>25),
            'B'=>array('name'=>"Email Address", 'width'=>35),
            'C'=>array('name'=>"Mobile No", 'width'=>20),
            'D'=>array('name'=>"Apply Date", 'width'=>15),
            'E'=>array('name'=>"Status",  'width'=>15),
            'F'=>array('name'=>"Short List",  'width'=>15),
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
				$sheet->setCellValueByColumnAndRow(0, $row, OnclickUtils::getProperty('fname', $record,''));
				$sheet->setCellValueByColumnAndRow(1, $row, OnclickUtils::getProperty('emailid', $record,''));
				$sheet->setCellValueByColumnAndRow(2, $row, OnclickUtils::getProperty('phone', $record,''));
				$sheet->setCellValueByColumnAndRow(3, $row, OnclickUtils::getProperty('applyDt', $record,''));
				$sheet->setCellValueByColumnAndRow(4, $row, OnclickUtils::getProperty('status', $record,''));
                $sheet->setCellValueByColumnAndRow(5, $row, (OnclickUtils::getProperty('isShortList', $record,'') == 'Y' ? "Yes" : "No" ));
			}
		}
	}
}

?>