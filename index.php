<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySQL</title>
</head>
<body>
    <?php
        //definiamo le costanti
        define('DB_SERVERNAME', 'localost:3310');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_NAME', 'db-university');

        // effettuiamo la connessione
        $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // controllo errori connessione
        if($conn && $conn->connect_error){
            echo ('Impossibile accedere: '. $conn->connect_error);
            die();
        }

        echo('Connessione effettuata!');

        // query request
        $sql = 'SELECT * FROM `students` LIMIT 30;';

        // preleviamo il risultato della richiesta
        $result = $conn->query($sql);

        if($result && $result->num_rows > 0){
            // stampiamo le righe una per volta
            while($student = $result->fetch_assoc()) {
                echo '<div> 
                    id:'. '<strong>'.$student['id'].'</strong>'. ' 
                    cognome: '.'<strong>'.$student['surname'].'</strong>'.' 
                    nome: '.'<strong>'.$student['name'].'</strong>'.
                '</div>';
            }
        }elseif($result){
            ?>
            <div>Non ci sono studenti iscritti.</div>
            <?php
        }
        else{
            echo('Errore!');
            die();
        }
        // chiudiamo la connessione
        $conn->close();
    ?>
</body>
</html>