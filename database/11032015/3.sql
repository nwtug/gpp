ALTER TABLE `countries` ADD `display_order` INT NOT NULL DEFAULT '3' AFTER `short_code` ;

UPDATE `countries` SET `display_order` = '1' WHERE `countries`.`id` =256;

UPDATE countries SET display_order='2' WHERE id IN (220, 219, 112, 69, 183, 45, 185, 18)

INSERT INTO secret_questions (question) VALUES 
('What was your childhood nickname?'),
('In what city did you meet your spouse/significant other?'),
('What is the name of your favorite childhood friend?'),
('What street did you live on when you were 10 years old?'),
('What is your oldest sibling\'s birthday month and year? (e.g., January 1900)'),
('What is the middle name of your oldest child?'),
('What is your oldest cousin\'s first and last name?'),
('In what city or town did your mother and father meet?'),
('What was the last name of your best childhood teacher?'),
('In what city does your nearest sibling live?'),
('What is your mother\'s maiden name?'),
('In what city or town was your first job?'),
('What is the name of a college you first applied to?');