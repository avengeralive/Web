<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class mSearch extends model
{
    public function getSearchResults()
    {
        $search_word = $this->data['request']->parameters['s'];
        $this->data['items'] = $this->dbmanager->selectByQuery('select r.*, m.action, m.design, m.material_design, m.container_id, m.container_type from
			(select a.is_searchable, a.id, case when a.parent_id > 0 then (select catalog_name from '.Backstage::gi()->db_table_prefix.'catalogs where id = a.parent_id) else a.catalog_name end resource_name, 
			b.'.Backstage::gi()->portal_current_lang.' resource_value, 
			b.table_name resource_type,
			b.field_name resource_field
			from '.Backstage::gi()->db_table_prefix.'catalogs a, '.Backstage::gi()->db_table_prefix.'translations b 
			where a.id = b.row_id and b.table_name = "catalogs" and b.field_name = "catalog_title" and lower(b.'.Backstage::gi()->portal_current_lang.') like lower("%'.$search_word.'%")
			union all
			select a.is_searchable, a.id, case when a.parent_id > 0 then (select catalog_name from '.Backstage::gi()->db_table_prefix.'catalogs where id = a.parent_id) else a.catalog_name end resource_name,
			b.'.Backstage::gi()->portal_current_lang.' resource_value, 
			b.table_name resource_type,
			b.field_name resource_field
			from '.Backstage::gi()->db_table_prefix.'catalogs a, '.Backstage::gi()->db_table_prefix.'translations b
			where a.id = b.row_id and b.table_name = "catalogs" and b.field_name = "catalog_content" and lower(b.'.Backstage::gi()->portal_current_lang.') like lower("%'.$search_word.'%")
			union all
			select a.is_searchable, a.id, a.content_name resource_name, 
			b.'.Backstage::gi()->portal_current_lang.' resource_value, 
			b.table_name resource_type,
			b.field_name resource_field
			from '.Backstage::gi()->db_table_prefix.'contents a, '.Backstage::gi()->db_table_prefix.'translations b 
			where a.id = b.row_id and b.table_name = "contents" and b.field_name = "content" and lower(b.'.Backstage::gi()->portal_current_lang.') like lower("%'.$search_word.'%")) r left join '.Backstage::gi()->db_table_prefix.'maps m
			on r.resource_type = m.resource_type and r.resource_name = m.resource_name where r.is_searchable = 1 and (m.action="getCatalog" or m.action = "getContent")');

        /*
        $new_items = array();
        foreach ($this->data['items'] as $item)
        {
            $new_items[$item->id][$item->short] = $item;
        }
        $this->data['items'] = $new_items;
        */
        return $this->data;
    }

    public function saveMap()
    {
        if(isset($this->data['request']->parameters['fields']['contents']) &&
            isset($this->data['request']->parameters['fields']['contents']['is_searchable'])){
            $is_searchable = $this->data['request']->parameters['fields']['contents']['is_searchable'];
        } else if(isset($this->data['request']->parameters['fields']['catalogs']) &&
                    isset($this->data['request']->parameters['fields']['catalogs']['is_searchable'])){
            $is_searchable = $this->data['request']->parameters['fields']['catalogs']['is_searchable'];
        } else {
            $is_searchable = 0;
        }

        // get container_type
        $container_type = (isset($this->data['items'][0]['container_type']) && !empty($this->data['items'][0]['container_type'])) ?
            $this->data['items'][0]['container_type'] : '';

        // if not searchable delete anyway
        if($is_searchable == 0) {
            $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'maps')
                ->where("container_id = ".$this->data['request']->parameters['container_id']." and container_type = '".$container_type."'")
                ->delete();

        } else {
            //collect not changed lqs and new one
            $new_lqs_array = array();
            foreach ($this->data['items'] as $item) {
                $new_lqs_array[] = $item['lq'];
            }
            $new_lqs_list = "('".implode("','", $new_lqs_array)."')";

            // delete changed lqs and after insert new one
            if ($is_searchable == 1) {
                $this->dbmanager->tables(Backstage::gi()->db_table_prefix . 'maps')
                    ->where("container_id = " . $this->data['request']->parameters['container_id'] . " and 
                                    container_type = '".$container_type."' and lq not in" . $new_lqs_list)
                    ->delete();
            }

            foreach ($this->data['items'] as $item)
            {
                $where = 'lq = "'.$item['lq'].'" 
                and container_type = "'.$container_type.'"
				and container_id = "'.$item['container_id'].'"';

                $count = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'maps')
                    ->where($where)
                    ->count();

                if ($count == 0) {
                    $this->data['status'] = $this->dbmanager->tables(Backstage::gi()->db_table_prefix.'maps')
                        ->values($item)
                        ->insert();
                }
            }
        }

        return $this->data;
    }


}