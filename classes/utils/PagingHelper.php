<?php

class PagingHelper {

    var $limit;
    
    function __construct($limit = 10) {
        if (is_null($limit)) {
            $limit = 10;
        }
        $this->limit = $limit;
    }

    /**
     * Method to find number of pages for fetched Number of records.
     * Used for Pagination in UI.
     *
     * @param recordCount Integer This contains number of construction projects.
     * @return numOfPages Integer returns the number of pages.
     */
    public function getTotalPages($records) {
        if (intval($records) != 0) {
            $totalPages = floor($records / $this->limit);
            if (($records % $this->limit) != 0) {
                $totalPages++;
            }
            return $totalPages;
        }
        return 0;
    }
    
    /*
     * @param $pageNo.
     * @return $offset.
     */
    public function getOffset($pageNo) {
        if (is_numeric($pageNo) && $pageNo > 1) {
            $offset = 0;
            if ($pageNo != null) {
                $offset = ($pageNo - 1) * $this->limit;
            }
            return $offset;
        }
        return 0;
    }
    
    /*
     * @param $pageNo.
     * @return $offset.
     */
    public function getLimit() {
        return $this->limit;
    }
    
    /*
     * @param $pageNo.
     * @return $offset.
     */
    public function getPageData($pageNo, $records) {
        $pageData = array();
        if (is_array($records) && !is_null($records) && count($records) > 0) {
            $offset = $this->getOffset($pageNo);
            $pageData = array_slice($records, $offset, $this->limit);
        }
        return $pageData;
    }
    
}

?>