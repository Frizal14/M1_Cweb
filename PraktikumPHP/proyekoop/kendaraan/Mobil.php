<?php
namespace Kendaraan;

include 'InfoKendaraan.php';
include 'Kendaraan.php';

class Mobil extends Kendaraan {
    use InfoKendaraan;

    public function deskripsi() {
        echo "Mobil ini bermerk $this->merk dan dibuat pada tahun $this->tahun.\n";
    }

    public function getMerk() {
        return $this->merk;
    }

    public function getTahun() {
        return $this->tahun;
    }
}
