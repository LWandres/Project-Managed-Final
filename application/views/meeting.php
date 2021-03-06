<head>
    <title>Meeting Agenda</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="/assets/css/meetingagenda.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/dashboard.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-theme.min.css">

    <!-- JS -->
    <script type="text/javascript" src="/assets/js/jquery-3.1.0.min.js"></script>
    <script async src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/tinymce/tinymce.minified.js"></script>

</head>
<!-- including header partial -->
<?php include_once("header2.php"); ?>
</div><!--intentional div for formatting-->
    <div id="background">
        <div class="email">
            <form method="post" action="/apis/sendemail/<?=$agenda['id']?>">
                <input type="submit" name="email" value="Email Notes to Participants"></input>
            </form>
            <form method="post" action="/apis/createPDF/<?=$agenda['id']?>">
                <input type="submit" name="PDF" value="Create PDF"></input>
            </form>
        </div>

        <div id="notes-container">
            <div id="agenda">
                <a href="/display/loaddashboard" name="back">Back to other meetings</a>
                <h2 id="meetingname">  <?=$agenda['name']?></h2>
                <ul id="date">
                    <li><?=date('l F d Y',strtotime($agenda['date']))?></li>
                    <li><?= date("g:i a", strtotime($agenda['start']))?> - <?= date("g:i a", strtotime($agenda['end']))?></li>
                </ul>

                <form action="/main/updatenotes/<?=$agenda['id']?>" method="post">
                    <?php $stringdate = date('Y-m-d', strtotime($agenda['date']))?>
                    <label>Meeting Name:</label><input type="text" name="meeting" value="<?=$agenda['name']?>"><br>
                    <label>Meeting Date:</label><input type="date" name="meetingdate" value="<?= $stringdate?>"><br>
                    <label>Starting:</label><input type="time" name="start" step=900 value="<?=$agenda['start']?>"><br>
                    <label>Ending:</label><input type="time" name="end" step=900 value="<?=$agenda['end']?>"><br>
                    <h4>Objectives</h4>
                    <div class="objectives"><textarea name="objectives"><?=$agenda['objective']?></textarea></div>
                    <h4>Goals</h4><div class="goals"><textarea name="goals"><?=$agenda['goals']?></textarea></div>
                    <h4>Attendees</h4>
                    <div class="attendees">
                        <?php foreach($attendees as $attendee){
                              $attendees ?>
                            <input type="checkbox" name="attendee[]" value="<?=$attendee['users_id']?>">
                              <?=$attendee['first']." ".$attendee['last']?>
                            </input><br>
                        <?php }?>
                    </div>

                    <h4>Agenda & Notes</h4>
                    <div class="Agenda">
                        <textarea name="agenda" size="200" required>
                            <?=$agenda['agenda']?>
                        </textarea>
                    </div>
                    <input type="submit" value="Save Notes"></input>
                </form><br><!--end update notes form-->

                <h4>Meeting Follow Ups</h4>
                <div class="FollowUps">
                    <form class="followtable" method="post" action="/main/updatefollows/<?=$agenda['id']?>">
                        <div class="input_fields_wrap">
                            <button class="add_field_button">Add New Followup</button>
                            <input type="hidden" name="meetingid" value="<?=$agenda['id']?>"></input>
                            <input type="submit" name="updatefollowup" value="Save Follow Ups"></input>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Owner</th>
                                        <th>Follow Up</th>
                                        <th>Due</th>
                                        <th>Done?</th>
                                    <tr>
                                </thead>
                                <tbody>
                                    <div>
                                        <tr><!--empty fields for followups-->
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </div>
                                    <?php if(empty($followups)){ echo "<tr>This meeting doesn't have any follow ups yet<tr>";
                                    } ?>
                                    <?php if(!empty($followups)){
                                           foreach($followups as $follow){ ?>
                                                <tr>
                                                   <td><?=$follow['first']?> <?=$follow['last']?></td>
                                                   <td><?=$follow['followup']?></td>
                                                   <td><?= date('F m, Y',strtotime($follow['duedate']))?></td>
                                                   <td><?=$follow['followstatus']?></td>
                                                 </tr>
                                               <?php }
                                         }?>
                                </tbody>
                            </table><!--end follow ups table-->
                        </div><!--end follow ups wrapper-->
                    </form><!--end follow ups form-->
                </div><!--end follow ups div-->
            </div><!--end agenda div-->
        </div><!--end notes container div-->
    </div><!--end background div-->
    <script>
        $(document).ready(function() {
            var max_fields = 30; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div><tr><td><select name="owner[]"><?php foreach($attendees as $attendee){ ?><option value="<?=$attendee['id']?>"><?= $attendee['first']." ".$attendee['last']?></option></td>"<?php }?>"<td><input type="text" name="follow[]"></td><td><input type="date" name="due[]"></td><td><select name="status[]"><option value="No">No</option><option value="Yes">Yes</option></select></td><td></tr><a href="#" class="remove_field">Remove</a></div>');
                }
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })

            tinymce.init({
                selector: 'textarea',
                browser_spellcheck: true,
                plugins: 'link advlist spellchecker paste textcolor colorpicker wordcount contextmenu hr',
                advlist_bullet_styles: "default circle disc square",
                menubar: "edit view insert",
                toolbar: 'undo redo |  bold italic | bullist numlist | styleselect | alignleft aligncenter alignright | spellchecker | paste | forecolor backcolor | link | fontselect |  fontsizeselect',
                fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            });
        });
    </script>
</body>
</html>
