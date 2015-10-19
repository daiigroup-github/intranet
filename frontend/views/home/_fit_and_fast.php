<div class="panel colourable">
    <div class="panel-heading">
        <span class="panel-title">Fit And Fast</span>

        <div class="panel-heading-controls">
            <button class="btn btn-xs btn-warning btn-outline"><span class="fa fa-refresh"></span>&nbsp;&nbsp;All
            </button>
        </div>
        <!-- / .panel-heading-controls -->
    </div>
    <!-- / .panel-heading -->
    <div class="panel-body">
        <div class="row">

            <div class="col-lg-3 col-xs-12">
                <?= $this->renderFile('@app/themes/pixel-admin/layouts/_fitandfast_panel.php', ['fitandfast' => $fitandfastEmployee]); ?>
            </div>

            <div class="col-lg-9">
                <?= $this->renderFile('@app/themes/pixel-admin/layouts/stat_panel/_statistic.php', [
                    'title' => 'Monthly (YTD)',
                    //'icon' = '',
                    'labels' => '%',
                    'data' => $fitfastStat,
                    'items' => [
                        [
                            'title' => 'SS',
                            'label' => $fitandfastEmployee['grades']['SS'],
                            'labelClass' => 'label-success'
                        ],
                        [
                            'title' => 'S',
                            'label' => $fitandfastEmployee['grades']['S'],
                            'labelClass' => 'label-primary'
                        ],
                        [
                            'title' => 's',
                            'label' => $fitandfastEmployee['grades']['s'],
                            'labelClass' => 'label-info'
                        ],
                        [
                            'title' => 'F',
                            'label' => $fitandfastEmployee['grades']['F'],
                            'labelClass' => 'label-danger'
                        ]
                    ]
                ]); ?>
            </div>
        </div>
    </div>
</div>