<a href="index.php">Back</a><br>
<?php
function selectPerson() {
    include 'config.php';
    try {
        $statement = $con->query("SELECT * FROM person");
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo $row['per_id'].' '.$row['per_vname'] . ' ' . $row['per_nname'] . '<br>';
            //Printing the elements of the table where field represent column names
        }
    } catch (PDOException $ex) {
        echo "Something messed up!"; //Some user friendly message
        write_error_to_log($ex->getMessage()); //This is a function which you can create yourself to write errors to an external log file.
    }
}
selectPerson();
