<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Excel {

    private $excel;

    public function __construct() {
        require_once APPPATH . 'third_party/Classes/PHPExcel.php';
        $this->excel = new PHPExcel();
    }

    public function load($path) {
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->excel = $objReader->load($path);
    }

    public function save($path) {
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save($path);
    }

    public function stream($filename, $data = null) { 
	
	
	

        if ($data != null) {
            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(str_replace("_", " ", $key));
				
				$style_header = array(
    
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'E1E0F7'),
    ),
    'font' => array(
        'bold' => true,
		'color' => array('rgb' => '000000'),
		'size' => 20,
		'name'  => 'Verdana'
    ),'borders' => array(
		'allborders' => array(
		  'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	  )
);

				//$this->excel->getActiveSheet()->getStyle('A1:AR1')->getFont()->setBold(true);
				//$this->excel->getActiveSheet()->getStyle('A1:AR1')->getFont()->setName('Arial');
				//$this->excel->getActiveSheet()->getStyle('A1:AR1')->getFont()->setSize(20)->getColor()->setRGB('E1E0F7');
				$this->excel->getActiveSheet()->getStyle('A1:AR1')->applyFromArray( $style_header );
				$this->excel->getActiveSheet()->getStyle('A1:AR1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A1:AR1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				

				$this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
                $this->excel->getActiveSheet()->getCell($col . '1')->setValue($objRichText);
                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $row) { 
                $col = 'A';
                foreach ($row as $cell) { 
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, $cell);
                    $col++;
                }
                $rowNumber++;
            }
        }
		
	
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
        header("Cache-control: private");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
        //header("location: " . base_url() . "export/$filename");
        //unlink(base_url() . "export/$filename");
    }

    public function __call($name, $arguments) {
        if (method_exists($this->excel, $name)) {
            return call_user_func_array(array($this->excel, $name), $arguments);
        }
        return null;
    }
}
