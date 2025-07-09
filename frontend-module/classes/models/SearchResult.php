<?php
/**
 * Description of SearchResult
 *
 * @author brijeshdhaker
 */
class SearchResult {
    //
    var $searchTitle;
    
    var $firstPageHref;
    var $lastPageHref;
    var $prevPageHref;
    var $nextPageHref;
    var $paging;
    var $totalNumberOfItems;
    var $items;
    //
    var $data;
    
    //
    var $message;
    
    //
    var $status;
    
    //
    var $count;
    var $currentPage;
    var $numberOfPages;
    //
    var $messages = array();
    
    /**
     * Success Response
     * @param data Data
     * @return
     */
    public static function Success($message=null) {
        $response = new SearchResult();
        $response->setStatus("200");
        if(is_null($message)){
            $message = new Message();
            $message->setCode("200000");
            $message->setProperties("");
            $message->setUserMessage("Success");
        }else{
            if(is_string($message)){
                $message = new Message();
                $message->setCode("200000");
                $message->setProperties("");
                $message->setUserMessage($message);
            }
        }
        $response->addMessages($message);
        return $response;
    }
    
    /**
     * Success Response
     * @param data Data
     * @return
     */
    public static function Error($status=404,$message=null) {
        $response = new SearchResult();
        $response->setStatus($status);
        if(is_null($message)){
            $message = new Message();
            $message->setCode($status."000");
            $message->setProperties("");
            $message->setUserMessage("Error");
        }else{
            if(is_string($message)){
                $message = new Message();
                $message->setCode("404000");
                $message->setProperties("");
                $message->setUserMessage($message);
            }
        }
        $response->addMessages($message);
        return $response;
    }
    
    function getData() {
        return $this->data;
    }

    function getMessage() {
        return $this->message;
    }

    function getStatus() {
        return $this->status;
    }

    function getCount() {
        return $this->count;
    }

    function getMessages() {
        return $this->messages;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCount($count) {
        $this->count = $count;
    }

    function setMessages($messages) {
        $this->messages = $messages;
    }
    
    public function addMessages($message) {
        if(!is_null($message)){
            array_push($this->messages,$message);
        }
    }
    
    function getFirstPageHref() {
        return $this->firstPageHref;
    }

    function getLastPageHref() {
        return $this->lastPageHref;
    }

    function getPrevPageHref() {
        return $this->prevPageHref;
    }

    function getNextPageHref() {
        return $this->nextPageHref;
    }

    function getPaging() {
        return $this->paging;
    }

    function getTotalNumberOfItems() {
        return $this->totalNumberOfItems;
    }

    function getItems() {
        return $this->items;
    }

    function setFirstPageHref($firstPageHref) {
        $this->firstPageHref = $firstPageHref;
    }

    function setLastPageHref($lastPageHref) {
        $this->lastPageHref = $lastPageHref;
    }

    function setPrevPageHref($prevPageHref) {
        $this->prevPageHref = $prevPageHref;
    }

    function setNextPageHref($nextPageHref) {
        $this->nextPageHref = $nextPageHref;
    }

    function setPaging($paging) {
        $this->paging = $paging;
    }

    function setTotalNumberOfItems($totalNumberOfItems) {
        $this->totalNumberOfItems = $totalNumberOfItems;
    }

    function setItems($items) {
        $this->items = $items;
    }
}
