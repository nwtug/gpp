<?php
/**
 * This class manages file cron jobs.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 12/30/2015
 */
class _file_cron extends CI_Model
{
	
	
	# remove orphaned files
	function remove_orphaned_files($jobId)
	{
		$runTime = @date('Y-m-d H:i:s');
		$cron = $this->_query_reader->get_row_as_array('get_cron_job_by_id', array('job_id'=>$jobId));
		
		# a) get files uploaded on system but older than FILE_EXPIRY_DAYS
		$files = $this->_query_reader->get_single_column_as_array('get_system_files', 'file_url', array('last_ran'=>$cron['when_ran'], 'expiry_days'=>FILE_EXPIRY_DAYS));
		$filesInUse = array();
		foreach($files AS $uFile) $filesInUse = array_merge($filesInUse, explode(',',$uFile));
		
		# b) get the files in the uploads folder within the given period
		$filesToDelete = array();
		if($handle = opendir(UPLOAD_DIRECTORY)) {
			$exemptFiles = array('.','..','plan_template.xls','regulations_2006_f2.pdf');
    		while(FALSE !== ($fileName = readdir($handle))) {
        		$uploadTime = filemtime(UPLOAD_DIRECTORY.$fileName);
				
				# c) check for orphaned expired files
				if((!in_array($fileName,$exemptFiles) && strstr($fileName, '_', TRUE) != 'certificate_')
				&& $uploadTime >= strtotime($cron['when_ran'])
				&& $uploadTime < strtotime('-'.FILE_EXPIRY_DAYS.' days')
				&& !in_array($fileName, $filesInUse)
				) {
           		 	array_push($filesToDelete, $fileName);
        		}
    		}
    		closedir($handle);
		}
		
		# d) remove the orphaned files identified
		if(!empty($filesToDelete)){
			foreach($filesToDelete AS $dFile) @unlink(UPLOAD_DIRECTORY.$dFile);
			$ranResult = TRUE;
		}
		else $ranResult = FALSE;
		
		return array('bool'=>$ranResult, 'run_time'=>$runTime, 'run_count'=>count($filesToDelete));
	}
	
	
	
	
	
	
	
	
	
	
	#Log cron job results
	function backup_cron_log()
	{
		# 1. Get file size and check if it is bigger than 500KB
		$fileSize = filesize(CRON_FILE_LOG)/1024;
		# 2. If bigger back it up and create a new log file
		if($fileSize > 500){
			$zipName = CRON_HOME_URL.'archive/'.@strtotime('now').'.zip';
			$zip = new ZipArchive;
			$zip->open($zipName, ZipArchive::CREATE);
			$zip->addFile(CRON_FILE_LOG, basename(CRON_FILE_LOG));
			$zip->close();
			
			# Then clear the log file
			$log = fopen(CRON_FILE_LOG, "w+");
			fwrite($log, '');
			fclose($log);
		}
		
		$bool = (!empty($zipName) && file_exists($zipName) && filesize($zipName) > 0) || $fileSize < 500;
		
		return array('archive'=>($bool && $fileSize > 500? 'Archive: '.basename($zipName): ''), 'bool'=>$bool);
	}
	
	
	
	
	
	
	
	
}


?>