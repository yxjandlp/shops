<?php
/**
 * @author yaoxianjin
 * 配置通用常量
 *
 * Date: 12-10-9
 * Time: 下午8:50
 */
class Constant
{
    /**
     * 不支创建实例
     */
    private function __construct(){}

    /**
     * 商家图片目录
     * @return string Path
     */
    public static function getShopImagePath()
    {
        return Yii::app()->request->baseUrl.'/assets/upload/shops/';
    }

    /**
     * 商家图片上传目录
     */
    public static function getShopImageUploadPath()
    {
        return 'assets/upload/shops/';
    }
    
    /**
     * 手机端API合法性校验使用 key
     */
    const API_CHECK_KEY = "yangfeiyangwenyaoxianjinsunchangyu";
    
    /**
     * 操作API成功code
     */
    const API_OPERATE_SUCCESS = 0;

}