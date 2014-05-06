<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>

        <script type='text/javascript'>

            $(document).ready(function() {
               
                $( "#startdate" ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    minDate:0
                });
                $( "#enddate" ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    minDate:0
                });
          
               
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                
                var calendar = $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    
                    eventRender: function(event,element){
                                         
                        function string(event)
                        {
                            var str = event;
                            var str1 = str.toString();
                            var str2 = str1.substr(0, 16);
                            return str2;
                        }
                        var str = string(event.start);
                        var str1 = string(event.end);

                        var id = event.url1;
                        var id1 = id.substr(-26);
                      
                        var content =  "<div><input type=\"hidden\" name=\"id\" value=\""+id1+"\"><table><tr><td><b>Title:</b></td><td>"+event.title+"</td></tr><tr><td><b>When:</b></td><td>"+str+"</td><td>"+str1+"</td></tr><tr><td><b>Where:</b></td> <td>"+event.where+"</td></tr><tr><td><b><a href=\"#\" onClick=\"ajaxt('"+id1+"');\">Delete</a></b></td><td>&nbsp;</td><td><b><a href=\"#\" onClick= \" update('"+id1+"');\">Edit</a></b></td></tr></table></div>";

                        element.qtip({
                            content :content,
                            position: {corner: {tooltip: 'bottomLeft', target: 'topRight'}},
                            style   : {
                                width: 270,
                                padding: 5,
                                background: '#A2D959',
                                color: 'black',
                                textAlign: 'center',
                                border: {
                                    width: 7,
                                    radius: 5,
                                    color: '#A2D959'
                                },
                                tip: 'bottomLeft',
                                name: 'dark' // Inherit the rest of the attributes from the preset dark style

                            },
                            show: {
                                when: { event: 'click' },
                                ready: false
                            },
                            hide: {
                            
                                when: { event: 'inactive' }
                                
                            }
                        });
                    },
                    editable: true,
                    dayClick:function()
                    {
                        $("#mydialog").dialog("open");
                    },
                    events: [
                                <?php $tot = count($events);
                                $i = 0;
                                foreach ($events as $event) {
                                    $i++; ?>
                            {
                            title : '<?php echo ucwords($event->title->text); ?>',
                            description:'<?php echo $event->content; ?>',
                            where:'<?php echo $event->where[0]; ?>',
                            start : '<?php foreach ($event->when as $when) {
                            echo $when->startTime; ?>',
                            end : '<?php echo $when->endTime;
                            } ?>',
                        url1:'<?php 
                        echo $event->id->text; ?>',
                        stick:true,
                        allDay: false
                        }<?php if ($i != $tot)
                        echo ','; ?>
                         <?php } ?>
                                ]
                            });
                        });
                        function ajaxt(id1)
                        {
                            $('.qtip').hide();
                           
                            $("#deletedialog").dialog("open");
                            document.getElementById("idval").value = id1;
                           
                           
                        }
                        function update(id1)
                        {
                            $('.qtip').hide();
                            $("#updatedialog").dialog("open");
                            document.getElementById("g").value = id1;
                        }
        </script>
        <style type='text/css'>
            #calendar {
                width: 900px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div id='calendar'></div>
        <?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'mydialog',
            // additional javascript options for the dialog plugin
            'options' => array(
                'title' => 'Create Event',
                'autoOpen' => false,
                'width' => 500,
                'height' => 350
            )
        ));
        ?>
        <div align="center">
            <p>The <span style="color:#CC0000;">*</span> marked fields are mandatory</p>
            <form name="createevent" action ="" method="post">
                <table style="width:400px;" align="center">
                    <tr>
                        <td> Event Title:<span style="color:#CC0000;">*</span></td><td><input type="text" name="createevent" id="createevent"></td>
                    </tr>
                    <tr>
                        <td> StartDate :<span style="color:#CC0000;">*</span></td><td><input type="text" id="startdate" name="startdate" />
                        </td>
                    </tr>
                    <tr>
                        <td> EndDate :<span style="color:#CC0000;">*</span></td><td><input type="text" id="enddate" name="enddate">
                        </td>
                    </tr>
                    <tr>
                        <td> Where : </td><td><input type="text" name="where" id="where"></td>
                    </tr>
                    <tr>
                        <td> Description : </td><td><textarea name="desc" id="desc"></textarea></td>
                    </tr>
                    <tr><td><input type="submit" name="submit" value="Create Event"></td></tr>
                </table>
            </form>
        </div>
        <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
        <?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'updatedialog',
            // additional javascript options for the dialog plugin
            'options' => array(
                'title' => 'Update Event',
                'autoOpen' => false,
                'width' => 500,
                'height' => 200
            )
        ));
        ?>
        <div align="center">
            <p>The <span style="color:#CC0000;">*</span> marked fields are mandatory</p>
            <form name="updateevent" action="" method="post">
                <table style="width:400px;" align="center">
                    <tr>
                        <td> Enter new event title:<span style="color:#CC0000;">*</span></td><td><input type="text" name="updateeevent" id="updateeevent"></td>
                    </tr>
                    <input type="hidden" name="id" value="" id="g">
                        <tr><td><input type="submit" name="update" value="Update Event"></td></tr>
                </table>
            </form>
        </div>
        <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
        <?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'deletedialog',
            // additional javascript options for the dialog plugin
            'options' => array(
                'title' => 'Delete Event',
                'autoOpen' => false,
                'width' => 500,
                'height' => 100
            )
        ));
        ?>
        <div align="center">

            <form name="deleteeevent" action="" method="post">
                <table style="width:400px;" align="center">
                    <tr>
                        <td>Do you really want to delete this event?</td>
                    </tr>
                    <input type="hidden" name="id" value="" id="idval">
                        <tr><td><input type="submit" name="delete" value="Yes"></td></tr>
                </table>
            </form>
        </div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
    </body>
</html>


