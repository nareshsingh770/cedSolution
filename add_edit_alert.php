<!-- 
 <div id="spmodalemailalert" class="modal">
        <div class="modal-content" >
            <h4>Would you like to send email notifications regarding this post to your staff?</h4>
            <p class="p1 cedr-darkgray-font center"></p>
            <div class="center">
            <button style="display:inline-block;" onclick="document.getElementById('alertemailflag').value = 1; document.getElementById('alertform').submit();" style="min-width: 100px;" class="waves-effect orangeButton waves-light">Yes</button>
            <button style="display:inline-block;" onclick="document.getElementById('alertemailflag').value = 0; document.getElementById('alertform').submit();" style="min-width: 100px;" class="waves-effect orangeButton waves-light">No</button>
            </div>
            <div class="moveCancel">
                <span class="or">or</span>
                <a href="#!" class="modal-close">Cancel</a>
            </div>
        </div>
</div>
 -->
<?
    $myusernamemod = $_POST['myusernamemod'];
    $monummod = $_POST['monum'];

    if ($_POST['setmaster']) {$_SESSION['master'] = true;}

    $myusername = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), base64_decode($myusernamemod), MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))), "\0");                      
    $monum = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), base64_decode($monummod), MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))), "\0");

    if ($_SESSION['master'])
      $sql = "SELECT
      office.message,
      office.messagestart,
      office.messageend
      FROM
      office where num = $monum";
    else 
    $sql = "SELECT
      office.message,
      office.messagestart,
      office.messageend
      FROM
      login
      JOIN office
      ON login.office = office.num and username = '$myusername'";

    $result=mysql_query($sql);

    while($row = mysql_fetch_array($result))
      {
            $message = $row['message'];
            $messagestart = $row['messagestart'];
            $messageend= $row['messageend'];
      }

    if ($message == '')
    {
      $startyear = date('Y');
      $startmonth = date('m');
      $startday = date('d');
      $endyear = date('Y');
      $endmonth = date('m');
      $endday = date('d');
      $at = 'Add';
      $ab = 'Add';
    }
    else
    {
      $startyear = date("Y", strtotime($messagestart));
      $startmonth = date("n", strtotime($messagestart));
      $startday = date("j", strtotime($messagestart));
      $endyear = date("Y", strtotime($messageend));
      $endmonth = date("n", strtotime($messageend));
      $endday = date("j", strtotime($messageend));
      $at = 'Edit';
      $ab = 'Save';
    }
?>


<form id="alertform" name="alertform" method="post" action="/membership/sandbox4/alert.php">


    <?php 
  if (!is_page(array(24185,26103)))  
    {
      $add_alert_editor = '<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=otgs49idhv3ao1eazl4hqu81ab7b7rfxfi1pyrx9itwi4qg2"></script>';
      $add_alert_editor .= '
        <script>
            function addAlertModal() { 
              var iframe = $("#alertmessage_ifr");
              var editorContent = $("#tinymce[data-id=alertmessage]", iframe.contents()).text().length;
              var title_length  = $("#addPost #alertsubject").val().length;
              var end_date_length  = $("#hiredate2").datepicker().val().length;

              if(editorContent == 0 || title_length == 0 || end_date_length == 0) {
                 $("#addPost .alertSaveButton").addClass("disabled-button disabledbtn");
              } else {
                 $("#addPost .alertSaveButton").removeClass("disabled-button disabledbtn");
              }  
           } 

          tinymce.init({        
              selector: "textarea#alertmessage",
              ui_container: "#addPost",
              height: "1000",
              convert_urls: false,
              init_instance_callback: function(editor) {
                editor.on("keyup", function() {  
                  addAlertModal();       
                });
             }   
          });            

          $("#addPost").on("keyup", "#alertsubject", function() {        
             addAlertModal();
          })
      </script>'; 

     echo $add_alert_editor;     

    

  } 
