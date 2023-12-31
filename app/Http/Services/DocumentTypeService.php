<?php

namespace App\Http\Services;

class DocumentTypeService
{
    public static $mimeTypes = array(
        'word' => array(
            'application/msword', // Word 97-2003 Document
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // Word Document
        ),
        'pdf' => array(
            'application/pdf', // Portable Document Format (PDF)
        ),
        'excel' => array(
            'application/vnd.ms-excel', // Excel 97-2003 Workbook
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // Excel Workbook
        ),
        'powerpoint' => array(
            'application/vnd.ms-powerpoint', // PowerPoint 97-2003 Presentation
            'application/vnd.openxmlformats-officedocument.presentationml.presentation', // PowerPoint Presentation
        ),
    );

    public static function checkIfPdf($document_type):bool{
       return in_array($document_type,self::$mimeTypes["pdf"]);
    }

    public static function isWord($document_type):bool{
        return in_array($document_type,self::$mimeTypes["word"]);
    }

    public static function isExcel($document_type):bool{
        return in_array($document_type,self::$mimeTypes["excel"]);
    }

    public static function isPowerPoint($document_type):bool{
        return in_array($document_type,self::$mimeTypes["powerpoint"]);
    }

}
