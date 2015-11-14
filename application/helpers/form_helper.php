<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @author Cengkuru Michael <mcengkuru@newwavetech.co.ug>
 * @version 1.0.0
 * pss
 * 11/9/2015
 */
# Process data from the form
function process_fields($obj, $data, $required=array(), $allowChars=array())
{
    $disallowChars = array("'", "\"", "\\", "(", ")", "/", "<", ">", "!", "#", "%", "&", "?", "$", ":", ";", "=", "*");
    if(!empty($allowChars)) $disallowChars = array_diff($disallowChars, $allowChars);
    # Did the data set pass the requried check
    $hasPassed = true;
    $finalData = array();
    $msg = "";

    foreach($data AS $key=>$value)
    {
        # Do not validate arrays
        if(!is_array($value))
        {
            $value = htmlentities(trim($value), ENT_QUOTES);
            # Add if the string is not empty and does not contain any of the disallowed characters
            if(!empty($value) && !(0 < count(array_intersect(str_split(strtolower($value)), $disallowChars))) )
            {
                
                $obj->native_session->set($key, $value);
                $finalData[$key] = $value;
            }
            # Catch the case where a required field was not entered
            else if(in_array($key, $required))
            {
                $hasPassed = false;
            }
        }
    }

    return array('boolean'=>$hasPassed, 'data'=>$finalData, 'msg'=>$msg);
}



