<a href="index.php">Back</a><br>
<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <form method="post">
            Vorname: <input type="text" name="vname" placeholder = "Max"/><br>
            Nachname: <input type="text" name="nname" placeholder = "Musermann"/><br>
            <input type="submit" value="Hinzufügen" name="submit"/>
        </form>
    </body>
</html>
<?php
if (isset($_POST['submit'])) {
    $vname = $_POST['vname'];
    $nname = $_POST['nname'];
    try {
        $query = 'insert into person (per_vname, per_nname) values(?, ?)';
        $stmt = $con->prepare($query);
        $names = array($vname, $nname);
        for ($i = 0; $i < sizeof($names); $i++) {
            $stmt->bindParam($i + 1, $names[$i]);
        }

        $stmt->execute();
        echo '<h3>Die Person ' . $vname . ' ' . $nname . ' wurde gespeichert!</h3>';
    } catch (Exception $ex) {
        
    }
}
