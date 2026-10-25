<?php

class MailingController extends Controller {

    protected $_url = '/mailing.php';

    protected function checkRequest($get) {
        if (!isset($get->email, $get->hash)) {
            return false;
        }
        if (md5($get->email . 'keykey') !== $get->hash) {
            return false;
        }
        return true;
    }

    public function click() {
        $get = new Request($_GET);
        if (!isset($get->linkid, $get->mid, $get->link, $get->hash)) {
            exit;
        }
        if (substr(md5($get->link . "keykey"), 0, 6) !== $get->hash) {
            exit('1');
        }
        $mailing = Mailing::getById($get->mid);
        if (!$mailing) {
            exit;
        }
        $sql = "insert into mailing_links set mailing_id=?, linkid=?, clicks=? on duplicate key update clicks=clicks+1";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute([ $get->mid, $get->linkid, 1]);
        $mailing->update([
            'clicks' => $mailing->clicks + 1,
        ]);
        header("Location:" . $get->link);
        exit;
    }

    public function opened() {
        $get = new Request($_GET);
        if (!$this->checkRequest($get)) {
            exit("bad request");
        }
        $user = User::getByEmail($get->email);
        $mailing = Mailing::getById($get->mid);
        if (!$mailing) {
            exit;
        }
        $md = new Mailing_Userdata;
        $md->user_id = $user->id;
        $md->mailing_id = intval($get->mid);
        $md->action = 'opened';
        if ($md->create()) {
            $mailing->update([
                'opened' => $mailing->opened + 1,
            ]);
        }
    }

    public function unsubscribe() {
        $get = new Request($_GET);
        if (!$this->checkRequest($get)) {
            exit("bad request");
        }

        $user = User::getByEmail($get->email);
        $user->update(['notify' => 0]);
        $mailing = Mailing::getById($get->mid);
        if (!$mailing) {
            exit;
        }
        $md = new Mailing_Userdata;
        $md->user_id = $user->id;
        $md->mailing_id = intval($get->mid);
        $md->action = 'unsubscribe';
        if ($md->create()) {
            $mailing->update([
                'unsubscribe' => $mailing->unsubscribe + 1,
            ]);
        }
        $site = Registry::get('di')->site;

        echo "<style>body{ font-family:Verdana;}</style><center><H4>Вы успешно отписались от рассылок. </h4><br>Перенаправляем на главну...</center><script>setTimeout( function(){ top.location='" . $site['host'] . "';}, 3000)</script>";
        exit;
    }

    public function handleRequest(DI $di = null) {
        $this->di = $di;
        $user = $this->di->user;
        if (!$user) {
            throw new Exception("User required");
        }
        $req = new Request($_REQUEST);
        if (!isset($req->action)) {
            return;
        }

        if( $req->action == 'templates'){
            return ['page' => 'templates'];
        }
        if ($req->action == 'edit') {

            return ['page' => 'index', 'vars' => ['mailing' => Mailing::getById($req->id)]];
        }
        if ($req->action == 'delete') {
            try {
                Mailing::getById($req->id)->delete();
                header("Location:?");
                exit;
            } catch (Exception $ex) {
                
            }
        }
        if ($req->action == 'links') {
            $mailing = Mailing::getById($req->id);
            $body = $mailing->body;
            $index = 1;
            $mid = intval($req->id);
            $body = preg_replace_callback("/href=\"(.*?)\"/", function( $r ) use ($mid, &$index) {
                $sql = "select clicks from mailing_links where mailing_id=" . $mid . " and linkid=" . $index;
                $res = intval(DB::getInstance()->query($sql)->FetchColumn());
                $index++;
                return 'data-stat=' . $res . ' href="' . $r[1] . '"';
            }, $body);
            $ret = [
                'page' => 'stat',
                'vars' => [
                    'mailing' => $mailing,
                    'body' => $body,
                ]
            ];
            return $ret;
        }
        if ($req->action == 'save') {
            if ($req->save == 'test') {
                // test email
                $letter = new Mailing_Letter_Spam();
                $letter->setSubject($req->subject);
                $letter->setTo($req->test);
                $letter->setHtml($req->body);
                $sender_config = $this->di->mailer;


                $sender = Mailing_Sender::factory($sender_config['type'], $sender_config['config']);

                try {
                    $status = intval($sender->send($letter));
                } catch (Exception $e) {
                    $status = 0;
                }

                echo json_encode(['status' => $status]);
                exit;
            }
            // save
            if (!isset($req->id)) {
                // new 
                $mailing = new Mailing;
                $mailing->subject = $req->subject;
                $mailing->created_user_id = $user->id;
                $mailing->create();
            } else {
                $mailing = Mailing::getById($req->id);
            }
            $up = [
                'subject' => $req->subject,
                'body' => $req->body,
                'sendAt' => $req->date,
            ];

            $groups = explode("-", $req->group);
            $up['group_type'] = $groups[0];
            $up['group_id'] = $groups[1];
            $up['status'] = Mailing::STATUS_NEW;
            $up['clicks'] = 0;
            $up['opened'] = 0;
            $up['unsubscribe'] = 0;
            $mailing->resetStat();


            $mailing->update($up);
            header("Location: ?");
            exit;
        }
        if ($req->action == 'group') {
            if (isset($req->add) && isset($req->name)) {
                $group = new Mailing_Group;
                $group->name = $req->name;
                $group->create();
                header("Location:?action=group&edit=" . $group->id);
                exit;
            }
            if (isset($req->edit)) {

                $group = Mailing_Group::getById($req->edit);
                if (isset($req->data)) {
                    // save 
                    $group->update($req->data);
                    $group->reSaveUsers($req->users);
                    header("Location:?action=group&list");
                }

                if (!$group) {
                    return;
                }
                return [
                    'page' => 'group_edit',
                    'vars' => [
                        'group' => $group
                    ]
                ];
            }
            if (isset($req->delete)) {

                $group = Mailing_Group::getById($req->delete);

                if ($group) {
                    try {
                        $group->delete();
                    } catch (Exception $ex) {
                        //echo $ex->getMessage();
                    }
                }

                header("Location:?action=group&list");
                exit;
            }
            if (isset($req->list)) {

                $gm = new Mailing_Group_Manager(DB::getInstance());
                $list = $gm->get();


                return [
                    'page' => 'list',
                    'vars' => [
                        'list' => $list,
                    ]
                ];
            }
        }
        return false;
    }

}
