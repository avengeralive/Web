<?php
namespace lib;

class Leadvertex {

    function start($list, $ids, $tostatus){
        // if($list == 17){
            $Result                     = JBase::Get_Data('list'.$list, $select = '*', ['id' => $ids]);
            if(!$Result) return;
            $data                       = $Result->fetch_assoc();
            if(!empty($data['leadvertexId']) && !empty($data['leadvertexProject'])){

                $leadvertexID               = $data['leadvertexId'];
                $project                    = $data['leadvertexProject'];
                if($project != 'sjb') return;
                $fio                        = $data['name'];
                $comment                    = $data['comment'];
                $stat = 0;
                $post = '';
                $posts = '';

                if($tostatus == 31){$post = self::changeStatus($project, $leadvertexID, 1, $fio, $comment); $stat = 1;}
                if($tostatus == 2) {$post = self::changeStatus($project, $leadvertexID, 11, $fio, $comment); $stat = 11;}
                if($tostatus == 28) {$post = self::changeStatus($project, $leadvertexID, 12, $fio, $comment); $stat = 12;}
                if($tostatus == 4) {$post = self::changeStatus($project, $leadvertexID, 2, $fio, $comment); $stat = 2;}
                if($tostatus == 8) {$post = self::changeStatus($project, $leadvertexID, 8, $fio, $comment); $stat = 8;}
                if($tostatus == 32) {$post = self::changeStatus($project, $leadvertexID, 77, $fio, $comment); $stat = 77;}
                if($tostatus == 6) {$post = self::changeStatus($project, $leadvertexID, 9, $fio, $comment); $stat = 9;}
                if($tostatus == 30) {$post = self::changeStatus($project, $leadvertexID, 78, $fio, $comment); $stat = 78;}
                if($tostatus == 3) {$post = self::changeStatus($project, $leadvertexID, 79, $fio, $comment); $stat = 79;}
                if($tostatus == 83) {$post = self::changeStatus($project, $leadvertexID, 2, $fio, $comment); $stat = 2;}
                if($tostatus == 84) {$post = self::changeStatus($project, $leadvertexID, 9, $fio, $comment); $stat = 9;}
                if($tostatus == 82) {$post = self::changeStatus($project, $leadvertexID, 80, $fio, $comment); $stat = 80;}
                if(is_array($post)){
                    foreach ($post as $key => $value) {
                        $posts .= '"'.$key.'":"'.$value.'"';
                    }
                }else{
                    $posts = $post;
                }
                Debugging::debug('LeadvertexPostback','project='.$project.' leadvertexID='.$leadvertexID.' tostatCRM='.$tostatus.' tostatLV='.$stat.' fio='.$fio.'  '.$posts);
            }
        // }
    }

    function changeStatus($project, $id, $tostatus, $fio, $comment){
        $Result                     = JBase::Get_Data('list52', $select = '*', ['project' => $project]);
        if(empty($Result)) return 'Такого проекта нету';
        $data                       = $Result->fetch_assoc();
        $curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, 'https://'.$project.'.leadvertex.ru/api/admin/updateOrder.html?token='.$data['token'].'&id='.$id);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "status=".$tostatus."&fio=".$fio."&comment=".$comment);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
 		$posts = json_decode(curl_exec($curl), true);
        curl_close($curl);
         
    	return $posts;
    }
}