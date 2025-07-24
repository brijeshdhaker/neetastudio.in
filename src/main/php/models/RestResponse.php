<?php
/**
 * Description of RestResponse
 *
 * @author brijeshdhaker
 */
class RestResponse {
    //
    var $firstPageHref = 1;
    var $lastPageHref;
    var $prevPageHref;
    var $nextPageHref;
    var $paging;
    var $currentPage;
    var $totalPages;
    var $items;
    var $totalItems;
    var $totalPageItems;
    var $offset;
    var $data;
    var $message;
    var $status;
    var $count;
    var $messages = array();
    
    /**
     * Success Response
     * @param data Data
     * @return
     */
    public static function Success($msg=null) {
        $response = new RestResponse();
        $response->setStatus("200000");
        //
        $message = Message::Success($msg);
        $response->addMessages($message);
        //
        return $response;
    }
    
    /**
     * Success Response
     * @param data Data
     * @return
     */
    public static function Error($status=404,$msg=null) {
        $response = new RestResponse();
        $response->setStatus($status);
        //
        $message = new Message();
        $message->setCode($status."000");
        if($status == 404){
            $message->setType('danger');
        }else{
            $message->setType('warning');
        }
        $message->setProperties("");
        $message->setUserMessage("Error");
        if(!is_null($msg)){
            $message->setUserMessage($msg);
        }
        //    
        $response->addMessages($message);
        //
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
    
    function getPaging() {
        return is_null($this->paging) ? FALSE : TRUE;
    }

    function getItems() {
        return $this->items;
    }
    
    function setItems($items) {
        $this->items = $items;
        if(!is_null($items)){
            $this->totalPageItems = count($items);
            $this->setTotalItems(count($items));
        }
    }
    
    function getFirstPageHref() {
        $this->firstPageHref = 1;
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

    function getCurrentPage() {
        return $this->currentPage;
    }
    
    function getTotalPages() {
        return $this->totalPages;
    }

    function getTotalItems() {
        return $this->totalItems;
    }

    function getTotalPageItems() {
        return $this->totalPageItems;
    }

    function setPrevPageHref($prevPageHref) {
        $this->prevPageHref = $prevPageHref;
    }

    function setNextPageHref($nextPageHref) {
        $this->nextPageHref = $nextPageHref;
    }

    function setCurrentPage($currentPage) {
        $this->currentPage = intval($currentPage);
        if(!is_null($currentPage)){
            $nextpage = intval($currentPage) + 1;
            if($nextpage > $this->getTotalPages()){
                $nextpage = $this->getTotalPages();
            }
            $this->nextPageHref = $nextpage;
            $previouspage = intval($currentPage) - 1;
            if($previouspage <= 0 ){
                $previouspage = 1;
            }
            $this->prevPageHref = $previouspage;
        }
    }
    
    function setTotalPages($totalPages) {
        $this->totalPages = $totalPages;
        if(!is_null($totalPages) && $totalPages != 0){
          $this->lastPageHref = intval($totalPages);
        }else{
            $this->totalPages   = 1;
            $this->lastPageHref = 1;
        }
    }

    function setTotalItems($totalItems) {
        $this->totalItems = $totalItems;
    }

    function setTotalPageItems($totalPageItems) {
        $this->totalPageItems = $totalPageItems;
    }

    function setFirstPageHref($firstPageHref) {
        $this->firstPageHref = $firstPageHref;
    }

    function setLastPageHref($lastPageHref) {
        $this->lastPageHref = $lastPageHref;
    }

    function setPaging($paging) {
        $this->paging = $paging;
    }
    
    function getOffset() {
        return $this->offset;
    }

    function setOffset($offset) {
        $this->offset = $offset;
    }


}
