<?php
$name = $mbiemri = $email = $message  = '';

if (isset($_REQUEST["submit"])) {
    $name = lexo($_REQUEST["name"]);
    $mbiemri = lexo($_REQUEST["mbiemri"]);
    $email = lexo($_REQUEST["email"]);
    $message = lexo($_REQUEST["message"]);
}
    // Kontrolloni që të dhënat janë të plota
    if (!empty($name) && !empty($mbiemri) && !empty($email) && !empty($message)) {
        $conn = mysqli_connect("localhost", "root", "", "detyrekursi");

        if (!$conn) {
            die("Lidhja me databazën nuk mundi të bëhet: " . mysqli_connect_error());
        }

        // Query për insertimin e të dhënave
        $query = "INSERT INTO kontakt (Emri, Mbiemri, Email, Mesazhi) VALUES ('$name', '$mbiemri', '$email', '$message')";

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
