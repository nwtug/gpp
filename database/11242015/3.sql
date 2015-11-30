DROP TABLE IF EXISTS procurement_categories;
CREATE TABLE IF NOT EXISTS procurement_categories (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO procurement_categories (id, name) VALUES
(1, 'Furniture, Supplies, Tools & Materials'),
(2, 'Procurement of Vehicles and other Transport equiptment'),
(3, 'Specialized Plant, Equipment and Machinery'),
(4, 'Construction and Civil Works'),
(5, 'Rehabilitation and Renovation of Assets (works)'),
(6, 'General/Non - Consulting Services (includes repairs & maintenance of office equipment & vehicles) '),
(7, 'Consulting Services'),
(8, 'Training'),
(9, 'Other');

DROP TABLE IF EXISTS tender_notices;
CREATE TABLE IF NOT EXISTS tender_notices (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  details text NOT NULL,
  `type` enum('works','services','supplies') NOT NULL,
  method varchar(250) NOT NULL,
  _category_id bigint(20) NOT NULL,
  _organization_id bigint(20) NOT NULL,
  _procurement_plan_id bigint(20) NOT NULL,
  document_url varchar(300) NOT NULL,
  deadline date NOT NULL,
  display_start_date date NOT NULL,
  display_end_date date NOT NULL,
  `status` enum('saved','published','archived') NOT NULL DEFAULT 'saved',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO tender_notices (id, name, details, type, method, _category_id, _organization_id, _procurement_plan_id, document_url, deadline, display_start_date, display_end_date, status, date_entered, _entered_by, last_updated, _last_updated_by) VALUES
(1, 'RFP For Maths Books', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eros risus, convallis in gravida non, viverra et leo. Aliquam egestas odio nec porta molestie. Etiam eu ligula fringilla, mollis leo a, scelerisque eros. Vivamus pulvinar dolor sit amet dolor ultricies iaculis. Etiam placerat facilisis enim nec commodo. Vivamus ac efficitur mi. Sed at erat eget ex pretium rutrum. Curabitur interdum tellus ligula, eget pharetra risus sagittis tristique. Mauris dictum varius nisl eu aliquet. Pellen', 'supplies', 'open_competitive_tendering', 1, 2, 3, 'document_1447993318.pdf', '2015-11-30', '2015-11-25', '2015-11-30', 'published', '2015-11-19 20:21:58', 1, '2015-11-19 20:21:58', 1);



