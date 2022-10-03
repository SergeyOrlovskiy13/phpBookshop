<?php
require("db.php");
$items = $db->query("SELECT * FROM `items`")->fetchAll(PDO :: FETCH_ASSOC);
$array=$db->query("SELECT c.id AS id,  c.name AS category, count(*) AS cnt FROM items AS p 
INNER JOIN category c ON p.category = c.id GROUP BY p.category")->fetchAll(PDO :: FETCH_ASSOC);

if (isset($_GET["category"])){
    $id=$_GET["category"];
    $items = $db->query("SELECT * FROM `items` WHERE category=$id")->fetchAll(2);
}
if(isset($_POST["sort"]))
{
    $sortBy = $_POST["sort"];
    $items = $db->query("SELECT * from items GROUP by $sortBy")->fetchAll(2);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-2.2.3.min.js"></script>
    <title>Books</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <h2>Books shop</h2>

    <main>
        <div class="filtersALl">
            
        <section class="filters">
            <?php foreach($array as $category):?>
            <a href="?category=<?php echo $category["id"];?>">
            <?php echo $category["category"];?>
            <?php echo $category["cnt"];?>
            </a>
            <?php endforeach; ?>
        </section>
        </div>
        <div class="booksAll">
        <section class= "books">
            <h2>All books
            <form method="POST">
    <select name="sort" size="1">
        <option value="name">Name</option>
        <option value="date">Date</option>
        <option value="price">Price</option>
    </select>
    <input type="submit" value="Отправить">
            

            </h2>
            <?php foreach($items as $item):?>
            <div class="item">
            <a href=""><?php echo  " Name: " ; echo $item["name"];?></a>  
            <p><?php echo "Date: " ; echo $item["date"];?></p>
            <p><?php echo "Price: "; echo $item["price"];?></p>
            <p><?php echo "Category: "; echo $item["category"];?></p>
            <a href="buy.php">Buy</a>
            </div>
            <?php endforeach; ?>   
        </section>
        </div>
    </main>
    
</body>
</html>