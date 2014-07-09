<script>
	function equalHeight(group) {
		tallest = 350;
		group.each(function() {
			thisHeight = $(this).height();
			if (thisHeight > tallest) {
				tallest = thisHeight;
			}
		});
		group.each(function() {
			$(this).height(tallest);
		});
	}

	$(document).ready(function() {
		equalHeight($(".thumbnail"));
	});
</script>
<div class="span3" style="margin-bottom: 8px;">
	<div class="thumbnail text-center" >
		<div class="row-fluid " >
			<div class="span12 " >
				<div style="text-align:center">
					<?php
					if(!empty($data->imageUrl))
					{
						if(strpos($data->imageUrl, ".pdf"))
						{
							$imgUrl = Yii::app()->baseUrl . "/images/ico/pdf_icon.png";
							echo "<p><a class='pdf' Title='$data->title' href='$data->imageUrl'><img src='$imgUrl' width='80%' alt='' /></a></p>";
						}
						else
						{
							echo "<p class='text-center'><a class='fancyFrame' Title='$data->title' href='$data->imageUrl'><img src='$data->imageUrl' width='80%' alt='' /></a></p>";
						}
					}
					else
					{
						switch($data->noticeType->noticeTypeCode)
						{
							case "A":
								$imgUrl = Yii::app()->baseUrl . "/images/ico/news_icon.jpg";
								break;
							case "B":
								$imgUrl = Yii::app()->baseUrl . "/images/ico/policy_icon.gif";
								break;
							case "C":
								$imgUrl = Yii::app()->baseUrl . "/images/ico/support_icon.png";
								break;
							default:
								break;
						}

						echo "<p class='text-center'><a class='fancyFrame' Title='$data->title' href='$data->imageUrl'><img src='$imgUrl' width='80%' alt='' /></a></p>";
					}
					?>
				</div>
				<div class="" >
					<h4 >
						<a  target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$data->noticeId"); ?>"><?php echo $data->title; ?></a>
					</h4>
					<p><?php
						if(1 == 1)
						{
							if(isset($data->headline) && !empty($data->headline))
							{
								echo $data->headline;
							}
							?>

							<?php
						}
						?>
					</p>
					<?php
					echo CHtml::link("รายละเอียด", Yii::app()->createUrl("/notice/view/$data->noticeId"), array(
						'class'=>'btn'));
					?>
				</div>
			</div>
		</div>
	</div>
</div>
