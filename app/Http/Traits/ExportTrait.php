<?php
namespace App\Http\Traits;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

trait ExportTrait
{
    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getRow() !== 1 && is_numeric($value) && (substr($value, 0, 1) == 0)) {
            $cell->setValueExplicit(mb_convert_encoding('="' . str_replace('"', '""', preg_replace('/\n/', ' ', preg_replace('/\r\n/', ' ', $value))) . '"', 'UTF-8'), DataType::TYPE_STRING);
        } else {
            $cell->setValueExplicit(mb_convert_encoding($value, 'UTF-8'), DataType::TYPE_STRING);
        }
        return true;
    }
}