?>



    <input type="hidden" id="alertemailflag" name="alertemailflag">
    <h2 class="ctn_heading">

        <? if($at == "Add") { ?>
        <svg class="addPostSVG" version="1.1" id="Isolation_Mode" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 185 153.7"
            style="enable-background:new 0 0 185 153.7;" xml:space="preserve">

            <g>
                <path class="st0" d="M81.5,135.4c-5.8,0-10.5-4.8-10.5-10.5c0-0.7-0.5-1.2-1.2-1.2s-1.2,0.5-1.2,1.2c0,7.1,5.8,12.9,12.9,12.9
                                c0.7,0,1.2-0.5,1.2-1.2C82.7,135.9,82.2,135.4,81.5,135.4z" />
                <g>
                    <path class="st0" d="M140.3,122.7c-0.1,0.5-0.3,0.9-0.7,1.2C139.9,123.6,140.2,123.1,140.3,122.7z" />
                    <path class="st0" d="M121,122.2c0,0.3,0.1,0.6,0.2,0.9c0.1,0.1,0.2,0.3,0.2,0.4c-0.1-0.1-0.2-0.3-0.2-0.4
                                  C121.1,122.8,121,122.5,121,122.2z" />
                    <path class="st0" d="M133,124.6h-9.6c-0.3,0-0.6-0.1-0.9-0.2c0.3,0.1,0.6,0.2,0.9,0.2L133,124.6l4.9,0c0.5,0,0.9-0.2,1.3-0.4
                                  c-0.4,0.3-0.8,0.4-1.3,0.4H133z" />
                    <path class="st0" d="M168.7,77.2c0.2,0.3,0.4,0.5,0.5,0.8C169.1,77.7,168.9,77.5,168.7,77.2z" />
                    <path class="st0" d="M93.6,95.5c0.1,0.1,0.3,0.1,0.4,0.1c0.2,0,0.3,0.1,0.5,0.1c-0.2,0-0.3-0.1-0.5-0.1
                                  C93.9,95.6,93.7,95.6,93.6,95.5z" />
                    <path class="st0" d="M168.9,94.9c0.1-0.1,0.1-0.2,0.2-0.2c0-0.1,0.1-0.2,0.1-0.3c-0.1,0.1-0.1,0.2-0.2,0.3
                                  C169,94.8,169,94.9,168.9,94.9z" />
                    <path class="dingPart" d="M81.5,135.3c-5.7,0-10.5-4.7-10.5-10.5c0-0.7-0.5-1.2-1.2-1.2s-1.2,0.5-1.2,1.2c0,7.1,5.8,12.9,12.9,12.9
                                  c0.7,0,1.2-0.5,1.2-1.2S82.2,135.3,81.5,135.3z" />
                    <path class="st0" d="M113,108.7v-5H94.5c-0.7,0-1.3-0.1-1.8-0.2c-1.7-0.2-3-0.9-3.9-1.6c-0.4-0.2-1-0.7-1.6-1.3c-0.4-0.4-1.3-1.3-2-2.7
                                  c-0.8-1.5-1.1-3.1-1.1-4.8V78.7c0-1.7,0.4-3.3,1.1-4.8c0.7-1.4,1.6-2.3,2-2.7c1.1-1.1,2.3-1.8,3.8-2.3l1.2-0.4h0.2
                                  c0.8-0.2,1.5-0.2,2-0.2h18.8V49.8c0-1.3,0.3-2.3,0.5-3c0.4-1.5,1.2-2.8,2.3-3.9c0,0,0.1-0.1,0.1-0.1c-4.5-9.8-14.4-18.3-28.3-20.3
                                  c0.4-0.9,0.6-1.8,0.6-2.9c0-3.9-3.1-7-7-7s-7,3.1-7,7c0,1,0.2,2,0.6,2.9c-19.4,2.9-31,18.2-31,32.3c0,35.3-12.6,51.7-23.4,60.8
                                  c0,5.1,4.2,9.4,9.4,9.4h32.8c0,10.3,8.4,18.7,18.7,18.7c10.3,0,18.7-8.4,18.7-18.7h13.1c-0.2-0.7-0.4-1.6-0.4-2.7V108.7z
                                   M81.5,137.7c-7.1,0-12.9-5.8-12.9-12.9c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2c0,5.8,4.8,10.5,10.5,10.5c0.7,0,1.2,0.5,1.2,1.2
                                  S82.2,137.7,81.5,137.7z" />

                    <path class="st0" d="M168.7,77.2c-0.2-0.2-0.5-0.4-0.8-0.5c-0.3-0.1-0.6-0.2-0.9-0.2h-26.5V49.9c0-1.3-1.1-2.4-2.4-2.4h-13.4h-1
                                  c-0.3,0-0.6,0.1-0.9,0.2c-0.1,0.1-0.3,0.2-0.4,0.2c-0.3,0.2-0.5,0.4-0.7,0.6c-0.1,0.1-0.2,0.3-0.2,0.4c-0.1,0.3-0.2,0.6-0.2,0.9
                                  v0.1c0-0.3,0.1-0.6,0.2-0.9c-0.1,0.3-0.2,0.6-0.2,0.9v26.4h-0.4H94.5c-0.2,0-0.3,0-0.5,0.1c-0.1,0-0.3,0.1-0.4,0.1
                                  c-0.3,0.1-0.5,0.2-0.7,0.4c-0.2,0.2-0.4,0.4-0.5,0.6c-0.2,0.4-0.3,0.8-0.3,1.2v14.5c0,0.4,0.1,0.8,0.3,1.2
                                  c0.1,0.2,0.3,0.4,0.5,0.6c0.2,0.2,0.5,0.3,0.7,0.5c0.1,0.1,0.3,0.1,0.4,0.1c0.2,0,0.3,0.1,0.5,0.1H121v13v13.5
                                  c0,0.3,0.1,0.6,0.2,0.9c0.1,0.2,0.2,0.3,0.2,0.4c0.3,0.4,0.6,0.7,1.1,0.9c0.3,0.1,0.6,0.2,0.9,0.2h9.6h4.9c0.5,0,0.9-0.2,1.3-0.4
                                  c0.1-0.1,0.2-0.2,0.4-0.3c0.3-0.3,0.6-0.7,0.7-1.2c0-0.2,0-0.3,0-0.5V121v-7.6v-5.8v0V97v-1.1H167c0.3,0,0.6-0.1,0.9-0.2
                                  c0.3-0.1,0.5-0.3,0.8-0.5c0.1-0.1,0.2-0.2,0.2-0.2c0.1-0.1,0.1-0.2,0.2-0.2c0.1-0.1,0.1-0.2,0.2-0.3c0-0.1,0.1-0.2,0.2-0.4
                                  c0-0.2,0-0.3,0-0.5V78.9c-0.1-0.3-0.1-0.6-0.2-0.9C169.1,77.7,168.9,77.5,168.7,77.2z M167,76.6c0.3,0,0.6,0,0.9,0.2
                                  C167.6,76.7,167.3,76.6,167,76.6z M168.6,95.2c0.2-0.1,0.3-0.3,0.4-0.5C168.9,94.9,168.8,95.1,168.6,95.2z M168.6,77.3
                                  c0.3,0.2,0.4,0.4,0.5,0.8C169,77.8,168.8,77.5,168.6,77.3z" />

                    <path d="M167.9,76.8c-0.3-0.2-0.6-0.2-0.9-0.2C167.3,76.6,167.6,76.7,167.9,76.8z" />
                    <path d="M168.6,77.3c0.2,0.2,0.4,0.5,0.5,0.8C169,77.7,168.9,77.5,168.6,77.3z" />
                </g>
            </g>
        </svg>
        <? } ?>

        <? if($at == "Edit") {echo "<i class='fa fa-bell'></i>";} ?>

        <span>
            <? echo $at; ?> Post
    </h2>
    <p class="p1 cedr-darkgray-font center">
        <?php 
                                      if($at == "Add") {echo "Schedule a post to display on your company's Bulletin Board.";}
                                      elseif ($at == "Edit") {echo "Edit or delete this previously scheduled post.";}        
                                   ?>
    </p>
    <hr />
    <div class="island active">
        <!--    <div class="titleWrapper activeTab">
                <i class="fa fa-bell" aria-hidden="true"></i> <?// echo $at; ?> Post
            </div> -->
        <div class="islandContent">
            <div class="col s6 smaller2 noLeftPad dateAnchor">
                <span class="p3 cedr-darkgray-font">
                    <label style="position: relative;bottom: 10px;">End Date*</label>
                    <select name="endmonth" style="display: none !important"
                        class="browser-default inline-select month">
                        <?
                            $arr_m = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
                            for ($i = 1; $i <= 12; $i++) {
                                $name = $arr_m[$i-1];
                                $sel = ($i == $endmonth) ? ' selected="selected"' : '';
                                echo "<option value=\"$i\"$sel>$name</option>";
                            }
                            ?>
                    </select>
                    <select name="endday" style="display: none !important" class="browser-default inline-select day">
                        <?
                            for ($i = 1; $i <= 31; $i++) {
                                $sel = ($i == $endday) ? ' selected="selected"' : '';
                                echo "<option value=\"$i\"$sel>$i</option>";
                            }
                            ?>
                    </select>
                    <select name="endyear" style="display: none !important" class="browser-default inline-select year">
                        <?
                            $minyear = date("Y");
                            $maxyear = date("Y")+1;
                            for ($i = $minyear; $i <= $maxyear; $i++) {
                                $sel = ($i == $endyear) ? ' selected="selected"' : '';
                                echo "<option value=\"$i\"$sel>$i</option>";
                            }
                            ?>
                    </select>
                </span>
                <!--  <input class="" type="text" name="hiredate2" id="hiredate2" value="11/19/2020">    -->

                <? if  ($message != '') { ?>
                <input class="" type="text" name="hiredate2" id="hiredate2" value="11/19/2020" autocomplete="off">
                <? } else { ?>
                <input class="add_date" type="text" name="hiredate2" id="hiredate2" value="" autocomplete="off">
                <? } ?>
            </div>
            <div class="clearfix"></div>
            <div class="colWrapper">
                <div class="noteCategory col s12">
                    <label>Subject*</label>
                    <input type="text" name="alertsubject" id="alertsubject" autocomplete="off" value="">
                </div>
                <div class="clearfix"></div>
            </div>
            <label>Message* </label> 
				
				<span class="pin_post" style="float:right;">
				
				<span>
                    <!-- <input id="pinTop" name="pinTop" type="radio" class="proxy_checkbox custom_proxy_checkbox1" value="pinTop">
                        <label for="pinTop"><span class="pin_post">Pin post to top?</span></label> -->
                    <label>
                        <input type="checkbox" class="filled-in proxy_checkbox custom_proxy_checkbox1" id="pinTop" value="pinTop"/>
                        <span class="chck"></span>
                       
                    </label> 
                </span> &nbsp;Pin post to top?</span>

            <div class="input-field">
                <textarea name="alertmessage" maxlength="1000" id="alertmessage" cols="20" rows="20"
                    class="materialize-textarea alertMessage"><? echo $message; ?></textarea>
            </div>

            <div class="alertControls clearfix">
                (Max 1000 char)
                <!-- <p><input id="notifyEmail" name="notifyEmail" type="radio" class="proxy_checkbox custom_proxy_checkbox1" value="notifyEmail">
                        <label for="notifyEmail"><span class="notify">Notify employees via email?</span></label> -->
               <p> <label>
                    <input type="checkbox" class="filled-in proxy_checkbox custom_proxy_checkbox1" id="notifyEmail" value="notifyEmail"/>
                    <span class="chck"></span>
                   
                </label>
                <span class="notify">Notify employees via email?</span>
                </p> 
                <? if  ($message != '') { ?>

                <div class="controlWrapper controlWrapper-edit">
                    <? } else { ?>
                    <div class="controlWrapper">

                        <? } ?>
                        <div class="alertCancel"><a href="#add_cancel_btn" type="submit" name="buttonchoice"
                                class="cancelButton cedr-darkgray-font" value="Cancel">Cancel</a><span
                                class="or">or</span></div>
                        <? if  ($message != '') { ?>
                        <a href="#delete_cancel_btn" name="buttonchoice" class="orangeButton orange_btn" value="Delete">
                            Delete</a>
                        <? } ?>
                        <button id="button" type="submit" name="buttonchoice"
                            class="orangeButton disabledbtn alertSaveButton" value="<? echo $ab.' Alert'; ?>">
                            <? echo $ab; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>



<script>
$(document).ready(function() {

	if($('.controlWrapper').hasClass('controlWrapper-edit')) {
	   $('#addPost').addClass('edit_post_modal')
	}
    // function validateform() { 
    //     if($("#hiredate2").val().length >= 1 && $("#alertmessage").val().length >= 1 && $("#alertsubject").val().length >= 1){
    //       $('#addPost #button').removeClass('disabledbtn')
    //     } else {
    //       $('#addPost #button').addClass('disabledbtn')
    //     }
    // }
    // $('#alertmessage, #alertsubject').on('keyup',function(){
    //     validateform();
    // }); 
    // $('#hiredate2').on('change',function(){
    //     validateform();
    // });
    // $('#hiredate2').on('input',function(){
    //     validateform();
    // });

    // $("#button").click(function () {
    //     if ($("#hiredate2").val().length >= 1 && $("#alertmessage").val().length >= 1) {
    //         $('#spmodalemailalert').modal({
    //           dismissible: true,
    //            startingTop: '10%', 
    //            endingTop: '195px'
    //         }); $('#spmodalemailalert').modal('open');          
    //     } 
    //      // else {
    //      //     alert('please fill both fields')
    //      // }
    // });

});
</script>