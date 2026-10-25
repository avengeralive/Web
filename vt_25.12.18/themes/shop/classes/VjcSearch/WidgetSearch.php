<?php
namespace VjcSearch;

class WidgetSearch extends \Cetera\Widget\Search
{
  public function getMorphs($in)
  {

    $in = mb_strtoupper($in);
    if ($this->getParam('morphology'))
    {
      $morphy = new \phpMorphy(DOCROOT.LIBRARY_PATH.'/phpmorphy/dicts/', 'ru_RU', array('storage' => PHPMORPHY_STORAGE_FILE));
    //  $res = $morphy->getAllForms($in, \phpMorphy::IGNORE_PREDICT);
        $res = $morphy->getAllForms($in);
    	  if (count($res)==1)
        {
          return array($in);
        }
    }
    return $res;

  }

  public function checkInluding($query, $text)
  {
    $text = mb_strtoupper($text);
    foreach($query as $value)
    {
      $strpos = mb_strpos($text, $value);
      if ($strpos != false)
      {
        return true;
      }
    }
    return false;
  }

  public function markupTextAndCut ($query, $title, $short, $opisanie)
  {

  $text = $title . $short . $opisanie;
  $sentences = preg_split('/(?<=[.?!])\s+(?=[А-Я])/i', $text);
  $newArray = [];
  foreach ($sentences as $keyPredl => $value)
  {
    $str = mb_split(' ',$value);
    $isHaveQuery = false;

    foreach ($str as $keyStr => &$word)
    {
      foreach ($query as $fd)
      {
          if (mb_strtoupper($fd) === mb_strtoupper($word))
          {
            $word = '<b>' . $word . '</b>';
            $isHaveQuery = true;

            if (($keyStr + 5) < count($str))
            {
              $newStr = [];
              for ($i=0; $i<$keyStr + 5; $i++)
              {
                $newStr[] = $str[$i];
              }
              $newStr[] = '...';
              $newArray[] = implode(' ',$newStr);
              break(3);

            }

          }

      }

    }
    if ($isHaveQuery)
    {
      $newArray[] = implode(' ',$str);
      $isHaveQuery = false;
    }


  }

  if (count($newArray)>0)
  {
    if (count($newArray==1))
    {
      $outStr = $title . '... ' . $newArray[0];
      return $outStr;
    }
    return implode(' ',$newArray);
  }
  else {

    $outTitle = $title . '...';
    return $outTitle;
  }


  }

}
