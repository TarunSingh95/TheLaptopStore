<?php 
    include ('config/dbconfig.php');

    $stmt =$pdo->prepare("SELECT * FROM products ORDER BY date_added DESC LIMIT 4");
    $stmt -> execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // mysqli_free_result($result);
    // mysqli_close($conn);

?>
<?php include('includes/header.php'); 
      include('includes/jumbotron.php');
?>
        <h5 class="page-header">Recently Added Products</h5>
        <div class="container">
            <div class="row">
            <?php foreach($products as $product): ?>
                <div class="bg-light col-sml-12 col-lg-4 my-col">
                    <a href="#">
                        <img src="<?=$product['img']?>" alt="<?php $product['pname']?>" width="200" height="150">
                        <h6><?=$product['pname']?></h6>
                        <?php if($product['rprice'] > 0):?>
                            <span class='marked'><em>$<?=$product['rprice']?></em></span>
                        <?php endif ?>
                        <span>$<?=$product['price']?></span>
                    </a><br>
                    <a class="btn btn-sm" href="product.php?productid=<?=$product['id']?>">Details</a>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        

<?php include('includes/footer.php') ?>