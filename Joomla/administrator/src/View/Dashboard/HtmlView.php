<?php

namespace Joomla\Component\Quiz\Administrator\View\Dashboard;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    public function display($tpl = null)
    {
        $this->message = "Hello Admin Dashboard!";
        parent::display($tpl);
    }
}
