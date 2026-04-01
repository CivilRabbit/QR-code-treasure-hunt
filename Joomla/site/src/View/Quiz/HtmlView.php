<?php

namespace Joomla\Component\Quiz\Site\View\Quiz;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;


class HtmlView extends BaseHtmlView
{
    protected $message;

    public function display($tpl = null)
    {
        $app = Factory::getApplication();
        $menu = $app->getMenu()->getActive();
        $params = $menu ? $menu->getParams() : $app->getParams();
        $this->message = $params->get('message', 'Hello from frontend!');

        return parent::display($tpl);
    }
}



