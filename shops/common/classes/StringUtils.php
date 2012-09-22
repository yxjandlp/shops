<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-9-12
 * Time: 下午9:12
 *
 * 字符串操作
 */

class StringUtils {

    /**
     * 不支持创建实例
     */
    private function __construct(){}

    /**
     * 字符串截取
     *
     * @param string $text
     * @param int $length
     * @param string $fill
     * @return string $text
     */
    public static function truncateText( $text, $length, $fill='...'){
        if(mb_strlen($text,'utf-8') > $length){
            $text = mb_substr($text, 0, $length, 'utf-8');
            return $text . $fill;
        }else{
            return $text;
        }
    }
}