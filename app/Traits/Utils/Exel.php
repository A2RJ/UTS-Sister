<?php

namespace App\Traits\Utils;

use Rap2hpoutre\FastExcel\FastExcel;

trait Exel
{
    static public function import($data, $exportOrDownload, $fileName)
    {
        (new FastExcel($data))->$exportOrDownload($fileName);
        return "Berhasil $exportOrDownload file $fileName";
    }
}
