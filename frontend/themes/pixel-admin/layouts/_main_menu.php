<?php
use frontend\models\MainMenu;
use frontend\assets\NavPixel;
?>
<!-- 4. $MAIN_MENU =================================================================================

		Main menu
		
		Notes:
		* to make the menu item active, add a class 'active' to the <li>
		  example: <li class="active">...</li>
		* multilevel submenu example:
			<li class="mm-dropdown">
			  <a href="#"><span class="mm-text">Submenu item text 1</span></a>
			  <ul>
				<li>...</li>
				<li class="mm-dropdown">
				  <a href="#"><span class="mm-text">Submenu item text 2</span></a>
				  <ul>
					<li>...</li>
					...
				  </ul>
				</li>
				...
			  </ul>
			</li>
-->
<div id="main-menu" role="navigation">
    <div id="main-menu-inner">
        <div class="menu-content top" id="menu-content-demo">
            <!-- Menu custom content demo
                 CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss
                 Javascript: html/assets/demo/demo.js
             -->
            <div>
<!--                <div class="text-bg"><span class="text-slim">Welcome,</span> <span class="text-semibold">John</span>-->
                    <div class="text-bg"><span class="text-slim text-sm"><?= $this->params['name']?></span>
                </div>

                <img src="<?php echo \yii\helpers\BaseUrl::base();?>/images/avatars/boy.png" alt="" class="">

                <div class="btn-group">
                    <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-envelope"></i></a>
                    <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
                    <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
                    <a href="#" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
                </div>
                <a href="#" class="close">&times;</a>
            </div>
        </div>
        <?php /*
        <ul class="navigation">
            <li>
                <a href="index.html"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Layouts</span><span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="layouts-grid.html"><span class="mm-text">Grid</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="layouts-main-menu.html"><i class="menu-icon fa fa-th-list"></i><span class="mm-text">Main menu</span><span class="label label-warning">Updated</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="stat-panels.html"><i class="menu-icon fa fa-tasks"></i><span class="mm-text">Stat panels</span></a>
            </li>
            <li>
                <a href="widgets.html"><i class="menu-icon fa fa-flask"></i><span class="mm-text">Widgets</span></a>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-desktop"></i><span class="mm-text">UI elements</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="ui-buttons.html"><span class="mm-text">Buttons</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-typography.html"><span class="mm-text">Typography</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-tabs.html"><span class="mm-text">Tabs &amp; Accordions</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-modals.html"><span class="mm-text">Modals</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-alerts.html"><span class="mm-text">Alerts &amp; Tooltips</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-components.html"><span class="mm-text">Components</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-panels.html"><span class="mm-text">Panels</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-jqueryui.html"><span class="mm-text">jQuery UI</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-icons.html"><span class="mm-text">Icons</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="ui-utility-classes.html"><span class="mm-text">Utility classes</span></a>
                    </li>
                </ul>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-check-square"></i><span class="mm-text">Form components</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="forms-layouts.html"><span class="mm-text">Layouts</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="forms-general.html"><span class="mm-text">General</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="forms-advanced.html"><span class="mm-text">Advanced</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="forms-pickers.html"><span class="mm-text">Pickers</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="forms-validation.html"><span class="mm-text">Validation</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="forms-editors.html"><span class="mm-text">Editors</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="tables.html"><i class="menu-icon fa fa-table"></i><span class="mm-text">Tables</span></a>
            </li>
            <li>
                <a href="charts.html"><i class="menu-icon fa fa-bar-chart-o"></i><span class="mm-text">Charts</span></a>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Pages</span><span class="label label-success">16</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="pages-search.html"><span class="mm-text">Search results</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-pricing.html"><span class="mm-text">Plans &amp; pricing</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-faq.html"><span class="mm-text">FAQ</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-profile.html"><span class="mm-text">Profile</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-timeline.html"><span class="mm-text">Timeline</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-signin.html"><span class="mm-text">Sign In</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-signup.html"><span class="mm-text">Sign Up</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-signin-alt.html"><span class="mm-text">Sign In Alt</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-signup-alt.html"><span class="mm-text">Sign Up Alt</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-invoice.html"><span class="mm-text">Invoice</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-404.html"><span class="mm-text">Error 404</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-500.html"><span class="mm-text">Error 500</span></a>
                    </li>
                    <li class="mm-dropdown">
                        <a href="#"><i class="menu-icon fa fa-envelope"></i><span class="mm-text">Messages</span></a>
                        <ul>
                            <li>
                                <a tabindex="-1" href="pages-inbox.html"><span class="mm-text">Inbox</span></a>
                            </li>
                            <li>
                                <a tabindex="-1" href="pages-show-email.html"><span class="mm-text">Show message</span></a>
                            </li>
                            <li>
                                <a tabindex="-1" href="pages-new-email.html"><span class="mm-text">New message</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-blank.html"><span class="mm-text">Blank page</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="complete-ui.html"><i class="menu-icon fa fa-briefcase"></i><span class="mm-text">Complete UI</span></a>
            </li>
            <li>
                <a href="color-builder.html"><i class="menu-icon fa fa-tint"></i><span class="mm-text">Color Builder</span></a>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-sitemap"></i><span class="mm-text">Menu levels</span><span class="badge badge-primary">6</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.1</span><span class="badge badge-danger">12</span><span class="label label-info">21</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.2</span></a>
                    </li>
                    <li class="mm-dropdown">
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.3</span><span class="label label-warning">5</span></a>
                        <ul>
                            <li>
                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.1</span></a>
                            </li>
                            <li class="mm-dropdown">
                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.2</span></a>
                                <ul>
                                    <li class="mm-dropdown">
                                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 3.1</span></a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 4.1</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 3.2</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.2</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- / .navigation -->
        */
        ?>

        <?php
        echo NavPixel::widget([
            'options' => [
                'class'=>'navigation'
            ],
            'items'=>MainMenu::mainMenu(),
        ]);
        ?>
        <div class="menu-content">
            <a href="pages-invoice.html" class="btn btn-primary btn-block btn-outline dark">Create Invoice</a>
        </div>
    </div>
    <!-- / #main-menu-inner -->
</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->
