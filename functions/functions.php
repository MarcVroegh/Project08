<?php

class Functions extends dbh {
    
    ///gebruiker
    public function SelectUserHash($Gebruikersnaam) {
        $STH = $this->connect()->prepare("SELECT * FROM gebruikers WHERE Gebruikersnaam = ?");
        $STH->execute([$Gebruikersnaam]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectFromGebruiker($Gebruikersnaam) {
        $STH = $this->connect()->prepare("SELECT * FROM gebruikers WHERE Gebruikersnaam = ?");
        $STH->execute([$Gebruikersnaam]);
        $count = $STH->rowCount();
        return $count;
    }
    public function UpdateGebruiker($naam, $achternaam, $functie, $rol, $gebruikersnaam, $wachtwoord, $gebruikersnaam2) {
        $STH = $this->connect()->prepare("UPDATE gebruikers SET Naam = ?, Achternaam = ?, Functie = ?, rol_id = ?, Gebruikersnaam = ?, Wachtwoord = ? WHERE Gebruikersnaam = ?");
        $STH->execute([$naam, $achternaam, $functie, $rol, $gebruikersnaam, $wachtwoord, $gebruikersnaam2]);
        $count = $STH->rowCount();
        return $count;
    }
    public function UpdateGebruiker2($wachtwoord, $gebruikersnaam2) {
        $STH = $this->connect()->prepare("UPDATE gebruikers SET Wachtwoord = ? WHERE Gebruikersnaam = ?");
        $STH->execute([$wachtwoord, $gebruikersnaam2]);
        $count = $STH->rowCount();
        return $count;
    }
    public function InsertIntoGebruiker($naam, $achternaam, $functie, $rol, $gebruikersnaam, $wachtwoord) {
        $STH = $this->connect()->prepare("INSERT INTO gebruikers (Naam, Achternaam, Functie, rol_id, Gebruikersnaam, Wachtwoord) VALUES (?, ?, ?, ?, ?, ?)");
        $STH->execute([$naam, $achternaam, $functie, $rol, $gebruikersnaam, $wachtwoord]);
        $count = $STH->rowCount();
        return $count;
    }
    public function InsertIntoLoginLog($Naam, $Achternaam, $Gebruikersnaam) {
        $STH = $this->connect()->prepare("INSERT INTO Loginlog (Naam, Achternaam, Gebruikersnaam) VALUES (?, ?, ?)");
        $STH->execute([$Naam, $Achternaam, $Gebruikersnaam]);
        $count7 = $STH->rowCount();
        return $count7;
    }

    public function SelectFromLoginLog($gebruikersnaam) {
        $STH = $this->connect()->prepare("SELECT * FROM Loginlog WHERE Gebruikersnaam = ? ORDER BY thistime DESC LIMIT 1");
        $STH->execute([$gebruikersnaam]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }

    public function DeleteFromLoginLog($gebruikersnaam) {
        $STH = $this->connect()->prepare("DELETE FROM Loginlog WHERE Gebruikersnaam = ?");
        $STH->execute([$gebruikersnaam]);
        $count7 = $STH->rowCount();
        return $count7;
    }




    ///koppelen
    public function insertIntoKoppelen($bsn, $username) {
        $STH = $this->connect()->prepare("INSERT INTO koppelen (BSN, Gebruikersnaam) VALUES (?, ?)");
        $STH->execute([$bsn, $username]);
        $count = $STH->rowCount();
        return $count;
    }
    public function SelectFromKoppelen($bsn, $username) {
        $STH = $this->connect()->prepare("SELECT * FROM koppelen WHERE BSN = ? AND Gebruikersnaam = ?");
        $STH->execute([$bsn, $username]);
        $count = $STH->rowCount();
        return $count;
    }
    public function DeleteFromKoppelen($bsn, $username) {
        $STH = $this->connect()->prepare("DELETE FROM koppelen WHERE BSN = ? AND Gebruikersnaam = ?");
        $STH->execute([$bsn, $username]);
        $count = $STH->rowCount();
        return $count;
    }





    ///gedetineerde
    public function CheckIfExistGedetineerde($BSNn) {
        $STH = $this->connect()->prepare("SELECT * FROM gedetineerdepg WHERE BSNnummer = ?");
        $STH->execute(array($BSNn));
        $count = $STH->rowCount();
        return $count;
    }
    public function InsertIntoGedetineerdePG($Naam, $Achternaam, $Huisadres, $Woonplaats, $Zaaknummer, $BSNnummer, $Celnummer, $Datum, $Datumbewaring, $Redenhechtenis, $Aantekeningen, $Verslag, $Pasfoto, $Bewijs, $Getuigen) {
        $STH = $this->connect()->prepare("INSERT INTO gedetineerdepg (Naam, Achternaam, Huisadres, Woonplaats, Zaaknummer, BSNnummer, Celnummer, Datumarrestatie, 
        Datumuitbewaring, Redenhechtenis, Aantekeningengedrag, VerslagMW, Pasfoto, Bewijsmateriaal, Getuigenverklaring) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $STH->execute(array($Naam, $Achternaam, $Huisadres, $Woonplaats, $Zaaknummer, $BSNnummer, $Celnummer, $Datum, $Datumbewaring, $Redenhechtenis, $Aantekeningen, $Verslag, $Pasfoto, $Bewijs, $Getuigen));
        $count2 = $STH->rowCount();
        return $count2;
    }
    public function UpdateIntoGedetineerdePG($Naam, $Achternaam, $Huisadres, $Woonplaats, $Zaaknummer, $BSNnummer, $Celnummer, $Datum, $Datumbewaring, $Redenhechtenis, $Aantekeningen, $Verslag, $Pasfoto, $Bewijs, $Getuigen) {
        $STH = $this->connect()->prepare("UPDATE gedetineerdepg SET Naam = ?, Achternaam = ?, Huisadres = ?, Woonplaats = ?, Zaaknummer = ?, BSNnummer = ?, Celnummer = ?, Datumarrestatie = ?, 
        Datumuitbewaring = ?, Redenhechtenis = ?, Aantekeningengedrag = ?, VerslagMW = ?, Pasfoto = ?, Bewijsmateriaal = ?, Getuigenverklaring = ?");
        $STH->execute(array($Naam, $Achternaam, $Huisadres, $Woonplaats, $Zaaknummer, $BSNnummer, $Celnummer, $Datum, $Datumbewaring, $Redenhechtenis, $Aantekeningen, $Verslag, $Pasfoto, $Bewijs, $Getuigen));
        $count2 = $STH->rowCount();
        return $count2;
    }
    public function SelectFromGedetineerdePG($BSN) {
        $STH = $this->connect()->prepare("SELECT * FROM gedetineerdepg WHERE BSNnummer = ?");
        $STH->execute([$BSN]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectGedetineerdePG() {
        $STH = $this->connect()->prepare("SELECT BSNnummer FROM gedetineerdepg");
        $STH->execute();
        $result = $STH->fetchAll(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectFromGedetineerdeCel($BSN) {
        $STH = $this->connect()->prepare("SELECT * FROM gedetineerdecel WHERE BSN = ?");
        $STH->execute([$BSN]);
        $result = $STH->fetchAll(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function DeleteFromGedetineerdePG($BSN) {
        $STH = $this->connect()->prepare("DELETE FROM gedetineerdepg WHERE BSNnummer = ?");
        $STH->execute([$BSN]);
        $count2 = $STH->rowCount();
        return $count2;
    }
    public function InsertIntoGedetineerdeCel($bsn, $oudecel, $nieuwecel, $datum) {
        $STH = $this->connect()->prepare("INSERT INTO gedetineerdecel (BSN, Oudecel, Nieuwecel, Datum) VALUES (?, ?, ?, ?)");
        $STH->execute(array($bsn, $oudecel, $nieuwecel, $datum));
        $count3 = $STH->rowCount();
        return $count3;
    }
    public function UpdateCelGedetineerdePG($celnummer, $bsn) {
        $STH = $this->connect()->prepare("UPDATE gedetineerdepg SET Celnummer = ? WHERE BSNnummer = ?");
        $STH->execute(array($celnummer, $bsn));
        $count3 = $STH->rowCount();
        return $count3;
    }




    ///bezoeker
    public function InsertIntoBezoekerPG($naam, $Achternaam, $Huisadres, $Woonplaats, $BSN) {
        $STH = $this->connect()->prepare("INSERT INTO bezoekerpg (Naam, Achternaam, Huisadres, Woonplaats, BSNnummer) VALUES (?, ?, ?, ?, ?)");
        $STH->execute([$naam, $Achternaam, $Huisadres, $Woonplaats, $BSN]);
        $count6 = $STH->rowCount();
        return $count6;
    }
    public function InsertIntoBezoekerGebouw($bsn, $datum, $tijdin, $tijduit, $wiebezocht) {
        $STH = $this->connect()->prepare("INSERT INTO bezoekergebouw (BSN, Datum, Tijdin, Tijduit, Wiebezocht) VALUES (?, ?, ?, ?, ?)");
        $STH->execute([$bsn, $datum, $tijdin, $tijduit, $wiebezocht]);
        $count7 = $STH->rowCount();
        return $count7;
    }
    public function CheckIfExistBezoekerPG($bsn) {
        $STH = $this->connect()->prepare("SELECT * FROM bezoekerpg WHERE BSNnummer = ?");
        $STH->execute([$bsn]);
        $count4 = $STH->rowCount();
        return $count4;
    }
    public function SelectFromBezoekerGebouw($bsn) {
        $STH = $this->connect()->prepare("SELECT * FROM bezoekergebouw WHERE Wiebezocht = ?");
        $STH->execute([$bsn]);
        $result = $STH->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function SelectFromBezoekerGebouw2($bsn) {
        $STH = $this->connect()->prepare("SELECT * FROM bezoekergebouw WHERE Wiebezocht = ?");
        $STH->execute([$bsn]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function SelectFromBezoekerPG($bsn) {
        $STH = $this->connect()->prepare("SELECT * FROM bezoekerpg WHERE BSNnummer = ?");
        $STH->execute([$bsn]);
        $result = $STH->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }




    ///website
    public function SelectFromTextWebsite($titel) {
        $STH = $this->connect()->prepare("SELECT * FROM TextWebsite WHERE id = ?");
        $STH->execute([$titel]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function InsertIntoTextWebsite($id, $text) {
        $STH = $this->connect()->prepare("SELECT * FROM TextWebsite WHERE id = ?");
        $STH->execute([$titel]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function DeleteFromTextWebsite($id, $text) {
        $STH = $this->connect()->prepare("DELETE FROM TextWebsite WHERE id = ?");
        $STH->execute([$titel]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }




    ///functies
    public function SelectFromFuncties($functie) {
        $STH = $this->connect()->prepare("SELECT * FROM functies WHERE Functie = ?");
        $STH->execute([$functie]);
        $count3 = $STH->rowCount();
        return $count3;
    }
    public function SelectFromFuncties2($rol) {
        $STH = $this->connect()->prepare("SELECT * FROM functies WHERE rol_id = ?");
        $STH->execute([$rol]);
        $count3 = $STH->rowCount();
        return $count3;
    }
    public function CheckFuncties($rol) {
        $STH = $this->connect()->prepare("SELECT Functie FROM functies WHERE rol_id = ?");
        $STH->execute([$rol]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function CheckFuncties2($functie) {
        $STH = $this->connect()->prepare("SELECT rol_id FROM functies WHERE Functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function InsertIntoFuncties($functie, $rol_id) {
        $STH = $this->connect()->prepare("INSERT INTO functies (Functie, rol_id) VALUES (?, ?)");
        $STH->execute([$functie, $rol_id]);
        $count7 = $STH->rowCount();
        return $count7;
    }
    public function SelectFromGebruikers($email) {
        $STH = $this->connect()->prepare("SELECT * FROM PasswordGebruikers WHERE email = ?");
        $STH->execute([$email]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function SelectFromGebruikersNoArgument() {
        $STH = $this->connect()->prepare("SELECT * FROM PasswordGebruikers");
        $STH->execute();
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function SelectFromGebruikers2($username) {
        $STH = $this->connect()->prepare("SELECT * FROM PasswordGebruikers WHERE Gebruikersnaam = ?");
        $STH->execute([$username]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function SelectFromGebruikers3($username) {
        $STH = $this->connect()->prepare("SELECT verificationhash FROM PasswordGebruikers WHERE Gebruikersnaam = ?");
        $STH->execute([$username]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function CheckPasswordGebruikers($email) {
        $STH = $this->connect()->prepare("SELECT * FROM PasswordGebruikers WHERE email = ?");
        $STH->execute([$email]);
        $count7 = $STH->rowCount();
        return $count7;
    }
    public function CheckPasswordGebruikers2($hash) {
        $STH = $this->connect()->prepare("SELECT * FROM PasswordGebruikers WHERE Gebruikersnaam = ? LIMIT 1");
        $STH->execute([$hash]);
        $count7 = $STH->rowCount();
        return $count7;
    }
    public function UpdateIntoPasswordGebruikers($een, $twee) {
        $STH = $this->connect()->prepare("UPDATE PasswordGebruikers SET verificationhash = ? WHERE email = ?");
        $STH->execute([$een, $twee]);
        $count7 = $STH->rowCount();
        return $count7;
    }




    ///rechten
    public function InsertIntoRechten($gebruikersgroep) {
        $STH = $this->connect()->prepare("INSERT INTO rechten (functie) VALUES (?)");
        $STH->execute([$gebruikersgroep]);
        $count7 = $STH->rowCount();
        return $count7;
    }
    public function UpdateIntoRechten($gebruikersgroep) {
        $STH = $this->connect()->prepare("INSERT INTO rechten (functie) VALUES (?)");
        $STH->execute([$gebruikersgroep]);
        $count7 = $STH->rowCount();   
        return $count7;
    }
    public function UpdateIntoRechten2($actie, $actieb, $infog, $instellingen, $change, $make, $assign, $celbezetting, $functie) {
        $STH = $this->connect()->prepare("UPDATE rechten SET actiegedetineerde = ?, actiebezoekers = ?, infogedetineerde = ?, instellingen = ?, aanpassen = ?, aanmaken = ?, rechtentoewijzen = ?, celbezetting = ? WHERE functie = ?");
        $STH->execute([$actie, $actieb, $infog, $instellingen, $change, $make, $assign, $celbezetting, $functie]);
        $count7 = $STH->rowCount();   
        return $count7;
    }
    public function DropDownRechten() {
        $STH = $this->connect()->prepare("SELECT Functie FROM functies");
        $STH->execute();
        $result = $STH->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function SelectRechten($functie) {
        $STH = $this->connect()->prepare("SELECT actiegedetineerde FROM rechten WHERE functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }

    public function SelectRechten2($functie) {
        $STH = $this->connect()->prepare("SELECT actiebezoekers FROM rechten WHERE functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectRechten3($functie) {
        $STH = $this->connect()->prepare("SELECT infogedetineerde FROM rechten WHERE functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectRechten4($functie) {
        $STH = $this->connect()->prepare("SELECT instellingen FROM rechten WHERE functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectRechten5($functie) {
        $STH = $this->connect()->prepare("SELECT aanpassen FROM rechten WHERE functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectRechten6($functie) {
        $STH = $this->connect()->prepare("SELECT aanmaken FROM rechten WHERE functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectRechten7($functie) {
        $STH = $this->connect()->prepare("SELECT rechtentoewijzen FROM rechten WHERE functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function SelectRechten8($functie) {
        $STH = $this->connect()->prepare("SELECT celbezetting FROM rechten WHERE functie = ?");
        $STH->execute([$functie]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }




    /// random pass generator
    public function createRandomPassword() { 

        $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $pass = '' ; 
    
        while ($i <= 50) { 
            $num = rand() % 33; 
            $tmp = substr($chars, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
        } 
    
        return $pass; 
    }


    ///image


    public function InsertIntoImageGedetineede($image, $omschrijving, $bsn) {
        $STH = $this->connect()->prepare("INSERT INTO imagesGedetineerde (id, imageg, created, omschrijving, bsn) VALUES (NULL, ?, current_timestamp(), ?, ?);");
        $STH->execute([$image, $omschrijving, $bsn]);
        $count7 = $STH->rowCount();   
        return $count7;
    }

    public function RetrieveFromImageGedetineede($bsn) {
        $STH = $this->connect()->prepare("SELECT imageg FROM imagesGedetineerde WHERE bsn = ? LIMIT 1");
        $STH->execute([$bsn]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }


    ///functions

    public function InsertIntoBewijsMateriaal($image, $bsn) {
        $STH = $this->connect()->prepare("INSERT INTO bewijsmateriaal (imageh, bsn) VALUES (?, ?)");
        $STH->execute([$image, $bsn]);
        $result = $STH->fetch(PDO::FETCH_ASSOC);;
        return $result;
    }
    public function CountBewijsMateriaal($bsn) {
        $STH = $this->connect()->prepare("SELECT * FROM bewijsmateriaal WHERE bsn = ?");
        $STH->execute([$bsn]);
        $count7 = $STH->rowCount();   
        return $count7;
    }
    public function SelectFromBewijsMateriaal($bsn) {
        $STH = $this->connect()->prepare("SELECT imageh FROM bewijsmateriaal WHERE bsn = ?");
        $STH->execute([$bsn]);
        $result = $STH->fetchAll(PDO::FETCH_ASSOC);;
        return $result;
    }


    ///celbezetting

    public function SelectCelFromGedetineerdePG() {
        $STH = $this->connect()->prepare("SELECT Celnummer FROM gedetineerdepg");
        $STH->execute();
        $result = $STH->fetchAll(PDO::FETCH_ASSOC);;
        return $result;
    }


}
?>
