<?php
class myReadFilter implements PHPExcel_Reader_IReadFilter
{
    private $_startRow = 0;

    /**  Set the list of rows that we want to read  */
    public function getRow($startRow) {
        $this->_startRow    = $startRow;
    }

    public function readCell($column, $row, $worksheetName = '') {
        //  Only read the heading row, and the rows that are configured in $this->_startRow and $this->_endRow
        if (($row == 1 || $row == $this->_startRow)) {
            return true;
        }
        return false;
    }
}
?>