<?php

class Offer_Prelanding extends Entity {

    const TYPE_BEST_SIMPLE_RANDOM = 1;
    const TYPE_BEST_SMART_RANDOM = 2;

    public static function tableName() {
        return 'prelandings';
    }

    public static function getBest($ids, $type = self::TYPE_BEST_SIMPLE_RANDOM) {
        if (!is_array($ids)) {
            return $ids;
        }
        if (count($ids) == 1) {
            return array_pop($ids);
        }
        if ($type == self::TYPE_BEST_SIMPLE_RANDOM) {
            return $ids[array_rand($ids)];
        }
        
        if ($type == self::TYPE_BEST_SMART_RANDOM) {
        
            $sum = "select sum(hits) from prelandings where id in( " . implode(',', array_fill(0, count($ids), '?')) . " )";
            $sum = DB::getInstance()->prepare($sum);
            $sum->execute($ids);
            $sum = $sum->fetchColumn();
            if ($sum == 0)
                $sum = 1;
            
            $sql = "select id from prelandings where id in( " . implode(',', array_fill(0, count($ids), '?')) . " ) order by (amount/if(hits=0,1,hits)+sqrt(2*ln(hits)/$sum )) desc limit 1";
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute($ids);
            return intval($stmt->fetchColumn());
        }
    }

}
