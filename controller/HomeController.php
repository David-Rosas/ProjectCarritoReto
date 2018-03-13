<?php

namespace Controller;

use Core\Helpers;

/**
 * HomeController
 */
class HomeController
{
    use Helpers;

    private $dataSource;

    
    public function __construct()
    {
        $this->dataSource = new \Core\DataSource();
    }

    public function index()
    {
        $products = $this->dataSource->executeQueryListResult("SELECT * FROM Product");
        if(!isset($_SESSION['current_balance']))
        {
            $_SESSION['current_balance'] = 100;
        }

        require_once "views/index.php";
    }

    public function addProduct()
    {
        if (!empty($_POST['quantity'])) 
        {
            $productByCode = $this->dataSource->executeQuerySingleResult("SELECT * FROM Product WHERE code=:code", array('code'=>$_GET['code']));
            $item = array($productByCode['code']=>
                        array(
                            'code' => $productByCode['code'],
                            'name' =>$productByCode['product_name'],
                            'quantity' => $_POST['quantity'],
                            'price' => $productByCode['price'],
                            'image_url'=> $productByCode['image_url']));
        
            if (!empty($_SESSION['shopping_cart_item'])) 
            {
                if (in_array($productByCode['code'], array_keys($_SESSION['shopping_cart_item']))) 
                {
                    foreach ($_SESSION['shopping_cart_item'] as $code => $value) 
                    {
                        if ($productByCode['code'] == $code) 
                        {
                            if (empty($_SESSION['shopping_cart_item'][$code]['quantity'])) 
                            {
                                $_SESSION['shopping_cart_item'][$code]['quantity'] = 0;
                            }

                            $_SESSION['shopping_cart_item'][$code]['quantity'] += $_POST['quantity'];
                        }
                    }
                } 
                else 
                {
                    $_SESSION['shopping_cart_item'] = $_SESSION['shopping_cart_item'] + $item;
                }
            }
            else 
            {
                $_SESSION['shopping_cart_item'] = $item;
            }
        }

        header("Location:index.php");
    }

    public function removeProduct()
    {
        if (!empty($_SESSION['shopping_cart_item'])) 
        {
            foreach ($_SESSION['shopping_cart_item'] as $code => $value) 
            {
                if ($_GET['code'] == $code) 
                {
                    unset($_SESSION['shopping_cart_item'][$code]);
                }

                if (empty($_SESSION['shopping_cart_item'])) 
                {
                    unset($_SESSION['shopping_cart_item']);
                }
            }
        }

        header("Location:index.php");
    }

    public function ratingProduct()
    {

    }
    

    public function pay()
    {
        $total_to_pay = 0;
        
        if (isset($_SESSION['shopping_cart_item']))
        {
            foreach ($_SESSION['shopping_cart_item'] as $product) 
            {
                $total_to_pay += $product['price'] * $product['quantity'];
            }
        }
    
        
        echo \json_encode(array('total_to_pay'=> $total_to_pay, 'current_balance' => $_SESSION['current_balance']));
    }


    public function paid()
    {
        $total_to_pay = $_POST['total_to_pay'];

        if ($_POST['payment_method'] == 'ups'){
            $total_to_pay += 5.0;
        }

        $_SESSION['current_balance'] = $_SESSION['current_balance'] - $total_to_pay;

        unset($_SESSION['shopping_cart_item']);
    }

}
