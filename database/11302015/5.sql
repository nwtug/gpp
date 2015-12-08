ALTER TABLE `tender_notices` ADD `budget_amount` FLOAT NOT NULL AFTER `status` ;


ALTER TABLE `faqs` CHANGE `answer` `answer` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

UPDATE `pss`.`faqs` SET `question` = 'What is the format of a procurement number?', `answer` = 'The basic Procurement Number consists of five parts as follows:
<ul>
<li type=''square''> The Procuring Entity - Up to five letters being the commonly used abbreviation which identifies the Procuring Entity. (e.g. “MOFEP” for the Ministry of Finance & Economic Planning)</li> 

<li type=''square''>The Department or Project - Up to five letters used to identify the Department or Project (e.g. “Admin” for the Administration & Finance Department) within the Procuring Entity.</li>

<li type=''square''>The Financial Year (e.g. 2009).</li>

<li type=''square''>Category of Procurement – A two digit number is allocated to each one of the three categories of procurement as follows: (01 for Goods, 02 for Works and 03 for Consulting Services).</li>

<li type=''square''>A Four-Digit Sequence Number - The sequence number allocated by the Department or Project within the Financial Year (e.g. from 0001 to 9999).</li>
</ul>

<strong>Example:</strong>
<br>A simple example is <strong>“MOFEP/ADMIN/2009/01/0022”</strong> representing the 22nd requisition raised for Goods procurement in the year 2009 by the Administration & Finance Department of the Ministry of Finance & Economic Planning' WHERE `faqs`.`id` = 1;





ALTER TABLE `procurement_plans` ADD `reference_number` VARCHAR( 100 ) NOT NULL AFTER `_organization_id` ;







