<?php $this->beginContent('//layouts/main'); ?>
<div class="row">	
	<div class="span12">

		<?php if (isset($this->pageHeader)): ?>
			<div class="page-header">
				<h1><?php echo $this->pageHeader; ?></h1>
			</div>
		<?php endif; ?>

		<?php echo $content; ?>
	</div>
</div><!-- content -->
<?php $this->endContent(); ?>