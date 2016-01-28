UPDATE `faqs` SET `answer` = 'The basic Procurement Number consists of five parts as follows:
<ul>
<li type=''square''> The Procuring Entity - Up to five letters being the commonly used abbreviation which identifies the Procuring Entity. (e.g. MOFEP for the Ministry of Finance & Economic Planning)</li> 

<li type=''square''>The Department or Project - Up to five letters used to identify the Department or Project (e.g. Admin for the Administration & Finance Department) within the Procuring Entity.</li>

<li type=''square''>The Financial Year (e.g. 2009).</li>

<li type=''square''>Category of Procurement - A two digit number is allocated to each one of the three categories of procurement as follows: (01 for Goods, 02 for Works and 03 for Consulting Services).</li>

<li type=''square''>A Four-Digit Sequence Number - The sequence number allocated by the Department or Project within the Financial Year (e.g. from 0001 to 9999).</li>
</ul>

<strong>Example:</strong>
<br>A simple example is <strong>MOFEP/ADMIN/2009/01/0022</strong> representing the 22nd requisition raised for Goods procurement in the year 2009 by the Administration & Finance Department of the Ministry of Finance & Economic Planning' WHERE `faqs`.`id` = 1;



ALTER TABLE `procurement_plan_details` ADD `_category_id` BIGINT NOT NULL AFTER `_plan_id` ;



UPDATE `pss_v1`.`queries` SET `details` = 'INSERT INTO procurement_plan_details (_plan_id, _category_id, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, _entered_by, date_entered) VALUES 

(''_PLAN_ID_'', ''_CATEGORY_ID_'', ''_A_'', ''_B_'', ''_C_'', ''_D_'', ''_E_'', ''_F_'', ''_G_'', ''_H_'', ''_I_'', ''_J_'', ''_K_'', ''_L_'', ''_M_'', ''_N_'', ''_O_'', ''_USER_ID_'', NOW())' WHERE `queries`.`id` =129;


UPDATE `pss_v1`.`queries` SET `details` = 'SELECT id, _plan_id, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, _entered_by, date_entered  FROM procurement_plan_details WHERE _plan_id=''_PLAN_ID_'' ORDER BY IF(NOW() > DATE(''2016-01-28 05:40:24''), _category_id, id), date_entered' WHERE `queries`.`id` =130;