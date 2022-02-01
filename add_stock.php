<!DOCTYPE html>
<!--
Page with add form to add stock to database
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a Stock to Watch</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            //validates form
            $(document).ready(function(){
                $("#saveStock").submit(
                    function(event){
                        if(!$("#stockSymbol").val().length){
                            event.preventDefault();
                            alert("You must enter a stock symbol to be saved.")
                        }
                    }
                );
                
                $("#cancel").click(
                    function(){
                        window.location.replace("index.php");
                    }
                );
            });
        </script>
    </head>
    <body>
        <div class="container mt-3 border rounded p-3">
            <!-- Stock add form -->
            <form action="saveStock.php" id="saveStock" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="stockSymbol" class="form-label">Stock Symbol</label>
                    <input type="text" id="stockSymbol" name="stockSymbol" class="form-control">
                </div>
                <input type="submit" value="Save" class="btn btn-primary">
                <input id="cancel" type="button" value="Cancel" class="btn btn-danger">
            </form>
        </div>
    </body>
</html>
