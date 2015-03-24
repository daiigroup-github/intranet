<?php
/**
 * Created by PhpStorm.
 * User: NPR
 * Date: 3/18/15
 * Time: 1:12 PM
 */
$this->pageHeader = 'Import Fit and Fast';

$this->breadcrumb = '<li>' . CHtml::link('Manage Fit And Fast', $this->createUrl('index')) . '<span class="divider">/</span> Import</li>';
?>

<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label" for="fFile">Year</label>
        <div class="controls">
            <?php echo CHtml::dropDownList('forYear', date('Y'), array(date('Y')-1=>date('Y')-1, date('Y')=>date('Y'), date('Y')+1=>date('Y')+1));?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="fFile">File</label>
        <div class="controls">
            <input type="file" id="fFile" name="fFile">
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Import</button>
        </div>
    </div>
</form>