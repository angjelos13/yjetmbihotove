<?php
$name = $mbiemri = $many = $taskdatetime = '';

if (isset($_REQUEST["submit"])) {
    $name = lexo($_REQUEST["name"]);
    $mbiemri = lexo($_REQUEST["mbiemri"]);
    $many = lexo($_REQUEST["many"]);
    $taskdatetime = lexo($_REQUEST["taskdatetime"]);

}
    // Kontrolloni që të dhënat janë të plota
    if (!empty($name) && !empty($mbiemri) && !empty($many) && !empty($taskdatetime)) {
        $conn = mysqli_connect("localhost", "root", "", "detyrekursi");

        if (!$conn) {
            die("Lidhja me databazën nuk mundi të bëhet: " . mysqli_connect_error());
        }

        // Formatimi i datës në formatin që është i nevojshëm për databazën
        $datetime = date('Y-m-d H:i:s', strtotime($taskdatetime)); 

        // Query për insertimin e të dhënave
        $query = "INSERT INTO rezervim (Emri, Mbiemri, NrPersonave, Data_Ora) VALUES ('$name', '$mbiemri', '$many', '$datetime')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            // Mesazh suksesi
            echo "Rezervimi u krye me sukses!";
        } else {
            // Gabimi në query
            echo "Gabim në insertimin e të dhënave: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Ju lutem plotësoni të gjitha fushat!";
    }

function lexo($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
