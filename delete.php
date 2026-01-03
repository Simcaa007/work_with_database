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

    if (isset($_POST['potvrdit_smazani'])) {
        Db::query('DELETE FROM databaze WHERE id = ?', $id);
        
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smazat knihu</title>
    <style>
        /* Používáme tvůj styl */
        html, body {
            height: 100%;
            margin: 0;
            background: linear-gradient(45deg, #49a09d, #5f2c82);
            font-family: sans-serif;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 450px;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            text-align: center;
        }

        h2 { font-weight: 300; margin-bottom: 10px; }
        p { opacity: 0.8; margin-bottom: 30px; line-height: 1.6; }

        .book-info {
            background: rgba(0,0,0,0.2);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        /* Styl pro potvrzovací tlačítko */
        .btn-delete {
            background: #ff4d4d; /* Červená barva pro varování */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        .btn-delete:hover { background: #cc0000; }

        /* Styl pro tlačítko zpět */
        .btn-back {
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 15px;
            transition: 0.3s;
        }

        .btn-back:hover { background: rgba(255,255,255,0.3); }
    </style>
</head>
<body>

<div class="container">
    <h2>Opravdu chcete tuto položku smazat?</h2>
    
    <div class="book-info">
        <?= htmlspecialchars($book['name']) ?> <br>
        <span style="font-weight: 100; font-size: 0.9em;"><?= htmlspecialchars($book['author']) ?></span>
    </div>

    <form method="POST">
        <div class="buttons">
            <a href="index.php" class="btn-back">Zrušit</a>
            
            <button type="submit" name="potvrdit_smazani" class="btn-delete">Ano, smazat</button>
        </div>
    </form>
</div>

</body>
</html>