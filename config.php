<?php
/*
 * This document includes all global settings required for operation of the system
 *
 */



/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
define('ENVIRONMENT', 'development');


/*
 *---------------------------------------------------------------
 * GLOBAL SETTINGS
 *---------------------------------------------------------------
 */
define('SECURE_MODE', FALSE);

define('BASE_URL', 'http://localhost:8888/pss/');#Set to HTTPS:// if SECURE_MODE = TRUE

define('RETRIEVE_URL_DATA_IGNORE', 3);#The starting point to obtain the passed url data

define('SITE_TITLE', "Public Procurement Portal");

define('SITE_SLOGAN', "");

define('SYS_TIMEZONE', "Africa/Kampala");

define('NUM_OF_ROWS_PER_PAGE', "5");

define('NUM_OF_LISTS_PER_VIEW', "10");

define('IMAGE_URL', BASE_URL."assets/images/");

define('HOME_URL', getcwd()."/"); 

define('DEFAULT_CONTROLLER', 'pages');

define('LABEL_DIRECTORY',  HOME_URL."assets/labels/");

define('UPLOAD_DIRECTORY',  HOME_URL."assets/uploads/");

define('MAX_FILE_SIZE', 40000000);

define('ALLOWED_EXTENSIONS', ".doc,.docx,.txt,.pdf,.xls,.xlsx,.jpeg,.png,.jpg,.gif");

define('MAXIMUM_FILE_NAME_LENGTH', 100);

define("MINIFY", FALSE);

define('PORT_HTTP', '80');

define('PORT_HTTP_SSL', '443');

define('PHP_LOCATION', "php5");

define('ENABLE_PROFILER', FALSE); #See perfomance stats based on set benchmarks

define('DOWNLOAD_LIMIT', 10000); #Max number of rows that can be downloaded

define('FULL_DATE_FORMAT', 'd/M/Y h:iA');

define('SHORT_DATE_FORMAT', 'd/M/Y');

define('MAXIMUM_FINANCIAL_HISTORY', 5);

define('FILE_EXPIRY_DAYS', 1);

define("PERMANENT_FILES", serialize(array('.','..','plan_template.xls','regulations_2006_f2.pdf', 'pde_user_manual.pdf', 'admin_user_manual.pdf'))); 

/*
 *
 *	0 = Disables logging, Error logging TURNED OFF
 *	1 = Error Messages (including PHP errors)
 *	2 = Debug Messages
 *	3 = Informational Messages
 *	4 = All Messages
 *	The log file can be found in: [HOME_URL]application/logs/
 *	Run >tail -n50 log-YYYY-MM-DD.php to view the errors being generated
 */
define('LOG_ERROR_LEVEL', 0);



/*
 *--------------------------------------------------------------------------
 * URI PROTOCOL
 *--------------------------------------------------------------------------
 *
 * The default setting of "AUTO" works for most servers.
 * If your links do not seem to work, try one of the other delicious flavors:
 *
 * 'AUTO'
 * 'REQUEST_URI'
 * 'PATH_INFO'
 * 'QUERY_STRING'
 * 'ORIG_PATH_INFO'
 *
 */

define('URI_PROTOCOL', 'AUTO'); // Set "AUTO" For WINDOWS
// Set "REQUEST_URI" For LINUX




/*
 *---------------------------------------------------------------
 * CACHE SETTINGS
 *---------------------------------------------------------------
 */

define('ENABLE_QUERY_CACHE', FALSE);

define('ENABLE_MESSAGE_CACHE', FALSE);

define('QUERY_FILE', HOME_URL.'application/helpers/queries_list_helper.php');

define('MESSAGE_FILE', HOME_URL.'application/helpers/message_list_helper.php');



	
	
	


/*
 *---------------------------------------------------------------
 * CRON JOB SETTINGS
 *---------------------------------------------------------------
 */

	define('CRON_HOME_URL',  "/var/www/pss/");
	
	define('CRON_REFRESH_PERIOD', "5 minutes");

	define('DEFAULT_CRON_HOME_URL', "/var/www/pss/");
	
	# Use in case of multiple system installations on one server
	# e.g., serialize(array("/var/www/pss-ver-1/", "/var/www/pss-ver-2/", "/var/www/pss-ver-3/"))
	# If only one installation has cron jobs, serialize(array(getcwd()."/")) works fine
	define("CRON_INSTALLATIONS", serialize(array("/var/www/pss/"))); 
	
	define('SERVER_SUDOER_USER', "root");
	
	define('CRON_FILE_NAME', "cron.list");
	
	define('CRON_FILE', CRON_HOME_URL.CRON_FILE_NAME);

	define('CRON_FILE_LOG', CRON_HOME_URL."cron.log");
	
	define('GLOBAL_CRON_FILE', DEFAULT_CRON_HOME_URL."global.".CRON_FILE_NAME);











/*
 *---------------------------------------------------------------
 * DATABASE SETTINGS
 *---------------------------------------------------------------
 */

define('HOSTNAME', "localhost");

define('USERNAME', "root");

define('PASSWORD', "");

define('DATABASE', "pss_v1");

define('DBDRIVER', "mysqli");

define('DBPORT', "3306");



/*
 *---------------------------------------------------------------
 * EMAIL SETTINGS
 *---------------------------------------------------------------
 */
define('SMTP_HOST', "localhost");

define('SMTP_PORT', "25");

define('SMTP_USER', "root");

define('SMTP_PASS', "");

define('FLAG_TO_REDIRECT', "0");// 1 => Redirect emails to a specific mail id,
// 0 => No need to redirect emails.


/*
 *---------------------------------------------------------------
 * COMMUNICATION SETTINGS
 *---------------------------------------------------------------
 */

	
	define("NOREPLY_EMAIL", "noreply@rssprocurement.org");
	
	define("APPEALS_EMAIL", "appeals@rssprocurement.org");
	
	define("FRAUD_EMAIL", "fraud@rssprocurement.org");
	
	define("SECURITY_EMAIL", "security@rssprocurement.org");
	
	define("HELP_EMAIL", "support@rssprocurement.org");
	        	        
	define('SITE_ADMIN_MAIL', "admin@rssprocurement.org");
	
	define('SITE_ADMIN_NAME', "RSS Admin");
	
	define('SITE_GENERAL_NAME', "RSS Procurement");
		
	define('DEV_TEST_EMAIL', "azziwa@gmail.com");

/*
 * If "FLAG_TO_REDIRECT" is set to 1, it will redirect all the mails from this site
 * to the email address  defined in "MAILID_TO_REDIRECT".
 */

define('MAILID_TO_REDIRECT', DEV_TEST_EMAIL);
?>