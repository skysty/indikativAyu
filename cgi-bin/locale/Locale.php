<?php

class Locale
{
	private static $sTable = 'locale';
	private static $aLocaleData = array();
	private static $sUserLocale;

	private static function init($sLang)
	{
	    self::$sUserLocale = $sLang;
        $connection = null;
        require dirname(__DIR__).'/incs/connect.php';
        if (empty(self::$aLocaleData)) {
            $query = mysqli_query($connection, "SELECT object, $sLang FROM " . self::$sTable . " ") or die(mysqli_error($connection));
            $aData = mysqli_fetch_all($query ,MYSQLI_ASSOC) ?? [];

            foreach ($aData as $aRow)
                self::$aLocaleData[$aRow['object']] = $aRow[self::$sUserLocale];
        }
	}

    public static function get($sVal, $sLang = 'kaz')
    {
        if (!isset($_SESSION['lang'])
            || (isset($_SESSION['lang']) && ( !mb_strlen($_SESSION['lang']) || $_SESSION['lang'] == 'kaz') )
        ) {
            return $sVal;
        }
        self::init($_SESSION['lang']);
        $sValMd5 = md5($sVal);
        if (isset(self::$aLocaleData[$sValMd5])) {
            return self::$aLocaleData[$sValMd5] != '' ? self::$aLocaleData[$sValMd5] : $sVal;
        } else {
            $connection = null;
            require dirname(__DIR__).'/incs/connect.php';
            $query = mysqli_query($connection, "SELECT id FROM locale WHERE object = '$sValMd5'") or die(mysqli_error($connection));
            $sId = mysqli_fetch_array($query);
            if(empty($sId)) {
                self::addLocale($sVal, $sValMd5, $connection);
            }
        }

        self::$aLocaleData[$sValMd5] = $sVal;
        return $sVal;
    }

	private static function addLocale($sVal, $sObjId, $connection)
	{
        $query = mysqli_query($connection,"INSERT INTO locale(object, kaz) VALUES('$sObjId','$sVal')") or die(mysqli_error($connection));
	}
}