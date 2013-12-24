<div class="form wide well">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'customer-form',
		'enableAjaxValidation' => false,
	));
	?>

	<div class="row">
		<div class="span">
			<p class="note">Fields with <span class="required">*</span> are required.
				<?php
				echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
					'class' => 'alert alert-error'));
				?>
				<?php
				echo $form->errorSummary($customerSale, 'Please fix the following input errors', '', array(
					'class' => 'alert alert-error'));
				?>
			</p>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model, 'customerType'); ?>
			<?php
			echo $form->dropDownList($model, 'customerType', $model->getCustomerType(), array(
				'class' => 'input-medium'));
			?>
			<?php echo $form->error($model, 'customerType'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model, 'customerFnTh'); ?>
			<?php
			echo $form->textField($model, 'customerFnTh', array(
				'size' => 60,
				'maxlength' => 80,
				'class' => 'input-small'));
			?>
			<?php echo $form->error($model, 'customerFnTh'); ?>
		</div>

		<div class="span3">
			<?php echo $form->labelEx($model, 'customerLnTh'); ?>
			<?php
			echo $form->textField($model, 'customerLnTh', array(
				'size' => 60,
				'maxlength' => 120,
				'class' => 'input-medium'));
			?>
			<?php echo $form->error($model, 'customerLnTh'); ?>
		</div>
	</div>

	<div class="row">

		<div class="span3">
			<?php echo $form->labelEx($model, 'email'); ?>
			<?php
			echo $form->textField($model, 'email', array(
				'size' => 60,
				'maxlength' => 120,
				'class' => 'input-medium'));
			?>
			<?php echo $form->error($model, 'email'); ?>
		</div>
	</div>


	<div class="row">
		<div class="span">
			<?php echo $form->labelEx($model, 'customerCompany'); ?>
			<?php
			echo $form->textField($model, 'customerCompany', array(
				'size' => 60,
				'maxlength' => 120));
			?>
			<?php echo $form->error($model, 'customerCompany'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($customerSale, 'saleId'); ?>
			<?php
			$saleModel = Employee::model()->find("employeeId =:employeeId AND isSale = 1", array(
				":employeeId" => Yii::app()->user->id));
			if (count($saleModel) == 0)
			{
				echo $form->dropDownList($customerSale, 'saleId', Employee::model()->getAllSaleByCompanyId(), array(
					'class' => 'input-small',
					'name' => 'CustomerSale[sales][' . $customerSale->saleId . ']',
					'multiple' => 'multiple'));
			}
			else
			{
				echo $saleModel->username;
				echo $form->hiddenField($customerSale, "sales[$saleModel->employeeId]", array(
					"value" => $saleModel->employeeId));
			}
			?>
			<?php echo $form->error($model, 'saleId'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model, 'engineerId'); ?>
			<?php
			echo $form->textField($model, 'engineerId', array(
				'size' => 10,
				'maxlength' => 10,
				'class' => 'input-small'));
			?>
			<?php echo $form->error($model, 'engineerId'); ?>
		</div>
	</div>

	<div class="row">	
		<div class="span2">
			<?php echo $form->labelEx($model, 'address'); ?>
			<?php
			echo $form->textArea($model, 'address', array(
				'rows' => 6,
				'cols' => 50));
			?>
			<?php echo $form->error($model, 'address'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model, 'city'); ?>
			<?php
			echo $form->textField($model, 'city', array(
				'size' => 60,
				'maxlength' => 80,
				'class' => 'input-small'));
			?>
			<?php echo $form->error($model, 'city'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model, 'province'); ?>
			<?php
			echo $form->dropDownList($model, 'province', Province::model()->getAllProvince(), array(
				'class' => 'input-medium'));
			?>
			<?php echo $form->error($model, 'province'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model, 'zipcode'); ?>
			<?php
			echo $form->textField($model, 'zipcode', array(
				'size' => 10,
				'maxlength' => 10,
				'class' => 'input-mini'));
			?>
			<?php echo $form->error($model, 'zipcode'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model, 'phone'); ?>
			<?php
			echo $form->textField($model, 'phone', array(
				'size' => 30,
				'maxlength' => 30,
				'class' => 'input-medium'));
			?>
			<?php echo $form->error($model, 'phone'); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->