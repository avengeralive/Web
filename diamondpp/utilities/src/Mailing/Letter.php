<?php

class Mailing_Letter {

    protected $to_email;
    protected $to_name;
    protected $subject;
    protected $html;
    protected $from_email;
    protected $from_name;
    protected $headers = [];

    public function setCustomHeader($name, $value) {
        $this->headers[$name] = $value;
        return $this;
    }

    public function resetHeaders() {
        $this->headers = [];
        return $this;
    }

    public function getHeaders() {
        return $this->headers;
    }

    /**
     * Подготавливает письмо, если нужно
     * @return boolean
     */
    public function ready() {
        return true;
    }

    public function setTo($to, $name = false) {
        $this->to_email = $to;
        if ($name) {
            $this->to_name = $name;
        }
        return $this;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function setHtml($html) {
        
        $tpl = "
            <html>
<Head>
	<link href=\"https://fonts.googleapis.com/css?family=Roboto:400,700\" rel=\"stylesheet\">
	
	<style>
			body{ margin:0;padding:0}
			table td{ font-family: 'Roboto', sans-serif;}
			.title{
				font-size: 150%;
				font-weight: bold;
				color: #fff;
				border-left: 7px solid #fff;
				padding-left: 30px;
			}
			@media (max-width: 800px){
				table{
					width: 100%;
				}
			}         
	</style>
	</head>
	<body>
		<table width=100% cellpadding=0 cellspacing=0>
			<tr>
				
			</tr>
			<Tr>
				<td class=bg>
					<Br><br>
					<table width=700 align=center cellpadding=20 cellspacing=0 style=\"background: url('https:///templates/default/img/bg_send.png') no-repeat center top;    background-size: 100% 60%;\">
						<TR>	
							<Td style= \"background:rgba(35, 39, 50, 0.75);\">
								<table width=700 align=center cellpadding=0>
									<Tr>
										<td align=left><img height=\"30px\" src=\"https:///templates/default/img/Logo@2x.png\" alt=\"logo\"></td>
										<td align=right style=\"padding-top:8px;\">
											<a href=\"https://vk.com/yescpa\"><img height=\"30px\" src=\"https:///templates/default/img/vk1.png\"></a>
											<a href=\"\"><img height=\"30px\" src=\"https:///templates/default/img/facebook1.png\"></a>
											<a href=\"\"><img height=\"30px\" src=\"https:///templates/default/img/telegram1.png\"></a>
											<a href=\"\"><img height=\"30px\" src=\"https:///templates/default/img/insta1.png\"></a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<Tr>
							<td>
							<table width=700 cellpadding=0 style=\"margin-top:30px;\">
							<Tr>
							<td  class=title>
							".$this->subject."
							</td>
							</tr>
							</table>
							</td>
						</tr>
						<tr>
							<td>
							<table width=700 align=center cellpadding=0 style=\"margin-top:15px;\">
							<Tr>
							<td style=\"-webkit-box-shadow: 0px 2px 20px 1px rgba(0,0,0,0.75);-moz-box-shadow: 0px 2px 20px 1px rgba(0,0,0,0.75);box-shadow: 0px 2px 20px 1px rgba(0,0,0,0.75);padding: 25px;background: #fff;\" cellpadding=40>
								$html
							</td>
							</tr>
							</table>
							</td>
						</tr>
					</table>	
					<table width=750 align=center cellpadding=0 cellspacing=0 style=\"margin-top:30px;\">	
						<TR>	
							<Td>
								<table width=800 align=center cellpadding=20>
									<Tr>
										<td align=center><img height=\"30px\" src=\"https:///templates/default/img/Logo footer.png\" alt=\"logo\"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<Br><BR>
				</td>
			</tr>
		</table>
	
        ";
        $this->html = $tpl;
        return $this;
       
    }

    public function getToEmail() {
        return $this->to_email;
    }

    public function getToName() {
        return $this->to_name;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getHtml() {
        return $this->html;
    }

    public function getFromName() {
        return $this->from_name;
    }

    public function getFromEmail() {
        return $this->from_email;
    }

}
