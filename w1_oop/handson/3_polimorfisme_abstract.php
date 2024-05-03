<?php

abstract class Orang {
  abstract public function etnis();
  abstract public function selamatPagi();
}

class OrangIndonesia extends Orang {
  public function etnis() {
    return "Indonesia";
  }

  public function selamatPagi() {
    return "Selamat Pagi !";
  }
}

class OrangInggris extends Orang {
  public function etnis() {
    return "Inggris";
  }

  public function selamatPagi() {
    return "Good Morning !";
  }
}

class OrangPerancis extends Orang {
  public function etnis() {
    return "Perancis";
  }

  public function selamatPagi() {
    return "Bonjour !";
  }
}

class OrangJepang extends Orang {
  public function etnis() {
    return "Jepang";
  }

  public function selamatPagi() {
    return "Ohayou gozaimasu !";
  }
}

class OrangKorea extends Orang {
  public function etnis() {
    return "Korea";
  }

  public function selamatPagi() {
    return "Annyeonghaseyo !";
  }
}

$anggotaKelompok = [
  new OrangIndonesia(),
  new OrangInggris(),
  new OrangPerancis(),
  new OrangJepang(),
  new OrangKorea()
];

foreach ($anggotaKelompok as $orang) {
  echo "Orang " . $orang->etnis() . " mengucapkan " . $orang->selamatPagi() . "<br/>";
}