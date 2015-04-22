<?php

class Input
{
    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */
    public static function has($key)
    {
        return isset($_REQUEST[$key]) ? true : false;
    }

    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = NULL)
    {
        return self::has($key) ? $_REQUEST[$key] : $default; 
    }

    public static function getString($key, $min = NULL, $max = NULL)
    {
        $keyValue = self::get($key);

        if(empty($key)){
            throw new OutOfRangeException("A key was not provided.");
        }

        if(!is_string($key)) {
            throw new InvalidArgumentException("Key $key must be a string.");
        }

        if(isset($min) && isset($max) && (!is_int($max) || !is_int($min))){
            throw new InvalidArgumentException("Minimum and Maximum must be integers.");
        }

        if(!is_string($keyValue) || !isset($keyValue) || is_numeric($keyValue)){
            throw new DomainException("$key input must be a string!");
        }

        if(strlen($keyValue) < $min || strlen($keyValue) > $max){
            throw new LengthException("$key input must be between $min and $max characters long.");
        }

        return trim($keyValue);
    }

    public static function getNumber($key, $min = NULL, $max = NULL)
    {
        $keyValue = trim(self::get($key));

        if(empty($key)){
            throw new OutOfRangeException("A key was not provided.");
        }

        if(!is_string($key)) {
            throw new InvalidArgumentException("Key $key must be a string.");
        }

        if(isset($min) && isset($max) && (!is_int($max) || !is_int($min))){
            throw new InvalidArgumentException("Min and Max parameters must be integers.");
        }

        if(!is_numeric($keyValue) || !isset($keyValue)){
            throw new Exception ("$key input must be a number!");
        }

        if(isset($min) && isset($max) && (strlen($keyValue) < $min || strlen($keyValue) > $max)){
            throw new RangeException("$key input must be between $min and $max.");
        }

        return (float)$keyValue;
    }

    public static function getDate($key)
    {
        // Re-format the user inputted date to the correct format, using PHP library functions, before passing to MySQL 
        // If date field is left blank by the user, default to today's date
        if (self::get($key)) {
            $userDate = date_create(trim(self::get($key)));
            if (!$userDate) {
                throw new exception ("Invalid date; must be in the format: YYYY-MM-DD."); 
            } else {
               return $newDate = date_format($userDate, 'Y-m-d');
            }
        } else {
            return $newDate = date('Y-m-d');
        }
    }

    public static function validateEmail($key)    // Found on stackoverflow: 'Best email validation function'
    {
        $email = self::get($key);

        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            throw new Exception ('Invalid email format');
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                throw new Exception ('Invalid email format');
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                throw new Exception ('Invalid email domain'); // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    throw new Exception ('Invalid email format');
                }
            }
        }

        return true;
     
    }

    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}
