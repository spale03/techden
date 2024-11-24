<?php
include "database.php";
include "adminchecker.php";


/**
 * Handles import of xml file
 * @param string $filename
 * @return void
 */
function handleImport($filename)
{
    // interpretira xml file koristeci njegovu putanju
    $newXml = simplexml_load_file($filename) or die("Error: Cannot create object");

    // ubacuje globalne promenljive u local scope kako bi imali pristup njima
    extract($GLOBALS);

    // loop preko liste dece
    foreach ($newXml->children() as $node) {

        // uzmemo propertije deteta (node-a) i sacuvamo u promenljivu
        $naziv = $node->naziv;
        $cena = $node->cena;
        $slika = $node->slika;


        // ako neki od propertija bude prazan u xml-u, nastavimo dalje
        if ($naziv == "" || $cena == "" || $slika == "") {
            // header("location: administrator.php?racunar=0");
            continue;
        }

        // spremimo sql statement za ubacivanje parametara sa delimiterom :delim
        $sql = "INSERT IGNORE INTO racunari (naziv, cena, slika) 
        VALUES (:naziv, :cena, :slika)";
        $stmt = $pdo->prepare($sql);

        // povezemo parametre sa delimiterom
        $stmt->bindParam(":naziv", $naziv);
        $stmt->bindParam(":cena", $cena);
        $stmt->bindParam(":slika", $slika);

        // izvrsimo sql insert za svaki element koji je ispunio uslove
        $stmt->execute();

    }
    // vratimo admina nazad na panel i potvrdimo uspesno ubacivanje (auto refresh liste racunara)
    header("location: administrator.php?racunar=1");

}

/**
 * Handles Database query and export of all pcs to an xml document file
 * 
 * root : racunari
 * child : racunar
 * children : naziv, cena, slika, id
 * root > child > children
 * racunari > racunar > [naziv,cena,slika,id]
 * @param PDO $pdo
 * @return void
 */
function handleExport()
{
    /**
     * selektuj sve kompove
     */
    extract($GLOBALS);
    $sql = "SELECT * from racunari";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $racunari = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // napravi dokument
    $domtree = new DOMDocument("1.0", "UTF-8");

    // napravi root node
    $xmlRoot = $domtree->createElement("racunari");
    // appenduj root node na dokument
    $domtree->appendChild($xmlRoot);


    foreach ($racunari as $racunar) {
        // Pretvori array u objekte
        // umesto $array["key"] koristimo
        // object->property
        $racunarObjekt = (object) $racunar;

        // sacuvaj sve vrednosti u promenljive
        $racunar_ID = $racunarObjekt->racunar_ID;
        $naziv = $racunarObjekt->naziv;
        $slika = $racunarObjekt->slika;
        $cena = $racunarObjekt->cena;

        // napravi child node koji ce biti jedan nivo ispod root node-a
        $racunarXML = $domtree->createElement("racunar");

        // napravi child node-ove koji ce biti nivo ispod child node-a
        $idXML = $domtree->createElement("id", $racunar_ID);
        $nazivXML = $domtree->createElement("naziv", $naziv);
        $cenaXML = $domtree->createElement("cena", $cena);
        $slikaXML = $domtree->createElement("slika", $slika);

        // appenduj sve na racunar node
        $racunarXML->appendChild($idXML);
        $racunarXML->appendChild($nazivXML);
        $racunarXML->appendChild($cenaXML);
        $racunarXML->appendChild($slikaXML);

        // appenduj racunar node na root racunari
        $xmlRoot->appendChild($racunarXML);

    }
    $today = date("m_d_y");
    $name = "export_racunara_" . $today . ".xml";
    header("Content-Disposition: attachment;filename=" . $name);
    header("Content-Type: text/xml");
    //ispisali smo Xml kako bi ga pretrazivac sacuvao
    echo $domtree->saveXML();
}


switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        if (isset($_FILES["xml"])) {
            handleImport($_FILES["xml"]["tmp_name"]);
        }
        break;

    case "GET":
        handleExport();
        break;
}
