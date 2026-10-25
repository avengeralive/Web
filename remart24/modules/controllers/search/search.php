<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class cSearch extends controller
{
    public function getSearchResults()
    {
        if ($this->data['request']->parameters['s'] == '')
        {
            $this->data['body'] = 'Search word should not be empty';
            return $this->data;
        }
        $this->data = Loader::gi()->getModel($this->data);
        $this->data['sequence'] = '';
        foreach ($this->data['items'] as $item)
        {
            /*
            $cur_item = new stdClass();
            if (isset($item[Backstage::gi()->portal_current_lang]))
            {
                $cur_item = $item[Backstage::gi()->portal_current_lang];
            }
            else
                $cur_item = reset($item);
            */
            $cur_item = $item;
            // Get design
            $design_name = isset($cur_item->design)?$cur_item->design:'';
            $des_data = Loader::gi()->callModule('GET', 'designs', array('where'=>'design_name="'.$design_name.'"'));
            if ($des_data['items'])
            {
                $design = $des_data['items'][0];
                $block_rules_cnt = preg_match_all("/.*(\[\[([A-z0-9\-\_]+)\]\]).*/", $design->block, $block_rules, PREG_SET_ORDER);
                $structure_rules_cnt = preg_match_all("/(\[\[([A-z0-9\-\_]+)\]\])/", $design->structure, $structure_rules, PREG_SET_ORDER);
            }

            // Get material design if there is any
            $material_design_name = $cur_item->material_design;
            $material_des_data = Loader::gi()->callModule('GET', 'designs', array('where'=>'design_name="'.$material_design_name.'"'));
            if ($material_des_data['items'])
            {
                $material_design = $material_des_data['items'][0];
                $material_block_rules_cnt = preg_match_all("/.*(\[\[([A-z0-9\-\_]+)\]\]).*/", $material_design->block, $material_design->block_rules, PREG_SET_ORDER);
                $material_structure_rules_cnt = preg_match_all("/(\[\[([A-z0-9\-\_]+)\]\])/", $material_design->structure, $material_design->structure_rules, PREG_SET_ORDER);
            }
            switch ($cur_item->resource_type)
            {
                case 'catalogs':
                    $catalog_data = Loader::gi()->callModule('GET', 'catalogs', array('id'=>$cur_item->id));
                    if ($catalog_data['items'])
                    {

                        $fields = array('id', 'catalog_name', 'catalog_title', 'catalog_content', 'insert_date', 'is_category');

                        $catalog_item = $catalog_data['items'][0];
                        $content_data = new stdClass();
                        $content_data->content =  $catalog_item->catalog_title;

                        $structure = $design->structure;
                        foreach ($structure_rules as $rule_key => $rule)
                        {
                            if (in_array($rule[2], $fields))
                                $structure = str_replace($rule[1], $catalog_item->$rule[2], $structure);
                        }

                        $pattern = '/href="(.*)"/';
                        preg_match($pattern, $structure, $matches);

                        $content_data->page_name = $matches[1];
                        $this->data['content_data'] = $content_data;
                        $this->data['view_name']  = 'content';
                        $this->data['resource_type']  = 'catalog';
                        $structure = Loader::gi()->getView($this->data);

                        $this->data['sequence'] .= $structure;
                    }

                    break;
                case 'contents':
                    $content_data = Loader::gi()->callModule('GET', 'contents', array('id'=>$cur_item->id));
                    $page_data = Loader::gi()->callModule('GET', 'pages', array('id'=>$cur_item->container_id));
                    if ($content_data['items'] && $page_data['items'])
                    {
                        $content_data = $content_data['items'][0];
                        $this->data['query'] = $content_data->content;
                        $content_data_lq = Loader::gi()->getLQ($this->data);
                        $content_data->content = $content_data_lq['query'];

                        // Ensure the result is not a html tag
                        if (!preg_match('/<[^>]*'.strtolower($this->data['request']->parameters['s']).'.*?>/i', strtolower($content_data->content)) && strpos(strtolower($content_data->content), strtolower($this->data['request']->parameters['s'])))
                        {
                            $page_data = $page_data['items'][0];

                            // Cut
                            $cut = explode('[[cut]]', $content_data->content);
                            $content_data->content = $cut[0];
                            $content_data->page_name = 'pages/'.$page_data->page_name;

                            $this->data['content_data'] = $content_data;
                            $this->data['view_name']  = 'content';
                            $this->data['resource_type']  = 'content';
                            $structure = Loader::gi()->getView($this->data);

                            $this->data['sequence'] .= $structure;
                        }
                    }

                    break;
            }

        }
        $this->data['body'] = $this->data['sequence'];
        return $this->data;
    }

    public function saveMap()
    {
        $table = key($this->data['request']->parameters['fields']);
        $fields = reset($this->data['request']->parameters['fields']);
        $container_id = $this->data['request']->parameters['container_id'];
        $this->data['items'] = array();

        foreach ($fields as $field)
        {
            if (is_array($field))
            {
                foreach ($field as $translation_field)
                    foreach ($translation_field as $translation)
                    {
                        $this->data['query'] = $translation;
                        $this->data = Loader::gi()->parseLQ($this->data);
                        $item = array();
                        foreach ($this->data['lqs'] as $lq)
                        {
                            $item['lq'] = $lq['lq'];
                            $item['container_type'] = $table;
                            $item['container_id'] = $container_id;
                            $item['resource_type'] = isset($lq['type'])?$lq['type']:'';
                            $item['resource_name'] = isset($lq['name'])?$lq['name']:'';
                            $item['resource_id'] = 0;
                            $item['action'] = isset($lq['action'])?$lq['action']:'';
                            $item['design'] = isset($lq['design'])?$lq['design']:'';
                            $item['material_design'] = isset($lq['material_design'])?$lq['material_design']:'';
                            if (!empty($item))
                                $this->data['items'][] = $item;
                        }
                    }
            }
            else
            {
                $this->data['query'] = $field;
                $this->data = Loader::gi()->parseLQ($this->data);
                $item = array();
                foreach ($this->data['lqs'] as $lq)
                {
                    $item['lq'] = $lq['lq'];
                    $item['container_type'] = $table;
                    $item['container_id'] = $container_id;
                    $item['resource_type'] = isset($lq['type'])?$lq['type']:'';
                    $item['resource_name'] = isset($lq['name'])?$lq['name']:'';
                    $item['resource_id'] = 0;
                    $item['action'] = isset($lq['action'])?$lq['action']:'';
                    $item['design'] = isset($lq['design'])?$lq['design']:'';
                    $item['material_design'] = isset($lq['material_design'])?$lq['material_design']:'';
                    if (!empty($item))
                        $this->data['items'][] = $item;
                }
            }
        }
        $this->data = Loader::gi()->getModel($this->data);
        return $this->data;
    }

}