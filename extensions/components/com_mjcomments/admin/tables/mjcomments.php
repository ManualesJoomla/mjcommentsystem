<?php
/**
 * @package     MJ.Component
 * @subpackage  mjcomments
 *
 * @copyright   Copyright (C) 2015 Carlos Rodriguez. All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

/**
 * Comments Table.
 *
 */
class MjcommentsTableMjcomments extends JTable
{
	/**
	 * @var  integer
	 */
	public $id;

	/**
	 * @var  integer
	 */
	public $content_id;

	/**
	 * @var  string
	 */
	public $visitor_name;

	/**
	 * @var  string
	 */
	public $visitor_email;

	/**
	 * @var  string
	 */
	public $visitor_comments;

	/**
	 * @var  datetime
	 */
	public $created;

	/**
	 * @var  integer
	 */
	public $state;

	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  Database connector object
	 *
	 * @since   1.0
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__mjcomments', 'id', $db);
	}
}
