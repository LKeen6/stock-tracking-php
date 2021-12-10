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
        
    }
    
    //Class function to load all stocks from database
    public function loadAllStocks(){
        
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
        
    }
    
    //Class funtion to delete stock from database
    public function deleteStock($symbol){
        
    }
}
