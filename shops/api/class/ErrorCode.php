<?php
/**
 * 错误代码类
 * 
 * @author yaoxianjin
 * 
 */
class ErrorCode {
	
	/**
	 * 不支持创建实例
	 */
	private function __construct(){}
	
	/**
	 * apikey校验错误，操作非法 
	 */
	const API_KEY_VALIDATE_ERROR = 1000;
	
}