<a href="von.php">Back</a>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post">
            <?php
            include 'config.php';
            $per_id = $_POST['per_id'];
            $user_changed = false;

            if (isset($_POST['update'])) {

                $per_vname = $_POST['per_vname'];
                $per_nname = $_POST['per_nname'];

                $query = ("UPDATE person SET per_vname = :per_vname, per_nname = :per_nname WHERE per_id = :per_id;");
                $stmt = $con->prepare($query);
                $stmt->bindValue(':per_id', $per_id, PDO::PARAM_INT);
                $stmt->bindValue(':per_vname', $per_vname, PDO::PARAM_STR);
                $stmt->bindValue(':per_nname', $per_nname, PDO::PARAM_STR);
                $stmt->execute();
                $user_changed = true;            }
            //------------------------------------------------------------------------------------------------------------

            $query = ("SELECT * FROM person where per_id = :per_id");
            $stmt = $con->prepare($query);
            $stmt->bindValue(':per_id', $per_id, PDO::PARAM_INT);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo 'Personen ID <input type="text" name="per_id" value=' . $per_id . ' readonly/><br>';
                echo 'Personen VN <input type="text" name="per_vname" value=' . $row['per_vname'] . '><br>';
                echo 'Personen NN <input type="text" name="per_nname" value=' . $row['per_nname'] . '><br>';
            }
            echo "<br><br><input type='submit' value='Update' name='update'/>";

            if ($user_changed) {
                echo '<br><br><strong>Der User mit der ID: ' . $per_id . ' wurde auf ' . $per_vname . '  ' . $per_nname . ' geändert</strong>';
            }
            ?> 
        </form>
    </body>
</html>
