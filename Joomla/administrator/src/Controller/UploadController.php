<?php

namespace Joomla\Component\Quiz\Administrator\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Folder;

use Joomla\CMS\MVC\Controller\BaseController;

class UploadController extends BaseController
{

    public function save()
    {
        $app = Factory::getApplication();
        
        $input = $app->input;
        $type = $input->getString('type', '');
       
        $file = $_FILES['myfile'];
  
        if (empty($file['name']))
        {
            $this->fail($app, 'No file uploaded');
            return;
        }

        $allowed = [];
        switch ($type) {
            case 'img':
                $allowed = ['jpeg','png', 'gif', 'jpg'];
                $destinationFolder = JPATH_ROOT . '/media/com_quiz/images';
                break;
            case 'json':
                $allowed = ['json','jsonc'];
                $destinationFolder = JPATH_ROOT . '/media/com_quiz';
                break;
            default:


        } 

        $ext = strtolower(File::getExt($file['name']));

        if (!in_array($ext, $allowed))
        {
            $this->fail($app, 'Invalid file type');
            return;
        }

        if ($file['size'] > 2 * 1024 * 1024)
        {
            $this->fail($app, 'File too large');
            return;
        }

        $tmpPath = $file['tmp_name'];
        $fileName = File::makeSafe($file['name']);

        if (!Folder::exists($destinationFolder))
        {
            Folder::create($destinationFolder);
        }

        $dest = $destinationFolder . '/' . $fileName;

        if (File::upload($tmpPath, $dest))
        {
            $app->enqueueMessage('File uploaded successfully', 'message');
        }
        else
        {
            $this->fail($app, 'Upload failed');
            return;
        }
        $app->redirect('index.php?option=com_quiz');
    }

    private function fail($app, $message){
        $app->enqueueMessage($message, 'error');
        $app->redirect('index.php?option=com_quiz');
    }

}