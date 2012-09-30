<?php
/**
 * The base controller of site
 * 
 * @author yaoxianjin
 *
 */
class BaseController extends CController {
	
	/**
	 * get param from request
	 * 
	 * @param $paramName 
	 * @param $defaultValue 
	 * @return string
	 */
	public function getRequestParam( $paramName , $defaultValue = null )
    {
		$request = Yii::app()->getRequest();
		return $request->getParam( $paramName, $defaultValue );
	}
	
	/**
	 * get return url
	 * 
	 * @return string $goUrl 
	 */
	public function getReturnUrl()
    {
		$currentUrl = Yii::app()->request->getUrl();
		$returnUrl = preg_replace( '/(\w+)(\?go_url=.*)/' , '${1}' , $currentUrl );
		
		return urlencode($returnUrl);
	}

    /**
     * 成功提示
     */
    public  function showSuccessMessage( $message="", $returnUrl="shops/")
    {
        $this->redirect(Yii::app()->createUrl('message/success') .'?message='.$message.'&returnUrl='.$returnUrl);
        //$this->redirect(Yii::app()->createUrl('message/success', array('message'=>$message, 'returnUrl'=>$returnUrl)));
    }

    /**
     * 设置页面标题
     *
     * @param string $title
     */
    public function setPageTitle( $title )
    {
        parent::setPageTitle( CHtml::encode(Yii::app()->name) . ' - ' .$title);
    }

}