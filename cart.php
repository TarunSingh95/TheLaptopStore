<?php
    include("config/dbconfig.php");

    #FETCHING THE PRODUCT AND QUANTITY AND FORMING THE ARRAY
    if(isset( $_POST['quantity'], $_POST['product_id']) && is_numeric($_POST['quantity']) && is_numeric($_POST['product_id']) ){
        $productid = (int)$_POST['product_id']; 
        $quantity = (int)$_POST['quantity'];

        $stmt = $pdo ->prepare("SELECT * FROM products WHERE id= ?");
        $stmt -> execute([$_POST['product_id']]);
        $product = $stmt -> fetch(PDO::FETCH_ASSOC);
        
        if($product && $quantity > 0){
            //Product exists in DB. We can now create/update the Session variable
            if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
                //Add product id and quantity if there already exist same product
                $_SESSION['cart'][$productid] += $quantity;
            }else{
                //Different kind of product added top cart
                $_SESSION['cart'][$productid] = $quantity;
                }
            }
        else{
            $_SESSION['cart'] = array($productid => $quantity);
        }
        // Prevent resubmission of the form
        header('Location:cart.php');
        exit;   
    }

    #SENDING QUERY AND UPDATING THE SUB-TOTAL
    //Checking the $_SESSION for sub-total
    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $subtotal = 0.00;

    if($products_in_cart){
        //Products in cart and we need to fetch them from db
        $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));

        $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN(' . $array_to_question_marks . ')');
        $stmt -> execute(array_keys($products_in_cart));
        $products = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        // print_r($products);
    
        //Total
        foreach($products as $product){
            $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
        }
    }
    

    #REMOVE THE PRODUCT
    if(isset($_GET['removeid']) && is_numeric($_GET['removeid']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['removeid']])){
        unset($_SESSION['cart'][$_GET['removeid']]);
        header('Location:cart.php');
    }

    #UPDATING THE PRODUCT
    if(isset($_POST['update']) && isset($_SESSION['cart'])){
        //loop through each POST value and update it
        foreach($_POST as $k => $v){
            if(strpos($k, 'quantity')!==false && is_numeric($v)){
                $id = str_replace('quantity-', '', $k);
                $quantity = (int)$v;

                //checks and validation
                if(is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity>0 ){
                    $_SESSION['cart'][$id] = $quantity;
                }
            }
        }
        header('Location:cart.php');
        exit;
    }

    #PLACING ORDER
    if(isset($_POST['place_order']) && isset($_SESSION['cart']) && !empty($_SESSION['cart']) ){
        header('Location:orderPlaced.php');
        unset($_SESSION['cart']);
    }else{
        header('Location:products.php');
    }

?>
<?php include('includes/header.php'); ?>
<?php include('includes/jumbotron.php'); ?>

<h5 class="page-header">Cart Total</h5>
<form action="cart.php" method="POST">
    <div class="container">
        <?php if(empty($products)): ?>
            <h1 class="jumbotron bg-light jumbotron-details">You have no product in Cart</h1>
        <?php else:?>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                    <th scope="col">Total</th>
                    </tr>
                </thead>
            <?php foreach($products as $product): ?>
                <tbody>
                    <tr>
                    <td><a href="product.php?productid=<?=$product['id']?>">
                        <img src="<?=$product['img']?>" alt="<?=$product['pname']?>" width="50" height="40">
                    </a></td>
                    <td>
                        <p>$<?=$product['price']?></p>
                    </td>
                    <td><input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required></td>
                    <td><a href="cart.php?removeid=<?=$product['id']?>">Remove</a></td>
                    <td>$<?php echo $product['price'] * $products_in_cart[$product['id']]; ?></td>
                    </tr>
                    <tr>  
                <?php endforeach ?>
                <tr>
                    <td col colspan="4"></td>
                    <td col colspan="1">Subtotal : $<?=$subtotal?></td>
                    </tr>
                    <tr>
                </tbody>
                </table>
                <div class="buttons">
                    <input type="submit" value="Update" name="update" class="btn btn-sm">             
                    <input type="submit" value="Place Order" name="place_order" class="btn btn-sm">
                </div>                  
                <?php endif ?>
                    
    </div>
</form>

<?php include('includes/footer.php'); ?>