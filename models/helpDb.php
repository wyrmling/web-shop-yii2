<?php
namespace app\models;
/**
 * Created by PhpStorm.
 * User: Green Drake
 * Date: 01.12.2015
 * Time: 22:31
 */

use Yii\db\Connection;

trait helpDb {

    /**
     * Quotes a string value for use in a query.
     * Note that if the parameter is not a string, it will be returned without change.
     * @param string $str string to be quoted
     * @return string the properly quoted string
     * @see http://www.php.net/manual/en/function.PDO-quote.php
     */
    public static function quote($str)
    {
        if (!is_string($str)) {
            return $str;
        }

        return "'" . addcslashes(str_replace("'", "''", $str), "\000\n\r\\\032") . "'";
    }

}