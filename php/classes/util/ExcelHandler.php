<?php

class ExcelHandler {
    
    public static function createExcelFile(){
        $ExcelFile=new PHPExcel();
        $ExcelFile->removeSheetByIndex(0);
        return $ExcelFile;
    }
    
    public static function loadExcelFile($FileName){
        $ExcelFile = PHPExcel_IOFactory::load($FileName);
        return $ExcelFile;
    }
    
    public static function saveExcelFile($ExcelFile, $FileName, $Version="Excel2007"){
        $ExcelFile->setActiveSheetIndex(0);
        $Writer = PHPExcel_IOFactory::createWriter($ExcelFile, $Version);
        $Writer->save($FileName);
    }
    
    public static function getSheet(PHPExcel $ExcelFile, $SheetName){
        $Sheet=$ExcelFile->getSheetByName($SheetName);
        if($Sheet===NULL){
            $Sheet=new PHPExcel_Worksheet();
            $Sheet->setTitle($SheetName);
            $ExcelFile->addSheet($Sheet);
        }
        return $Sheet;
    }
    
    public static function rowsToSheet(PHPExcel $ExcelFile, $SheetName, $Rows, $StartRow=NULL, $StartColumn=NULL){
        if($StartRow==NULL) $StartRow=1;
        if($StartColumn==NULL) $StartColumn=0;
        $Sheet=self::getSheet($ExcelFile, $SheetName);
        $DB=DB::getInstance();
        $Columns=$DB->getColumns($Rows);
        $DB->Close();
        $ColumnIndex=$StartColumn;
        $RowIndex=$StartRow; 
        foreach($Columns as $Column){
            $Value=$Sheet->getCellByColumnAndRow($ColumnIndex, $RowIndex)->getValue();
            if($Value===NULL){
                $Sheet->setCellValueByColumnAndRow($ColumnIndex, $RowIndex, $Column);
            }
            $Sheet->getColumnDimensionByColumn($ColumnIndex)->setAutoSize(true);
            $ColumnIndex++;
        }
        
        $RowIndex=$StartRow+1;
        foreach($Rows as $Row){
            $ColumnIndex=$StartColumn;
            foreach($Row as $Column){
                $Sheet->setCellValueByColumnAndRow($ColumnIndex, $RowIndex, $Column);
                $Sheet->setCellValueByColumnAndRow($ColumnIndex, $RowIndex, $Column);
                $ColumnIndex++;
            }
            $RowIndex++;
        } 
    }
    
    public static function writeCell(PHPExcel_Worksheet $Sheet, $RowIndex, $ColumnIndex, $Value, $BackColor=NULL, $ForeColor=NULL){
        $Sheet->setCellValueByColumnAndRow($ColumnIndex, $RowIndex, $Value);
        
        if($ForeColor!=NULL){
            $Sheet->getCellByColumnAndRow($ColumnIndex, $RowIndex)->getStyle()->getFont()->getColor()->setRGB($ForeColor);
        }
        if($BackColor!=NULL){
            $Sheet->getCellByColumnAndRow($ColumnIndex, $RowIndex)->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $Sheet->getCellByColumnAndRow($ColumnIndex, $RowIndex)->getStyle()->getFill()->getStartColor()->setRGB($BackColor);
        }
    }
}

