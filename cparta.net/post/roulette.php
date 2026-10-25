<?php
@session_start();

include dirname(__FILE__) . '/../includes/config.php';
include dirname(__FILE__) . '/../includes/auth/index.php';

if (!isset($user_id)){
    Header ('Location: /');	
    exit;
}

$user = User::getById($user_id);

if(!$user){
    Header ('Location: /');	
    exit;
}

$post = new Request($_POST);

if($user->roulette_keys > 0){
    
    $keys = $user->roulette_keys - 1;
    $user->update([
        'roulette_keys' => $keys
    ]);
    
    $items = array(1 => 0.001, 2 => 0.05, 3 => 0.4, 4 => 10, 5 => 20, 6 => 50);

    
    $priz = roulette($items);

    switch($priz){
        case 1:
            $pp = 0;
            break;
        case 2:
            $pp = 20;
            break;
        case 3:
            $pp = 40;
            break;
        case 4:
            $pp = 60;
            break;
        case 5:
            $pp = 80;
            break;
        case 6:
            $pp = 100;
            break;
    }
    
    $Roulette = new Roulette();
    $Roulette->user_id = $user->id;
    $Roulette->priz = $priz;
    $Roulette->status = 0;
    $Roulette->create();
    
    $response = array(
        "priz" => $pp,
        "keys" => $keys,
    );
    print json_encode($response);
    
}else{
    Header ('Location: /');	
    exit;
}



function numberOfDecimals($value)
{
    if ((int)$value == $value)
    {
        return 0;
    }
    else if (! is_numeric($value))
    {
        // throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
        return false;
    }

    return strlen($value) - strrpos($value, '.') - 1;
}

function roulette($items)
{
  $sumOfPercents = 0;
  foreach($items as $itemsPercent)
  {
    $sumOfPercents += $itemsPercent;
  }

  $decimals = numberOfDecimals($sumOfPercents);
  $multiplier = 1;
  for ($i=0; $i < $decimals; $i++) 
  { 
    $multiplier *= 10;
  }

    $sumOfPercents *= $multiplier;
  $rand = rand(1, $sumOfPercents);
  //echo "max percent = {$sumOfPercents}\n";
  //echo "rand = $rand\n";
  
  $rangeStart = 1;
  foreach($items as $itemKey => $itemsPercent)
  {
    $rangeFinish = $rangeStart + ($itemsPercent * $multiplier);
    //echo "$itemKey in [$rangeStart, $rangeFinish]\n";
    if($rand >= $rangeStart && $rand <= $rangeFinish)
    {
      return $itemKey;
    }

    $rangeStart = $rangeFinish + 1;
  }

}