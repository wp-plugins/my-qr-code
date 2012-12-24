<div id="pmsg"></div>
<div class="wrap metabox-holder has-right-sidebar">
       <h2><?php global $myPluginName; echo $myPluginName ?></h2>
       <div class="postbox">
           <h3><span><?php echo isset($_GET['tagedit'])? 'Update':'Create'; ?> QR code</span></h3>
           <div class="inside">
               <form name="frmQrtag" method="post" action="">
                                <table class="form-table" id="qrTable">
                                        <?php if($filename!=""){ ?>
                                        <tr>
                                                <td colspan="2"><img src="<?php echo QRgen_Url.'../../Qrcode/image'.basename($filename)?>" alt="" /></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                                <td><b>Code Name: </b></td>
                                                <td>
                                                    <input type="text" name="txtTagname"  value="<?php echo $tagname ?>" size="33" >
                                                </td>
                                        </tr>
                                        <tr>
                                                <td><b>Code Action: </b></td>
                                                <td>
                                                    <select name="selTagaction" id="selTagaction" onchange="GetElement(this.value);">
                                                        <option  value="site" <?php if($tagaction=="site")echo "selected=selected"; ?>>Browse to a Website</option>
                                                        <option value="bkm" <?php if($tagaction=="bkm")echo "selected=selected"; ?>>Bookmark a Website</option>
                                                        <option value="call" <?php if($tagaction=="call")echo "selected=selected"; ?>>Make a Phone Call</option>
                                                        <option value="sms" <?php if($tagaction=="sms")echo "selected=selected"; ?>>Send an SMS</option>
                                                        <option value="mail" <?php if($tagaction=="mail")echo "selected=selected"; ?>>Send an E-Mail</option>
                                                        <option value="vcard" <?php if($tagaction=="vcard")echo "selected=selected"; ?>>Create a vCard</option>
                                                        <option value="mecard" <?php if($tagaction=="mecard")echo "selected=selected"; ?>>Create a meCard</option>
                                                        <option value="vevent" <?php if($tagaction=="vevent")echo "selected=selected"; ?>>Create a vCalendar Event</option>
                                                        <option value="youtube" <?php if($tagaction=="youtube")echo "selected=selected"; ?>>Youtube URL for iPhone</option>
                                                        <option value="tweet" <?php if($tagaction=="tweet")echo "selected=selected"; ?>>Tweet on Twitter</option>
                                                        <option value="bbm" <?php if($tagaction=="bbm")echo "selected=selected"; ?>>Create Blackberry Messenger User</option>
                                                        <option value="wifi" <?php if($tagaction=="wifi")echo "selected=selected"; ?>>WIFI Network for Android</option>
                                                        <option value="text" <?php if($tagaction=="text")echo "selected=selected"; ?>>Free Formatted Text</option>
                                                    </select>
                                                </td>
                                        </tr>
                                        <tr id="tr_1" class="qrhideele">
                                                <td><b>Bookmark Title*: </b></td>
                                                <td>
                                                    <input type="text" name="txt_sitetitle"  value="<?php echo $tagArray['txt_sitetitle']?>" size="33" >
                                                </td>
                                        </tr>
                                        <tr id="tr_2" class="qrhideele">
                                                <td><b>Website Url*: </b></td>
                                                <td>
                                                    <input type="text" name="txt_site" id="txt_site" value="<?php echo $tagArray['txt_site']?>" size="33" >
                                                </td>
                                        </tr>
                                        <tr id="tr_3" class="qrhideele">
                                                <td><b>Phone Number*: </b></td>
                                                <td>
                                                    <input type="text" name="txt_phone" id="txt_phone" size="33" value="<?php echo $tagArray['txt_phone']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_4" class="qrhideele">
                                                <td><b>Mail Recipient: </b></td>
                                                <td>
                                                    <input type="text" name="txt_mailre"  size="33" value="<?php echo $tagArray['txt_mailre']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_5" class="qrhideele">
                                                <td><b>Subject: </b></td>
                                                <td>
                                                    <input type="text" name="txt_mailsub"  size="33" value="<?php echo $tagArray['txt_mailsub']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_6" class="qrhideele" class="qrhideele">
                                                <td><b>Body*: </b></td>
                                                <td>
                                                    <textarea name="txt_smsbody" id="txt_smsbody" cols="40"  rows="5"><?php echo $tagArray['txt_smsbody']?></textarea>
                                                </td>
                                        </tr>
                                        <tr id="tr_7" class="qrhideele">
                                                <td><b>Version: </b></td>
                                                <td>
                                                    <input type="radio" name="rd_version" value="2.1" <?php if($tagArray['rd_version']=="2.1"){echo 'checked=checked'; }?>/> 2.1<br/>
                                                    <input type="radio" name="rd_version" value="3.0" <?php if($tagArray['rd_version']=="3.0"){echo 'checked=checked'; }?> /> 3.0
                                                </td>
                                        </tr>
                                        <tr id="tr_8" class="qrhideele">
                                                <td><b>vCard Type: </b></td>
                                                <td>
                                                    <input type="radio" name="rd_vtype" value="P" <?php if($tagArray['rd_vtype']=="P"){echo 'checked=checked'; }?> />Real Person<br/>
                                                    <input type="radio" name="rd_vtype" value="C" <?php if($tagArray['rd_vtype']=="C"){echo 'checked=checked'; }?> />Company
                                                </td>
                                        </tr>
                                        <tr id="tr_9" class="qrhideele">
                                                <td><b>First Name: </b></td>
                                                <td>
                                                    <input type="text" name="txt_fname" id="txt_fname" size="33" value="<?php echo $tagArray['txt_fname']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_10" class="qrhideele">
                                                <td><b>Middle Name: </b></td>
                                                <td>
                                                    <input type="text" name="txt_mname" id="txt_mname" size="33" value="<?php echo $tagArray['txt_mname']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_11" class="qrhideele">
                                                <td><b>Last Name: </b></td>
                                                <td>
                                                    <input type="text" name="txt_lname" id="txt_lname" size="33" value="<?php echo $tagArray['txt_lname']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_12" class="qrhideele">
                                                <td><b>Organization: </b></td>
                                                <td>
                                                    <input type="text" name="txt_org" id="txt_org" size="33" value="<?php echo $tagArray['txt_org']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_13" class="qrhideele">
                                                <td><b>Title: </b></td>
                                                <td>
                                                    <input type="text" name="txt_vtitle" id="txt_vtitle" size="33" value="<?php echo $tagArray['txt_vtitle']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_15" class="qrhideele">
                                                <td><b>E-mail Address: </b></td>
                                                <td>
                                                    <input type="text" name="txt_vemail" id="txt_vemail" size="33" value="<?php echo $tagArray['txt_vemail']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_16" class="qrhideele">
                                                <td><b>Mobile Phone: </b></td>
                                                <td>
                                                    <input type="text" name="txt_mphone" id="txt_mphone" size="33" value="<?php echo $tagArray['txt_mphone']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_17" class="qrhideele">
                                                <td><b>Work Phone: </b></td>
                                                <td>
                                                    <input type="text" name="txt_wphone" id="txt_wphone" size="33" value="<?php echo $tagArray['txt_wphone']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_18" class="qrhideele">
                                                <td><b>Home Phone: </b></td>
                                                <td>
                                                    <input type="text" name="txt_hphone" id="txt_hphone" size="33" value="<?php echo $tagArray['txt_hphone']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_19" class="qrhideele">
                                                <td><b>Video Call Phone: </b></td>
                                                <td>
                                                    <input type="text" name="txt_videocall" id="txt_videocall" size="33" value="<?php echo $tagArray['txt_videocall']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_20" class="qrhideele">
                                                <td><b>Work Address: </b></td>
                                                <td>
                                                    <table id="table_inner">
                                                        <tr>
                                                            <td><b>Street:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_wstreet"  value="<?php echo $tagArray['txt_wstreet']?>" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>City:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_wcity"  value="<?php echo $tagArray['txt_wcity']?>" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>State:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_wstate"  value="<?php echo $tagArray['txt_wstate']?>" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Zip Code:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_wzip"  value="<?php echo $tagArray['txt_wzip']?>" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Country:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_wcountry"  value="<?php echo $tagArray['txt_wcountry']?>" >
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                        </tr>
                                        <tr id="tr_21" class="qrhideele">
                                            <td><b>Home Address: </b></td>
                                                <td>
                                                    <table id="table_inner">
                                                        <tr>
                                                            <td><b>Street:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_hstreet"  value="<?php echo $tagArray['txt_hstreet']?>" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>City:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_hcity"  value="<?php echo $tagArray['txt_hcity']?>" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>State:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_hstate"  value="<?php echo $tagArray['txt_hstate']?>" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Zip Code:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_hzip"  value="<?php echo $tagArray['txt_hzip']?>" >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Country:</b></td>
                                                            <td>
                                                                <input type="text" name="txt_hcountry"  value="<?php echo $tagArray['txt_hcountry']?>" >
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                        </tr>
                                        <tr id="tr_22" class="qrhideele">
                                                <td><b>Web Address: </b></td>
                                                <td>
                                                    <input type="text" name="txt_mweb" size="33" value="<?php echo $tagArray['txt_mweb']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_23" class="qrhideele">
                                                <td><b>Work Web Address: </b></td>
                                                <td>
                                                    <input type="text" name="txt_workweb" size="33" value="<?php echo $tagArray['txt_workweb']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_24" class="qrhideele">
                                                <td><b>Home Web Address: </b></td>
                                                <td>
                                                    <input type="text" name="txt_homeweb" size="33" value="<?php echo $tagArray['txt_homeweb']?>" >
                                                </td>
                                        </tr>
                                        <tr id="tr_25" class="qrhideele">
                                                <td><b>Birth Date: </b></td>
                                                <td>
                                                    <?php
                                                        echo "<select name=sel_date>";
                                                        echo "<option value='' >Day</option>";
                                                        for($i=1;$i<=31;$i++)
                                                        {
                                                            if($tagArray['sel_date']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select> ";
                                                     ?>
                                                    <select name="sel_month">
                                                        <option selected="selected" value="">Month</option>
                                                        <option value="1" <?php if($tagArray['sel_month']==1){echo 'selected=selected';}?>>January</option>
                                                        <option value="2" <?php if($tagArray['sel_month']==2){echo 'selected=selected';}?>>February</option>
                                                        <option value="3" <?php if($tagArray['sel_month']==3){echo 'selected=selected';}?>>March</option>
                                                        <option value="4" <?php if($tagArray['sel_month']==4){echo 'selected=selected';}?>>April</option>
                                                        <option value="5" <?php if($tagArray['sel_month']==5){echo 'selected=selected';}?>>May</option>
                                                        <option value="6" <?php if($tagArray['sel_month']==6){echo 'selected=selected';}?>>June</option>
                                                        <option value="7" <?php if($tagArray['sel_month']==7){echo 'selected=selected';}?>>July</option>
                                                        <option value="8" <?php if($tagArray['sel_month']==8){echo 'selected=selected';}?>>August</option>
                                                        <option value="9" <?php if($tagArray['sel_month']==9){echo 'selected=selected';}?>>September</option>
                                                        <option value="10" <?php if($tagArray['sel_month']==10){echo 'selected=selected';}?>>October</option>
                                                        <option value="11" <?php if($tagArray['sel_month']==11){echo 'selected=selected';}?>>November</option>
                                                        <option value="12" <?php if($tagArray['sel_month']==12){echo 'selected=selected';}?>>December</option>
                                                    </select>
                                                    <?
                                                        echo "<select name=sel_year>";
                                                        echo "<option value='' >Year</option>";
                                                        for($i=1931;$i<=date('Y');$i++)
                                                        {
                                                            if($tagArray['sel_year']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select>";
                                                    ?>
                                                </td>
                                        </tr>
                                        <tr id="tr_26" class="qrhideele">
                                                <td><b>Event Format: </b></td>
                                                <td>
                                                    <input type="radio" name="rd_eventfor" value="f" <?php if($tagArray['rd_eventfor']=="f"){echo 'checked=checked'; }?> >  Fully Compliant to iCalendar Standard <br/>
                                                    <input type="radio" name="rd_eventfor" value="c" <?php if($tagArray['rd_eventfor']=="c"){echo 'checked=checked'; }?>>  Compliant to ZXing Proposal
                                                </td>
                                        </tr>
                                        <tr id="tr_27" class="qrhideele">
                                                <td><b>Event Summary: </b></td>
                                                <td>
                                                    <input type="text" name="txt_eventsum" size="33" value="<?php echo $tagArray['txt_eventsum']?>"/>
                                                </td>
                                        </tr>
                                        <tr id="tr_28" class="qrhideele">
                                                <td><b>Event Description: </b></td>
                                                <td>
                                                    <textarea name="txt_eventdes" cols="40" rows="5"><?php echo $tagArray['txt_eventdes']?></textarea>
                                                </td>
                                        </tr>
                                        <tr id="tr_29" class="qrhideele">
                                                <td><b>Full Day Event: </b></td>
                                                <td>
                                                    <input type="radio" name="rd_eventday" value="yes" <?php if($tagArray['rd_eventday']=="yes"){echo 'checked=checked'; }?> > Yes
                                                    <input type="radio" name="rd_eventday" value="no" <?php if($tagArray['rd_eventday']=="no"){echo 'checked=checked'; }?>> No
                                                </td>
                                        </tr>
                                        <tr id="tr_30" class="qrhideele">
                                                <td><b>Start Date: </b></td>
                                                <td>
                                                    <?php
                                                        echo "<select name=sel_sdate>";
                                                        echo "<option value='' >Day</option>";
                                                        for($i=1;$i<=31;$i++)
                                                        {
                                                            if($tagArray['sel_sdate']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select> ";
                                                     ?>
                                                    <select name="sel_smonth">
                                                        <option selected="selected" value="">Month</option>
                                                        <option value="1" <?php if($tagArray['sel_smonth']==1){echo 'selected=selected';}?>>January</option>
                                                        <option value="2" <?php if($tagArray['sel_smonth']==2){echo 'selected=selected';}?> >February</option>
                                                        <option value="3" <?php if($tagArray['sel_smonth']==3){echo 'selected=selected';}?>>March</option>
                                                        <option value="4" <?php if($tagArray['sel_smonth']==4){echo 'selected=selected';}?> >April</option>
                                                        <option value="5" <?php if($tagArray['sel_smonth']==5){echo 'selected=selected';}?>>May</option>
                                                        <option value="6" <?php if($tagArray['sel_smonth']==6){echo 'selected=selected';}?>>June</option>
                                                        <option value="7" <?php if($tagArray['sel_smonth']==7){echo 'selected=selected';}?>>July</option>
                                                        <option value="8" <?php if($tagArray['sel_smonth']==8){echo 'selected=selected';}?>>August</option>
                                                        <option value="9" <?php if($tagArray['sel_smonth']==9){echo 'selected=selected';}?>>September</option>
                                                        <option value="10" <?php if($tagArray['sel_smonth']==10){echo 'selected=selected';}?>>October</option>
                                                        <option value="11" <?php if($tagArray['sel_smonth']==11){echo 'selected=selected';}?>>November</option>
                                                        <option value="12" <?php if($tagArray['sel_smonth']==12){echo 'selected=selected';}?>>December</option>
                                                    </select>
                                                    <?
                                                        echo "<select name=sel_syear>";
                                                        echo "<option value='' >Year</option>";
                                                        for($i=date('Y');$i<=(date('Y')+5);$i++)
                                                        {
                                                            if($tagArray['sel_syear']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select>";
                                                    ?>
                                                </td>
                                        </tr>
                                        <tr id="tr_31" class="qrhideele">
                                                <td><b>Start Time: </b></td>
                                                <td>
                                                    <?php
                                                        echo "<select name=sel_shour>";
                                                        for($i=0;$i<=23;$i++)
                                                        {
                                                            if($tagArray['sel_shour']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            if($i<=9)
                                                                echo "<option value=$i $select >0$i</option>";
                                                            else
                                                                echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select> ";
                                                        echo "<select name=sel_smin>";
                                                        for($i=0;$i<=60;$i++)
                                                        {
                                                            if($tagArray['sel_smin']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            if($i<=9)
                                                                echo "<option value=$i $select >0$i</option>";
                                                            else
                                                                echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select> ";
                                                     ?>
                                                </td>
                                        </tr>
                                        <tr id="tr_32" class="qrhideele">
                                                <td><b>End Date: </b></td>
                                                <td>
                                                    <?php
                                                        echo "<select name=sel_edate>";
                                                        echo "<option value='' >Day</option>";
                                                        for($i=1;$i<=31;$i++)
                                                        {
                                                            if($tagArray['sel_edate']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select> ";
                                                     ?>
                                                    <select name="sel_emonth">
                                                        <option selected="selected" value="">Month</option>
                                                        <option value="1" <?php if($tagArray['sel_emonth']==1){echo 'selected=selected';}?>>January</option>
                                                        <option value="2" <?php if($tagArray['sel_emonth']==2){echo 'selected=selected';}?>>February</option>
                                                        <option value="3" <?php if($tagArray['sel_emonth']==3){echo 'selected=selected';}?>>March</option>
                                                        <option value="4" <?php if($tagArray['sel_emonth']==4){echo 'selected=selected';}?>>April</option>
                                                        <option value="5" <?php if($tagArray['sel_emonth']==5){echo 'selected=selected';}?>>May</option>
                                                        <option value="6" <?php if($tagArray['sel_emonth']==6){echo 'selected=selected';}?>>June</option>
                                                        <option value="7" <?php if($tagArray['sel_emonth']==7){echo 'selected=selected';}?>>July</option>
                                                        <option value="8" <?php if($tagArray['sel_emonth']==8){echo 'selected=selected';}?>>August</option>
                                                        <option value="9" <?php if($tagArray['sel_emonth']==9){echo 'selected=selected';}?>>September</option>
                                                        <option value="10" <?php if($tagArray['sel_emonth']==10){echo 'selected=selected';}?>>October</option>
                                                        <option value="11" <?php if($tagArray['sel_emonth']==11){echo 'selected=selected';}?>>November</option>
                                                        <option value="12" <?php if($tagArray['sel_emonth']==12){echo 'selected=selected';}?>>December</option>
                                                    </select>
                                                    <?
                                                        echo "<select name=sel_eyear>";
                                                        echo "<option value='' >Year</option>";
                                                        for($i=date('Y');$i<=(date('Y')+5);$i++)
                                                        {
                                                            if($tagArray['sel_eyear']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select>";
                                                    ?>
                                                </td>
                                        </tr>
                                        <tr id="tr_33" class="qrhideele">
                                                <td><b>End Time: </b></td>
                                                <td>
                                                    <?php
                                                        echo "<select name=sel_ehour>";
                                                        for($i=0;$i<=23;$i++)
                                                        {
                                                            if($tagArray['sel_ehour']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            if($i<=9)
                                                                echo "<option value=$i $select >0$i</option>";
                                                            else
                                                                echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select> ";
                                                        echo "<select name=sel_emin>";
                                                        for($i=0;$i<=60;$i++)
                                                        {
                                                            if($tagArray['sel_emin']==$i)
                                                                $select="selected=selected";
                                                            else
                                                                $select="";
                                                            if($i<=9)
                                                                echo "<option value=$i $select >0$i</option>";
                                                            else
                                                                echo "<option value=$i $select >$i</option>";
                                                        }
                                                        echo "</select> ";
                                                     ?>
                                                </td>
                                        </tr>
                                        <tr id="tr_34" class="qrhideele">
                                                <td><b>Location Name: </b></td>
                                                <td>
                                                    <input type="text" name="txt_eventloc" size="33" value="<?php echo $tagArray['txt_eventloc']?>"/>
                                                </td>
                                        </tr>
                                        <tr id="tr_35" class="qrhideele">
                                                <td><b>Search Type: </b></td>
                                                <td>
                                                    <input type="radio" name="rd_astype" value="pub">Publisher Search <br/>
                                                    <input type="radio" name="rd_astype" value="pkg">Exact Package Name
                                                </td>
                                        </tr>
                                        <tr id="tr_36" class="qrhideele">
                                                <td><b>Market Search: </b></td>
                                                <td>
                                                    <input type="text" name="txt_market" size="33" value="<?php echo $tagArray['txt_market']?>"/>
                                                </td>
                                        </tr>
                                        <tr id="tr_37" class="qrhideele">
                                                <td><b>Youtube Video ID: </b></td>
                                                <td>
                                                    <input type="text" name="txt_youid" size="33" value="<?php echo $tagArray['txt_youid']?>"/>
                                                </td>
                                        </tr>
                                            <tr id="tr_38" class="qrhideele">
                                                <td><b>Twitter User: </b></td>
                                                <td>
                                                    <input type="text" name="txt_twiuser" size="33" value="<?php echo $tagArray['txt_twiuser']?>"/>
                                                </td>
                                        </tr>
                                        <tr id="tr_39" class="qrhideele">
                                                <td><b>Twitter Text: </b></td>
                                                <td>
                                                    <input type="text" name="txt_twitext" size="33" value="<?php echo $tagArray['txt_twitext']?>"/>
                                                </td>
                                        </tr>
                                        <tr id="tr_40" class="qrhideele">
                                                <td><b>BBM Pin: </b></td>
                                                <td>
                                                    <input type="text" name="txt_bbmpin" size="33" value="<?php echo $tagArray['txt_bbmpin']?>"/>
                                                </td>
                                        </tr>
                                        <tr id="tr_41" class="qrhideele">
                                                <td><b>SSID:</b></td>
                                                <td>
                                                    <input type="text" name="txt_ssid" size="33" value="<?php echo $tagArray['txt_ssid']?>"/>
                                                </td>
                                        </tr>
                                        <tr id="tr_42" class="qrhideele">
                                                <td><b>Password:</b></td>
                                                <td>
                                                    <input type="text" name="txt_wpsw" size="33" value="<?php echo $tagArray['txt_wpsw']?>"/>
                                                </td>
                                        </tr>
                                        <tr id="tr_43" class="qrhideele">
                                                <td><b>Network Type:</b></td>
                                                <td>
                                                    <select name="sel_nettype">
                                                        <option value="WPA" <?php if($tagArray['sel_nettype']=='WPA'){echo 'selected=selected';}?>>WPA/WPA2</option>
                                                        <option value="WEP" <?php if($tagArray['sel_nettype']=='WEP'){echo 'selected=selected';}?>>WEP</option>
                                                        <option value="nopass" <?php if($tagArray['sel_nettype']=='nopass'){echo 'selected=selected';}?>>No encryption</option>
                                                    </select>
                                                </td>
                                        </tr>
                                        <tr id="tr_44" class="qrhideele">
                                                <td><b>Text:</b></td>
                                                <td>
                                                    <textarea name="txt_ftext" cols="40" rows="5"><?php echo $tagArray['txt_ftext']?></textarea>
                                                </td>
                                        </tr>
										<tr>
                                                <td><b>Alignment:</b></td>
                                                <td>
                                                    <input type="radio" name="alignment" value="none" checked="checked"/>None &nbsp;&nbsp;
													<input type="radio" name="alignment" value="alignleft" <?php echo ($tagalign=='alignleft')?'checked=checked':''; ?> />Left &nbsp;&nbsp;
													<input type="radio" name="alignment" value="aligncenter" <?php echo ($tagalign=='aligncenter')?'checked=checked':''; ?> />Center &nbsp;&nbsp;
													<input type="radio" name="alignment" value="alignright" <?php echo ($tagalign=='alignright')?'checked=checked':''; ?> />Right
                                                </td>
                                        </tr>
                                        <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <input type="submit" name="submit" value="<?php echo (isset($_REQUEST['tagedit']))?'Update Tag':'Add Tag'; ?>" class="button-primary" onclick="" >
                                                </td>
                                        </tr>
                                </table>
                </form>
           </div>
       </div>
</div>
<script type="text/javascript">
    QrgetValue();
</script>