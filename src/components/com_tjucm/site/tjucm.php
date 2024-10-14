<?php
/**
 * @package     TJ-UCM
 * @subpackage  com_tjucm
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2019 Techjoomla. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\MVC\Controller\BaseController;

JLoader::registerPrefix('Tjucm', JPATH_COMPONENT);
JLoader::register('TjucmController', JPATH_COMPONENT . '/controller.php');

// Load tj-fields language files
$lang = Factory::getLanguage();
$lang->load('com_tjfields', JPATH_ADMINISTRATOR);
$lang->load('com_tjfields', JPATH_SITE);

// Load backend helper
$path = JPATH_ADMINISTRATOR . '/components/com_tjucm/helpers/tjucm.php';

// Load joomla icon media file
$doc = Factory::getDocument();
$doc->addStyleSheet(Uri::root() . '/media/jui/css/icomoon.css');

if (!class_exists('TjucmHelper'))
{
	JLoader::register('TjucmHelper', $path);
	JLoader::load('TjucmHelper');
}

JLoader::register('TjucmHelpersTjucm', JPATH_SITE . '/components/com_tjucm/helpers/tjucm.php');
JLoader::load('TjucmHelpersTjucm');
TjucmHelpersTjucm::getLanguageConstantForJs();

// Initialise UCM
JLoader::register('TjucmAccess', JPATH_SITE . '/components/com_tjucm/includes/access.php');
JLoader::register('TJUCM', JPATH_SITE . '/components/com_tjucm/includes/tjucm.php');
TJUCM::init();

// Execute the task.
$controller = BaseController::getInstance('Tjucm');

$controller->execute(Factory::getApplication()->input->getCmd('task'));
$controller->redirect();
