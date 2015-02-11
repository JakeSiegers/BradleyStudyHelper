<?php
  function crawl_dept($url = 'http://schedule.bradley.edu/scripts/schedule.dll?s=15SP')
  {
    $dept = array();
    $temp = '';

    $dom = new DOMDocument('1.0');
    @$dom->loadHTMLFile($url);

    $raw_data = $dom->getElementsByTagName('a');
    foreach($raw_data as $link)
    {
      /**
       * Takes 3 letter code of department and description that follows,
       * puts them in correct arrays
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
?>
