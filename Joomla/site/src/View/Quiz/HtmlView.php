<?php

namespace Joomla\Component\Quiz\Site\View\Quiz;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;


class HtmlView extends BaseHtmlView
{

    public function display($tpl = null)
    {   
        $app = Factory::getApplication();

        // adding css and js
        $wa = $app->getDocument()->getWebAssetManager();
        $wa->getRegistry()->addRegistryFile(JPATH_ROOT . '/media/com_quiz/joomla.asset.json');
        
        
        $wa->useStyle('com_quiz.main-css');
        $wa->useScript('com_quiz.main-js');


        // loading json
        $path = JPATH_ROOT . '/media/com_quiz/questions.json';
        $json = file_get_contents($path);
        $data = json_decode($json);

        $current = $app->input->getInt('id', 1);

        // loading the correct question
        $this->question = $data->questions[$current - 1];
        $this->current  = $current;

        // checking progress
        
        $cookie = $app->input->cookie->getInt('progress', 1);

        if ($cookie < $current){
            $app->enqueueMessage('You scanned this QR too early! Go back and complete the previous question.', 'warning');
            $app->redirect('index.php?option=com_quiz&view=quizquestion&id=' . $cookie);
            return;
        }

        return parent::display($tpl);
    }
}




