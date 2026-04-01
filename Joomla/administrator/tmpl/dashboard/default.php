<?php defined('_JEXEC') or die; ?>

<h1>Choose a question file</h1>
<form action="index.php?option=com_quiz&task=upload.save&type=json"
      method="post"
      enctype="multipart/form-data">

    <input type="file" name="myfile" />

    <button type="submit">Upload</button>

    <?php echo JHtml::_('form.token'); ?>
</form>

<h1>Upload the used images one by one</h1>
<form action="index.php?option=com_quiz&task=upload.save&type=img"
      method="post"
      enctype="multipart/form-data">

    <input type="file" name="myfile" />

    <button type="submit">Upload</button>

    <?php echo JHtml::_('form.token'); ?>
</form>