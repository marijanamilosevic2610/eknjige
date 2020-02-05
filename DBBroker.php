<?php
class DBBroker
{
    private $konekcija;

    public function __construct()
    {
        $this->konekcija = new Mysqli('localhost','root','','eknjige');
        $this->konekcija->set_charset("utf8");
    }

    public function unesiKnjigu($naziv,$autor,$cena,$zanrID,$naStanju)
    {
        $pStatement = $this->konekcija->prepare("INSERT INTO knjiga VALUES(null,?,?,?,?,?)");
        $pStatement->bind_param("ssiii",$naziv,$autor,$cena,$zanrID,$naStanju);
        return $pStatement->execute();
    }

    public function vratiZanrove()
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM zanr");
        $pStatement->execute();
        $result = $pStatement->get_result();
        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function vratiAktivneKnjige($zanrID, $sort)
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM knjiga k join zanr z on k.zanrID = z.zanrID where k.zanrID = ? and k.naStanju > 0 order by cena ".$sort);
        $pStatement->bind_param("i",$zanrID);
        $pStatement->execute();
        $result = $pStatement->get_result();
        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function findByID($id)
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM knjiga k join zanr z on k.zanrID = z.zanrID where k.knjigaID = ?");
        $pStatement->bind_param("i",$id);
        $pStatement->execute();
        $result = $pStatement->get_result();

        while($rez = $result->fetch_object()){
            return $rez;
        }

        return null;
    }

    public function vratiKnjigePoIdijevima($knjigeIzKorpe)
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM knjiga k join zanr z on k.zanrID = z.zanrID where k.knjigaID IN ( ".$knjigeIzKorpe.")");
        $pStatement->execute();
        $result = $pStatement->get_result();
        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function ulogujAdmina($username, $password)
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM administrator where username = ? AND password = ?");
        $pStatement->bind_param("ss",$username,$password);
        $pStatement->execute();
        $result = $pStatement->get_result();

        while($rez = $result->fetch_object()){
            return $rez;
        }

        return null;
    }
    public function ulogujKupca($username, $password)
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM kupac where emailKupca = ? AND sifraKupca = ?");
        $pStatement->bind_param("ss",$username,$password);
        $pStatement->execute();
        $result = $pStatement->get_result();

        while($rez = $result->fetch_object()){
            return $rez;
        }

        return null;
    }

    public function unesiKupca($ime, $username, $password)
    {
        $pStatement = $this->konekcija->prepare("INSERT INTO kupac VALUES(null,?,?,?)");
        $pStatement->bind_param("sss",$ime,$username,$password);
        return $pStatement->execute();
    }

    public function unosiKupovinu($kupacID, $ukupno, $now, $status)
    {
        $pStatement = $this->konekcija->prepare("INSERT INTO kupovina VALUES(null,?,?,?,?)");
        $pStatement->bind_param("iiss",$kupacID,$ukupno,$now,$status);
        return $pStatement->execute();
    }

    public function vratiKupovinaID()
    {
        return $this->konekcija->insert_id;
    }

    public function unesiStavku($id, $kupovinaID, $kolicina)
    {
        $pStatement = $this->konekcija->prepare("INSERT INTO stavkakupovine VALUES(null,?,?,?)");
        $pStatement->bind_param("iii",$id,$kupovinaID,$kolicina);
        return $pStatement->execute();
    }

    public function smanjiBrojKnjigaNaLageru($id, $kolicina)
    {
        $pStatement = $this->konekcija->prepare("update knjiga set naStanju = naStanju - ". $kolicina . " WHERE knjigaID = ?");
        $pStatement->bind_param("i",$id);
        return $pStatement->execute();
    }

    public function vratiKupovinePoKupcu($kupacID)
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM kupovina k  where k.kupacID = ?");
        $pStatement->bind_param("i",$kupacID);

        $pStatement->execute();
        $result = $pStatement->get_result();
        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function vratiKupovine()
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM kupovina k join kupac kup on k.kupacID = kup.kupacID");

        $pStatement->execute();
        $result = $pStatement->get_result();
        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function vratiStavke($id)
    {
        $pStatement = $this->konekcija->prepare("SELECT * FROM kupovina k join kupac kup on k.kupacID = kup.kupacID join stavkaKupovine sk on k.id = sk.kupovinaID join knjiga kn on sk.knjigaID = kn.knjigaID where k.id =  ".$id);

        $pStatement->execute();
        $result = $pStatement->get_result();
        $niz = [];

        while($rez = $result->fetch_object()){
            $niz[] = $rez;
        }

        return $niz;
    }

    public function unesiZanr($niz)
    {
        $nazivZanra = $niz['nazivZanra'];
        $pStatement = $this->konekcija->prepare("INSERT INTO zanr VALUES (null,?)");
        $pStatement->bind_param("s",$nazivZanra);
        return $pStatement->execute();
    }
}