	
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>The Kwit E Mart</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="scripts/custom.js"></script>
        
    </head>

    <body>
        <!--Shopping Cart-->
        <div id="shoppint-cart">
            <div class="product"> Shopping Cart Products </div>
            <div class="product"> Current Balance: <?php echo $_SESSION['current_balance'] ?></div>
            <!--Filling Table Producto Shopping Cart-->
            <?php
                if (isset($_SESSION["shopping_cart_item"])) 
                {
                    $total_to_pay = 0;
            ?>
            <!--Product Table-->
            <table>
                <tbody>
                    <tr>
                        <th style="text-align:left;"></th>
                        <th style="text-align:left;"><strong>Product Name</strong></th>
                        <th style="text-align:right;"><strong>Quantity</strong></th>
                        <th style="text-align:right;"><strong>Price</strong></th>
                        <th style="text-align:center;"><strong>Action</strong></th>
                    </tr>
                    <?php 
                        foreach($_SESSION['shopping_cart_item'] as $product)
                        { 
                        ?>
                        <tr>
                        
                            <td style="text-align:left; 1px solid;"><div class="image"><img src=<?php echo $product["image_url"]; ?>></div></td>
                            <td style="text-align:left; 1px solid;"><strong><?php echo $product["name"]; ?></strong></td>
				            <td style="text-align:right; 1px solid;"><?php echo $product["quantity"]; ?></td>
				            <td style="text-align:right; 1px solid;"><?php echo "$".$product["price"]; ?></td>
				            <td style="text-align:center; 1px solid;"><a href=<?php echo $this->url('removeProduct', $product['code']); ?> class="removeProduct">Remove Item</a></td>
                        </tr>  
                    <?php 
                            $total_to_pay += ($product["price"] * $product["quantity"]);
                        } 
                    ?>
                        <tr>
                            <td colspan="5" align=right><strong>Total to pay:</strong> <?php echo "$".$total_to_pay; ?></td>
                        </tr>        
                    </tr>      
                </tbody>
            </table>    
            <!--End Product Table-->
            <?php 
                }
            ?>
            <!--End Filling Table Producto Shopping Cart-->

        </div>
        
        <!--Product Catalog-->
        <div id="product-catalag">
            <div class="catalog"> Catalog Products </div>
            <?php 
                if (!empty($products)) 
                { 
                    
                    foreach ($products as $index => $value) 
                    {
            ?>
                        <div class="item">
                            <form action=<?php echo $this->url('addProduct', $products[$index]['code']); ?> method="post">

                                <div><strong><?php echo $products[$index]['product_name']; ?></strong></div>
                                <div class="image"><img src="<?php echo $products[$index]["image_url"]; ?>"></div>
                                <div><strong><?php echo "$".$products[$index]['price']; ?></strong></div>
                                <div>
                                    <input type="text" name="quantity" value="1" size="1" />
                                    <input type="submit" value="Add to cart" class="add" />
                                </div>
                            </form>
                        </div>
            <?php 
                    } 
                }
            ?>
            
        </div>

        <br>
        <br>        
            <div class="payment">
                <select>
                    <option disabled selected value> -- Select payment method -- </option>
                    <option value="pick_up">Pick Up</option>
                    <option value="ups">UPS</option>
                </select>
                <div>
                    <input type="button" value="Pay for Products" class="pay"/>
                </div>
            </div>
        
    
    </body>

</html>