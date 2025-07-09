<?php

/**
 * Description of PasswordHelper
 * @author brijeshdhaker
 */
class OnclickUtils {

    public static function getProperty($key, $object, $default = NULL) {
        $value = null;
        if (!is_null($key) && !is_null($object)) {
            try {
                if (is_object($object)) {
                    $value = $object->$key;
                }
                if (is_array($object)) {
                    $value = $object[$key];
                }
            } catch (Exception $e) {
                
            }
        }
        if (is_null($value) && !is_null($default)) {
            $value = $default;
        }
        if (!is_null($value) && is_string($value)) {
            $value = addslashes(trim($value));
        }
        return $value;
    }

    public static function validateRegex($regex, $value) {
        // '/\/profiles\/\?peopleId=1/'

        return preg_match($regex, $value);
    }

    public static function asString($value) {
        //&& $value != ""
        if (!is_null($value)) {
            if (is_string($value) && $value != "") {
                return "'" . $value . "'";
            }
            if (is_bool($value)) {
                return $value ? "'Y'" : "'N'";
            }
            if (is_array($value)) {
                return "[" . implode(',', $value) . "]";
            }
            return "'" . trim($value) . "'";
        } else {
            return "NULL";
        }
    }

    public static function asNumber($value) {
    	if (!is_null($value) && is_numeric($value)) {
            return intval($value);
        } else {
            return "NULL";
        }
    }

    //
    public static function resultsetMapper($mapping, $data) {
        $output = array();
        if ((null != $mapping) && (null != $data)) {
            if (is_array($data)) {
                $datalength = count($data);
                for ($x = 0; $x < $datalength; $x++) {
                    $record = $data[$x];
                    if ($record) {
                        array_push($output, self::recordMapper($mapping, $record));
                    }
                }
            } else {
                $output = self::recordMapper($mapping, $data);
            }
        }
        return $output;
    }

    public static function recordMapper($mapping, $data) {
        $output = array();
        if ((null != $mapping) && (null != $data)) {
            foreach ($mapping as $x => $x_value) {
                try {
                    $val = $data[$x];
                    if (!is_null($val)) {
                        $output[$x_value] = $data[$x];
                    } else {
                        $output[$x_value] = '';
                    }
                } catch (Exception $exc) {
                    
                }
            }
        }
        return $output;
    }

    //
    function arrayToObject(array $array, $className) {
        return unserialize(sprintf('O:%d:"%s"%s', strlen($className), $className, strstr(serialize($array), ':')));
    }

    //
    function objectToObject($instance, $className) {
        return unserialize(sprintf(
                        'O:%d:"%s"%s', strlen($className), $className, strstr(strstr(serialize($instance), '"'), ':')
        ));
    }

    /**
     * Class casting
     *
     * @param string|object $destination
     * @param object $sourceObject
     * @return object
     */
    function cast($destination, $sourceObject) {
        if (is_string($destination)) {
            $destination = new $destination();
        }
        $sourceReflection = new ReflectionObject($sourceObject);
        $destinationReflection = new ReflectionObject($destination);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($sourceObject);
            if ($destinationReflection->hasProperty($name)) {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($destination, $value);
            } else {
                $destination->$name = $value;
            }
        }
        return $destination;
    }

    /**
     * recast stdClass object to an object with type
     *
     * @param string $className
     * @param stdClass $object
     * @throws InvalidArgumentException
     * @return mixed new, typed object
     */
    function recast($className, stdClass &$object) {
        if (!class_exists($className))
            throw new InvalidArgumentException(sprintf('Inexistant class %s.', $className));

        $new = new $className();

        foreach ($object as $property => &$value) {
            $new->$property = &$value;
            unset($object->$property);
        }
        unset($value);
        $object = (unset) $object;
        return $new;
    }

    public static function joinArrayKeyValues($key, $array) {
        if (!is_null($array) && (!is_null($key) && $key != "")) {

            $values = array();
            foreach ($array as $d) {
                $val = null;
                if (is_object($d)) {
                    $val = $d->$key;
                } else {
                    $val = $d[$key];
                }
                if (!is_null($val)) {
                    array_push($values, $val);
                }
            }
            return implode(", ", $values);
        } else {
            return null;
        }
    }

    public static function alphaNumericRandom($length = 10) {
        $characters = 'aBcDeFgHiJkLmNoPqRsTuVwXyZ0123456789./';
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $random;
    }

    public static function isEmpty($value) {
        if (is_null($value)) {
            return true;
        } else {
            if (is_string($value) && trim($value) == "") {
                return true;
            }

            if (is_numeric($value) && is_nan($value)) {
                return true;
            }
        }
        return false;
    }

}
