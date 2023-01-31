<?php
/**
 * Use an HTML form to create a new entry in the
 * movies table
 */

 $sql = "";
if (isset($_POST['submit']) && validateNames($_POST['name'], 30)
    && validateNames($_POST['genre'], 30) 
    && validateRating($_POST['rating'])) {
    require "config.php";
    try {
    $connection = new PDO($dsn, $username, $password, $options); 
    $new_movie = array(
        "name" => $_POST['name'],
        "genre" => $_POST['genre'],
        "rating" => $_POST['rating']

    );

    $sql = sprintf(
        "INSERT INTO %s (%s, date) VALUES (%s, NOW());",
        "movies",
        implode(", ", array_keys($new_movie)),
        "'" . implode("', '", array_values($new_movie)) . "'"
    );
    $statement = $connection->prepare($sql);
    $statement->execute();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
 }

 function validateNames($name, $maxlen) {
     if(strlen($name) > $maxlen) {
         echo "$name is longer than allowed. Max allowed length is $maxlen";
        return false;
     } else {
         return true;
     }
 }
 function validateRating($rating) {
    if (!is_numeric($rating)) {
        echo "Rating should be a number between 1 and 10";
        return false;
    }
    $rating = intval($rating);
    if ($rating >= 1 && $rating <= 10) {
        return true;
    } else {
        echo "Rating should be in between 1 and 10";
        return false;
    }
}

?>

<?php include "header.php"; ?>
<h2>Add movie</h2>

<form method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" required><br><br>
    <label for="genre">Genre</label>
    <input type="text" name="genre" id="genre" required><br><br>
    <label for="Rating">Rating</label>
    <input type="number" name="rating" id="rating"><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="../index.php">Back</a><br>
<?php include "footer.php"; ?>