<?php
//file to delete selected stock
include 'includes/functions.php';
include 'includes/database.php';
include 'includes/stocks.php';
include 'includes/settings.php';

//get stock from $_GET variable
$stkSymbol =getG('stkSymbol');

//declare error variable
$success = 0;

//declare stocks variable instantiate as stocks class then run delete function
if(!empty($stkSymbol)){
    $stock =new stocks($db, apiToken);
    $success = $stock->deleteStock($stkSymbol);
}
    
//redirect back to index page and pass error code
if($success){
    header("Location: index.php?error=o");
} else{
    header("Location: index.php?error=1");
}