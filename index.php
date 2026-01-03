<?php
require_once('Db.php');
Db::connect('127.0.0.1', 'books', 'root', '');

$books = Db::queryAll('SELECT * FROM databaze');


if(isset($_GET['submit'])){

    if ($_GET["genre"] ?? "0"){
        function filterByGenre($var) {
            return $var['genre'] == $_GET['genre'];
        }
        
        $books = array_filter($books, "filterByGenre");
    }
}

if(isset($_POST["vytvorit"])) {

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>databaze ukol</title>
</head>

<style>
html, body {
	height: 100%;
	margin: 0;
	background: linear-gradient(45deg, #49a09d, #5f2c82);
	font-family: sans-serif;
	font-weight: 100;
}

.container {
	width: 600px;
    margin: 40px auto;
}

table {
	width: 100%;
	border-collapse: collapse;
	box-shadow: 0 0 20px rgba(0,0,0,0.3);
	border-radius: 10px;
	overflow: hidden;
}

th, td {
	padding: 15px;
	background: rgba(255,255,255,0.15);
	color: #fff;
	height: 80px;
}

th {
	background: rgba(0,0,0,0.25);
	text-align: left;
}

tbody tr:hover {
	background: rgba(255,255,255,0.25);
}

form {
	margin-top: 20px;
}

select, input[type="submit"] {
	padding: 10px 15px;
	border-radius: 5px;
	border: none;
	font-size: 15px;
	cursor: pointer;
}

select {
	background: rgba(255,255,255,0.3);
	color: #fff;

	option{
		color: black;
	}
}

input[type="submit"] {
	background: #222;
	color: #fff;
}

input[type="submit"]:hover {
	background: #444;
}

svg {
	width: 20px;
	fill: white;
	cursor: pointer;
}
</style>


<body>
<div class="container">
	<table>
		<thead>
			<tr>
				<th>name</th>
				<th>author</th>
				<th>genre</th>
				<th>year</th>
				<th>available</th>
				<th>edit</th>
				<th>delete</th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($books as $book): ?>
			<tr>
                    <td><?= $book['name']?></td>
                    <td><?= $book['author']?></td>
                    <td><?= $book['genre']?></td>
                    <td><?= $book['year_of_publication']?></td>
                    <td><?= $book['info'] ? 'Yes' : 'No' ?></td>
					<td><a href="edit.php?id=<?= $book['id'] ?>" title="Upravit"><svg width="20px" height="40px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M6 -3.49691e-07L14 8L6 16L4 16L4 -4.37114e-07L6 -3.49691e-07Z" fill="#000000"/>
					</svg></a></td>
					<td><a href="delete.php?id=<?= $book['id'] ?>" title="Smazat"><svg width="80px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M14 10V17M10 10V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg></a></td>

			</tr>
            <?php endforeach; ?>
		</tbody>
	</table>


    <form method="GET">
        <select name="genre">
                <option value="0">Choose</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Dystopian / Science fiction">Dystopian / Science fiction</option>
                <option value="Sci-fi">Sci-fi</option>
                <option value="Horor">Horor</option>
        </select>
        <input type="submit" name="submit" value="sumbit">
    </form>

	<form method="POST" action="create.php">
		<input type="submit" value="vytvroit" name="vytvorit">
	</form>
</div>



</body>
</html>