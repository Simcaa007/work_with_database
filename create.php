<?php 

    require_once('Db.php');
    Db::connect('127.0.0.1', 'books', 'root', '');

    $books = Db::queryAll('SELECT * FROM databaze');


    if(isset($_POST["vyt"])){

        $available = isset($_POST['available']) ? 1 : 0;

        if (!empty($_POST['name']) && !empty($_POST['author']) && $_POST['genre'] !== "0") {

            Db::insert("databaze", [
                "name" => $_POST['name'],
                "author" => $_POST['author'],
                "genre" => $_POST['genre'],
                "year_of_publication" => $_POST['year'],
                "info" => $available
            ]);

            header("Location: /databaze/index.php");
            die();

            
        } else {
            echo "Prosím vyplňte všechna pole správně.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<style>
html, body {
    height: 100%;
    margin: 0;
    background: linear-gradient(45deg, #49a09d, #5f2c82);
    font-family: Arial, sans-serif;
    color: #fff;
}

/* VYSTŘEDĚNÍ NA STŘED STRÁNKY */
body {
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 420px;
    background: rgba(255,255,255,0.15);
    box-shadow: 0 0 25px rgba(0,0,0,0.35);
    border-radius: 12px;
    padding: 30px 35px;
}

/* NADPIS */
h1 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 300;
}

/* FORMULÁŘ */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* INPUTY */
input[type="text"],
select {
    padding: 12px;
    border-radius: 6px;
    border: none;
    font-size: 14px;
    background: rgba(255,255,255,0.25);
    color: #fff;
    outline: none;
}

input::placeholder {
    color: rgba(255,255,255,0.75);
}

select option {
    color: #000;
}

/* CHECKBOX */
.checkbox {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
}

/* BUTTON */
input[type="submit"] {
    margin-top: 10px;
    width: 90px;
    padding: 12px;
    border-radius: 6px;
    border: none;
    background: #222;
    color: #fff;
    cursor: pointer;
    font-size: 15px;
    transition: background 0.3s;
}

input[type="submit"]:hover {
    background: #444;
}
</style>



<form method="POST">

    <input type="text" name="name" placeholder="name">
    <input type="text" name="author" placeholder="author">
    <select name="genre">
                <option value="0">Choose</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Dystopian / Science fiction">Dystopian / Science fiction</option>
                <option value="Sci-fi">Sci-fi</option>
                <option value="Horor">Horor</option>
        </select>
    <input type="text" name="year" pattern="\d{4}" placeholder="YYYY" title="Zadejte rok ve formátu YYYY">
    <label><input type="checkbox" name="available" >available</lable>
    <input type="submit" value="vytvorit" name="vyt">

</form>
    
</body>
</html>