<?php
define('FORUM_PERM_EDIT_ALL_POSTS', PERM_CAT_ALL_MAT);

function forum_id_by_alias($alias) {
    try {
        $f = Forum::getByAlias($alias);
        return $f->id;
    } catch (Exception $e) {
        return 0;
    }
}

function _forum_allow($forumid,$userid,$permid) {
    $f = Forum::getById($forumid);
    if (!$f) return false;
    return $f->userAllowAccess($permid, $userid);
}

function can_create_theme($forumid,$userid=0) {
  return _forum_allow($forumid,$userid,PERM_FORUM_CREATE_THEME);
}

function can_answer_theme($forumid,$themeid,$userid=0) {
  if (is_theme_closed($themeid)) return 0;
  return _forum_allow($forumid,$userid,PERM_FORUM_CREATE_POST);
}

function is_theme_closed($themeid) {
  $r = fssql_query("select closed from forums where id=$themeid");
  if (mysql_num_rows($r)) $res = mysql_result($r,0);
  return (bool)$res;
}

function _forum_replace($forumid,$userid,&$args) {
  $f = Forum::getById($forumid);
  if (!$f) return false;
  $args['text'] = $f->replace($args['text']);
}

function forum_new_message($forumid,$themeid,$threadid,$args,$user,$checkmail=1, $theme_name = FALSE, $theme_text = FALSE, $idcat=0, $idmath=0) {
    try {
        $f = Forum::getById($forumid);
        if (!$f) throw new Exception_CMS(Exception_CMS::INVALID_PARAMS);
        if ($threadid) $themeid = $threadid;
        return $f->addPost($themeid,$args,$user['id'],$checkmail, $theme_name, $theme_text, $idcat, $idmath);
    } catch (Exception_CMS $e) {
        return $e->code;
    }
}

function forum_new_theme($forumid, $args, $user=NULL, $idcat=0, $idmath=0, $checkmail=1) {
    try {
        $f = Forum::getById($forumid);
        if (!$f) throw new Exception_CMS(Exception_CMS::INVALID_PARAMS);
        return $f->newTheme($args,$user['id'],$idcat, $idmath, $checkmail);
    } catch (Exception_CMS $e) {
        return $e->code;
    }
}

function forum_edit_message($forumid,$messageid,$userid,$args) {
    try {
        $f = Forum::getById($forumid);
        if (!$f) throw new Exception_CMS(Exception_CMS::INVALID_PARAMS);
        return $f->editPost($messageid,$userid,$args);
    } catch (Exception_CMS $e) {
        return $e->code;
    }
}

function forum_delete_message($forumid,$messageid,$userid) {
    try {
        $f = Forum::getById($forumid);
        if (!$f) throw new Exception_CMS(Exception_CMS::INVALID_PARAMS);
        return $f->deletePost($messageid,$userid,1);
    } catch (Exception_CMS $e) {
        return $e->code;
    }
}