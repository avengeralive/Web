<?php

class Utils_Phones {

    /**
     * @assert ('79265554477') == 'RU'
     * @assert ('789265554477') == 'RU'
     * @assert ('73265554477') == 'RU'
     * @assert ('89235554477') == 'RU'
     * @assert ('9225554477') == 'RU'
     * 
     * @assert ('77265554477') == 'KZ'
     * 
     * @assert ('87265554477') == 'KZ'
     * @assert ('877265554477') == 'KZ'
     * @assert ('876265554477') == 'KZ'
     * 
     * @assert ('77751098593') == 'KZ'
     * @assert ('76265554477') == 'KZ'
     * 
     * @assert ('380633125477') == 'UA'
     * @assert ('30633125477') == 'UA'
     * @assert ('0633125477') == 'UA'
     * @assert ('0633145122') == 'UA'
     * 
     */
    public static function getCountryCodeByPhone($phone) {
	if (preg_match("/^996/", $phone)) {
            return 'KG';
        }

        if (preg_match("/^(76|77)\d{9}/", $phone)) {
            return 'KZ';
        }
        if (preg_match("/^(87)\d{9}/", $phone)) {
            return 'KZ';
        }
        if (preg_match("/^38\d{10}/", $phone)) {
            return 'UA';
        }
        if (preg_match("/^0\d{9}/", $phone)) {
            return 'UA';
        }
        if (preg_match("/^78\d{10}/", $phone)) {
            return 'RU';
        }
        if (preg_match("/^7\d{10}/", $phone)) {
            return 'RU';
        }
        if (preg_match("/^8\d{10}/", $phone)) {
            return 'RU';
        }
        if (preg_match("/^9\d{9}/", $phone) && !preg_match("/^99/", $phone)) {
            return 'RU';
        }
        return false;
    }

    /**
     * @assert ('RU','79265554477') == '79265554477'
     * @assert ('RU','789265554477') == '79265554477'
     * @assert ('RU','73265554477') == '73265554477'
     * @assert ('RU','89235554477') == '79235554477'
     * @assert ('RU','9225554477') == '79225554477'
     * 
     * @assert ('KZ','77265554477') == '77265554477'
     * @assert ('KZ','76265554477') == '76265554477'
     * 
     * @assert ('KZ','87265554477') == '77265554477'
     * @assert ('KZ','877265554477') == '77265554477'
     * @assert ('KZ','876265554477') == '76265554477'
     * 
     * @assert ('UA','380633125477') == '380633125477'
     * @assert ('UA','30633125477') == '380633125477'
     * @assert ('UA','0633125477') == '380633125477'
     * @assert ('UA','0633145122') == '380633145122'
     * 
     */
    public static function formatPhoneByCountry($country, $phone) {
        $phone = preg_replace("/[^0-9]/", '', $phone);
        if( $country=='KG') return $phone;

        if ($country == 'RU') {
            if (preg_match("/^79\d{9}$/", $phone)) {
                return $phone;
            }
            if (preg_match("/^78\d{10}$/", $phone)) {
                return preg_replace("/^78/", "7", $phone);
            }
            if (preg_match("/^7\d{10}$/", $phone)) {
                return $phone;
            }
            if (preg_match("/^8\d{10}$/", $phone)) {
                return preg_replace("/^8/", "7", $phone);
            }
            if (preg_match("/^9\d{9}$/", $phone) && !preg_match("/^99/", $phone)) {
                return '7' . $phone;
            }
            return false;
        }
        if ($country == 'UA') {
            if (preg_match("/^38\d{10}$/", $phone)) {
                return $phone;
            }
            if (preg_match("/^30\d{9}$/", $phone)) {
                return preg_replace("/^30/", "380", $phone);
            }
            if (preg_match("/^0\d{9}$/", $phone)) {
                return "38" . $phone;
            }
            return false;
        }
        if ($country == 'KZ') {
            if (preg_match("/^87\d{9}$/", $phone)) {
                return preg_replace('/^87/','77', $phone);
            }
            if (preg_match("/^87\d{10}$/", $phone)) {
                return preg_replace('/^87/','7', $phone);
            }
            if (preg_match("/^(77|76)\d{9}$/", $phone)) {
                return $phone;
            }
            return false;
        }
        return $phone;
    }

}
