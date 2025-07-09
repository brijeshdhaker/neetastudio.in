<?php 
/**
 * Description of ExcelReportWriter
 * @author i100121
 */
abstract class ExcelWriter {

	protected $filename;
	protected $sheetname;
	protected $objPHPExcel;
	protected $EXCEL_HEADER;
    protected static $ROW_NUM = 1;
    
    protected function setupDefaults(){
        
        $this->objPHPExcel = new PHPExcel();
        ini_set('memory_limit', '1024M');
        $cacheMethod   = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array('memoryCacheSize' => '256MB');
        //set php excel settings
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
        
    }
    
	abstract function write($data);

	public function getActiveSheet(){
		$sheet = $this->objPHPExcel->setActiveSheetIndex(0);
		return $sheet;
	}

	public function setSheetName(){
		if($this->sheetname != ''){
			$this->objPHPExcel->getActiveSheet()->setTitle($this->sheetname);
		}
	}

	public function writeReportProperties(){
		$this->objPHPExcel->getProperties()->setCreator("Brijesh K Dhaker")
		->setLastModifiedBy("Brijesh K Dhaker")
		->setTitle($this->sheetname)
		->setSubject($this->sheetname)
		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
		->setKeywords("office 2007 openxml php")
		->setCategory("Test result file");
	}

	public function writeHeaderRows(){
        //if(count($this->EXCEL_HEADER) > 0){
            //
            $sheet = $this->getActiveSheet();
            $sheet->setTitle($this->sheetname);
            $col = 0;
            //$mapping as $x => $x_value
            foreach ($this->EXCEL_HEADER as $colid => $colname){
                $style = $this->getWorkBookStyles('HEADER_CELL');
                $sheet->setCellValueByColumnAndRow($col,1, $colname['name'])->getStyle($colid."1")->applyFromArray($style);
                $sheet->getColumnDimension($colid)->setWidth($colname['width']);
                $col++;
            }
        //}
    }

	public function getWorkBookStyles($style){
		$styles = array(
				'HEADER_CELL'=>array(
                    'font' => array(
                        'bold' => true,
                    ),
                    'fill' => array(
                        'type'=>PHPExcel_Style_Fill::FILL_SOLID,
                        'color'=>array('argb' => 'FFCCFFCC')
                    ),
                    'borders' => array(
                        'bottom'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
                        'right'=>array('style' => PHPExcel_Style_Border::BORDER_THIN)
                    )
				),
				'DATA_CELL'=>array(
                    'borders' => array(
                        'top'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                        'bottom'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                        'left'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                        'right'=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
                    )
				),
				'SAMPLE_CELL'=>array(
                    'font' => array(
                        'bold' => true,
                    ),
                    'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT),
                    'borders' => array(
                        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startcolor' => array(
                            'argb' => 'FFA0A0A0',
                        ),
                        'endcolor' => array(
                            'argb' => 'FFFFFFFF',
                        )
                    ),
				)
		);
		return $styles[$style];
	}

	public function getRowNumber(){
		return ++self::$ROW_NUM;
	}
    
    protected function setupColumnWidth() {
        // Auto size columns for each worksheet
        $objPHPExcel = $this->objPHPExcel;
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));
            $sheet = $objPHPExcel->getActiveSheet();
            $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            foreach ($cellIterator as $cell) {
                $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
            }
            $sheet->calculateColumnWidths();
        }
    }

    public function writeWorkBook($type='XLSX'){


		/* If you're serving to IE 9, then the following may be needed */
		//header('Cache-Control: max-age=1');
		/* If you're serving to IE over SSL, then the following may be needed */
		//header('Expires: Mon, 18 Dec 2014 05:00:00 GMT'); // Date in the past
		/*
		 //header("Expires: 0");
		 header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		 header('Content-Type: application/force-download');

		 //header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		 header("Cache-control: private");
		 header('Cache-Control: max-age=1');

		 //header('Pragma: public'); // HTTP/1.0
		 header('Pragma: private');
		 header("Content-Transfer-Encoding: binary");
		 header('Accept-Ranges: bytes');
		 */
		//
		if($type == 'XLSX'){
			//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			//header('Content-Disposition: attachment;filename="'.$this->filename.'.xlsx"');
			$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
		}else{
			//header('Content-Type: application/vnd.ms-excel');
			//header('Content-Disposition: attachment;filename="'.$this->filename.'.xls"');
			$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
		}

		$objWriter->save('php://output');
	}
}
?>