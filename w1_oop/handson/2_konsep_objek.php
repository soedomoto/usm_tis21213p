<?php

class Manusia
{
  public $jumlahMata;
  public $jumlahTangan;
  public $jumlahKaki;
  private $golonganDarah;
  private $jenisKelamin;

  // Constructor dapat berisi nilai awal (default) ketika suatu object di buat
  public function __construct()
  {
    $this->jumlahMata = 2;
    $this->jumlahTangan = 2;
    $this->jumlahKaki = 2;
    $this->golonganDarah = "A";
    $this->jenisKelamin = "L";
  }

  public function golonganDarah()
  {
    return $this->golonganDarah;
  }

  public function jenisKelamin()
  {
    return $this->jenisKelamin;
  }
}

$andi = new Manusia();

echo $andi->jumlahMata;
echo "<br/><br/>";

echo $andi->golonganDarah;
echo "<br/><br/>";

echo $andi->golonganDarah();
echo "<br/><br/>";
