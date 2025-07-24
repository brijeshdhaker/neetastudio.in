<?php
/**
 *
 */
class SeekerExcelWriter extends ExcelWriter {
    
    public function __construct(){
        $this->setupDefaults();
		$this->filename = "SavedSeeker";
		$this->sheetname = "SavedSeeker";
        $this->EXCEL_HEADER = array(
            'A'=>array('name'=>"Name",   'width'=>25),
            'B'=>array('name'=>"Email Address", 'width'=>35),
            'C'=>array('name'=>"Moblie", 'width'=>20),
            'D'=>array('name'=>"Skill Set", 'width'=>15),
            'E'=>array('name'=>"Resume Link",  'width'=>50),
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
				$sheet->setCellValueByColumnAndRow(0,$row, OnclickUtils::getProperty('fname', $record,''));
				$sheet->setCellValueByColumnAndRow(1,$row, OnclickUtils::getProperty('emailid', $record,''));
				$sheet->setCellValueByColumnAndRow(2,$row, OnclickUtils::getProperty('phone', $record,''));
				$sheet->setCellValueByColumnAndRow(3,$row, OnclickUtils::getProperty('coreSkills',$record,''));
				$docurl = OnclickEnv::getRepoDomain()."/".OnclickUtils::getProperty('resumelink',$record,'');
				$sheet->setCellValueByColumnAndRow(4,$row,$docurl);
			}
		}
	}
}

?>