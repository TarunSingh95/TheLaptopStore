<?php
    include("config/dbconfig.php");

    if(isset($_GET['productid']) && !empty($_GET['productid'])){

        $stmt = $pdo ->prepare("SELECT * FROM products WHERE id=?");
        $stmt -> execute([$_GET['productid']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$product){
            $status = "Product Does not Exist";
        }

        // mysqli_free_result($result);
        // mysqli_close($conn);

    }
?>
<?php include("includes/header.php"); ?>

    <div class="container">
        <?php if($product): ?>
            <div class="row">    
                    <div class="col-sm-12">
                        <img src="<?=$product['img']?>" alt="<?=$product['pname']?>" width="500" height="350">
                    </div>
                    <div class="col-sm-12">
                        <h1><?=$product['pname']?></h1>
                        <p><strong><?=$product['pdescription']?></strong></p>
                        <?php if($product['rprice']>0):?>
                            <p class="details_para">Before: <span class="marked">$<?=$product['rprice']?></span></p>
                        <?php else:?>
                            <p class="details_para">Before: <span class="marked">$<?=$product['price']?></span></p>
                        <?php endif?>
                        <p>Now: $<?=$product['price']?></p>
                        <form action="cart.php" method="POST">
                            <label>Quantity: </label>
                            <input type="number" name="quantity" value='1' min='1' max='<?=$product['quantity']?>' placeholder='quantity' required>
                            <!-- <select name="quantity" >
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select> -->
                            <input type="hidden" name="product_id" value="<?=$product['id']?>">
                            <br>
                            <input class="btn btn-sm" type="submit" name="submit" value="Add to cart">
                        </form>
                    </div>
        <?php else: ?>
                    <?php header('Location: index.php') ?>
        <?php endif ?>   
    </div>
    </div>

<?php include("includes/footer.php"); ?>
