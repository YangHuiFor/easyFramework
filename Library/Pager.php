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

	/*
		第一页
	 */
	static $firstPage;

	/*
		最后一页
	 */
	static $lastPage;
	/*
		分页风格
	 */
	static $style ;

	/*
	 * 分页标识参数
	 */
	static $p = 'p';

	/*
		页码替换标识
	 */
	static $B = '_P_';
	
	/*
		分页地址
	 */
	static $pageUrl ;

	/*
		不跳转的默认值
	 */
	static $unValidHref = 'javascript:;';

	/**
	 * 构造
	 * @param [type] $page      [description]
	 * @param [type] $itemTotal [description]
	 * @param [type] $pageSize  [description]
	 * @param [type] $style     [description]
	 */
	public function __construct($page, $itemTotal, $pageSize, $style)
	{
		self::$page = $page ? $page : 1;
		self::$pageSize = !empty($pageSize) ? $pageSize : self::$pageSize;
		self::$itemTotal = $itemTotal;
		self::$pageCount = intval(ceil($itemTotal/self::$pageSize));
		self::$style = $style;
		self::_init();

	}

	/**
	 * 初始化
	 * @return [type] [description]
	 */
	public static function _init()
	{
		self::PageUrl();
		self::setPrevUrl();
		self::setNextUrl();
		self::setFirstUrl();
		self::setLastUrl();
	}

	/**
	 * 分页地址
	 */
	public static function  PageUrl()
	{	
		parse_str($_SERVER['QUERY_STRING'],$arr);
		$str = '';
		if (!empty($arr)) {
			unset($arr[self::$p]);
			$str = http_build_query($arr);
		} 
		if (!empty($str)){
			$str .= '&';
		}
		$str .= self::$p . '=' . self::$B; 
		self::$pageUrl = 'http://'. $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']  . '?' . $str; 

	}

	/**
	 * 分页面地址替换
	 * @param  [type] $page [description]
	 * @return [type]       [description]
	 */
	public static function pageUrlReplace($page)
	{
		return str_replace(self::$B, $page, self::$pageUrl);
	}

	/**
	 * 设置前一页
	 */
	public static function setPrevUrl()
	{	
		$prevPageNums = self::$page - 1;
		//第一页的前一页为空，或者是第一页
		if ( $prevPageNums <= 0 ) {
			self::$prevPage = self::$unValidHref;
		} else {
			self::$prevPage = self::pageUrlReplace($prevPageNums);
		}
		
	}

	/**
	 * 设置下一页
	 */
	public static function setNextUrl()
	{	
		$nextPageNums = self::$page + 1;
		//最后一页的下一页为空，或者是最后一页
		if ( $nextPageNums > self::$pageCount ) {
			self::$nextPage = self::$unValidHref;
		} else {
			self::$nextPage = self::pageUrlReplace($nextPageNums);
		}
		
	}

	/**
	 * 设置第一页
	 */
	public static function setFirstUrl()
	{
		self::$firstPage = self::pageUrlReplace(1);
	}

	/**
	 * 设置最后一页
	 */
	public static function setLastUrl()
	{
		self::$lastPage = self::pageUrlReplace(self::$pageCount);
	}

	/**
	 * 输出分页
	 * @return [type] [description]
	 */
	public static function show()
	{	
		$output = '';
		$style = self::$style;
		switch ($style) {
			case '1':
				$before = max(self::$page - 2 , 1);
				$behind = min(self::$page + 2 , self::$pageCount);

				$output = '<div class="page"><span>总共' . self::$itemTotal . '条</span>';
				$output .= '<label><a href="' . self::$prevPage . '"><<</a></label>';
				
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
				
				$output .= '<label><a href="' . self::$nextPage . '">>></a></label>';
				$output .= '</div>';
				break;
			case '2':
				$output  = '<div class="page"><span>总共' . self::$itemTotal . '条</span>';
				$output .= '<span>' .self::$page . '/' . self::$pageCount . '</span>';
				$output .= '<span><a href="' . self::$prevPage . '">上一页</a></span>';
				$output .= '<span><a href="' . self::$nextPage . '">下一页</a></span>';
				$output .= '<span><input type="text" name="p" value="' .self::$page. '" size ="3" id="to-page"/></span>';
				$output .= '<span><input type="button" name="s" value="GO" onclick="' . self::goToJs() . '"/></span>';
				$output .= '</div>';
				break;
		}
		return $output;
	}

	/**
	 * 跳转js
	 * @return [type] [description]
	 */
	public static function goToJs(){
		return "window.location.href='". self::$pageUrl . "'.replace('".self::$B."',document.getElementById('to-page').value)";
	}
}	


