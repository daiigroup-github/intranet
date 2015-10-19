<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employee */

$this->title = $model->fullThName;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'view :: ' . $this->title;
$this->params['bodyCSS'] = 'page-profile';
$this->params['pageHeader'] = 'Employee Profile';
?>
<?php
/*
<div class="employee-view">

    <h1><? //= Html::encode($this->title) ?></h1>

    <p>
        <? //= Html::a('Update', ['update', 'id' => $model->employeeId], ['class' => 'btn btn-primary']) ?>
        <? //= Html::a('Delete', ['delete', 'id' => $model->employeeId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
*/
?>

<div class="profile-full-name">
	<span class="text-semibold"><?php echo $model->fnTh . ' ' . $model->lnTh; ?></span>
</div>

<div class="profile-row">
	<div class="left-col">
		<div class="profile-block">
			<div class="panel profile-photo">
				<img src="<?php echo \yii\helpers\BaseUrl::base(); ?>/images/avatars/boy.png" alt="">
			</div>
			<br>
			<?php
			/*
                <a href="#" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Following</a>&nbsp;&nbsp;
                <a href="#" class="btn"><i class="fa fa-comment"></i></a>
            */
			?>
		</div>

		<?php
		/*
        <div class="panel panel-transparent">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-phone"></i> Extension</span>
            </div>
            <div class="panel-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                <a href="#">dolore magna</a> aliqua.
            </div>
        </div>

        <div class="panel panel-transparent">
            <div class="panel-heading">
                <span class="panel-title">Statistics</span>
            </div>
            <div class="list-group">
                <a href="#" class="list-group-item"><strong>126</strong> Likes</a>
                <a href="#" class="list-group-item"><strong>579</strong> Followers</a>
                <a href="#" class="list-group-item"><strong>100</strong> Following</a>
            </div>
        </div>

        <div class="panel panel-transparent profile-skills">
            <div class="panel-heading">
                <span class="panel-title">Skills</span>
            </div>
            <div class="panel-body">
                <span class="label label-primary">UI/UX</span>
                <span class="label label-primary">Web design</span>
                <span class="label label-primary">Photoshop</span>
                <span class="label label-primary">HTML</span>
                <span class="label label-primary">CSS</span>
            </div>
        </div>
        */
		?>

		<div class="panel panel-transparent">
			<div class="panel-heading">
				<span class="panel-title">Contact</span>
			</div>
			<div class="list-group">
				<a href="#" class="list-group-item"><i class="profile-list-icon fa fa-phone"></i>
					Ext. <?php echo $model->ext; ?></a>
				<a href="#" class="list-group-item"><i class="profile-list-icon fa fa-mobile"></i>
					<?php echo $model->mobile; ?></a>
				<a href="#" class="list-group-item"><i class="profile-list-icon fa fa-envelope"></i>
					<?php echo $model->email; ?>@daiigroup.com</a>
			</div>
		</div>

	</div>

	<div class="right-col">
		<div class="profile-content">
			<div class="panel">
				<div class="panel-heading">
					<span class="panel-title"><?php echo $model->fnTh . ' ' . $model->lnTh; ?></span>

					<div class="panel-heading-controls">
						<?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $model->employeeId], ['class' => 'btn btn-xs btn-outline']) ?>
					</div>
				</div>
				<div class="panel-body">
					<?= DetailView::widget([
						'model' => $model,
						'attributes' => [
//                            'employeeId',
							'employeeCode',
//                            'status',
//                            'createDateTime',
//                            'updateDateTime',
//                            'isFirstLogin',
							[
								'attribute' => 'username',
								'value' => strtoupper($model->username),
							],
//                            'password',
//                            'email:email',
							[
								'format' => ['email'],
								'attribute' => 'email',
								'value' => $model->email . '@daiigroup.com',
							],
//                            'prefix',
//                            'prefixOther',
							[
								'format' => ['html'],
								'label' => 'ชื่อ-สกุล',
								'value' => $model->fnTh . ' ' . $model->lnTh . ' (' . $model->nickName . ')' . '<br />' . $model->fnEn . ' ' . $model->lnEn,
							],
//                            'fnTh',
//                            'lnTh',
//                            'nickName',
//                            'fnEn',
//                            'lnEn',
							[
								'attribute' => 'gender',
								'value' => $model->genderText,
							],
							'citizenId',
							'citizenIdExpire',
							'accountNo',
//                            'ext',
//                            'mobile',
//                            'employeeLevelId',
							[
								'attribute'=>'employeeLevelId',
								'value'=>$model->employeeLevel->description
							],
							'position',
//                            'companyId',
							[
								'attribute'=>'companyId',
								'value'=>$model->company->companyNameTh,
							],
//                            'companyValue',
//                            'branchId',
							[
								'attribute'=>'branchId',
								'value'=>$model->branch->branchName,
							],
//                            'branchValue',
//                            'companyDivisionId',
							[
								'attribute'=>'companyDivisionId',
								'value'=>$model->companyDivision->description
							],
//                            'managerId',
							[
								'attribute'=>'managerId',
								'value'=>isset($model->managerId) && !empty($model->managerId) ? strtoupper($model->manager->username) : '-',
							],
//                            'startDate',
							[
								'attribute'=>'startDate',
								'value'=>$model->thaiDate($model->startDate),
							],
//                            'proDate',
//                            'transferDate',
//                            'endDate',
//                            'birthDate',
							[
								'attribute'=>'birthDate',
								'value'=>$model->thaiDate($model->birthDate),
							],
//                            'isSale',
//                            'isEngineer',
//                            'leaveQuota',
//                            'leaveRemain',
//                            'isManager',
							'lastChangePasswordDateTime',
//                            'loginFailed',
						],
					]) ?>
				</div>
			</div>
		</div>
	</div>