<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class mCatalogs extends model
{
    private $parent_catalogs = array();

    public function getCatalog()
    {
        $table = Backstage::gi()->db_table_prefix . 'catalogs a';
        $where = isset($this->data['request']->parameters['parent_id']) ? 'parent_id = ' . $this->data['request']->parameters['parent_id'] : 'parent_id = (select id from ' . $table . ' where ' . (isset($this->data['request']->parameters['id']) ? 'id="' . $this->data['request']->parameters['id'] : 'catalog_name="' . $this->data['request']->parameters['lq']['name']) . '")';


        // Paging
        if (isset($this->data['request']->parameters['lq']['navigation'])) {

            if (isset($this->data['request']->parameters['pcat']) && isset($this->data['request']->parameters['pnum']) && $this->data['request']->parameters['lq']['name'] == $this->data['request']->parameters['pcat']) {

                if (isset($this->data['request']->parameters['pnum'])) {
                    $start = $this->data['request']->parameters['pnum'] * $this->data['request']->parameters['lq']['navigation'] - $this->data['request']->parameters['lq']['navigation'];
                } else {
                    $start = 0;
                }
                $limit = ' LIMIT ' . ($start) . ',' . $this->data['request']->parameters['lq']['navigation'];
            } else {
                $start = 0;
                $limit = ' LIMIT ' . ($start) . ',' . $this->data['request']->parameters['lq']['navigation'];
            }
        } else {

            $limit = '';
        }


        // Check usage of ID parameter in LQ. If exist - show it, else get parameter from URL. ( If both not exists - 404 page must be created )
        if (isset($this->data['request']->parameters['lq']['id'])) {
            if (!empty($where))
                $where .= " AND";
            $where .= " id IN (" . $this->data['request']->parameters['lq']['id'] . ")";
        }

        //order by
        if (isset($this->data['request']->parameters['lq']['order'])) {
            $orders = explode(',', $this->data['request']->parameters['lq']['order']);
            foreach ($orders as $key => $item) {
               $orderItems[] = str_replace('|', ' ', $item);
            }
            $order = implode("," ,$orderItems);
        } else {
            $order = " insert_date ASC";
        }

        
        $this->data['items'] = $this->dbmanager->tables($table)
            ->fields('a.*, (SELECT catalog_name FROM ' . Backstage::gi()->db_table_prefix . 'catalogs' . ' WHERE id = a.parent_id) parent_name, (select count(*) from ' . Backstage::gi()->db_table_prefix . 'catalogs' . ' where parent_id = a.id AND is_visible=1) cnt, (select count(*) from catalogs WHERE ' . $where . ' AND is_visible=1) cnt_parent')
            ->where('is_visible = 1 and ' . $where)
            ->order($order . $limit)
            ->select();

        foreach ($this->data['items'] as $key => $item) {

            if (!isset($this->data['request']->parameters['lq']['lang'])) {
                $translations = Translations::gi()->getTranslations('catalogs', $item->id, Backstage::gi()->portal_current_lang);
            }else{
                $translations = Translations::gi()->getTranslations('catalogs', $item->id, $this->data['request']->parameters['lq']['lang']);
            }

            if (!empty($translations)) {
                foreach ($translations as $field => $translation)
                    $this->data['items'][$key]->$field = $translation->translation;
            }
        }

        $parent_where = isset($this->data['request']->parameters['parent_id']) ? 'id = ' . $this->data['request']->parameters['parent_id'] : 'id = (select id from ' . $table . ' where ' . (isset($this->data['request']->parameters['id']) ? 'id="' . $this->data['request']->parameters['id'] : 'catalog_name="' . $this->data['request']->parameters['lq']['name']) . '")';

        $this->data['parent_item'] = $this->dbmanager->tables($table)
            ->fields('*')
            ->where('is_visible = 1 and '.$parent_where)
            ->getScalar();

        return $this->data;
    }

    public function getCatalogItem()
    {
        $table = Backstage::gi()->db_table_prefix . 'catalogs a';

        $id = isset($this->data['request']->parameters['lq']['id']) ? ' LIMIT 0,' . $this->data['request']->parameters['lq']['id'] : '';

        // Check usage of ID parameter in LQ. If exist - show it, else get parameter from URL. ( If both not exists - 404 page must be created )
        if (isset($this->data['request']->parameters['lq']['id']) && !isset($this->data['request']->parameters['id'])) {
            $id = $this->data['request']->parameters['lq']['id'];
        } else {
            $id = $this->data['request']->parameters['id'];
        }

        $this->data['item'] = $this->dbmanager->tables($table)
            ->fields('a.*, (select count(*) from ' . $table . ' where parent_id = a.id) cnt,
                                (select catalog_title from ' . $table . ' where id = a.parent_id) parent_catalog_title,
                                    (select catalog_content from ' . $table . ' where id = a.parent_id) parent_catalog_content')
            ->where('is_visible = 1 and id = ' . $id)
            ->getScalar();

        $translations = Translations::gi()->getTranslations('catalogs', $this->data['item']->id, Backstage::gi()->portal_current_lang);
        if (!empty($translations)) {
            foreach ($translations as $field => $translation)
                $this->data['item']->$field = $translation->translation;
        }


        $translations_parent = Translations::gi()->getTranslations('catalogs', $this->data['item']->parent_id, Backstage::gi()->portal_current_lang);
        if (!empty($translations_parent)) {
            foreach ($translations_parent as $field => $translation)
                $this->data['item']->{'parent_'.$field} = $translation->translation;
        }

        return $this->data;
    }

    public function getBreadcrumbs()
    {
        $this->parent_catalogs[] = $this->getParentCatalogs($this->data['request']->parameters['id']);

        foreach ($this->parent_catalogs as $key=>$item)
        {
            $translations = Translations::gi()->getTranslations('catalogs', $item->id, Backstage::gi()->portal_current_lang);

            if (!empty($translations))
            {
                foreach ($translations as $field => $translation) {
                    $this->parent_catalogs[$key]->$field = $translation->translation;
                    if ($field == "catalog_title") {
                        $this->parent_catalogs[$key]->title = $translation->translation;
                    }
                }
            }
        }

        return $this->parent_catalogs;
    }

    private function getParentCatalogs($id){
        $item = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'catalogs')
            ->fields('*')
            ->where('id = '.$id)
            ->getScalar();

        $item->child_count = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'catalogs')
            ->where('parent_id = '.$id)
            ->count();

        if ($item && $item->parent_id > 0)
            $this->parent_catalogs[] = $this->getParentCatalogs($item->parent_id);

        return $item;
    }
}