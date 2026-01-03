<?php 

    require_once('Db.php');
    Db::connect('127.0.0.1', 'books', 'root', '');

    if (!isset($_GET['id'])) {
        die('Chybí ID');
    }
    
    $id = (int)$_GET['id'];

    

    $book = Db::queryOne('SELECT * FROM databaze WHERE id = ?', $id);
    if (!$book) {
        die('Kniha nenalezena');
    }
    
    if(isset($_POST['zmenit'])){

        $change = [
            'name' => $_POST['name'],
            'author' => $_POST['author'],
            'genre' => $_POST['genre'],
            'year_of_publication' => $_POST['year'],
            'info' => isset($_POST['available']) ? 1 : 0
        ];

        Db::update('databaze', $change, 'WHERE id = ?', $id );
            
        header("Location: index.php"); 
        exit;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
<form method="POST">

    <input type="text" name="name"
        value="<?= htmlspecialchars($book['name']) ?>" required>

    <input type="text" name="author"
        value="<?= htmlspecialchars($book['author']) ?>" required>

    <select name="genre">
        <option value="Fantasy" <?= $book['genre'] == 'Fantasy' ? 'selected' : '' ?>>Fantasy</option>
        <option value="Dystopian / Science fiction" <?= $book['genre'] == 'Dystopian / Science fiction' ? 'selected' : '' ?>>Dystopian / Science fiction</option>
        <option value="Sci-fi" <?= $book['genre'] == 'Sci-fi' ? 'selected' : '' ?>>Sci-fi</option>
        <option value="Horor" <?= $book['genre'] == 'Horor' ? 'selected' : '' ?>>Horor</option>
    </select>

    <input type="number" name="year" min="1000" max="<?= date('Y') ?>"
        value="<?= $book['year_of_publication'] ?>" pattern="\d{4}" required>

    <label>
        <input type="checkbox" name="available"
            <?= $book['info'] ? 'checked' : '' ?>>
        available
    </label>

    <input type="submit" name="zmenit" value="Změnit">

</form>

</body>
</html>