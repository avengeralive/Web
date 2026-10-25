<?php

class BookKeeperController extends Controller {

    protected $_url = '/finances_log.php';

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

        if ($req->action == 'search') {
            $fl = new FinancesLog;
            list( $start, $end ) = explode(' - ', $req->dates);
            $fl->setStartDate($start)->setEndDate($end);
            if ($req->type) {
                $fl->setType($req->type);
            }
            if ($this->di->tip == 70) {
                if ($req->userid) {
                    $fl->setType(0)->setUser($req->userid);
                }
            } else {
                $fl->setType(0)->setUser($user->id);
            }

            $data = $fl->getStat();
            return [ 'page' => 'table', 'vars' => ['data' => $data]];
        }
        if ($req->action == 'excel') {
            $fl = new FinancesLog;
            list( $start, $end ) = explode(' - ', $req->dates);
            $fl->setStartDate($start)->setEndDate($end);
            if ($req->type) {
                $fl->setType($req->type);
            }
            if ($this->di->tip == 70) {
                if ($req->userid) {
                    $fl->setType(0)->setUser($req->userid);
                }
            } else {
                $fl->setType(0)->setUser($user->id);
            }

            $data = $fl->getStat();
            return [ 'page' => 'excel', 'vars' => ['data' => $data]];
        }
        if ($req->action == 'run' && $this->di->tip == 70) {
            $u = User::getById($req->userid);
            $diff = 0;
            $balance = $u->balance;
            $refbalance = $u->ref_balance;
            $operation = 0;
            $newbalance = $balance;
            $newrefbalance = $refbalance;
            if ($req->type > 0) {
                $operation = 1;
                $newbalance += $req->amount;
            } else if ($req->type == -20) {
                $operation = 2;
                $newbalance-=$req->amount;
            } else if ($req->type == -4) {
                $operation = 2;
                $newbalance-=$req->amount;
            } else if ($req->type == -30) {
                $operation = 2;
                $newrefbalance-=$req->amount;
            }
            $fl = new FinancesLog;
            $fl->user_id = $u->id;
            $fl->status = 2;
            $fl->comments = $req->comments;
            $fl->operation = $operation;
            $fl->summ = $req->amount;
            $fl->balance = $newbalance;
            $fl->ref_balance = $newrefbalance;
            $fl->description = abs($req->type);
            $fl->create();
            $u->update(['balance' => $newbalance]);
            $u->update(['ref_balance' => $newrefbalance]);
            if ($req->type > 0) {
                Events::trigger(Events::EVENT_MONEY_IN, $fl->id, ['added' => $req->amount, 'balance' => $newbalance]);
            }

            exit;
        }
        if ($req->action == 'getUsers' && $this->di->tip == 70) {
            $sql = 'select * from users where id like ? or email like ? or email like ? or email like ? or wmr like ? or wmr like ? or wmr like ?';
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->execute([
                $req->query . '%',
                '%' . $req->query,
                '%' . $req->query . '%',
                $req->query . '%',
                '%' . $req->query,
                '%' . $req->query . '%',
                $req->query . '%',
            ]);
            $list = [];
            while ($row = $stmt->fetchObject()) {
                $list[] = [
                    'name' => $row->email . ' (ID: ' . $row->id . ') ' . $row->wmr,
                    'id' => $row->id,
                ];
            }

            echo json_encode($list);
            exit;
        }

        return false;
    }

}
