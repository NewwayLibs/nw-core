<?php namespace App\Decorators;

/**
 * Class Phone
 * @package App\Decorators
 */
class Phone extends AbstractDecorator {

    function getDecorated()
    {
        $phone = preg_replace('/([^0-9]+)/','',$this->object);

        if ( str_is('380*',$phone) && strlen($phone) == 12 ){
            // nothing to do
        } elseif( str_is('80*',$phone) && strlen($phone) == 11 ) {
            $phone = '3'.$phone;
        }elseif ( str_is('0*',$phone)  && strlen($phone) == 10 ){
            $phone = '38'.$phone;
        }elseif ( strlen($phone) == 9 ){
            $phone = '380'.$phone;
        }

        return $phone;
    }
}