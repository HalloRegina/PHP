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
            Personen Vorname: <input type="text" name="per_vname" placeholder="XXX"/><br>
            <input type="submit" value="Search" name="search"/>
        </form>
    </body>
</html>
<?php
function search($par) {
    include 'config.php';
    if (isset($_POST['search'])) {
        try {
            $per_vname = $par;
            $query = ("SELECT * FROM person where per_vname Like :per_vname");
            $stmt = $con->prepare($query);
            $stmt->bindValue(':per_vname', $per_vname, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo $row['per_id'] . ' ' . $row['per_vname'] . ' ' . $row['per_nname'] . '<br>';
            }
        } catch (PDOException $ex) {
            echo "Something messed up!"; //Some user friendly message
            write_error_to_log($ex->getMessage()); //This is a function which you can create yourself to write errors to an external log file.
        }
    }
}
//search($_POST['per_vname'] . '%');
//search('%' . $_POST['per_vname']);
