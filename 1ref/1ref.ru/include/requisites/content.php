<style>
h1 {
  font-size: 24px;
}

.payment-systems,
.verify-systems {
  margin-bottom: -10px;
}

.payment-systems img,
.verify-systems img {
  height: 80px;
  max-width: 180px;
  vertical-align: middle;
  margin: 0 30px 10px;
  width: 100%;
}

.bank-logo {
  width: 300px;
  max-height: 100px;
  height: 100%;
}

.contact-info-table .cell {
  display: inline-block;
  padding: 2px 0;
}

.contact-info-table .cell:first-child {
  font-weight: bold;
  margin-right: 10px;
}

.contact-info-table .cell {
  word-break: break-word;
}

.payment-head {
  display: flex;
  align-items: center;
}

.payment-head__image {
  margin: 0 0 0 40px;
}


@media screen and (max-width: 800px) {
  .payment-systems img,
  .verify-systems img {
    height: 50px;
    max-width: 100px;
    margin: 0 18px 10px;
  }

  .bank-logo {
    width: 200px;
    max-height: 100px;
    height: 100%;
  }
}

@media screen and (max-width: 450px) {
  .payment-systems img,
  .verify-systems img {
    height: 30px;
    max-width: 60px;
    margin: 0 15px 10px;
  }

  .contact-info-table .cell {
    display: block;
  }

  .contact-info-table .row + .row {
    margin-top: 5px;
  }

  .payment-head__image {
    margin: 0 0 0 20px;
  }

  .bank-logo {
    width: 100px;
    max-height: 100px;
  }
}
</style>
<div class="content">
	<div class="payment-info">
		<h1 data-lang="paymentInfo.title">Правила оплаты и безопасность платежей, конфиденциальность информации</h1>
		<div class="payment-head">
			<div class="payment-head__title">
				<p data-lang="bankInfo">
					 Оплата банковскими картами осуществляется через Альфа-Банк
				</p>
				<p data-lang="paymentSystems">
					 К оплате принимаются карты Visa, MasterCard и платежной системы МИР.
				</p>
			</div>
			<p class="payment-head__image">
 <img alt="Логотип банка" src="https://pay.alfabank.ru/payment/bank-info/logo.svg" class="bank-logo" data-lang="bankInfo.logo">
			</p>
		</div>
		<p class="payment-systems">
 <img alt="Visa Inc." src="https://pay.alfabank.ru/payment/modules/payment-systems/img/logo-visa.svg" class="visa" title="Visa Inc."> <img alt="Mastercard" src="https://pay.alfabank.ru/payment/modules/payment-systems/img/logo-mastercard.svg" class="mastercard" title="Mastercard"> <img alt="MIR" src="https://pay.alfabank.ru/payment/modules/payment-systems/img/logo-mir.svg" class="mir" title="MIR">
		</p>
		<p data-lang="paymentSystems.info1">
			 Услуга оплаты через интернет осуществляется в соответствии с Правилами международных платежных систем Visa, MasterCard и платежной системы МИР на принципах соблюдения конфиденциальности и безопасности совершения платежа, для чего используются самые современные методы проверки, шифрования и передачи данных по закрытым каналам связи. Ввод данных банковской карты осуществляется на защищенной платежной странице Альфа-Банк.
		</p>
		<p data-lang="paymentSystems.info2">
			 На странице для ввода данных банковской карты потребуется ввести <strong>данные банковской карты</strong>: номер карты, имя владельца карты, срок действия карты, трёхзначный код безопасности (CVV2 для VISA, CVC2 для MasterCard, код дополнительной идентификации для МИР). Все необходимые данные пропечатаны на самой карте. Трёхзначный код безопасности — это три цифры, находящиеся на обратной стороне карты.
		</p>
		<p data-lang="paymentSystems.info3">
			 Далее вы будете перенаправлены на страницу Вашего банка для ввода кода безопасности, который придет к Вам в СМС. Если код безопасности к Вам не пришел, то следует обратиться в банк выдавший Вам карту.
		</p>
		<p class="verify-systems">
 <img alt="Visa Secure" src="https://pay.alfabank.ru/payment/modules/payment-systems/img/verify-visa_tds.svg" class="visa_tds" title="Visa Secure"> <img alt="Mastercard Identity Check" src="https://pay.alfabank.ru/payment/modules/payment-systems/img/verify-mastercard_tds.svg" class="mastercard_tds" title="Mastercard Identity Check"> <img alt="Mir Accept" src="https://pay.alfabank.ru/payment/modules/payment-systems/img/verify-mir_tds.svg?v=20190626" class="mir_tds" title="Mir Accept">
		</p>
		<p data-lang="refusalOfPayment1">
			 Случаи отказа в совершении платежа:
		</p>
		<ul>
			<li data-lang="refusalOfPaymentList1">банковская карта не предназначена для совершения платежей через интернет, о чем можно узнать, обратившись в Ваш Банк;</li>
			<li data-lang="refusalOfPaymentList2">недостаточно средств для оплаты на банковской карте. Подробнее о наличии средств на банковской карте Вы можете узнать, обратившись в банк, выпустивший банковскую карту;</li>
			<li data-lang="refusalOfPaymentList3">данные банковской карты введены неверно;</li>
			<li data-lang="refusalOfPaymentList4">истек срок действия банковской карты. Срок действия карты, как правило, указан на лицевой стороне карты (это месяц и год, до которого действительна карта). Подробнее о сроке действия карты Вы можете узнать, обратившись в банк, выпустивший банковскую карту;</li>
		</ul>
		<p data-lang="refusalOfPayment2">
			 По вопросам оплаты с помощью банковской карты и иным вопросам, связанным с работой сайта, Вы можете обращаться по следующим телефонам: 89031304014.
		</p>
		<p data-lang="refusalOfPayment3">
			 Предоставляемая вами персональная информация (имя, адрес, телефон, e-mail, номер банковской карты) является конфиденциальной и не подлежит разглашению. Данные вашей кредитной карты передаются только в зашифрованном виде и не сохраняются на нашем Web-сервере.
		</p>
	</div>
	<div class="refund">
		<h1 data-lang="refund.title">Правила возврата товара</h1>
		<p data-lang="refund1">
			 При оплате картами возврат наличными денежными средствами не допускается. Порядок возврата регулируется правилами международных платежных систем.
		</p>
		<p data-lang="refund2">
			 Процедура возврата товара регламентируется статьей 26.1 федерального закона «О защите прав потребителей».
		</p>
		<ul>
			<li data-lang="refundList1">Потребитель вправе отказаться от товара в любое время до его передачи, а после передачи товара - в течение семи дней;</li>
			<li data-lang="refundList2">Возврат товара надлежащего качества возможен в случае, если сохранены его товарный вид, потребительские свойства, а также документ, подтверждающий факт и условия покупки указанного товара;</li>
			<li data-lang="refundList3">Потребитель не вправе отказаться от товара надлежащего качества, имеющего индивидуально-определенные свойства, если указанный товар может быть использован исключительно приобретающим его человеком;</li>
			<li data-lang="refundList4">При отказе потребителя от товара продавец должен возвратить ему денежную сумму, уплаченную потребителем по договору, за исключением расходов продавца на доставку от потребителя возвращенного товара, не позднее чем через десять дней со дня предъявления потребителем соответствующего требования;</li>
		</ul>
		<p data-lang="refund4">
			 Для возврата денежных средств на банковскую карту необходимо заполнить «Заявление о возврате денежных средств», которое высылается по требованию компанией на электронный адрес и оправить его вместе с приложением копии паспорта по адресу <a href="mailto:finance@gm-cg.ru">finance@gm-cg.ru</a>
		</p>
		<p data-lang="refund5">
			 Возврат денежных средств будет осуществлен на банковскую карту в течение 21 (двадцати одного) рабочего дня со дня получения «Заявление о возврате денежных средств» Компанией.
		</p>
		<p data-lang="refund6">
			 Для возврата денежных средств по операциям проведенными с ошибками необходимо обратиться с письменным заявлением и приложением копии паспорта и чеков/квитанций, подтверждающих ошибочное списание. Данное заявление необходимо направить по адресу <a href="mailto:finance@gm-cg.ru">finance@gm-cg.ru</a>
		</p>
		<p data-lang="refund7">
			 Сумма возврата будет равняться сумме покупки. Срок рассмотрения Заявления и возврата денежных средств начинает исчисляться с момента получения Компанией Заявления и рассчитывается в рабочих днях без учета праздников/выходных дней.
		</p>
	</div>
	<div class="delivery" style="display:none;">
		<h1 data-lang="delivery">Правила доставки товара</h1>
		<p data-lang="delivery1">
			 Наличие на электронной витрине Интернет-магазина информации по доставке товара (получении работы, услуги), такой, как сроки, способы, а также любой другой информации, необходимой для получения ясного представления о доставке товара (получении работы, услуги) после оплаты с использованием карты.
		</p>
	</div>
	<div class="contact-info">
		<h1 data-lang="contactInfo">Контактная информация</h1>
		<div class="contact-info-wrapper">
			<div class="contact-info-table">
				<div class="row">
					<div class="cell" data-lang="rules_page_merchant_name">
						 Название компании
					</div>
					<div class="cell rules_page_merchant_name">
						 ООО БСО
					</div>
				</div>
				<div class="row">
					<div class="cell merchant_inn_label" data-lang="merchant_inn_short">
						 ИНН
					</div>
					<div class="cell merchant_inn">
						 7724317936
					</div>
				</div>
				<div class="row">
					<div class="cell" data-lang="merchant_ogrn">
						 ОГРН
					</div>
					<div class="cell merchant_ogrn">
						 1157746419082
					</div>
				</div>
				<div class="row">
					<div class="cell" data-lang="merchant_actual_address">
						Юридический адрес
					</div>
					<div class="cell merchant_actual_address">
						 127411, Москва, Дмитровское, 157, 9, 3/122
					</div>
				</div>
				<div class="row">
					<div class="cell" data-lang="merchant_phone">
						 Телефон
					</div>
					<div class="cell merchant_phone">
						 89031304014
					</div>
				</div>
				<div class="row">
					<div class="cell" data-lang="merchant_feedback_email">
						 e-mail
					</div>
					<div class="cell merchant_feedback_email">
 <a href="mailto:finance@bs-opt.ru">finance@bs-opt.ru</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="error" style="display:none;">
		<h1 data-lang="loadingError">Не удалось загрузить информацию</h1>
	</div>
</div>
 <br>