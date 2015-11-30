<tr>
    <td>Your Name: </td>
    <td><input type="text" id="yourname" name="yourname" value="" maxlength="100"/></td>
  </tr>
  <tr>
    <td>Email Address: </td>
    <td><input type="text" id="emailaddress" name="emailaddress" class="email" value="" maxlength="100"/></td>
  </tr>
  <tr>
    <td>Telephone: </td>
    <td><input type="text" id="telephone" name="telephone" placeholder="Optional (e.g: 0782123456)" class="numbersonly telephone optional" value="" maxlength="10"/></td>
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
    <td colspan="2"><button type="button" id="verifydocument" name="verifydocument" class="btn green submitmicrobtn" style="width:100%;">Send Message</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'pages/contact_us';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().(!empty($source)? 'faqs/manage': 'pages/contact_us').'';?>' /> 
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' />
    </td>
  </tr>