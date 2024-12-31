<?php
namespace Kendaraan;

abstract class Kendaraan {
    protected $merk;
    protected $tahun;

    public function __construct($merk, $tahun) {
        $this->merk = $merk;
        $this->tahun = $tahun;
    }

    abstract public function deskripsi();
}
