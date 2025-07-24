<?php
/**
 * Description of FileIterator
 *
 * @author brijeshdhaker
 **/
 
/*
 try{
    $fIterator=new FileIterator(‘test.txt’);
    // reset pointer to beginning of file
    $fIterator->rewind();
    // display current line of file
    echo $fIterator->current();
    // move to next line of file
    $fIterator->next();
    // display current line of filet
    echo $fIterator->current();
    // display number of lines in file
    echo $fIterator->count();
    // move file pointer to third line
    $fIterator->seek(3);
    // display third line
    echo $fIterator->current();
}
catch(Exception $e){
    echo $e->getMessage();
    exit();
}
*/

class FileIterator {

    private $iterator;

    public function __construct($file) {
        if (!file_exists($file)) {
            throw new Exception('Invalid input file');
        }
        // get ArrayObject
        $arrayobj = new ArrayObject();
        // get Iterator object
        $this->iterator = $arrayobj->getIterator();
        $lines = file($file);
        foreach ($lines as $line) {
            $arrayobj[] = $line;
        }
    }

    // get first line of file
    public function rewind() {
        return $this->iterator->rewind();
    }

    // get current line of file
    public function current() {
        if ($this->iterator->valid()) {
            return $this->iterator->current();
        }
    }

    // get next line of file
    public function next() {
        if ($this->iterator->valid()) {
            return $this->iterator->next();
        }
    }

    public function seek($pos) {
        if (!is_int($pos) || $pos < 0) {
            throw new Exception('Invalid position');
        }
        return $this->iterator->seek($pos);
    }

    public function count() {
        return $this->iterator->count();
    }

}
