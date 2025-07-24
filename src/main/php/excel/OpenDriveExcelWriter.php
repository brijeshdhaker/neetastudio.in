<?php
/**
 *
 */
class OpenDriveExcelWriter extends ExcelWriter {

	public function __construct(){

		$this->setupDefaults();
		$this->filename = "OpenDrives";
		$this->sheetname = "OpenDrives";
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
				$col = 0;
				$row = $this->getRowNumber();
				//
				$sheet->setCellValueByColumnAndRow(0,$row,$record['i_walkinid']);
				$sheet->setCellValueByColumnAndRow(1,$row,$record['i_title']);
				$sheet->setCellValueByColumnAndRow(2,$row,$record['i_skills']);
				$sheet->setCellValueByColumnAndRow(3,$row,$record['i_startdt']);
				$sheet->setCellValueByColumnAndRow(4,$row,$record['i_enddt']);
			}
		}
	}
}

?>