<?php

// Что будет если вызвано удаление новости
// What if caused by the removal of the news
if (($user_tip=='70' || $user_tip=='80' || $user_tip=='60') && isset($_GET['del']) && $_GET['del']!='')
	{
	$delnews=htmlentities($_GET['del']);
	$mysqli->query("DELETE FROM `news` WHERE `id`='$delnews'");
	header('location:' . $_SERVER['PHP_SELF']);
	exit;
	}

// Что будет если добавляется новость
// What happens if you add news
if (($user_tip=='70' || $user_tip=='80' || $user_tip=='60') && isset($_POST['addnews']) && $_POST['addnews']=='ok')
	{
	if (isset($_POST['news_small']) && isset($_POST['news_full']))
		{
		if ($_POST['news_small']!='' && $_POST['news_full']!='')
			{
			if ($_POST['komu']!='' && $_POST['komu']!='')
				{
				$news_small=htmlentities($_POST['news_small']); $news_full=htmlentities($_POST['news_full']); $komu=htmlentities($_POST['komu']);
				$news_offer = htmlentities($_POST['offer']);
				if (isset($_POST['public_news']) && $_POST['public_news']=='1')
					{
					$public_news=htmlentities($_POST['public_news']);
					}
				else
					{
					$public_news='0';
					}
                                if(isset($_POST['img_news']) && $_POST['img_news'] !=''){
                                    $img_news = htmlentities($_POST['img_news']);
                                }else{
                                    $img_news = '';
                                }       
                                        
                                        
				$mysqli->query("INSERT INTO `news` (`user_tip`,`news_zagolovok`,`news`,`image`, `public_news`,`offer_id`) VALUES ('$komu','$news_small','$news_full','$img_news','$public_news','$news_offer')");
                                Events::trigger(Events::EVENT_NEWS_NEW, $mysqli->insert_id);
				header('location:' . $_SERVER['PHP_SELF']);
				exit;
				}
			}
		}
	}

// Что будет если редактируется новость
// What if the news is edited
if (($user_tip=='70' || $user_tip=='80' || $user_tip=='60') && (isset($_POST['editnews']) && $_POST['editnews']=='ok') && isset($_POST['news_id']))
	{
	if (isset($_POST['news_small']) && isset($_POST['news_full']))
		{
		if ($_POST['news_small']!='' && $_POST['news_full']!='')
			{
			if ($_POST['komu']!='' && $_POST['komu']!='')
				{
				$news_id=htmlentities($_POST['news_id']);
				$news_small=htmlentities($_POST['news_small']); 
				$news_full=htmlentities($_POST['news_full']); 
				$komu=htmlentities($_POST['komu']);
				$news_offer = htmlentities($_POST['offer']);
				if (isset($_POST['public_news']) && $_POST['public_news']=='1')
					{
					$public_news=htmlentities($_POST['public_news']);
					}
				else
					{
					$public_news='0';
					}
                                if(isset($_POST['img_news']) && $_POST['img_news'] !=''){
                                    $img_news = htmlentities($_POST['img_news']);
                                }else{
                                    $img_news = '';
                                }      
                                        
				$mysqli->query("UPDATE `news` SET `user_tip`='$komu',`news_zagolovok`='$news_small',`news`='$news_full',`image`='$img_news',`public_news`='$public_news',`offer_id`='$news_offer' WHERE `id`='$news_id'");
				header('location:' . $_SERVER['PHP_SELF']);
				exit;
				}
			}
		}
	}

?>