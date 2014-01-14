<?php
$this->breadcrumb = '<li>' . CHtml::link('Customer', Yii::app()->request->urlReferrer) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>View</li>';
$this->pageHeader = 'View Customer : ' . strtoupper($model->customerFnTh);
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/customer/update/' . $model->customerId); ?>"><i class="icon-edit icon-white"></i> Update</a>
	</div>
</div>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'htmlOptions' => array(
		'class' => 'table table-bordered table-striped table-condensed'),
	'attributes' => array(
		'customerType',
		array(
			'name' => 'Customer Name',
			'value' => $model->customerFnTh . ' ' . $model->customerLnTh,
		),
		'customerCompany',
		'email',
		'companyValue',
		//'saleId',
		array(
			'name' => 'address',
			'value' => isset($model->address) ? $model->address : " " . ' ' . $model->city . ' ' . $model->province->provinceName . ' ' . $model->zipcode,
		),
		'phone',
	),
));
?>
