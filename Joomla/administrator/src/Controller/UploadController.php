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
       
        $folder = $_FILES['files'];
  
        if (empty($folder['name']))
        {
            $this->fail($app, 'No folder uploaded');
            return;
        }

        $allowedPicture = ['jpeg','png', 'gif', 'jpg'];
        $allowedJson = ['json','jsonc'];


        foreach ($folder['name'] as $i => $name) {
            $ext = strtolower(File::getExt($folder['name'][$i]));
            if (in_array($ext, $allowedPicture)) {
               $destinationFolder = JPATH_ROOT . '/media/com_quiz/images';
            }elseif (in_array($ext, $allowedJson)){
                $destinationFolder = JPATH_ROOT . '/media/com_quiz';
            }else{
                $this->fail($app, 'Invalid file type');
                return;
            }

            $tmpPath = $folder['tmp_name'][$i];
            $fileName = File::makeSafe($folder['name'][$i]);

            if (!Folder::exists($destinationFolder))
            {
                Folder::create($destinationFolder);
            }

            $dest = $destinationFolder . '/' . $fileName;

            if (File::upload($tmpPath, $dest))
            {
                $app->enqueueMessage('file uploaded successfully:' . $folder['name'][$i], 'message');
            }
            else
            {
                $this->fail($app, 'failed uploading' . $folder['name'][$i]);
            }
            
        }

        $app->redirect('index.php?option=com_quiz');
    }

    private function fail($app, $message){
        $app->enqueueMessage($message, 'error');
        $app->redirect('index.php?option=com_quiz');
    }

}