DROP TABLE IF EXISTS faqs;
CREATE TABLE IF NOT EXISTS faqs (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  question varchar(300) NOT NULL,
  answer varchar(500) NOT NULL,
  number_of_views bigint(20) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  display_order int(11) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  _entered_by_organization bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO faqs (id, question, answer, number_of_views, status, display_order, date_entered, _entered_by, _entered_by_organization, last_updated, _last_updated_by) VALUES
(1, 'What is a procurement plan?', 'This is a plan to show the government PDE''s planned expenditure for that quoted financial period.', 0, 'active', 1, '2015-11-27 00:00:00', 1, 1, '2015-11-27 00:00:00', 1),
(3, 'What is Sale to Public Officers?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque blandit nulla non bibendum.', 0, 'active', 3, '2015-11-27 15:04:11', 1, 1, '2015-11-27 15:04:11', 1),
(4, 'What is Lorem Ipsum?', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in consectetur elit, sit amet tristique lacus. Proin vestibulum bibendum lobortis. Duis viverra iaculis justo non vehicula. Maecenas sed dui sit amet mauris venenatis malesuada. Nulla et tincidunt neque. Pellentesque sollicitudin id lectus in ullamcorper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ultricies justo nec ultricies sollicitudin. Interdum et malesuada fames ac ante ', 0, 'active', 5, '2015-11-27 15:14:18', 1, 1, '2015-11-27 15:15:17', 1),
(5, 'Another FAQ For You', 'This is a simple faq to test order', 0, 'active', 4, '2015-11-27 15:58:01', 1, 1, '2015-11-27 15:58:01', 1),
(6, 'FAQ Question 4', 'Another test of FAQ order', 0, 'active', 2, '2015-11-27 16:00:55', 1, 1, '2015-11-27 16:00:55', 1);





DROP TABLE IF EXISTS forums;
CREATE TABLE IF NOT EXISTS forums (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  topic varchar(300) NOT NULL,
  details text NOT NULL,
  document_url varchar(300) NOT NULL,
  no_of_views int(11) NOT NULL,
  no_of_contributors int(11) NOT NULL,
  category varchar(100) NOT NULL,
  is_public enum('Y','N') NOT NULL DEFAULT 'Y',
  _moderator_id bigint(20) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  _entered_by_organization bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;






