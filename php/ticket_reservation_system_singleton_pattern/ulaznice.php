<?php

// ulaznice.php

class Ulaznice
{
    private static $instance;

    private $rezervacijeArray = array();
    private $file_csv = "rezervacije.csv";

    function __construct()
    {
        $this->prepareCsv();
        $this->readCsv();
    }

    private function prepareCsv()
    {
        if(!file_exists($this->file_csv))
        {
            $fp = fopen($this->file_csv, "w+");
            fwrite($fp, "Datum;BrUlaznice;Ime;Prezime\n");
            fclose($fp);
        }
    }

    private function readCsv()
    {
        $this->rezervacijeArray = array();

        $file_array = file($this->file_csv);

        if(is_array($file_array))
        {
            foreach($file_array as $line_num => $line)
            {
                if($line_num > 0)
                {
                    $line = trim($line, "\n");
                    $line = trim($line, "\r");

                    $this->rezervacijeArray[] = explode(";", $line);
                }
            }
        }
    }

    function Rezerviraj($data = array())
    {
        $fp = fopen($this->file_csv, "a");

        $line = implode(";", $data);

        fwrite($fp, $line . "\n");

        fclose($fp);

        return true;
    }

    function getHtmlTable()
    {
        $this->readCsv();

        $html = '';

        $html .= '
        <table border="1">
            <thead>
                <tr>
                    <th>Rbr.</th>
                    <th>Datum</th>
                    <th>Br. ulaznice</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                </tr>
            </thead>
            <tbody>';

            $rbr = 1;

            foreach($this->rezervacijeArray as $key => $rezervacija)
            {
                $html .= '
                <tr>
                    <td>'.$rbr.'.</td>
                    <td>'.$rezervacija[0].'</td>
                    <td>'.$rezervacija[1].'</td>
                    <td>'.$rezervacija[2].'</td>
                    <td>'.$rezervacija[3].'</td>
                </tr>';

                $rbr++;
            }

            $html .= '
            </tbody>
        </table>';

        return $html;
    }

    function isFree($br_ulaznice)
    {
        $this->readCsv();

        foreach($this->rezervacijeArray as $key => $rezervacija)
        {
            if($rezervacija[1] == $br_ulaznice)
            {
                return false;
            }
        }

        return true;
    }

    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance = new self;
        }
        
        return self::$instance;
    }
}

//-------------------------------------------

if(isset($_POST["btn_save"]))
{
    $br_ulaz = $_POST["br_ulaznica"];
    $ime     = $_POST["ime"];
    $prezime = $_POST["prez"];

    //$ulaznice = new Ulaznice();
    $ulaznice = Ulaznice::getInstance();

    $data = array();
    $data["datum"]   = date("Y-m-d");
    $data["br_ulaz"] = $br_ulaz;
    $data["ime"]     = $ime;
    $data["prezime"] = $prezime;

    if($ulaznice->isFree($br_ulaz))
    {
        if($ulaznice->Rezerviraj($data))
        {
            echo 'Podaci uspjesno spremljeni!';
        }
    }
    else
    {
        echo 'Error: Ulaznica je iskorištena';
    }
}


// HTML Formular
echo '
<form method="POST" action="">

    Broj ulaznice:<br />
    <input type="text" name="br_ulaznica" value="" /><br />

    Ime:<br />
    <input type="text" name="ime" value="" /><br />

    Prezime:<br />
    <input type="text" name="prez" value="" /><br />

    <br />
    <input type="submit" name="btn_save" value="Spremi" />

</form>';

// HTML Tablicu za prikaz podataka iz CSV datoteke
$ulaznice = Ulaznice::getInstance();

$html_tbl = $ulaznice->getHtmlTable();

echo $html_tbl;

?>