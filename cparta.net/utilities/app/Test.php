<?php
	class Test{


		public function screens(){
			$sql = "select * from landings where preview=0 order by id desc limit 100";
			$stmt = DB::getInstance()->query($sql);
			set_time_limit(0);
			ignore_user_abort(1);

			while($row = $stmt->fetchObject()){
				$jpeg = file_get_contents("http://api.screenshotmachine.com/?key=ce7aff&size=F&format=PNG&url=".urlencode($row->url.'?r='.rand(1,9999) ));
				file_put_contents(dirname(__FILE__)."/../../images/screens/".md5($row->url).".jpg", $jpeg);

				DB::getInstance()->query("update landings set preview=1 where id=".$row->id);
			}
		}
		public function renamer(){
			
			$post = new Request($_POST);
			if(isset($post->name)){
				foreach($post->name as $id=>$name){	
					echo $id." / ".$name."<br>";
					$stmt = DB::getInstance()->prepare("update landings set name=? where id=?");
					$stmt->execute([ $name, $id]);

				}
				exit;
			}
			$sql = "select * from landings order by id asc";
			$stmt = DB::getInstance()->query($sql);
			echo "<form action=? method=post><table width=100%><tr><Td width=400>";
			while($row=$stmt->fetchObject()){
				echo "<input name=name[{$row->id}] value='{$row->name}'> / <a href='{$row->url}' target=i onclick=\"javascript:document.getElementById('m').src=this.href\">{$row->url}</a><hr>";
			}
			echo "<hr><input type=submit></form></td><td valign=top><iframe style=\"position:fixed\" name=i width=1500 height=600></iframe></td></tr></table><Br>
			<iframe id=m style='position:fixed;top:610;left:450' width=500 height=400></iframe>";
		}
		public function testmy(){
                    
                    $zm = new Zakaz_Manager( DB::getInstance());
                    $zm->where('offer_id', 170);
                    $zm->where('pinger_type', 'Offer_Pinger_M1');
                    $zm->where('status', [2,3], Entity_Manager::WHERE_IN );
                    $zm->sortBy('id', 'desc');
                    $zm->limit(100);
                    $zm->offset(50);
                    $list = $zm->get();
                    
                    echo count($list);
                    echo '<br>';echo '<br>';
                    foreach($list as $zakaz){

                        list($good_id, $user, $api_key, $id) = explode(',', $zakaz->pinger_value);
                        
                        $get = Providers_M1::getStatus($user, $api_key,$id);
                        
                        if($get->result[0]->status == 1){
                            continue;
                        }
                        
                        /*
                        echo '<pre>';
                        print_r($get);
                        echo '</pre>';

                        echo '<br>';
                        echo '------';
                         * 
                         */
                        echo $zakaz->id;
                        echo '<br>';

                        
                    }
                    

		}
		public function resend(){
                    
                    $sql = "SELECT * FROM `zakaz` WHERE `id` in (13731,13732,13733)"; 
                    $stmt = DB::getInstance()->query($sql);
                    while($row=$stmt->fetchObject()){
                        $z=Zakaz::getById($row->id);

                        $z->update([
                            'status' => 1,
							'comments' => ''							
                        ]);

                        $o = Offer::getById($z->offer_id);
                        $o->pingOtherCpa($z);
                    }                    
                    
					
		}
	}
