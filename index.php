<?php
//main page for stock tracker project 
include 'includes/database.php';
include 'includes/functions.php';
include 'includes/stocks.php';
include 'includes/settings.php';

//get the error code if it has been set

//declare a stocks and instantiate the stocks class

//load the stocks from the data, retrieve the stocks, and pass stocks to graphData variable

?>
<!DOCTYPE html>
<!--
main page for stock tracker project
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stock Tracker Page</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
        <?php
        //iterate through graphData array
        ?>
    </script>

    </head>
    <body>
        <div class="container-fluid">
            <div class="container-fluid m-2 border rounded p-3">
                <h1>Stock Recommendations</h1>
                <div class="mt-2 mb-2"><a href="add_stock.php" class="btn btn-primary" target="_self" title="Add a Stock to Watch">Add a Stock to Watch</a></div>
            <?php
            //display error if it is not equal to zero
            

            //create the html needed to display the graphs and create the delete stocks buttons
            
            ?>
                <!-- Button to go to add stock page -->
                <div class='mt-2 mb-2'><a href="add_stock.php" class="btn btn-primary" target="_self" title="Add a Stock to Watch">Add a Stock to Watch</a></div>
            </div>
        </div>
    </body>
</html>
