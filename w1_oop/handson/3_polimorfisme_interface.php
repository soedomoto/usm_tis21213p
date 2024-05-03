<?php

interface Orang {
  public function etnis();
  public function selamatPagi();
}

class OrangIndonesia implements Orang {
  public function etnis() {
    return "Indonesia";
  }

  public function selamatPagi() {
    return "Selamat Pagi !";
  }
}

class OrangInggris implements Orang {
  public function etnis() {
    return "Inggris";
  }

  public function selamatPagi() {
    return "Good Morning !";
  }
}

class OrangPerancis implements Orang {
  public function etnis() {
    return "Perancis";
  }

  public function selamatPagi() {
    return "Bonjour !";
  }
}

class OrangJepang implements Orang {
  public function etnis() {
    return "Jepang";
  }

  public function selamatPagi() {
    return "Ohayou gozaimasu !";
  }
}

class OrangKorea implements Orang {
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
