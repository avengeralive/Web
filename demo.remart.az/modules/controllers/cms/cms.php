<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class cCMS extends controller
{
    public function get()
    {
        $this->contents();
        return $this->data;
    }
	
	private function navigationData()
	{
		$this->data['catalogs'] = Loader::gi()->callModule('GET', 'catalogs', array('where'=>'parent_id = 0'));
		$this->data['catalogs'] = $this->data['catalogs']['items'];
	}
	
    public function pages()
    {
		// Collect global menu data
		$this->navigationData();
		
        $pages = Loader::gi()->callModule('GET', 'pages', array('order' => 'page_name'));
        $pages_arr = array();
        foreach ($pages['items'] as $key => $page)
            $pages_arr[$page->id] = $page->page_name;

        $layouts = Loader::gi()->callModule('GET', 'layouts', array('order' => 'layout_name'));
        $layouts_arr = array();
        foreach ($layouts['items'] as $key => $layout)
            $layouts_arr[$layout->id] = $layout->layout_name;

        $crud_pages = new Crud("pages");
        $this->data['crud_pages'] = $crud_pages->setQuery('SELECT pages.*, layouts.layout_name from '.Backstage::gi()->db_table_prefix . 'pages LEFT JOIN '.Backstage::gi()->db_table_prefix . 'layouts ON pages.layout_id = layouts.id')
            ->setSearch('*')
            ->setIDs('id')
            ->validateUnique('page_name')
            //->restrict('add','edit','delete')
            ->mapTitles(
                'page_name', 'Name',
                'page_title', 'Title',
                'parent_id', 'Parent page',
                'page_meta_title', 'Meta title',
                'page_meta_keywords', 'Meta keyword',
                'page_meta_description', 'Meta description',
                'page_content', 'Content',
                'page_menu_group', 'Menu group',
                'page_sub_menu', 'Sub menu',
                'layout_id', 'Layout',
                'layout_name', 'Layout name',
                'is_visible', 'Visibility',
                'is_active', 'Active',
                'is_external_link', 'Link to external URL',
                'external_url_target', 'External URL Target',
                'is_main', 'Main',
                'ordering', 'Order number')
			->hideFields('layout_name,design_id', 'add,edit', 'child_count,layout_id,design_id', 'table')
			->setDefaultValues('design_id','0')
            ->disableSavingToTables('layouts')
            ->mapParents('id', 'parent_id')
            ->setParentTable('pages')
            ->setTranslations('page_title', 'page_content')
            ->setEditor('page_content')
            ->mapFieldInputs(
                'layout_id', 'select:' . json_encode($layouts_arr),
                'parent_id', 'select:' . json_encode($pages_arr),
                'is_visible', 'checkbox:1',
                'is_active', 'checkbox:1',
                'is_external_link', 'checkbox:1',
                'is_main', 'checkbox:1')
            ->setGrants('pages')
            ->addEasyLQ('page_name', 'page_title', 'page_meta_title', 'page_meta_keywords', 'page_meta_description', 'page_content', 'page_menu_group', 'page_sub_menu')
            ->afterSave('pages/addLQContent')
            ->execute();

        $this->data['view_name'] = 'pages';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
	
    public function contents()
    {
		// Collect global menu data
		$this->navigationData();
	
        $designs = Loader::gi()->callModule('GET', 'designs', array('order' => 'design_name'));
        $designs_arr = array();
        foreach ($designs['items'] as $key => $design)
            $designs_arr[$design->id] = $design->design_name;

        $crud_pages = new Crud("contents");
        $this->data['crud_contents'] = $crud_pages->setTables(Backstage::gi()->db_table_prefix . 'contents')
            ->setFields('id', 'content_name', 'content', 'is_visible', 'is_searchable')
            ->setSearch('*')
            ->setIDs('id')
            ->validateUnique('content_name')
            //->restrict('add','edit','delete')
            ->mapTitles(
                'design_id', 'Design',
                'content_name', 'Content name',
                'content', 'Content',
                'is_searchable', 'Searchable',
                'is_visible', 'Visibility')
            ->mapFieldInputs('is_visible', 'checkbox:1', 'is_searchable', 'checkbox:1')
            ->setTranslations('content')
            ->setGrants('contents')
            ->setEditor('content')
            ->hideFields('content', 'table')
            ->addEasyLQ('content_name', 'content')
            ->execute();

        $this->data['view_name'] = 'contents';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }

    public function catalogs()
    {
		// Collect global menu data
		$this->navigationData();

        $designs = Loader::gi()->callModule('GET', 'designs', array('order' => 'design_name'));
        $designs_arr = array();
        foreach ($designs['items'] as $key => $design)
            $designs_arr[$design->id] = $design->design_name;

        $catalogs = Loader::gi()->callModule('GET', 'catalogs', array('order' => 'catalog_name'));
        $catalogs_arr = array();
        foreach ($catalogs['items'] as $key => $catalog)
            $catalogs_arr[$catalog->id] = $catalog->catalog_name;

        $forms = Loader::gi()->callModule('GET', 'forms');
        $forms_arr = array();
        foreach ($forms['items'] as $key => $form)
            $forms_arr[$form->id] = $form->form_name;

        $crud_pages = new Crud("catalogs");
        $this->data['crud_catalogs'] = $crud_pages->setTables(Backstage::gi()->db_table_prefix.'catalogs')
            ->setFields('id', 'parent_id', 'design_id', 'form_id', 'catalog_name', 'catalog_title', 'catalog_content', 'catalog_group', 'is_category', 'is_visible', 'is_searchable', 'insert_date')
            ->setSearch('*')
            ->setIDs('id')
            ->validateUnique('catalog_name')			
			->hideFields('parent_id, design_id, form_id, is_category, is_visible, catalog_group', 'add,edit')
//			->disabledEditFields('parent_id', 'design_id', 'form_id', 'is_category', 'is_visible', 'catalog_group')
            ->setGrants('catalogs')
            ->mapParents('id','parent_id')
			->formatFields('catalog_content', 'table', 'text')				
            ->setSystemValues('crud_parent_id', $this->data['request']->parameters['id'])
            //->restrict('add','edit','delete')
            ->mapTitles(
                'parent_id', 'Parent catalog',
                'design_id', 'Design',
                'form_id', 'Form',
                'catalog_name', 'Name',
                'catalog_title', 'Title',
                'catalog_content', 'Content',
                'catalog_group', 'Group',
                'is_category', 'Is category',
                'is_visible', 'Visibility',
                'is_searchable', 'Searchable',				
                'insert_date', 'Modify date')
            ->setTranslations('catalog_title', 'catalog_content')
            ->setUploader('catalogs')
            ->mapFieldInputs('design_id', 'select:' . json_encode($designs_arr), 
							'parent_id', 'select:' . json_encode($catalogs_arr), 
							'form_id', 'select:' . json_encode($forms_arr), 
							'is_category', 'checkbox:1',
							'is_searchable', 'checkbox:1',							
							'is_visible', 'checkbox:1')
            ->setEditor('catalog_content')
            ->execute();

        $this->data['view_name'] = 'catalogs';
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }



}