<?php

$this->pageHeader = 'แก้ไขเบอร์ภายในพนักงาน : ' . strtoupper($model->username);
?>
<?php

echo $this->renderPartial('extensionForm', array(
	'model' => $model));
?>