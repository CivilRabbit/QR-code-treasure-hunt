<?php defined('_JEXEC') or die; ?>

<h1>Choose a folder containing all the pictures and a json with the questions</h1>
<form action="index.php?option=com_quiz&task=upload.save"
      method="post"
      enctype="multipart/form-data">

    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">

    <button type="submit">Upload</button>

    <?php echo JHtml::_('form.token'); ?>
</form>
