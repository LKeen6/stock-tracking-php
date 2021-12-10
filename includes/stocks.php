<?php
/**
 * Class to handle stocks
 *
 * @author jasonc
 */
class stocks {
    private $db;
    private $stocks;
    private $symbols;
    private $apiToken;
    
    //Class contructor function
    function __construct($DB_con, $apiToken) {
        $this->db = $DB_con;
        $this->apiToken = $apiToken;
    }
    
    //Class function to save stock symbol to database
    public function saveStock($symbol){
        try{
            $stmt = $this->db->prepare("INSERT INTO stocks(stock_symbol) VALUES (:stock_symbol)");

            $stmt->bindparam(":stock_symbol", $symbol);

            $stmt->execute();
            $stmt->closeCursor();
            
            if($stmt->rowCount() != 0){
                return 1;
            }else{
                return 0;
            }
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    //Class function to load all stocks from database
    public function loadAllStocks(){
        try{
            $stmt = $this->db->prepare("SELECT * FROM stocks");
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $this->symbols = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            $stmt->closeCursor();
            
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    //Class function to access the stocks variable from the class
    public function getAllStocks(){
        return $this->stocks;
    }
    
    //Class function to retrieve stock data from the API
    public function retrieveStockData(){
        try{
            
            $results = array();
            
            if(!empty($this->symbols)){
                foreach($this->symbols as $stk){
                    $curl = curl_init();
                    
                    curl_setopt($curl, CURLOPT_URL, "https://finnhub.io/api/v1/stock/recommendation?symbol=" . $stk['stock_symbol'] . "&token=$this->apiToken&format=json");

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    $results = json_decode(curl_exec($curl));
                    
                    $this->formatStockData($results);
                    curl_close($curl);
                }
            }
            
            $this->retrieveCompanyData();
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    //Class function to retrieve company data from the API
    private function retrieveCompanyData(){
        try{
            $curl = curl_init();
            $results = array();
            
            if(!empty($this->stocks)){
                foreach($this->stocks as $key => $stk){

                    curl_setopt($curl, CURLOPT_URL, "https://finnhub.io/api/v1/stock/profile2?symbol=" . $stk['symbol'] . "&token=$this->apiToken&format=json");

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    $results = json_decode(curl_exec($curl));
                    $this->stocks[$key]['name'] = $results->name;
                }
            }

            curl_close($curl);
            
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    //Class function to format the retrieved stock data for graph display
    private function formatStockData($results){
        $counter = 0;
        foreach ($results as $result){
            
                $this->stocks[$result->symbol]['symbol'] = $result->symbol;
                if($counter < 12){
                    $this->stocks[$result->symbol]['data'][] = "['" . $result->period . "', " . $result->strongBuy . ", " . $result->buy . ", " . $result->hold . ", " . $result->sell . ", " . $result->strongSell . "]";
                $counter++;
            }
        }
    }
    
    //Class funtion to delete stock from database
    public function deleteStock($symbol){
        try {
            $stmt = $this->db->prepare("DELETE FROM stocks WHERE stock_symbol = :stock_symbol");

            $stmt->bindparam(":stock_symbol", $symbol);

            $stmt->execute();
            $rowCount = $stmt->rowCount();
            $stmt->closeCursor();
            
            return $rowCount;
        } catch (Exception $ex) {
            return 0;
        }
    }
}
