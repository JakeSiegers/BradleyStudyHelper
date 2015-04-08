<?php
	function crawl_dept($semester = '15SP')
	{
		$url = 'http://schedule.bradley.edu/scripts/schedule.dll?s='.$semester;
		$dept = array();
		$temp = '';

		$dom = new DOMDocument('1.0');
		@$dom->loadHTMLFile($url);

		$raw_data = $dom->getElementsByTagName('a');
		foreach($raw_data as $link)
		{
			/**
			 * Takes 3 letter code of department and description that follows,
			 * puts them in correct arrays.
			 * sort of "queues" the code for the next loop to use
			 */
			if ( strlen($link->nodeValue) == 3 )
			{
				$temp = $link->nodeValue;
			}
			else if ($temp)
			{
				$dept[] = array('id' => $temp, 'desc' => $link->nodeValue);
			}
		}

		// Don't really know what to do with it yet.
		echo '<pre>';
		echo var_dump($dept);
		echo '</pre>';
	}

	function crawl_class($semester = '15SP', $department)
	{
    $department = 'CS';
		$url = 'http://schedule.bradley.edu/scripts/schedule.dll?s='.$semester.'&d='.$department;
		$classes = array();
		$temp = '';

		$dom = new DOMDocument('1.0');
		$dom->loadHTMLFile($url);
		$a = new DOMXPath($dom);

		$raw_data = $a -> query("//*[contains(concat(' ', normalize-space(@class), ' '), ' course ')]");
		$temp = [];
    // get course info
    for ($n = 0; $n < $raw_data->length; $n++)
    {
      $temp[] = $raw_data->item($n)->nodeValue;
    }
    //for ($i = 0; $i < $temp->length; $i++)
    //{
      echo var_dump($temp[0]) . "<br>";
      echo var_dump( preg_split("/^.{2}/", $temp[0]) );
    //}
    
    echo '<pre>';
    echo var_dump($temp);
			/*
			if ( strlen($link->nodeValue) == 3 )
			{
				$temp = $link->nodeValue;
			}
			else if ($temp)
			{
				$dept[] = array('id' => $temp, 'desc' => $link->nodeValue);
			}
		}

		// Don't really know what to do with it yet.
		echo '<pre>';
		echo var_dump($dept);
		echo '</pre>';
		*/
	}
?>
