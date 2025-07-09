<?php
/**
 *
 */
class OpenJobExcelWriter extends ExcelWriter {
    
    public function __construct(){
        $this->setupDefaults();
        $this->filename = "OpenJobs";
		$this->sheetname = "OpenJobs";
        $this->EXCEL_HEADER = array(
            'A'=>array('name'=>"POST ID",   'width'=>15),
            'B'=>array('name'=>"JOB TITLE", 'width'=>35),
            'C'=>array('name'=>"SKILL SET", 'width'=>50),
            'D'=>array('name'=>"OPEN_DATE", 'width'=>15),
            'E'=>array('name'=>"END_DATE",  'width'=>15),
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
				$sheet->setCellValueByColumnAndRow(0,$row,OnclickUtils::getProperty('postid', $record,''));
				$sheet->setCellValueByColumnAndRow(1,$row,OnclickUtils::getProperty('title', $record,''));
				$sheet->setCellValueByColumnAndRow(2,$row,OnclickUtils::getProperty('skills', $record,''));
				$sheet->setCellValueByColumnAndRow(3,$row,OnclickUtils::getProperty('openDate', $record,''));
				$sheet->setCellValueByColumnAndRow(4,$row,OnclickUtils::getProperty('endDate', $record,''));
			}
		}
        
    }
}

?>