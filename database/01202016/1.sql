-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2016 at 10:26 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pss_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question` varchar(300) NOT NULL,
  `answer` text NOT NULL,
  `number_of_views` bigint(20) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `display_order` int(11) NOT NULL,
  `date_entered` datetime NOT NULL,
  `_entered_by` bigint(20) NOT NULL,
  `_entered_by_organization` bigint(20) NOT NULL,
  `last_updated` datetime NOT NULL,
  `_last_updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `number_of_views`, `status`, `display_order`, `date_entered`, `_entered_by`, `_entered_by_organization`, `last_updated`, `_last_updated_by`) VALUES
(1, 'What is the format of a procurement number?', 'The basic Procurement Number consists of five parts as follows:\r\n<ul>\r\n<li type=''square''> The Procuring Entity - Up to five letters being the commonly used abbreviation which identifies the Procuring Entity. (e.g. “MOFEP” for the Ministry of Finance & Economic Planning)</li> \r\n\r\n<li type=''square''>The Department or Project - Up to five letters used to identify the Department or Project (e.g. “Admin” for the Administration & Finance Department) within the Procuring Entity.</li>\r\n\r\n<li type=''square''>The Financial Year (e.g. 2009).</li>\r\n\r\n<li type=''square''>Category of Procurement – A two digit number is allocated to each one of the three categories of procurement as follows: (01 for Goods, 02 for Works and 03 for Consulting Services).</li>\r\n\r\n<li type=''square''>A Four-Digit Sequence Number - The sequence number allocated by the Department or Project within the Financial Year (e.g. from 0001 to 9999).</li>\r\n</ul>\r\n\r\n<strong>Example:</strong>\r\n<br>A simple example is <strong>“MOFEP/ADMIN/2009/01/0022”</strong> representing the 22nd requisition raised for Goods procurement in the year 2009 by the Administration & Finance Department of the Ministry of Finance & Economic Planning', 0, 'active', 1, '2015-11-27 00:00:00', 1, 1, '2015-11-27 00:00:00', 1),
(15, 'Should Procuring Entities use the RSS Procurement Regulations when procuring donor funded projects?', 'Yes, Procuring Entities shall use the RSS Procurement Regulations when procuring donor funded projects?', 0, 'active', 29, '2016-01-20 07:57:56', 1, 1, '2016-01-20 07:57:56', 1),
(14, 'Does repetitive awarding of contracts to one bidder limits competition, especially where the prequalification list has more than one provider?', 'The Procuring Enities should rotate their prequalified bidders and also use the PPDA register of providers or providers from other PDEs to increase on the competitiveness, as this will promote fairness and competition.', 0, 'active', 30, '2016-01-20 07:57:24', 1, 1, '2016-01-20 07:57:24', 1),
(8, 'Can I change the method of procurement at BEB', 'you cannot be  able to change the method of procurement, the method can only be changed at entry level', 0, 'inactive', 38, '2016-01-06 11:45:38', 21, 19, '2016-01-06 11:46:06', 21),
(11, 'What is an Evaluation Committee and its roles? ', 'An Evaluation Committee is a team of selected people and is based on the procurement transaction being evaluated considering its competency, skills and knowledge. The committee assesses compliance and responsiveness of the bids or proposals using the criteria stated in the solicitation documents. In addition, the Evaluation Committee\r\n&lt;ul&gt;\r\n&lt;li&gt;Prepares Evaluation Report&lt;/li&gt;\r\n&lt;li&gt;Recommends in the report which Tenderer should be awarded the contract&lt;/li&gt;\r\n&lt;li&gt;Maintain confidentiality throughout the', 0, 'active', 33, '2016-01-20 07:45:34', 1, 1, '2016-01-20 07:45:34', 1),
(12, 'Can Tenderers be threatened to be blacklisted whenever they make complaints to the entities, do Procuring Entities have power to blacklist providers?', 'Entities are advised to accommodate and respond to the complaints made by the providers. Procuring Entities have no powers to blacklist providers it&rsquo;s only the Procurement Policy Unit which has powers to blacklist providers after giving them a fair hearing.', 0, 'active', 32, '2016-01-20 07:51:10', 1, 1, '2016-01-20 07:51:10', 1),
(13, 'Do PDEs need to ask for eligibility documents from pre-qualified providers under restricted bidding?', 'Procuring Entities should not ask pre-qualified providers to re-submit all the eligibility requirements, unless the documents vary from those requested for during pre-qualification especially annual documents like a trading license.', 0, 'active', 31, '2016-01-20 07:51:49', 1, 1, '2016-01-20 07:51:49', 1),
(17, 'What are the benefits of the Register of Providers?', '&lt;ul&gt;\r\n&lt;li&gt;Increased visibility for suppliers, Consultants and Contractors. The Suppliers&rsquo;, Consultants&rsquo; and Contractors&rsquo; profile is an opportunity for providers to show case their skills and experience&lt;/li&gt;\r\n&lt;li&gt;Identify eligible Providers to participate in preference and reservation schemes&lt;/li&gt;\r\n&lt;li&gt;Instant on-line access to all bid opportunities in Government for all registered providers&lt;/li&gt;\r\n&lt;li&gt;Avail e-mail and SMS- alert service for Suppliers, Consultants and Contractors&lt;/li&gt;\r\n&lt;li&gt;Communicate with PDEs and other providers online.&lt;/li&gt;\r\n&lt;li&gt;Reliable source of information on Providers for PDEs&lt;/li&gt;\r\n&lt;li&gt;Offer a more transparent and reliable Providers&rsquo; data bank to PDEs&lt;/li&gt;\r\n&lt;li&gt;Provide PDEs with a record of current and past contract performance of the Providers&lt;/li&gt;\r\n&lt;li&gt;Expedite short listing for routine procurement&lt;/li&gt;\r\n&lt;li&gt;Conveniently publish procurement notices&lt;/li&gt;\r\n&lt;/ul&gt;', 0, 'active', 27, '2016-01-20 08:11:14', 1, 1, '2016-01-20 08:11:14', 1),
(18, 'What is the Register of Providers? ', 'The register of providers is an on- line database of providers of works, services and goods to government. The register is maintained by the PPDA.', 0, 'active', 26, '2016-01-20 08:11:39', 1, 1, '2016-01-20 08:11:39', 1),
(19, 'Can members of Procurement Unit allowed to evaluate bids?', 'Yes, a member of the Procurement Unit can be a member on an evaluation committee.', 0, 'active', 25, '2016-01-20 08:12:30', 1, 1, '2016-01-20 08:12:30', 1),
(20, 'Is it allowed to request for eligibility documents that were not submitted?', 'It is allowed to ask for clarification from bidders either to clarify or submit eligibility documents. This will increase competition and enhance performance and result in value for money. Only documents that the bidder had at the time of bidding will be accepted. Bidders will not be allowed to submit new documents which were not available at the time of bidding.', 0, 'active', 24, '2016-01-20 08:12:56', 1, 1, '2016-01-20 08:12:56', 1),
(21, 'What should a Tenderer or any other interested stakeholder do if one finds the Procurement process is not managed in accordance with the regulations?', 'The RSS Procurement regulations encourage any Tenderer, supplier, contractor or consultant that claims to have suffered, or that may suffer loss or injury due to a breach of a duty imposed on the Procuring Entity by these Regulations or Contract may seek review in accordance with this Regulation. \r\nAny person that considers him or herself a stakeholder in public procurement and claims to have experienced a breach of a duty imposed on the Procuring Entity by these Regulations may seek review in accordance with this Regulation immediately before or after the recognition of the breach. No frivolous or vexatious complain shall be attended by the Procuring Entity.', 0, 'active', 23, '2016-01-20 08:14:42', 1, 1, '2016-01-20 08:14:42', 1),
(22, 'What purpose does a reservation scheme serve?', '&lt;ul&gt;&lt;li&gt;To promote the use of local expertise and materials;&lt;/li&gt;\r\n&lt;li&gt;To promote the participation of local communities or local organizations; or promote the application of specific technologies.&lt;/li&gt;&lt;/ul&gt;\r\n', 0, 'active', 22, '2016-01-20 08:16:11', 1, 1, '2016-01-20 08:16:11', 1),
(23, 'What is a reservation scheme?', 'A reservation scheme serves to set aside procurement opportunities to benefit for a target group of providers depending on the objectives of the scheme.', 0, 'active', 21, '2016-01-20 08:16:41', 1, 1, '2016-01-20 08:16:41', 1),
(24, 'Are foreign registered Tenderers permitted to participate in National Competitive Tenders?', 'Yes, foreign registered Tenderers are free to participate in the National Competitive Tenders if they are interested.', 0, 'active', 20, '2016-01-20 08:18:10', 1, 1, '2016-01-20 08:18:10', 1),
(25, 'How is expired bid security and bid validity handled for procurements which are initiated before release of funds?', 'There is a provision for extension of bid security and bid validity period in case of delays. It&rsquo;s null and void to enter into a contract where the bid validity or bid security has expired.\r\n\r\nConfirmation of the acceptability of a proposed issuer or of a proposed confirmer does not preclude the Procuring Entity from rejecting the tender security on the ground that the issuer or confirmer has become insolvent or is otherwise not creditworthy.\r\n', 0, 'active', 19, '2016-01-20 08:18:38', 1, 1, '2016-01-20 08:18:38', 1),
(26, 'Can a Tenderer submit a tender security from any Country?', 'Yes, Tenderer, Supplier or Contractor can submit a tender security from any Country. A tender security shall not be rejected by the Procuring Entity on the grounds that the tender security was not issued by an issuer in the country, if the tender security and the issuer otherwise conform to requirements in the invitation documents.\r\n\r\nA Tenderer, supplier or contractor may request the Procuring Entity to confirm the acceptability of a proposed issuer or a proposed confirmer of a tender security before submitting a tender and the Procuring Entity shall respond promptly to the request.\r\n', 0, 'active', 18, '2016-01-20 08:19:10', 1, 1, '2016-01-20 08:19:10', 1),
(27, 'Can I submit a tender in any language?', 'The pre-qualification documents, invitation documents and other documents for invitation of proposals, offers or quotations shall be in English language.', 0, 'active', 17, '2016-01-20 08:30:16', 1, 1, '2016-01-20 08:30:16', 1),
(28, 'Can a Procuring entity reject a tender and when?', 'Yes, a Procuring Entity may reject tenders, proposals and quotations at any time prior to\r\nacceptance on economic grounds if the grounds for the rejection are specified in the tender documents or in the request for proposals or quotations.\r\n\r\nFor contracts of procurement by open competitive tendering, the Procuring Entity shall in the first place report the matter to the Procurement Policy Unit for its information and comments. If the Procurement Policy Unit has any objections to such rejection, it shall, within seven days of receipt of such communication, inform the Procuring Entity of the objection. The Procuring Entity shall not proceed till any objection by the Procurement Policy Unit is resolved.  \r\n\r\nA Procuring Entity shall reject a tender, proposal, offer or quotation if the supplier, contractor or consultant that submitted it offers, gives or agrees to give an inducement/bribe, directly or indirectly, to any current or former officer or employee of the Procuring Entity or other governmental authority.', 0, 'active', 16, '2016-01-20 08:31:55', 1, 1, '2016-01-20 08:31:55', 1),
(29, 'Can I supply goods or services to a Procuring entity after receiving a phone call or text message request?', 'Communication between Procuring Entities and suppliers, contractors and consultants shall be in writing and communications in any other form shall be referred to and confirmed in writing.', 0, 'active', 15, '2016-01-20 08:32:19', 1, 1, '2016-01-20 08:32:19', 1),
(30, 'What will happen where the price of the best evaluated bidder is higher than the market price established at the commencement of the procurement?', 'Prior to committing the procuring entity into a binding contract, the entity shall re-assess the market price, if the price is still higher the procurement should be cancelled, if it within the same range, the entity will go ahead and sign the contract subject to confirmation of availability of the funds.', 0, 'active', 14, '2016-01-20 11:17:33', 1, 1, '2016-01-20 11:17:33', 1),
(31, 'What kind of information do Accounting Officers need to look at when assessing market price? ', 'The procuring and disposing entity can use all appropriate sources of information including\r\n&lt;ul&gt;\r\n&lt;li&gt;Prices obtained on previous similar bids or contracts taking into account any difference in the quantities purchased, inflation and location of delivery among others.&lt;/li&gt;\r\n&lt;li&gt;Prices published or advised by potential providers; (e.g supplier catalogues, average prices and list of common user items) or a buildup of estimates of prices of components of the cost of BOQs established by the user department, non-consultancy services or supplies.\r\n&lt;/li&gt;\r\n&lt;li&gt;consultants rates obtain from professional association&lt;/li&gt;\r\n\r\n&lt;/ul&gt;', 0, 'active', 13, '2016-01-20 11:20:15', 1, 1, '2016-01-20 11:20:15', 1),
(32, 'What qualifications must one possess as a tenderer for RSS procurement opportunities?', ' A tenderer in public procurement shall possess the following qualifications\r\n&lt;ul&gt;\r\n&lt;li&gt;Necessary professional and technical qualifications and competence, financial resources, equipment and other physical facilities, managerial capability, reliability and reputation, experience in the procurement object, and personnel to perform a procurement contract. The detailed requirements shall be included in each tender to meet specific objectives of each procurement.&lt;/li&gt;\r\n&lt;li&gt;Have the legal capacity to enter into a contract;&lt;/li&gt;\r\n&lt;li&gt;Be solvent, not be in receivership, bankrupt or in the process of being wound up and not have its business activities suspended.&lt;/li&gt;\r\n&lt;li&gt;Have fulfilled his/her obligations to pay taxes and social security contributions and any compensation due for damages caused to property or third party;&lt;/li&gt;\r\n&lt;li&gt;Have Directors or Officers who have not in any country been convicted of any criminal offence relating to their professional conduct or making false statements or misrepresentations as to their qualifications to enter into a procurement contract, within a period of five years preceding the commencement of the procurement proceedings; and &lt;/li&gt;\r\n&lt;li&gt;Meet such other criteria, as the Procuring Entity considers appropriate.&lt;/li&gt;\r\n&lt;/ul&gt;', 0, 'active', 12, '2016-01-20 11:25:34', 1, 1, '2016-01-20 11:25:34', 1),
(33, 'What is does one do to be added on the Procuring Entity&rsquo;s list of tenderers?', 'The procurement regulations set out a procedure to be followed by the procuring and disposing entities to identify tenderers who are qualified prior to the submission of tenders. Pre-qualification is required for large works contracts and occasionally for complex contracts for goods. Tenderers for pre-qualification proceedings shall meet the qualification criteria of the Procuring Entity as set out in pre-qualification documents made available to each supplier or contractor that requests them. In order to ensure that pre-qualification is not misused, the decision by the procuring and disposing entity on each case for pre-qualification shall be cleared with the Procurement Policy Unit of the Ministry of Finance &amp; Economic Planning.', 0, 'active', 11, '2016-01-20 12:01:42', 1, 1, '2016-01-20 12:01:42', 1),
(34, 'Does the display of the procurement plan on the PDEs&rsquo; notice board affect the confidentiality of the procurement process?', 'The display of the procurement plan does not affect the procurement process since the award of contract is not only based on price but follows the evaluation criteria stated in the bidding document. The bidders will still be subjected to competition to determine the best offer.', 0, 'active', 10, '2016-01-20 12:02:08', 1, 1, '2016-01-20 12:02:08', 1),
(35, 'What is the best approach to preparing a procurement plan?', 'Procurement planning is a systematic process of setting achievable procurement objectives. It is a consultative process in such a way that users are develop their individual (Ministry/ departmental/sectional) procurement plans and eventually amalgamated into master procurement plans for the entire organization/ministry.', 0, 'active', 9, '2016-01-20 12:02:34', 1, 1, '2016-01-20 12:02:34', 1),
(36, 'What is a Procurement Plan?', 'A is comprehensive statement of requirements to be procured over the life of the plan &ndash; usually one year, based on the approved budget or prepared to support every program of a User Ministry, Department or Agency. It is a systematic process of setting achievable procurement objectives, entails setting the strategies and defining the time frame within which the objectives have to be achieved.\r\n\r\nThe Procurement Plan shall indicate\r\n&lt;ul&gt;\r\n&lt;li&gt;Contract packages,&lt;/li&gt;\r\n&lt;li&gt;Estimated cost for each package,&lt;/li&gt;\r\n&lt;li&gt;The procurement method, and&lt;/li&gt;\r\n&lt;li&gt;Processing steps and times.&lt;/li&gt;\r\n\r\n&lt;/ul&gt;\r\n', 0, 'active', 8, '2016-01-20 12:07:56', 1, 1, '2016-01-20 12:07:56', 1),
(37, 'What is a Procuring Entity?', 'Procuring Entity means any entity designated responsibility for conducting public procurement at all levels of Government, in the Republic of Southern Sudan and any other Procuring Entity as may be established by the Minister of Finance and Economic Planning from time to time.', 0, 'active', 7, '2016-01-20 12:09:19', 1, 1, '2016-01-20 12:09:19', 1),
(38, 'What are public funds?', '&ldquo;Public Funds&rdquo; include funds from government budget, local authority or a parastatal organization or State owned enterprises, government foundations, government Trust funds, domestic loans and foreign loans, credits and grants, guaranteed by the  government, foreign aid to the State, or revenue generated from the economic  activities of public entities.', 0, 'active', 6, '2016-01-20 12:09:40', 1, 1, '2016-01-20 12:09:40', 1),
(39, 'What type of procurement and disposal activities will be governed by the regulations?', 'The Interim Public Procurement and Disposal Regulations shall apply to all public procurement and disposal activities in the Republic of Southern Sudan. The regulations shall be followed for the procurement of goods, works and services, financed in whole or in part from public funds except for military hardware or in cases where the Government decides that it is in the national interest to use different procedure.', 0, 'active', 5, '2016-01-20 12:10:05', 1, 1, '2016-01-20 12:10:05', 1),
(40, 'What does disposal mean and include?', 'Disposal means the divesture of public assets, including intellectual and proprietary rights and goodwill, and any other rights of a procuring and disposing entity by any means, including sale, rental, lease, franchise, auction, or any combination however classified.', 0, 'active', 4, '2016-01-20 12:10:25', 1, 1, '2016-01-20 12:10:25', 1),
(41, 'What does Procurement mean?', 'Procurement means acquisition by purchase, rental, lease, hire purchase, license, tenancy, franchise, or any type of works, services or supplies or any combination&rsquo; up to the time a user consumes or utilizes a service as per his requirement and in line with the procurement Act and regulations of the country.', 0, 'active', 3, '2016-01-20 12:16:23', 1, 1, '2016-01-20 12:16:23', 1),
(42, 'Who is responsible for the RSS Government Procurement function?', 'All procurement will be processed by the Procurement Unit of the Ministry of Finance &amp; Economic Planning. No Ministry, Department or other Government Agency shall undertake procurement unless it is designated as a Procuring Entity.', 0, 'active', 2, '2016-01-20 12:18:47', 1, 1, '2016-01-20 12:18:47', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
