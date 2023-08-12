<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class KaryawanExport implements FromArray
{
    private $daftarKaryawan;

    public function __construct($daftarKaryawan)
    {
        $this->daftarKaryawan = $daftarKaryawan;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        return $this->daftarKaryawan;
    }
}
