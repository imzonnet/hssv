<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_ex extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->helper(array("url","text"));    
    }
    
	public function index()
	{
        echo "<meta charset='utf-8'/>";
		$this->load->library("excel");
        $objPHPExcel = PHPExcel_IOFactory::load("upload/nt.xls");
        //var_dump($objPHPExcel->getWorksheetIterator());
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $worksheetTitle     = $worksheet->getTitle();
            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;
            echo "<br>The worksheet ".$worksheetTitle." has ";
            echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
            echo ' and ' . $highestRow . ' row.';
            echo '<br>Data: <table border="1"><tr>';
            for ($row = 1; $row <= $highestRow; ++ $row) {
                echo '<tr>';
                for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getValue();
                    $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                    echo '<td>' . $val.''.$dataType .'</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */