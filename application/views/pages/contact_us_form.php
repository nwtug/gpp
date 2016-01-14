<tr>
    <td>Your Name: </td>
    <td><input type="text" id="yourname" name="yourname" maxlength="100" <?php echo ($this->native_session->get('__first_name')? " value='".$this->native_session->get('__first_name').' '.$this->native_session->get('__last_name')."' style='font-weight:bold;' readonly": " value=''");?>/></td>
  </tr>
  <tr>
    <td>Email Address: </td>
    <td><input type="text" id="emailaddress" name="emailaddress" class="email" maxlength="100" <?php echo ($this->native_session->get('__email_address')? " value='".$this->native_session->get('__email_address')."' style='font-weight:bold;' readonly": " value=''");?>/></td>
  </tr>
  <tr>
    <td>Telephone: </td>
    <td><input type="text" id="telephone" name="telephone" placeholder="Optional (Include country code e.g: 211 91 1234567)" class="numbersonly telephone optional" value="" maxlength="14"/></td>
  </tr>
  <tr>
    <td>Reason: </td>
    <td><input type="text" id="reason__contactreason" name="reason__contactreason" placeholder="Enter or Select reason" class="drop-down searchable do-not-clear" value=""/></td>
  </tr>
  <tr>
    <td valign="top">Message: </td>
    <td><textarea id="details" name="details" placeholder="Enter your message here" style="height:120px;"></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><button type="button" id="verifydocument" name="verifydocument" class="btn green submitmicrobtn" style="width:<?php echo !empty($source)? "calc(100% + 18px)": "100%";?>;">Send Message</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'pages/contact_us';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().(!empty($source)? 'faqs/manage': 'pages/contact_us').'';?>' /> 
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' />
    </td>
  </tr>