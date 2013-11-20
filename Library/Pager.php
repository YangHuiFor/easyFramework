<?php
/**
 *分页类
 *
 * @author yanghuinobody@qq.com 
 * @createtime 2013-11-20 22:48:45
 * @version 
 */
class Pager  
{	
	/*
		当前页
	 */
	static $page ;

	/*
		分页总数
	 */
	static $pageCount ;

	/*
		分页数
	 */
	static $pageSize = 10;

	/*
		数据总数
	 */
	static $itemTotal ;

	/*
		前一页
	 */
	static $prevPage ;

	/*
		下一页
	 */
	static $nextPage ;

	static $firstPage;

	static $lastPage;
	/*
		分页风格
	 */
	
	static $style ;

	/*
	 * 分页标识参数
	 */
	static $p = 'p';

	static $B = '_P_';

	static $pageUrl ;

	public function __construct($page, $itemTotal, $pageSize, $style)
	{
		self::$page = $page ;
		self::$pageSize = !empty($pageSize) ? $pageSize : self::$pageSize;
		self::$itemTotal = $itemTotal;
		self::$pageCount = intval(ceil($itemTotal/self::$pageSize));
		self::$style = $style;
		self::_init();

	}

	public static function _init()
	{
		self::PageUrl();
		self::setPrevUrl();
		self::setNextUrl();
		self::setFirstUrl();
		self::setLastUrl();
	}

	public static function  PageUrl()
	{	
		parse_str($_SERVER['QUERY_STRING'],$arr);
		var_dump($arr);
		$str = '';
		if (!empty($arr)) {
			unset($arr[self::$p]);
			$str = http_build_query($arr);
		} 

		if (!empty($str)){
			$str .= '&';
		}
		$str .= self::$p . '=' . self::$B; 
		self::$pageUrl =  $_SERVER['SCRIPT_NAME']  . '?' . $str; 
		var_dump(self::$pageUrl);

	}

	public static function pageUrlReplace($page)
	{
		return str_replace(self::$B, $page, self::$pageUrl);
	}

	public static function setPrevUrl()
	{	
		$prevPageNums = self::$page - 1;
		//第一页的前一页为空，或者是第一页
		if ( $prevPageNums < 0 ) {
			self::$prevPage = null;
		}
		self::$prevPage = self::pageUrlReplace($prevPageNums);
	}

	public static function setNextUrl()
	{	
		$nextPageNums = self::$page + 1;
		//最后一页的下一页为空，或者是最后一页
		if ( $nextPageNums > self::$pageCount ) {
			self::$prevPage = null;
		}
		self::$nextPage = self::pageUrlReplace($nextPageNums);
	}

	public static function setFirstUrl()
	{
		self::$firstPage = self::pageUrlReplace(1);
	}

	public static function setLastUrl()
	{
		self::$lastPage = self::pageUrlReplace(self::$pageCount);
	}

	public static function show()
	{	
		$output = '';
		$style = self::$style;

		switch ($style) {
			case '1':
				$output = '<div><span>总共' . self::$itemTotal . '条</span></div>';

				$before = max(self::$page - 5 , 1);
				$behind = min(self::$page + 5 , self::$pageCount);
				if (self::$prevPage) {
					$output .= '<label><a href="' . self::$prevPage . '"><<</a></label>';
				} else {
					$output .= '<label><a href="javascript:;"><<</a></label>';
				}
				
				if ($before != 1) {
					$output .= '<label><a href="' . self::$firstPage . '">1</a></label>';
					$output .= '<label>...</label>';
				}

				$center = '';
				foreach (range($before,$behind) as $p) {
					if (self::$page != $p) {
						$center .= '<label><a href="' . self::pageUrlReplace($p). '">' .$p. '</a></label>';
					} else {
						$center .= '<label><b>' .$p. '</b></label>';
					}
					
				}

				$output .= $center;
				if ($behind != self::$pageCount) {
					$output .= '<label>...</label>';
					$output .= '<label><a href="' . self::$lastPage . '">'.self::$pageCount.'</a></label>';
				}
				if (self::$nextPage) {
					$output .= '<label><a href="' . self::$nextPage . '">>></a></label>';
				} else {
					$output .= '<label><a href="javascript:;">>></a></label>';
				}
				break;
			
		}
		return $output;
	}
}	


