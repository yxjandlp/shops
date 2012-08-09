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
	protected function getParamFromRequest( $paramName , $defaultValue = null ) {
		$request = Yii::app()->getRequest();
		return $request->getParam( $paramName, $defaultValue );
	}
	
}