<?php

/*
  -- @objective	: This is the base class for all onclick batches.
  -- @author      : Brijesh K Dhaker
  -- @date        : 01/12/2011
  -- BATCH_ID     : 1
 * 
 */

interface DBHelper {
    
    function execute($sql, $fetchmode, $isAll);
}
