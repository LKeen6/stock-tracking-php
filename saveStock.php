<?php
//Save stock to database
include 'includes/database.php';
include 'includes/functions.php';
include 'includes/stocks.php';
include 'includes/settings.php';

//get the stock symbol from the $_POST variable and convert it to uppercase
$stockSymbol = strtoupper(getP('stockSymbol'));

//declare a stock variable and instantiate is as a stocks class and invoke the save function
$stock = new stocks($db, apiToken);
$success = $stock->saveStock($stockSymbol);
    
//redirect to index and pass either an error code
if($success){
    header("Location: index.php?error=0");
} else{
    header("Location: index.php?error=1");
}