<?php
	Class extension_symphony_store extends Extension
	{
		/*-------------------------------------------------------------------------
			Extension definition
		-------------------------------------------------------------------------*/
	
	public function about()
		{
			return array(
				'name' => 'Symphony Store',
				'version'	=> '0.0.2',
				'author'	=> array('name' => 'IBCICO Development',
									'website' => 'http://ibcico.com/',
									'email' => 'i.bogdanov@ibcico.com'),
				'release-date' => '2010-12-05',
			);
		}
		
		
		
	public function getSubscribedDelegates()
		{
			return array(
				array(
					'page'		=> '/blueprints/events/new/',
					'delegate'	=> 'AppendEventFilter',
					'callback'	=> 'addFilterToEventEditore'
				),
				array(
					'page'		=> '/blueprints/events/edit/',
					'delegate'	=> 'AppendEventFilter',
					'callback'	=> 'addFilterToEventEditore'
				),
				array(
					'page'		=> '/frontend/',
					'delegate'	=> 'EventPostSaveFilter',
					'callback'	=> 'collect_data'
				),
			);
		}
				
		
	public function addFilterToEventEditore(&$context)
		{
			$context['options'][] = array('symphony-store', @in_array('symphony-store', $context['selected']) ,'Symphony Order Processing');
		}
		
	public function collect_data($context)
		{
			$id = $_POST['fields']['id'];
			$entry_id = $context['entry']->get('id');
			Symphony::Database()->query("INSERT INTO tbl_entries_data_104 (id, entry_id, relation_id) VALUES (NULL, $id, $entry_id)");
		}
	}