<?php
namespace App\Libraries;

/**
 * Class Translit
 * @package Services
 */
class Translit {

	static $cyr = array ("Щ", "Ш", "Ч", "Ц", "Ю", "Я", "Ж", "А", "Б", "В", "Г", "Д", "Е", "Ё", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ь", "Ы", "Ъ", "Э", "Є", "Ї", "І", "щ", "ш", "ч", "ц", "ю", "я", "ж", "а", "б", "в", "г", "д", "е", "ё", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ь", "ы", "ъ", "э", "є", "ї", "і" );
	static $lat = array ("Sch", "Sh", "Ch", "C", "U", "Ya", "Zh", "A", "B", "V", "G", "D", "E", "Yo", "Z", "I", "Y", "K", "L", "M", "N", "O", "P", "R", "S", "T", "U", "F", "H", "", "Y", "", "E", "Ye", "Yi", "I", "sch", "sh", "ch", "c", "u", "ya", "zh", "a", "b", "v", "g", "d", "e", "yo", "z", "i", "y", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "", "y", "", "e", "ye", "yi", "i" );

    public static function translate($str)
    {

        $str = str_replace(self::$cyr, self::$lat, $str);
        return $str;
    }
}