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
	protected function getRequestParam( $paramName , $defaultValue = null )
    {
		$request = Yii::app()->getRequest();
		return $request->getParam( $paramName, $defaultValue );
	}
	
	/**
	 * get return url
	 * 
	 * @return string $goUrl 
	 */
	protected function getReturnUrl()
    {
		$currentUrl = Yii::app()->request->getUrl();
		$returnUrl = preg_replace( '/(\w+)(\?go_url=.*)/' , '${1}' , $currentUrl );
		
		return urlencode($returnUrl);
	}

    /**
     * 成功提示
     */
    protected function showSuccessMessage( $message="", $returnUrl="shops/")
    {
        $this->redirect(Yii::app()->homeUrl.'message/success?message='.$message.'&returnUrl='.$returnUrl);
    }
	
}