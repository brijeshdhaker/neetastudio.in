<?php
/**
 * Description of ResultIterator
 *
 * @author brijeshdhaker
 */
class ResultIterator{
    private $iterator;
    public function __construct($result){
        if(get_resource_type($result)!='mysql result'){
            throw new Exception('result must be a MySQL result set');
        }
        // get ArrayObject
        $arrayobj=new ArrayObject();
        // get Iterator object
        $this->iterator=$arrayobj->getIterator();
        while($row=mysql_fetch_row($result)){
            $arrayobj[]=implode(',',$row);
        }
    }
    // reset pointer of MySQL result set
    public function rewind(){
        return $this->iterator->rewind();
    }
    // get current row
    public function current(){
        if($this->iterator->valid()){
            return $this->iterator->current();
        }
    }
    // get next row
    public function next(){
        if($this->iterator->valid()){
            return $this->iterator->next();
        }
    }
    // seek row
    public function seek($pos){
        if(!is_int($pos)||$pos<0){
            throw new Exception('Invalid position');
        }
        return $this->iterator->seek($pos);
    }
    // count rows
    public function count(){
        return $this->iterator->count();
    }
}
