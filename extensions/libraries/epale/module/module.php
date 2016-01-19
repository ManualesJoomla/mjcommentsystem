<?php
/**
 * @package     Epale
 * @subpackage  Library
 *
 * @copyright   Copyright (C) 2016 Carlos Rodriguez - All rights reserved.
 * @license     License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */

defined('_JEXEC') or die;

/**
 * Modules base class
 *
 * @since  1.0
 */
abstract class EpaleModule
{
  /**
	 * Latest error
	 *
	 * @var  string
	 */
	protected $error;

	/**
	 * Name of the module folder
	 *
	 * @var    string
	 */
	protected $folderName;

	/**
	 * Layout to render
	 *
	 * @var  string
	 */
	protected $layout;

	/**
	 * Module parameters
	 *
	 * @var  JRegistry
	 */
	protected $params;

  /**
	 * Constructor
	 *
	 * @param   mixed  $params  array or JRegistry with the module parameters
	 */
	public function __construct($params = array())
	{
		$this->setParams($params);
	}

  /**
	 * Get the base module layout data
	 *
	 * @return  array
	 */
	public function getBaseLayoutData()
	{
		return array(
			'params'         => $this->getParams(),
			'moduleInstance' => $this,
			'cssClass'       => $this->getCssClass()
		);
	}

  /**
	 * Get the module main CSS class
	 *
	 * @return  string
	 */
	public function getCssClass()
	{
		return str_replace('_', '-', $this->getFolderName());
	}

  /**
	 * Get the latest error
	 *
	 * @return  string
	 */
	public function getError()
	{
		return $this->error;
	}

  /**
	 * Get current instance name
	 *
	 * Example: in class "MjModuleSample" it will return "sample"
	 *
	 * @return  string
	 */
	protected function getInstanceName()
	{
		$class = get_class($this);

		$name = strstr($class, 'Module');
		$name = str_replace('Module', '', $name);

		return strtolower($name);
	}

  /**
	 * Get the module folder name
	 *
	 * @return  string
	 */
	protected function getFolderName()
	{
		if (null === $this->folderName)
		{
			$this->folderName = 'mod_' . $this->getPrefix() . $this->getInstanceName();
		}

		return $this->folderName;
	}

  /**
	 * Get the active layout
	 *
	 * @return  string
	 */
	public function getLayout()
	{
		if (null === $this->layout)
		{
			$params = $this->getParams();

			$this->layout = $params->get('layout', '_:default');
		}

		return $this->layout;
	}

  /**
	 * Get the layout name. This cleans layouts from the modulelayout field
	 *
	 * @return  string
	 */
	protected function getLayoutName()
	{
		$layout = $this->getLayout();

		$layoutParts = explode(':', $layout);

		return count($layoutParts) == 2 ? $layoutParts[1] : $layoutParts[0];
	}

  /**
	 * Return the folder of the active layout
	 *
	 * @return  string
	 */
	protected function getLayoutFolder()
	{
		$path = JModuleHelper::getLayoutPath($this->getFolderName(), $this->getLayout());

		return dirname($path);
	}

  /**
	 * Get the module parameters
	 *
	 * @return  JRegistry
	 */
	public function getParams()
	{
		return $this->params;
	}

  /**
	 * Get the module prefix. Example: MjModuleSample will return Mj
	 *
	 * @return  string
	 */
	protected function getPrefix()
	{
		$class = get_class($this);

		$prefix = strstr($class, 'Module', true);

		return strtolower($prefix);
	}

  /**
	 * Fast proxy to load overridable JS files from the module folder
	 *
	 * @param   string  $fileName  JS file to load. Example: script.js
	 *
	 * @return  void
	 */
	public function loadScript($fileName, $base = '')
	{
    $path = empty($base) ? $this->getFolderName() : $base . '/' . $this->getFolderName();
		JHtml::script($path . '/' . $fileName, false, true);
	}

	/**
	 * Fast proxy to load overridable CSS files from the module folder
	 *
	 * @param   string  $fileName  CSS file to load. Example: style.css
	 *
	 * @return  void
	 */
	public function loadStylesheet($fileName, $base = '')
	{
    $path = empty($base) ? $this->getFolderName() : $base . '/' . $this->getFolderName();
		JHtml::stylesheet($path . '/' . $fileName, false, true, false);
	}

  /**
	 * Render the module
	 *
	 * @param   array  $layoutData  Array containing the data to use in the layout
	 *
	 * @return  string
	 */
	public function render($layoutData = array())
	{
		$params = $this->getParams();

		$options = array('debug' => $params->get('debug', false));

		$layoutData = array_merge($this->getBaseLayoutData(), $layoutData);

		return JLayoutHelper::render($this->getLayoutName(), $layoutData, $this->getLayoutFolder(), $options);
	}

  /**
	 * Set the error message
	 *
	 * @param   string  $message  The error message
	 *
	 * @return  MjModule  Self instance for chaining
	 */
	protected function setError($message)
	{
		$this->error = $message;

		return $this;
	}

  /**
	 * Set the active layout
	 *
	 * @param   string  $layout  Layout name. Example: default
	 *
	 * @return  MjModule  Self instance for chaining
	 */
	public function setLayout($layout)
	{
		$this->layout = $layout;

		return $this;
	}

  /**
	 * Set the module parameters
	 *
	 * @param   mixed  $params  array or JRegistry witht the module parameters
	 *
	 * @return  MjModule  Self instance for chaining
	 */
	public function setParams($params)
	{
		if (is_array($params) || is_string($params))
		{
			$this->params = new JRegistry($params);
		}

		if ($params instanceof JRegistry || $params instanceof Joomla\Registry\Registry)
		{
			$this->params = $params;
		}
		else
		{
			$this->params = new JRegistry;
		}

		return $this;
	}
}
