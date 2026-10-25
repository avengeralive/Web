<?php

/**
 * Класс письма для рассылки
 * Особенность в том, что добавляет header отписок, ссылку отписки и картинку 1х1 для уведомления о прочтении
 * 
 */
class Mailing_Letter_Spam extends Mailing_Letter {

    protected $tpl = '';
    protected $mailing_id = 0;

    public function setHtml($html) {
// парсим ссылки и заменяем на свои
        $index = 1;
        $host = Registry::get('di')->site['api-host'];
        $mid = $this->mailing_id;
        $html = preg_replace_callback("/href=\"(.*?)\"/ismu", function( $r ) use (&$index, $host, $mid) {
            $vars = [];
            $vars['mid'] = $mid;
            $vars['linkid'] = $index++;
            $vars['link'] = $r[1];
            $vars['hash'] = substr(md5($r[1] . "keykey"), 0, 6);
            return 'href="' . $host . 'mailing/link/?' . http_build_query($vars) . '"';
        }, $html);

        $this->tpl = $html;
        return parent::setHtml($html);
    }

    public function setMailingId($id) {
        $this->mailing_id = $id;
        return $this;
    }

    public function ready() {

        $host = Registry::get('di')->site['api-host'];
        $this->resetHeaders();
        $this->setCustomHeader('List-Unsubscribe', '<' . $host . 'mailing/unsubscribe/?mid=' . $this->mailing_id . '&email=' . urlencode($this->to_email) . '&hash=' . md5($this->to_email . 'keykey') . '>');
        $this->html = $this->tpl;
        parent::setHtml($this->tpl);
        $this->html .= '<br><br><center><small><a href="' . $host . 'mailing/unsubscribe/?text&mid=' . $this->mailing_id . '&email=' . urlencode($this->to_email) . '&hash=' . md5($this->to_email . 'keykey') . '">Отписаться от рассылки</a>';
        $this->html .= '<br><img width=1 height=1 src="' . $host . 'mailing/track/?text&mid=' . $this->mailing_id . '&email=' . urlencode($this->to_email) . '&hash=' . md5($this->to_email . 'keykey') . '">';
    }

}
