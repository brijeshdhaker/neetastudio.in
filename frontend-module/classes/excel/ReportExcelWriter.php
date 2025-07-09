<?php
/**
 *
 */
class ReportExcelWriter extends ExcelWriter {
    
    public function __construct(){
        $this->setupDefaults();
		$this->filename = "Report";
		$this->sheetname = "data";
        $this->EXCEL_HEADER = array(
            'A'=>array('name'=>"Message",   'width'=>50),
            'B'=>array('name'=>"Action", 'width'=>20),
            'C'=>array('name'=>"Category", 'width'=>20),
            'D'=>array('name'=>"Action User", 'width'=>30),
            'E'=>array('name'=>"Action Time",  'width'=>30),
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
				$row = $this->getRowNumber();
				//
				$sheet->setCellValueByColumnAndRow(0,$row, OnclickUtils::getProperty('message', $record,''));
				$sheet->setCellValueByColumnAndRow(1,$row, OnclickUtils::getProperty('action', $record,''));
				$sheet->setCellValueByColumnAndRow(2,$row, OnclickUtils::getProperty('category', $record,''));
				$sheet->setCellValueByColumnAndRow(3,$row, OnclickUtils::getProperty('addByName',$record,''));
                $sheet->setCellValueByColumnAndRow(4,$row, OnclickUtils::getProperty('addTs',$record,''));
			}
		}
	}
}

?>