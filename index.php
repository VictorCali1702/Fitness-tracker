<?php

session_start();

$wynik_treningu = "";
$wynik_bmi = "";

if (isset($_POST["Zapisz"])){
    $rodzaj_treningu = $_POST["rodzaj"];
    $liczba_cwiczen = $_POST["liczba_cwiczen"];
    $czas_treningu = $_POST["czas"];

    $wynik_treningu = "Trening: {$rodzaj_treningu} zawiera {$liczba_cwiczen} ćwiczeń. Trening o: {$czas_treningu}";

    if (!isset($_SESSION["treningi"])){
        $_SESSION["treningi"] = [];
    }

    $_SESSION["treningi"][] = $wynik_treningu;
    
}
    
// Kalkulator BMI
// Wzrost i waga

if (isset($_POST["bmi"])){

    $wzrost = $_POST["wzrost"];
    $waga = $_POST["waga"];

    if($wzrost > 0 && $waga > 0){
        $converted_wzrost = $wzrost / 100;

        $bmi = $waga / ($converted_wzrost ** 2);
        $bmi_rounded = round($bmi, 1);
        $wynik_bmi = "BMI: {$bmi_rounded}";

        switch(true) {
            case ($bmi_rounded < 18.5):
                $category = "Niedowaga";
                break;
            case ($bmi_rounded <= 24.9):
                $category = "Normalna waga";
                break;
            case ($bmi_rounded <= 29.9):
                $category = "Nadwaga";
                break;
            default:
                $category = "Otyłość";
        }
        
        $wynik_bmi = "Twoje BMI wynosi: {$bmi_rounded}<br>Kategoria: {$category}";
    }

}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Fitness Tracker</h1>
    </header>

    <main>
        <div class="container">
            
            <div class="left">        
                <h2>Witaj!</h2>
                <p>Śledź swoje treningi i postępy.</p>
                <form action=index.php method="post">
                    <label>Rodzaj treningu: </label>
                    <input type="text" name="rodzaj"></br>
                    <label>Liczba ćwiczeń: </label>
                    <input type="number" name="liczba_cwiczen"></br>
                    <label>Godzina treningu: </label>
                    <input type="time" name="czas"></br>
                    <input type="submit" name="Zapisz" value="Zapisz trening"></br>
                </form>
                <div class="result">
                    <?php echo $wynik_treningu; ?>
                </div>
                <h3>Kalkulator BMI</h3>
                <p>Sprawdź czy twoje BMI jest dobre</br>
                Podaj swój wzrost oraz wagę ciała</p></br>
                <form action="index.php" method="post">
                    <label>Wzrost: </label>
                    <input type="number" name="wzrost">CM</br>
                    <label>Waga: </label>
                    <input type="number" name="waga">KG</br>
                    <input type="submit" name="bmi" value="Oblicz"></br>
                </form>
                <div class="result">
                    <?php echo $wynik_bmi; ?>
                </div>
            </div>
            
            <div class="right">
                <div class="treningi">
                    <h2>Ostatnie treningi</h2>
                    <?php 
                    if (isset($_SESSION["treningi"])){
                        echo "<p>Liczba treningów: " . count($_SESSION["treningi"]) . "</p>";
                        
                        foreach($_SESSION["treningi"] as $trening){
                            echo "<p>$trening</p>";
                        }
                    }
                    ?>

                </div>
            </div>
        
        </div>
        
    </main>

    
</body>
</html>

