<?php
/**
 *  $title = string
 *  $icon = string : fa-xxx
 *  $items = [
 *      ['title'=>string, 'label'=>'string', 'labelClass'=>string]
 * ]
 * $data = [
 *      [
 *          'xkey'=>string,
 *          'ykey'=>float
 *      ]
 * ],
 * $labels = string
 * $xLabels = Default month
 */

$xLabels = (isset($xLabels)) ? $xLabels : 'month';
$d = json_encode($data);
?>

<?php
$this->registerJs("
    init.push(function () {
        var uploads_data = {$d};
        Morris.Line({
            element: 'hero-graph',
            data: uploads_data,
            xkey: 'xkey',
            ykeys: ['ykey'],
            labels: ['{$labels}'],
            lineColors: ['#fff'],
            lineWidth: 2,
            pointSize: 4,
            gridLineColor: 'rgba(255,255,255,.5)',
            resize: true,
            gridTextColor: '#fff',
            xLabels: '{$xLabels}',
            xLabelFormat: function(d) {
                return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
            }
        });

    });
");
?>

<div class="stat-panel">
    <div class="stat-row">
        <?php
        /**
         * left cell
         */
        if(isset($title)):
        ?>
        <div class="stat-cell col-sm-4 bordered no-border-r padding-sm-hr valign-top">
            <h4 class="padding-sm no-padding-t padding-xs-hr">
                <?php if (isset($icon)): ?>
                    <i class="fa <?= $icon?> text-primary"></i>&nbsp;&nbsp;
                <?php endif; ?>
                <?= $title?>
            </h4>

            <ul class="list-group no-margin">
                <?php foreach($items as $item):?>
                    <?php $labelClass = isset($item['labelClass']) ? ' '.$item['labelClass'] : '';?>
                <li class="list-group-item no-border-hr padding-xs-hr">
                    <?= $item['title']?> <span class="label<?=$labelClass?> pull-right"><?=$item['label']?></span>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php endif;?>

        <?php
        /**
         * right cell
         */
        ?>
        <div class="stat-cell col-sm-8 bg-primary padding-sm valign-middle">
            <div id="hero-graph" class="graph" style="height: 180px;"></div>
        </div>
    </div>
</div> <!-- /.stat-panel -->
<!-- /12. $EXAMPLE_UPLOAD_STATISTICS -->