<?php include "header.php"; ?>
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";
/**
 * Function to display all the movies
 */
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT id, name, genre, rating, date FROM movies";
$result = $conn->query($sql);
// Add your SQL query here
try {
    require "config.php";
    $connection = new PDO($dsn, $username, $password, $options);

    // Execute the SQL query and store the result in $result
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<h2>Highest Rated Movies</h2>
<form method="post">
    <label for="rating">Rating</label>
    <input type="text" id="rating" name="rating">
    <br><br><input type="submit" name="submit" value="Submit">
</form>
<a href="../index.php">Back</a><br>
<?php
    if ($result && $statement->rowCount() > 0) { ?>
        <table id="movies">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">#</th>
                    <th onclick="sortTable(1)">Name</th>
                    <th onclick="sortTable(2)">Genre</th>
                    <th onclick="sortTable(3)">Rating</th>
                    <th onclick="sortTable(6)">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["genre"]; ?></td>
                    <td><?php echo $row["rating"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <script>
            function sortTable




        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount=0;
            table = document.getElementById("movies");
            switching = true;
            dir = "asc";

            while(switching) {
                switching = false;
                rows = table.rows;
                
                for(i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[n];
                    y = rows[i + 1].getElementsByTagName("td")[n];
                    if(dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount ++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
    <?php } else { ?>
        <p>No movies yet, be the first one to add a movie!</p>
    <?php }

?>
<?php include "footer.php"; ?>
