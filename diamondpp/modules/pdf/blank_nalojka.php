<?php

	set_include_path('modules/pdf/');
    require "Zend/Pdf.php";    
	$pdfNew = new Zend_Pdf();
	$pdf1 = Zend_Pdf::load("modules/pdf/tpl.pdf");
	$pdf2  = Zend_Pdf::load("modules/pdf/7.pdf");
	
	$font = Zend_Pdf_Font::fontWithPath("modules/pdf/Arial.ttf");
	$fontPechkin = Zend_Pdf_Font::fontWithPath("modules/pdf/PostIndex.ttf");
	//$fontPechkin = Zend_Pdf_Font::fontWithPath("PostIndex_Bold.ttf");
    
    $style = new Zend_Pdf_Style();
    $style->setLineColor(new Zend_Pdf_Color_Rgb(0,0,0));
    $style->setFont($font, 12);
    
    $styleBig = new Zend_Pdf_Style();
    $styleBig->setLineColor(new Zend_Pdf_Color_Rgb(0,0,0));
    $styleBig->setFont($font, 32);
	
	$styleIndex= new Zend_Pdf_Style();
    $styleIndex->setLineColor(new Zend_Pdf_Color_Rgb(0,0,0));
    $styleIndex->setFont($font, 18);
	
	$stylePechkin = new Zend_Pdf_Style();
    $stylePechkin->setLineColor(new Zend_Pdf_Color_Rgb(0,0,0));
    $stylePechkin->setFont($fontPechkin, 46);
	
	$style6 = new Zend_Pdf_Style();
    $style6->setLineColor(new Zend_Pdf_Color_Rgb(0,0,0));
    $style6->setFont($font, 8);
	
	$style10 = new Zend_Pdf_Style();
    $style10->setLineColor(new Zend_Pdf_Color_Rgb(0,0,0));
    $style10->setFont($font, 9);
	
    $pdfMerged = new Zend_Pdf();
	foreach($pdf1->pages as $page){
	  $clonedPage = clone $page;
	  $pdfMerged->pages[] = $clonedPage;
	}
	foreach($pdf2->pages as $page){
	  $clonedPage = clone $page;
	  $pdfMerged->pages[] = $clonedPage;
	}
	
	$page = $pdfMerged->pages[0];
    $page->setStyle($style);
	 
	$page1 = $pdfMerged->pages[1];
    $page1->setStyle($style10);
    
    // Отправитель
	// Sender
    fillSender($page, $page1, $styleIndex);
	
	// Адресат
	// Destination
    fillReceiver($page, $page1, $stylePechkin, $style6, $style10, $styleIndex);
    
    // Сумма
	// Sum
    fillSum($page, $page1);
    
    // Банковские реквизиты
	// Bank details
    fillBank($page);

    // Прочее (сообщение, галочки)
	// Other (message, tick)
	$page1->setStyle($style);
    fillAdd($page, $styleBig, $page1); 
	
	$page1->setFillColor(new Zend_Pdf_Color_Html("#141794"));
	$page1->setLineColor(new Zend_Pdf_Color_Html("#141794"));
	$page1->drawRectangle(144-25, 520-2, 163-25, 525-2);
	$page1->drawRectangle(144-25, 515-2, 163-25, 516-2);
	$page1->drawRectangle(144, 520-2, 163, 525-2);
	$page1->drawRectangle(144+26, 520-2, 163+26, 525-2);
	$page1->drawRectangle(144+51, 520-2, 163+51, 525-2);
	$page1->drawRectangle(144+77, 520-2, 163+77, 525-2);
	$page1->drawRectangle(144+102, 520-2, 163+102, 525-2);
	$page1->drawRectangle(144+127, 520-2, 163+127, 525-2);
	
	unset($clonedPage);
	header("Content-type: application/pdf");
	echo $pdfMerged->render();
	
		/**
	 * Разбивка строки на несколько по словам
	 * A breakdown of the line for a few words on
	 * @param string $str Исходная строка
	 * @param integer $wrapLimit Наибольшая длина строки // Maximum length of the string
	 * @return array
	 */
	function getLines($str, $wrapLimit)
	{
		$linesStr = wordwrap($str, $wrapLimit);
		return explode("\n", $linesStr);
	}

	/**
	 * Побуквенная печать строки
	 * Literal strings print
	 * @param Zend_Pdf_Page $page Пдф страница, на которую выводить // PDF-page, which displays
	 * @param string $str Строка вывода // output string
	 * @param integer $step Шаг между символами // Step between characters
	 * @param integer $x Координата Х // The x coordinate
	 * @param integers $y Координата Y // The y coordinate
	 */
	function printByChars(&$page, $str, $step, $x, $y)
	{
		$len = mb_strlen($str);

		for ($i = 0; $i <= $len; $i++) {
			$page->drawText(mb_substr($str, $i, 1, "UTF-8"), $x, $y, "UTF-8");
			$x += $step;
		}
	}

	/*
	 * Формирует строку адреса
	 * Generates a string address
	 */
	function getAddressLines($prefix, $wraplen)
	{
		$receiverCountry = filter_input(INPUT_POST, $prefix . "country");
		$receiverDistrict = filter_input(INPUT_POST, $prefix . "district");
		$receiverCity = filter_input(INPUT_POST, $prefix . "city");
		$receiverStreet = filter_input(INPUT_POST, $prefix . "street");
		$receiverBuilding = filter_input(INPUT_POST, $prefix . "building");
		$receiverFlat = filter_input(INPUT_POST, $prefix . "flat");
		
		$where = ($receiverCountry ? $receiverCountry . ", " : "") 
				. ( $receiverDistrict ? $receiverDistrict . ", " : "" ) 
				. ($receiverCity ? $receiverCity . ", " : "")
				. ($receiverStreet ? $receiverStreet . ", " : "")
				. ($receiverBuilding ? "д. " . $receiverBuilding . ", " : "")
				. ($receiverFlat ? " кв. " . $receiverFlat : "")
			;
		
		return getLines($where, $wraplen);
	}

	function fillAdd(&$page, $styleBig, &$page1)
	{
		$messageLines = getLines(filter_input(INPUT_POST, "message"), 60);
		
		// Сообщение
		// Message
		printByChars($page, $messageLines[0], 13.9, 95, $page->getHeight() - 293);
		
		if(!empty($messageLines[1])) {
			// Вторая строка сообщения
			// The second line of the message
			printByChars($page, $messageLines[1], 13.9, 95, $page->getHeight() - 315);
		}

		$chbDelivery = filter_input(INPUT_POST, "chb_home_delivery");
		$chbNotice = filter_input(INPUT_POST, "chb_notice");
		$chbPayAtDelivery = filter_input(INPUT_POST, "chb_pay_deliv");
		
		if ($chbDelivery) {
			// Доставка на дом
			// Home delivery
			$page->drawText("x", 164, ($page->getHeight()-190), "UTF-8");
		}
		
		if ($chbNotice) {
			// С уведомлением
			// With Notify
			$page->drawText("x", 164, ($page->getHeight()-208), "UTF-8");
			$page1->drawText("x", 12+269, 400+303, "UTF-8");
		}

		// Установка большого шрифта
		// Set large font
		$page->setStyle($styleBig);
		
		if ($chbPayAtDelivery) {
			// Наложенный платёж
			// Cash on delivery
			$page->drawText("x", 24, ($page->getHeight()-207), "UTF-8");
			$page1->drawText("x", 50+289, 400+320, "UTF-8");
		}
	}

	/*
	 * Банковские реквизиты
	 * Bank details
	 */
	function fillBank(&$page)
	{
		$orgInn = filter_input(INPUT_POST, "org_inn");
		printByChars($page, $orgInn, 14, 57, $page->getHeight() - 346);
		$orgKs = filter_input(INPUT_POST, "org_ks");
		printByChars($page, $orgKs, 14, 303, $page->getHeight() - 346);
		$orgRs = filter_input(INPUT_POST, "org_rs");
		printByChars($page, $orgRs, 14, 78, $page->getHeight() - 381);
		$orgBik = filter_input(INPUT_POST, "org_bik");
		printByChars($page, $orgBik, 14, 457, $page->getHeight() - 381);
		
		$bankName = filter_input(INPUT_POST, "org_bank");
		$page->drawText($bankName, 145, ($page->getHeight()-363), "UTF-8");
	}

	/*
	 * Вывод суммы 
	 * Displays the amount
	 */
	function fillSum(&$page, &$page1)
	{
		$sum = str_replace(",", ".", filter_input(INPUT_POST, "sum"));
		
		if (strpos($sum, ".") !== false) {
			list($sum1, $sum2) = explode(".", $sum);
			if($sum2 == "0")
				$sum2 = "00";
		} else {
			$sum1 = $sum;
			$sum2 = "00";
		}
		
		// Рубли
		// Rubles
		$page->drawText($sum1, 30, ($page->getHeight()-179), "UTF-8");
		
		// Копейки
		// Kopeika
		$page->drawText($sum2, 105, ($page->getHeight()-179), "UTF-8");
		
		$summain =$sum1." " . morph("32300", "рубль", "рубля", "рублей")." ". $sum2." " . morph("35", "копейка", "копейки", "копеек");
		$page1->drawText($summain, 63+235, 420+253, "UTF-8");
		$page1->drawText($summain, 63+235, 420+225, "UTF-8");
		
		// Прописью
		// in words
		$sumStrMore = num2str($sum1, true) . " " . morph($sum1, "рубль", "рубля", "рублей");
		
		if ($sum2 > 0) {
			$sumStrMore .= " " . $sum2 . " " . morph($sum2, "копейка", "копейки", "копеек");
		}
		
		$page->drawText($sumStrMore, 164, ($page->getHeight()-163), "UTF-8");
	}

	/*
	 * Отправитель
	 * Sender
	 */

	function fillSender(&$page, &$page1, &$styleIndex)
	{
		// От кого
		// From whom
		$senderWhom = filter_input(INPUT_POST, "sender_whom");
		$page->drawText($senderWhom, 70, ($page->getHeight()-400), "UTF-8");
		$whomtoline = getLines($senderWhom ,55);
		$page1->drawText($whomtoline[0], 63+90, 420+258, "UTF-8");
		if (!empty($whomtoline[1])) {
			$page1->drawText($whomtoline[1], 63+53, 420+242, "UTF-8");
		}	
		// Обратный адрес
		// Return address
		$senderWhereLines = getAddressLines("sender_", 130);
		$page->drawText($senderWhereLines[0], 135, ($page->getHeight()-420), "UTF-8");	
		if(count($senderWhereLines) > 1) {
			$wheretoline = getLines($senderWhereLines[0].$senderWhereLines[1], 55);
		} else {
			$wheretoline = getLines($senderWhereLines[0], 60);
		}
		if (!empty($wheretoline[0])) 
			$page1->drawText($wheretoline[0], 63+90, 420+224, "UTF-8");
		if (!empty($wheretoline[1])) 
			$page1->drawText($wheretoline[1], 63+53, 420+208, "UTF-8");
		if (!empty($wheretoline[2])) 
			$page1->drawText($wheretoline[2], 63+53, 420+190, "UTF-8");

		if (!empty($senderWhereLines[1])) {
			// Вторая строка обратного адреса
			// The second line of the return address
			$page->drawText($senderWhereLines[1], 20, ($page->getHeight()-440), "UTF-8");
		}

		// Индекс
		// Index
		$senderZip = substr(filter_input(INPUT_POST, "sender_zip"), 0, 6);
		printByChars($page, $senderZip, 14.5, 495, $page->getHeight()-438);
		$page1->setStyle($styleIndex);
		printByChars($page1, $senderZip, 14.5, 63+141, 420+172);

		// Телефон
		// Phone
		$senderPhone = preg_replace("/[\D]/", "", filter_input(INPUT_POST, "sender_phone"));
		printByChars($page, $senderPhone, 12, 462, $page->getHeight()-210);
	}

	/*
	 * Адресат
	 * Destination
	 */
	function fillReceiver(&$page, &$page1, &$stylePechkin, &$style6, &$style10, &$styleIndex)
	{
		// Кому
		// This
		$receiverWhom = filter_input(INPUT_POST, "reciever_whom");
		$page->drawText($receiverWhom, 52, ($page->getHeight()-230), "UTF-8");
		$page1->setStyle($style10);
		$towhomtoline = getLines($receiverWhom , 60);
		if (!empty($towhomtoline[0])) 
			$page1->drawText($towhomtoline[0], 63+270, 420+194, "UTF-8");
		if (!empty($towhomtoline[1])) 
			$page1->drawText($towhomtoline[1], 63+246, 420+175, "UTF-8");
		
		// Куда
		// Where
		$receiverWhereLines = getAddressLines("reciever_", 150);
		$page->drawText($receiverWhereLines[0], 50, ($page->getHeight()-250), "UTF-8");
		if(count($receiverWhereLines) > 1) {
			$towheretoline = getLines($receiverWhereLines[0].$receiverWhereLines[1], 60);
		} else {
			$towheretoline = getLines($receiverWhereLines[0], 60);
		}
		if (!empty($towheretoline[0])) 
			$page1->drawText($towheretoline[0], 63+270, 420+155, "UTF-8");
		if (!empty($towheretoline[1])) 
			$page1->drawText($towheretoline[1], 63+246, 420+139, "UTF-8");
		if (!empty($towheretoline[2])) 
			$page1->drawText($towheretoline[2], 63+246, 420+122, "UTF-8");
		
		if (!empty($receiverWhereLines[1])) {
			// Вторая строка адреса
			// The second line of the address
			$page->drawText($receiverWhereLines[1], 20, ($page->getHeight()-270), "UTF-8");
		}
		
		// Индекс
		// Index
		$receiverZip = substr(filter_input(INPUT_POST, "reciever_zip"), 0, 6);
		printByChars($page, $receiverZip, 14.5, 495, $page->getHeight()-269);
		$page1->setStyle($styleIndex);
		printByChars($page1, $receiverZip, 14.5, 63+369, 420+120);
		$page1->setStyle($stylePechkin);
		printByChars($page1, $receiverZip, 25.5, 63+78, 420+65);

		// Телефон
		// Phone
		$receiverPhone = preg_replace("/[\D]/", "", filter_input(INPUT_POST, "reciever_phone"));
		printByChars($page, $receiverPhone, 12, 462, $page->getHeight()-191);   

		// Сумма прописью
		// Suma in cuirsive
		$sum = str_replace(",", ".", filter_input(INPUT_POST, "sum"));		
		$kopnull = " ноль копеек";
		if (strpos($sum, ".") !== false) {
			list($sum1, $sum2) = explode(".", $sum);
			if($sum2 != "0" || $sum2 != "00") {
				$str = num2str($sum1+($sum2)/100);
			} else {
				$sum2 =$kopnull;
				$str = num2str($sum).$sum2;
			}
		} else {
			$sum1 = $sum;
			$sum2 = $kopnull;
			$str = num2str($sum).$sum2;
		}
		$page1->setStyle($style6);
		
		$summainstr = getLines($str , 100);
		if(count($summainstr) == 1) 
			$summainstr[0] = $summainstr[0].")";
		else 
			$summainstr[1] = $summainstr[1].")";
		$page1->drawText("(".$summainstr[0], 63+235, 420+245, "UTF-8");
		if (!empty($summainstr[1])) 
			$page1->drawText($summainstr[1], 63+235, 420+237, "UTF-8");
		$page1->drawText("(".$summainstr[0], 63+235, 420+217, "UTF-8");
		if (!empty($summainstr[1])) 
			$page1->drawText($summainstr[1], 63+235, 420+209, "UTF-8");
	}

	/**
	 * Возвращает сумму прописью
	 * Returns the amount of words
	 * @uses morph(...)
	 */
	function num2str($num, $sumOnly=false) {
		$nul='ноль';
		$ten=array(
			array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
			array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
		);
		$a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
		$tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
		$hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
		$unit=array( // Units
			array('копейка' ,'копейки' ,'копеек',	 1),
			array('рубль'   ,'рубля'   ,'рублей'    ,0),
			array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
			array('миллион' ,'миллиона','миллионов' ,0),
			array('миллиард','милиарда','миллиардов',0),
		);
		//
		list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
		$out = array();
		if (intval($rub)>0) {
			foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
				if (!intval($v)) continue;
				$uk = sizeof($unit)-$uk-1; // unit key
				$gender = $unit[$uk][3];
				list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
				// mega-logic
				$out[] = $hundred[$i1]; # 1xx-9xx
				if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
				else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
				// units without rub & kop
				if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
			} //foreach
		}
		else $out[] = $nul;

		if(!$sumOnly) {
			$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
			if ($kop != "00")
				$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
		}
		
		return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
	}

	/**
	 * Склоняем словоформу
	 * bow wordform
	 */
	function morph($n, $f1, $f2, $f5) {
		$n = abs(intval($n)) % 100;
		if ($n>10 && $n<20) return $f5;
		$n = $n % 10;
		if ($n>1 && $n<5) return $f2;
		if ($n==1) return $f1;
		return $f5;
	}
	
?>



