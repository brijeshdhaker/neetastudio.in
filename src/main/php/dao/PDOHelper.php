<?php
/**
 * Description of PDOHelper
 *
 * @author brijeshdhaker
 */
class PDOHelper {
    
    private $pdoconn; 
    /**
     * @return the environment
     */
    function __construct() {
        $datasource = new DataSourceInfo(CONSTANTS::DRIVER_PDO);
        $this->pdoconn = $datasource->getDBConnection();
    }
    
    function getConnection() {
        return $this->pdoconn;
    }
    
    function processTransaction(){
         try {
            $this->conn->beginTransaction();
            // commit the transaction
            $this->conn->commit();
        } catch (Exception $e) {
            $this->message = $e->getMessage();
            $this->conn->rollBack();
        }
    }
    
    public function execute($sql, $fetchmode, $isAll) {
        $results = null;
        if ($sql != null && $sql != '') {
            $query = $this->pdoconn->query($sql);
            if (!$query) {
                die("Execute query error, because: " . $this->pdoconn->errorInfo());
            }
            $query->setFetchMode(($fetchmode != null ) ? $fetchmode : PDO::FETCH_BOTH);
            if ($isAll) {
                $results = $query->fetchAll();
            } else {
                $results = $query->fetch();
            }
        }
        return $results;
    }
    
    public function processQuery($procedure, $mapping) {
        
        $resultset = $this->execute($procedure, PDO::FETCH_ASSOC, TRUE);
        $inouts = $this->execute("SELECT @code as code, @message as message;", PDO::FETCH_ASSOC, FALSE);
        
        if (!is_null($inouts) && $inouts['code'] != 0) {
            throw new Exception($inouts['message'],$inouts['code']);
        }
        
        return $this->resultMapper($resultset, $mapping);
        
    }
    
    /*
    public function processResultSet($procedure, $mapping, $mappertype) {
        $response = null;
        $resultset = $this->execute($procedure, PDO::FETCH_ASSOC, TRUE);
        $inouts = $this->execute("SELECT @code as code, @message as message;", PDO::FETCH_ASSOC, FALSE);
        if (!is_null($inouts)) {
            if ($inouts['code'] == 0) {
                $response = OnclickResponse::Success($inouts['message']);
                if (!is_null($resultset)) {
                    $results = null;
                    if (count($resultset) == 1 && $mappertype == 1) {
                        $results = $this->recordMapper($mapping, $resultset[0]);
                    } else {
                        $results = $this->resultsetMapper($mapping, $resultset);
                    }
                    $response->setData($results);
                    $response->setCount(count($resultset));
                }
            } else {
                $response = OnclickResponse::Error($inouts['message']);
                $response->setStatus($inouts['code']);
            }
        } else {
            $response = OnclickResponse::Error("System Error occurred while processing your request.");
        }
        return $response;
    }

    */
    
    public function processMultiResults($procedure, $rsmapper, $mappertypes, $mappings) {
        $results = array();
        if (!is_null($procedure) && $procedure != '') {
            $stmt = $this->pdoconn->query($procedure);
            $i = 0;
            do {
                $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($resultset){
                    $key = $rsmapper[$i];
                    $mapping = $mappings[$key];
                    $mappertype = $mappertypes[$key];
                    if (count($resultset) == 1 && $mappertype == 1) {
                        $records = $this->recordMapper($mapping, $resultset[0]);
                    } else {
                        $records = $this->resultsetMapper($mapping, $resultset);
                    }
                    $results[$key] = $records;    
                }
                $i++;
            } while ($stmt->nextRowset());
        }
        return $results;
    }

    /**
     * 
     * @param type $resultset
     * @param type $mapping
     * @return type
     */
    private function resultMapper($resultset, $mapping){
        $output = array();
        if ((null != $mapping) && (null != $resultset)) {
            if(count($resultset) == 1){
                $output = $this->recordMapper($resultset[0], $mapping);
            } else{
                for ($x = 0; $x < count($resultset); $x++) {
                    $record = $resultset[$x];
                    array_push($output, $this->recordMapper($record, $mapping));
                }
            } 
        }
        return $output;
    }
    
    private function recordMapper($record, $mapping) {
        $output = array();
        if (null != $record) {
            foreach ($mapping as $x => $x_value) {
                try {
                    $val = $record[$x];
                    if(!is_null($val)) {
                       $output[$x_value] = $record[$x];
                    }else{
                       $output[$x_value] = '';
                    }
                }catch (Exception $exc) {
                    
                }
            }
        }
        return $output;
    }
    
    public function processDataList($table, $datafields, $data) {
        $insert_values = array();
        $status = TRUE;
        try {
            foreach($data as $d){
                $question_marks[] = '('  . $this->placeholders('?', sizeof($d)) . ')';
                $insert_values = array_merge($insert_values, array_values($d));
            }
            $sql = "INSERT INTO " .$table. " (" . implode(",", $datafields ) . ") VALUES " . implode(',', $question_marks);
            $this->pdoconn->beginTransaction();
            $stmt = $this->pdoconn->prepare ($sql);
            $stmt->execute($insert_values);
            $this->pdoconn->commit();
        } catch (PDOException $e){
            $status = FALSE;
        }
        return $status;
    }
    
    private function placeholders($text, $count=0, $separator=","){
        $result = array();
        if($count > 0){
            for($x=0; $x<$count; $x++){
                $result[] = $text;
            }
        }
        return implode($separator, $result);
    }
}
