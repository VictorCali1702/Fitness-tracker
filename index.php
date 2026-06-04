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
                    <label>Rodzaj treningu: </labe>
                    <input type="text" name="rodzaj"></br>
                    <label>Liczba ćwiczeń: </label>
                    <input type="number" name="liczba_cwiczen"></br>
                    <label>Godzina treningu: </label>
                    <input type="time" name="czas"></br>
                    <input type="submit" name="Zapisz trening"></br>
                </form>
                
                <h3>Kalkulator BMI</h3>
                <p>Sprawdź czy twoje BMI jest dobre</br>
                Podaj swój wzrost oraz wagę ciała</p></br>
                <form action="index.php" method="post">
                    <label>Wzrost: </label>
                    <input type="number" name="wzrost">CM</br>
                    <label>Waga: </label>
                    <input type="number" name="waga">KG</br>
                    <input type="submit" value="Oblicz"></br>
                </form>
            </div>
            
            <div class="right">
            </div>
        
        </div>
        
    </main>

    
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $rodzaj_treningu = $_POST["rodzaj"];
    $liczba_cwiczen = $_POST["liczba_cwiczen"];
    $czas_treningu = $_POST["czas"];

    echo "<h3>Trening: {$rodzaj_treningu} zawiera {$liczba_cwiczen} ćwiczeń. Trening o: {$czas_treningu}</h3>";

    // Kalkulator BMI
    // Wzrost i waga

    $wzrost = $_POST["wzrost"];
    $waga = $_POST["waga"];

    $converted_wzrost = $wzrost / 100;

    $bmi = $waga / ($converted_wzrost ** 2);
    $bmi_rounded = round($bmi, 1);

    switch (true){
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
            break;
    }

    echo "Twoje BMI wynosi: {$bmi_rounded}</br>";
    echo "Kategoria: {$category}";
    
}

?>