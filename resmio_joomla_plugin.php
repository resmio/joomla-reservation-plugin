<?php
// no direct access
defined( '_JEXEC' ) or die;

class plgContentResmiojoomlaplugin extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Plugin method with the same name as the event will be called automatically.
	 */
	 function onContentPrepare($context, &$row, &$params, $page = 0)
	 {
		/*
		 * Plugin code goes here.
		 * You can access database and application objects and parameters via $this->db,
		 * $this->app and $this->params respectively
		 */
     $title = &$article->title;
     $text =  &$article->text;

     $text = str_replace("world", "hello", $text);

		return true;
	}
}
?>
