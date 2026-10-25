<?php

class ScreensController extends Controller {

    protected $_url = '/landings_screenshots.php';
    public static $devices = [
	205 => 'Apple iPhone 5/205',

	186 => 'Apple iPhone 5/186',
	185 => 'Apple iPhone 5/186',
	204 => 'Apple iPhone 5/204',



        187 => 'Apple iPhone 5',
        155 => 'Nexus S',


        189 => 'Apple iPhone 5',
        21 => 'Apple iPad 1',
        161 => 'Apple iPad 2',
        190 => 'Apple iPad 3',
        162 => 'Android Nexus S',
        184 => 'Android Nexus 7',
        275 => 'Android Galaxy Note II',
        274 => 'Android Galaxy Note 10.1',
    ];

    public function run() {
        $apiKey = 'UVR0uOPiQfr1j8SkglVOTT6Dn5w';
        $sql = "select * from langings_screenshots where status='new'";
        $stmt = DB::getInstance()->query($sql);
        $url = 'https://api.browshot.com/api/v1/screenshot/create?';
        //url=http://www.google.com/&instance_id=3&size=screen&cache=0&key=UVR0uOPiQfr1j8SkglVOTT6Dn5w
        while ($row = $stmt->fetchObject()) {
            $vars = [];
            $vars['url'] = Offer_Landing::getById($row->landing_id)->url;
            $vars['instance_id'] = $row->instance;
            $vars['key'] = $apiKey;
            $vars['size'] = 'page';
            $vars['delay'] = 15;
            $res = @file_get_contents($url . http_build_query($vars));
            $json = json_decode($res);
            $ext = $json->id;
            DB::getInstance()->query('update langings_screenshots set status="working",ext_id="' . $ext . '" where id=' . $row->id);
        }
        // check for finished
        $sql = "select * from langings_screenshots where status='working'";
        $stmt = DB::getInstance()->query($sql);
        while ($row = $stmt->fetchObject()) {
            $status = file_get_contents("https://api.browshot.com/api/v1/screenshot/info?id=" . $row->ext_id . "&key=" . $apiKey);
            $json = json_decode($status);
            if ($json->status == 'finished') {
                DB::getInstance()->query('update langings_screenshots set url="' . $json->screenshot_url . '",status="done" where id=' . $row->id);
            }
            if ($json->status == 'error') {
                DB::getInstance()->query('update langings_screenshots set status="error" where id=' . $row->id);
            }
        }
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
        if ($req->action == 'run') {

            foreach ($req->devices as $device_id) {

                $sql = "insert into langings_screenshots set landing_id=:lid, device=:d, status='new', instance=:i";
                $stmt = DB::getInstance()->prepare($sql);
                $stmt->execute([
                    'lid' => $req->landing,
                    'd' => self::$devices[$device_id],
                    'i' => $device_id,
                ]);
            }

            header('Location: ' . $this->_url);
            exit;
        }
        if ($req->action == 'getScreens') {
            $list = [];
            $sql = "select * from langings_screenshots where landing_id = ?";
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([$req->id]);
            while ($row = $stmt->fetchObject()) {
                $list[] = [
                    'device' => $row->device,
                    'url' => preg_replace("/(scale=(.*))/i", "", $row->url),
                    'status' => $row->status,
                ];
            }
            echo json_encode($list);
            exit;
        }
        if ($req->action == 'getLandings') {
            $offer = Offer::getById($req->id);
            if (!$offer)
                exit;
            $landings = $offer->getLandings();
            $list = [];
            foreach ($landings as $l) {
                $list[] = ['name' => $l->name, 'id' => $l->id];
            }
            echo json_encode($list);

            exit;
        }


        if ($req->action == 'edit') {

            return ['page' => 'index', 'vars' => ['mailing' => Mailing::getById($req->id)]];
        }

        return false;
    }

}
