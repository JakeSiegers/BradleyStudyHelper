<?php

	class BradleyScheduleCrawler {
		public static function crawl_dept($semester = '15SP') {
			$url = 'http://schedule.bradley.edu/scripts/schedule.dll?s='.$semester;
			$dept = array();
			$temp = '';

			$dom = new DOMDocument('1.0');
			@$dom->loadHTMLFile($url);

			$raw_data = $dom->getElementsByTagName('a');
			foreach($raw_data as $link) {
				/**
				 * Takes 3 letter code of department and description that follows,
				 * puts them in correct arrays.
				 * sort of "queues" the code for the next loop to use
				 */
				if ( strlen($link->nodeValue) == 3 ) {
					$temp = $link->nodeValue;
				}
				else if ($temp) {
					$dept[] = array('id' => $temp, 'desc' => $link->nodeValue);
				}
			}

			// Don't really know what to do with it yet.
			echo '<pre>';
			echo var_dump($dept);
			echo '</pre>';
		}

		public static function crawl_class($semester = '15SP', $department) {
	    $department = 'CS';
			$url = 'http://schedule.bradley.edu/scripts/schedule.dll?s='.$semester.'&d='.$department;
			$classes = array();
			$temp = '';

			$dom = new DOMDocument('1.0');
			$dom->loadHTMLFile($url);
			$raw_data = $dom->getElementsByTagName('tr');
			echo '<pre>';
			foreach($raw_data as $x) {
				$str = preg_replace('/[^\w]+/',' ', mb_convert_encoding($x->nodeValue, 'ASCII') ) . '<br>';
				preg_match("/^.*$department([\d]{3})(.*)(\d+).*$/", $str, $matches);

				preg_match("/^.(\d+)[\ R]+([MTuWFS]+)(\d \d{2}).*(\d \d{2}).*(\w{2}\d{3}) (.*)$/", $str, $matches2);

				if (!empty($matches)) {
					print_r($matches);
				}
				if (!empty($matches2)) {
					print_r($matches2);
				} else {
					echo $str;
				}
			}
			echo '</pre>';
		}
	}
?>
