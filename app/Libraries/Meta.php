<?php namespace App\Libraries;

/**
 * Class Meta
 * @package App\Libraries
 */
class Meta {

	static $tags = array(
		"title"             => "<title>%s</title>\n",
		"description"       => "<meta content=\"%s\" name=\"description\" />\n",
		"keywords"          => "<meta content=\"%s\" name=\"keywords\" />\n",
		"base"              => "<base href=\"%s\"/>\n",
		"canonical"         => "<link rel=\"canonical\" href=\"%s\"/>\n",
		"custom"            => "%s\n",
	);

	static $data = array(
		"title"             => array(),
		"description"       => "",
		"keywords"          => "",
		"base"              => "",
		"canonical"         => "",
		"custom"            => array(),
	);

	static $titleDelimiter = " - ";


	public static function title($str) {

		if(!empty($str))
			array_unshift(self::$data['title'],$str);
	}

	public static function clearTitle() {
		self::$data['title'] = array();
	}

	public static function description($str) {
		self::$data['description'] = $str;
	}

	public static function keywords($str) {
		self::$data['keywords'] = $str;
	}

	public static function base($str) {
		self::$data['base'] = $str;
	}

	public static function canonical($str) {
		self::$data['canonical'] = $str;
	}

	public static function custom($str) {
		self::$data['custom'][] = $str;
	}


	public static function render(){

		$output  = sprintf(self::$tags['title'], implode( self::$titleDelimiter, self::$data['title']) );

		if(!empty( self::$data['description']) )
			$output .= sprintf(self::$tags['description'], self::$data['description']);

		if(!empty( self::$data['keywords']) )
			$output .= sprintf(self::$tags['keywords'], self::$data['keywords']);

		if(!empty( self::$data['canonical']) )
			$output .= sprintf(self::$tags['canonical'], self::$data['canonical']);

		foreach (self::$data['custom'] as $custom){
			$output .= sprintf(self::$tags['custom'], $custom);
		}

		return $output;
	}





}