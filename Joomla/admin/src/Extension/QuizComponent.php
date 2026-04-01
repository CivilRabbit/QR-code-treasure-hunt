<?php

namespace Joomla\Component\Quiz\Site\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class QuizComponent extends MVCComponent
{
    public function __construct(MVCFactoryInterface $factory)
    {
        parent::__construct($factory);
    }
}
