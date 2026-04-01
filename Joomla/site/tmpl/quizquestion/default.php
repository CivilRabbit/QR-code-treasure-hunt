<?php defined('_JEXEC') or die; ?>
<div class="box">
    <div class="quiz-container">

        <span class="popuptext" id="success"></span>
        <span class="popuptext" id="failure"></span>

        <h2 class="question"><?= htmlspecialchars($this->question->question) ?></h2>

        <?php 
        $type = $this->question->type;
        if ($type== 'ms') {
            ?> <div class="buttonBox"> <?php
            foreach ($this->question->answers as $answer) { ?>
            <button
                class="niceButton"
                data-correct="<?= $answer->correct ? '1' : '0' ?>"
                data-hint="<?= htmlspecialchars($answer->hint ?? '', ENT_QUOTES, 'UTF-8') ?>"
                data-current="<?= (int) $this->current ?>">
                <?= htmlspecialchars($answer->text) ?>
            </button>
            <?php 
            } ?> 
            </div> 
            <?php
        }elseif ($type == 'txt'){?>
                <form class="niceForm" id="form"
                    data-correct="<?= htmlspecialchars($this->question->correct ?? '', ENT_QUOTES, 'UTF-8')?>"
                        data-hint="<?= htmlspecialchars($this->question->hint ?? '', ENT_QUOTES, 'UTF-8')?>"
                        data-current="<?= (int) $this->current ?>">
                    <input type="text" id="textBox" placeholder="your answer">
                    <button type="submit" class="niceButton"> Check
                    </button>
                </form>
            <?php 
        }else{
            echo("Does not recognize type: " . $type);
        }
        ?>
    </div>
</div>