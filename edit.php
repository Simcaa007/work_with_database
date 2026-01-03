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

<style>
    html, body {
        height: 100%;
        margin: 0;
        background: linear-gradient(45deg, #49a09d, #5f2c82);
        font-family: sans-serif;
        font-weight: 100;
        color: #fff;
    }

    /* 1. Zmenšení hlavního kontejneru */
    /* Proč: Nastavíme max-width na 400px místo původních 600px, aby formulář nebyl roztažený. */
    .container {
        max-width: 400px; 
        margin: 60px auto;
        background: rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 300;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center; /* Proč: Zarovná prvky na střed kontejneru */
        gap: 15px;
    }

    /* 2. Omezení šířky inputů */
    /* Proč: Nastavíme pevnou šířku 80 %, aby inputy nevyplňovaly celý kontejner až k okrajům. */
    input[type="text"],
    input[type="number"],
    select {
        width: 40%; 
        padding: 10px;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
        outline: none;
    }

    label {
        font-size: 13px;
        opacity: 0.8;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-group {
        width: 85%;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    input[type="checkbox"] {
        cursor: pointer;
        width: 85%;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* 3. Tlačítko */
    input[type="submit"] {
        width: 30%;
        margin-top: 15px;
        padding: 12px;
        background: #222;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.3s;
    }

    input[type="submit"]:hover {
        background: #444;
    }

    option {
        color: #000;
    }
</style>

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