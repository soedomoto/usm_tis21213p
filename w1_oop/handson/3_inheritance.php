<?php

class Manusia
{
  public $jumlahMata;
  public $jumlahTangan;
  public $jumlahKaki;
  private $golonganDarah;
  protected $jenisKelamin;

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

class TukangOjek extends Manusia
{
  public $jumlahMotor;

  public function __construct()
  {
    parent::__construct();

    $this->jumlahMotor = 1;
  }
}

$aris = new Manusia();
echo "aris adalah sebuah " . gettype($aris) . " bertipe " . get_class($aris);
echo "<br/><br/>";

$arif = new TukangOjek();
echo "arif adalah sebuah " . gettype($arif) . " bertipe " . get_class($arif);
echo "<br/><br/>";

echo "Jumlah mata arif " . $arif->jumlahMata;
echo "<br/><br/>";
$arif->jumlahMata = 1;
echo "Jumlah mata arif sekarang " . $arif->jumlahMata;
echo "<br/><br/>";
