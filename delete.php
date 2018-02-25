<a href="index.php">Back</a><br>
<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post">
            Personen ID <input type="text" name="per_id" placeholder="XXX"/><br>
            <input type="submit" value="Löschen" name="delete" /><br>
        </form>    
    </body>
</html>
<?php
if (isset($_POST['delete'])){
    $del_id = $_POST['per_id'];    
    try {
        $query = 'DELETE FROM person where per_id = ?;';
        $stmt = $con->prepare($query);
        $names = array($del_id);
        for ($i = 0; $i < sizeof($names); $i++) {
            $stmt->bindParam($i + 1, $names[$i]);
        }

        $stmt->execute();
        echo 'Der Eintrag mit der ID ' . $del_id . ' wurde gelöscht';
    } catch (Exception $ex) {
        
    }

}
