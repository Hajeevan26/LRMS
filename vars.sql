-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2022 at 06:43 AM
-- Server version: 5.7.36
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vars`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE IF NOT EXISTS `tbl_department` (
  `d_id` varchar(50) DEFAULT '0',
  `d_name` varchar(50) DEFAULT NULL,
  `f_id` varchar(50) DEFAULT NULL,
  `head` varchar(50) DEFAULT NULL,
  `tp_no` varchar(50) DEFAULT NULL,
  `d_email` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`d_id`, `d_name`, `f_id`, `head`, `tp_no`, `d_email`, `status`) VALUES
('D001', 'Animal science', 'F001', 'head_animalscience_fag', NULL, 'head_animalscience_fag@esn.ac.lk', 'active'),
('D002', 'Crop Science', 'F001', 'head_cropscience_fag', NULL, 'head_cropscience_fag@esn.ac.lk', 'active'),
('D003', 'Agric Engineering', 'F001', 'head_agricengineering_fag', NULL, 'head_agricengineering_fag@esn.ac.lk', 'active'),
('D004', 'Agric Chemistry', 'F001', 'head_agrichemistry_fag', NULL, 'head_agrichemistry_fag@esn.ac.lk', 'active'),
('D005', 'Agric.Biology', 'F001', 'head_agribiology_fag', NULL, 'head_agribiology_fag@esn.ac.lk', 'active'),
('D006', 'Biosystems Technology', 'F002', 'head_bst_fot', NULL, 'head_bst_fot@esn.ac.lk', 'active'),
('D007', 'Pathophysiology', 'F003', 'head_dpp_fhcs', NULL, 'head_dpp_fhcs@esn.ac.lk', 'active'),
('D008', 'Human Biology', 'F003', 'head_humanbiology_fhcs', NULL, 'head_humanbiology_fhcs@esn.ac.lk', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

DROP TABLE IF EXISTS `tbl_faculty`;
CREATE TABLE IF NOT EXISTS `tbl_faculty` (
  `f_id` varchar(50) NOT NULL DEFAULT '0',
  `f_name` varchar(50) DEFAULT NULL,
  `dean` varchar(50) DEFAULT NULL,
  `tp_no` int(11) DEFAULT '0',
  `status` varchar(50) DEFAULT 'active',
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`f_id`, `f_name`, `dean`, `tp_no`, `status`) VALUES
('F001', 'Agriculture', 'H Agriculture', 111111111, 'active'),
('F002', 'Technology', 'H Technology', 111111111, 'active'),
('F003', 'Faculty of health-care sciences', 'H FCHS', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instruments`
--

DROP TABLE IF EXISTS `tbl_instruments`;
CREATE TABLE IF NOT EXISTS `tbl_instruments` (
  `id` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT '0',
  `description` longtext,
  `manufactured_year` year(4) DEFAULT '2000',
  `tech_off` varchar(50) DEFAULT NULL,
  `w_condition` varchar(50) DEFAULT NULL,
  `f_id` varchar(50) DEFAULT '0',
  `d_id` varchar(50) DEFAULT '0',
  `status` varchar(50) DEFAULT 'active',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_instruments`
--

INSERT INTO `tbl_instruments` (`id`, `name`, `description`, `manufactured_year`, `tech_off`, `w_condition`, `f_id`, `d_id`, `status`) VALUES
('IE001', 'kjeldahl system', 'New', 2021, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE002', 'Egg Analyzer', 'Analyse:- Egg Weight', 2021, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE006', 'Electric Meat Grinder', 'food processing\r\n', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE004', 'Vacuum Packing Machine', 'can be used to packing under vacuum\r\n', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE005', 'Stuffer', 'used for stuffing\r\n', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE003', 'Dissecting Microscope with Camera', 'It is commonly used to view larger specimens and even perform dissections of small specimens such as insects.\r\n', 2020, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE007', 'RT-PCR equipment', 'Real time amplification of  nucleicacid molecules. Can be used in diagnosis of infectious diseases and other genetic conditions.\r\n', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE008', 'Spectro photo meter', 'Measure the absorbance, reflectance, and transmission of light by gases, liquids, and solids\r\n', 2016, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE009', 'Dissecting Microscope with Camera', 'It is commonly used to view larger specimens and even perform dissections of small specimens such as insects.\r\n', 2020, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE010', 'pH Meter', 'Can be Analysed pH of solution\r\n', 2018, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE011', 'Autoclave', 'steam sterilizers', 2020, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE012', 'Centrifuge', 'separate a mixture of two different miscible liquids.\r\n', 2018, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE013', 'Cream Separator', 'Cream separation of milk\r\n', 2018, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE014', 'Digital Butyro Meter', 'Calculate milk fat', 2018, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE015', 'Lactoscan', 'Analyse:- Milk Fat- Proteins- Lactose- Density- SNF- Water content- Tempaerature- Freezing point- salt- pH- Conductivity- Total Solids', 2016, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE016', 'Muffle Furnace', 'high-temperature testing- such as loss-on-ignition or ashing', 2016, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE017', 'Meet Grainder', 'Graind the Meet', 2019, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE018', 'Refractometer Salinity', 'Test water Salinity', 2016, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE019', 'Rice mill power crusher comibned machine', 'Rice mill ', 2016, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE020', 'Spectrophoto Meter', NULL, 2021, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE021', 'Color Meter', 'Read the Food color', 2021, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE022', 'Biological Safety Cabinet', 'Media preparetion', 2016, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE023', 'Incubator', 'Incubation', 2000, 'YES', 'YES', 'F001', 'D001', 'active'),
('IE024', 'Vacuum Packing Machine', 'can be used to packing under vacuum', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE025', 'Stuffer', 'used for stuffing', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE026', 'Electric Meat Grinder', 'food processing', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE027', 'Cream separator', 'dairy food processing', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE028', 'Cooling Incubator', 'to provide incubation under low temperatures', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE029', 'BMI Height Weight Machine', 'electronically calculate BMI', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE030', 'Benchtop Small Scale Bioreactor', 'liquid state- solid state bio processes can be tested', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE031', 'UV Visible Spectrophotometer', 'uses visible light and ultraviolet to analyze the chemical structure of substance', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE032', 'Horizontal Laminar flow', 'microbial and tissue culture', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE033', 'Refrigerated Centrifuge', 'DNA extraction- PCR reaction mixing', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE034', 'Muffle furnace', 'high-temperature testing- such as loss-on-ignition or ashing', 2018, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE035', 'Horizontal water sampler', 'water sampling', 0000, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE036', 'Bottom sampling dredge', 'bottom sampling from water bodies', 0000, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE037', 'Small scale meat ball making machine', 'meat ball making', 0000, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE038', 'Kjeldhal Digestion and Distillation Assembly', 'analysis of Nirtogen content', 0000, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE039', 'Freezer( -80 0C)', 'facilitate for storage DNA- RNA- all type of cell samples and chemicals', 2019, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE040', 'Thermo cycler', 'For PCR', 2016, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE041', 'Gel documentation system', 'DNA - RNA and Protein analysis', 2016, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE042', 'Gel tank and electorphoration unit', 'DNA and RNA separation', 2016, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE043', 'Micro pipettes', 'measuring Micro leter range ', 0000, 'YES', 'YES', 'F002', 'D006', 'active'),
('IE044', 'leaf area meter', 'measure the leaf area', 2021, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE045', 'Auto clave', 'Sterilization of materials', 2016, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE046', 'CO2 monitor meter', 'Measuring and analysis of carcon dioxide level', 2016, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE047', 'Centrifuge', 'Separation of samples based on density', 2015, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE048', 'Chlorophyl florimeter', 'Detect nitrogen density in plants', 2019, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE049', 'Microscope', 'Magnify small objects', 2021, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE050', 'Microtome', 'Make thin slices of tissue', 2014, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE051', 'Oven', 'Drying and curing various substances', 2019, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE052', 'Plant canopy imager', 'measure the gradient of leaf nitrogen', 2017, 'YES', 'YES', 'F001', 'D002', 'active'),
('IE053', 'Atomic Absorption Spectrometer', 'measuring the concentrations of  elements in different materials.', 2021, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE054', 'Colour Meter', 'used for determining the location of a color', 2018, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE055', 'Grain Moisture Meter', 'to determine the moisture levels of grains', 2017, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE056', 'Muffle furnance', 'used for high-temperature testing applications such as loss-on-ignition or ashing', 2013, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE057', 'Multi Meter ( Ph , EC , TDS)', 'analysis of Ph - EC - TDS', 2019, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE058', 'Oven', 'used for drying- heating', 2003, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE059', 'Tachometer', 'measure the rotation speed of a shaft or disk', 2017, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE060', 'ph Meter', 'analysis of Ph', 2019, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE061', 'Soil Moisture meter', 'analysis Soil Moisture', 0000, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE062', 'Psychrometer', 'measures humidity', 1993, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE063', 'Spectrophotometer', 'detecting the presence of any light-absorbing particles dissolved in a solution', 2017, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE064', 'Refractor meter', 'to measure salinity', 2017, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE065', 'Water still', 'to purify water using distillation process', 2017, 'YES', 'YES', 'F001', 'D003', 'active'),
('IE066', 'Fruit Firmness Tester', 'to test maturity of many fruits', 2018, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE067', 'Wind Anemometer', 'instrument that measures wind speed', 2017, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE068', 'Agitator', 'used to mix- blend- or agitate substances in a tube or flask by shaking them', 2018, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE069', 'Centrifuge', 'separate a mixture of two different miscible liquids.', 1985, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE070', 'Extrator Heading unit (Soxlet)', 'determination of fat percentage any sample (seeds- busskits -etc)', 2013, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE071', 'Top loading balance', 'Measuring small weight ', 2022, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE072', 'Flame photo meter', 'determination (N-P-K-Ba-Li)  by Flame method', 2009, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE073', 'Microscope', 'Magnify small objects', 2016, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE074', 'Microware oven', 'used for drying- heating', 2017, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE075', 'ph Meter', 'Can be Analysed pH of solution', 2011, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE076', 'Spectro photo meter', 'Detemination of Phosphours- Nitrate-phosphate', 2015, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE077', 'Water still', 'Makeing distilled water', 2021, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE078', 'EC meter', 'Determination of Electro Conduetivity', 2014, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE079', 'Kjeldhal unit', 'analysis of Nirtogen content', 2020, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE080', 'Soil test ket', 'All kind of soil  parameter', 2022, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE081', 'baking oven', 'Drying and curing various substances', 2017, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE082', 'Soil nutrient analyzer', 'Detemination of Ph-EC-P- Etc', 2021, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE083', 'Pediatric Baby scale', 'Baby weight', 2021, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE084', 'Platform beam scale', 'Measuring heavy weight', 2022, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE085', 'Fume Hood', 'Useing for con.acids- removeing fumes', 2022, 'YES', 'YES', 'F001', 'D004', 'active'),
('IE086', 'leaf area meter', 'measurments of leaf area', 2014, 'YES', 'YES', 'F001', 'D005', 'active'),
('IE087', 'Insect Growth Chamber', 'Rearing insect in differen environmental conditions', 2021, 'YES', 'YES', 'F001', 'D005', 'active'),
('IE088', 'Ice-cold Centrifuge', 'Get the pure form of suprnatnant where low temperature requirement', 2016, 'YES', 'YES', 'F001', 'D005', 'active'),
('IE089', 'Soxhlter', 'Get the  leaf exraction using different solvents', 2021, 'YES', 'YES', 'F001', 'D005', 'active'),
('IE090', 'Rotor Evaporator', 'Get the solvent free extractions', 2022, 'YES', 'YES', 'F001', 'D005', 'active'),
('IE091', 'Soil Sterilizer', 'Steriliz the infected soil', 2000, 'YES', 'YES', 'F001', 'D005', 'active'),
('IE092', 'Laminar Flow', 'Doing Microbial works in the aseptic environment', 2004, 'YES', 'YES', 'F001', 'D005', 'active'),
('IE093', 'Spectro photo meter', 'Quantitativ analysing of phytochemicals from the plants', 2015, 'YES', 'YES', 'F001', 'D005', 'active'),
('IE094', 'RT-PCR equipment', 'Real time amplification of  nucleicacid molecules. Can be used in diagnosis of infectious diseases and other genetic conditions.', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE095', 'Thermal cycler', 'Conventional amplification of nucleic acid material. Can be used in diagnosis of infectious and genetic conditions in combination with  gel electrophoresis system', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE096', 'Microcentrifuge', 'Extraction of DNA/RNA from clinical samples as well as from cuulture isolates', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE097', 'Refrigerated centrifuge', 'Extraction of DNA/RNA of certain pathogens.', 2016, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE098', 'Biosafety cabinet class II A', 'Provides  safety work environment to handle infectious  materials.', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE099', 'Ultrafreezer (-80degree)', 'Preserves specimens for longer period', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE100', 'Camera Microscope', 'Can be connected to the digital plat form.', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE101', 'Water purification system', 'Purifies  water to  obtain molecular grade water', 2016, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE102', 'Autoclave  Vertical\r\n', 'Sterilizes samples and media', 2015, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE103', 'Spectrophotometer', 'For serology testing ', 2018, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE104', 'Incubators', 'For incubation of culture media', 2016, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE105', 'Dry incubators', 'For nucleic  acid extraction process', 2015, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE106', 'Micropipetes', 'For handling  liquids in micro  volumes', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE107', 'Freezers (-40 and - 20 degree)', 'For preservation of samples', 2017, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE108', 'Phase contrast microscopes', 'To visualize cells and certain microorganisms', 2017, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE109', 'Teaching Microscope', 'More than one person can visualize the field.', 2017, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE110', 'Analytical balance', 'used in quantitative chemical analysis', 2021, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE111', 'Autocve - benchtop', 'Sterilizes samples and media', 2013, 'YES', 'YES', 'F003', 'D007', 'active'),
('IE112', 'Spectro photo meter', 'Measure the absorbance- reflectance- and transmission of light by gases- liquids- and solids', 2016, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE113', 'HPLC Machine', 'used to separate- identify- and quantitate compounds in liquid samples.', 2020, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE114', 'Micro centrifuge', 'used for spinning a variety of samples at high speed', 2018, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE115', 'Shaking water bath', 'shaking water baths are ideal for thawing- heating- mixing and shaking samples', 2017, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE116', 'Skin fold caliper', ' assess the skinfold thickness- so that a prediction of the total amount of body fat can be made', 2017, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE117', 'BMI Scale', 'To measure weight -Height and BMI', 2018, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE118', 'Vortex mixer', 'mixing laboratory samples in test tubes- well plates- or flasks', 2018, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE119', 'Water distilation unit', 'used to purify water using distillation process', 2017, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE120', 'Analytical Balance', 'used in quantitative chemical analysis', 2017, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE121', 'Electronic Balance', 'used in the accurate measurement of weight of materials.', 2017, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE122', 'ECG Machine', 'used to quickly detect heart problems and monitor the heart\'s health.', 2014, 'YES', 'YES', 'F003', 'D008', 'active'),
('IE123', 'EMG Machine', 'Measures muscle response or electrical activity in response to a nerve\'s stimulation of the muscle', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE124', 'Audio metry', 'Tests how well hearing functions', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE125', 'Bio safety cabinet', 'used to protect personnel against biohazardous or infectious', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE126', 'Deionizer water appartus', 'uses to filter out salt and other ions from the tap or bottled waters', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE127', 'Gel Documentation System', 'used to record and measure labeled nucleic acid and protein in various types of media such as agarose- acrylamide or cellulose', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE128', 'Micro Centrifuge with refrigeration', 'used for the separation of microliter temperature-sensitive heterogeneous mixtures or samples', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE129', 'PCR Thermocycler', 'used for DNA sequencing- cloning- generation of probes- quantification of DNA and RNA', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE130', 'UV-Visible Spectrophotometer', 'useful to measure the absorbance- reflectance- and transmission of light by gases- liquids- and solids', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE131', 'Analyzer - Semi auto', 'used to measure metabolites present in biological samples such as blood or urine.', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE132', 'Autoclave (vertical)', 'to sterilize medical devices.', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE133', 'Autoclave (large)', 'used to sterilize surgical equipment- laboratory instruments- pharmaceutical items- and other materials.', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE134', 'Drying cabinet', 'drying cabinet is the ideal solution to quickly- easily and efficiently dry items that need extra care', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE135', 'Electronic balance', 'used in the accurate measurement of weight of materials.', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE136', 'Electrophoresis apparatus', 'used to separate the antibodies in the antibiotic from any impurities', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE137', 'Hot air electric oven', 'used to sterilize biohazard waste- dissecting instruments or media/reagents for aseptic assays', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE138', 'Immuno analyzer', 'used to identify and detect the concentration of specific substances in a sample-', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE139', 'Incubator', 'to provide a controlled- contaminant-free environment for safe and reliable work with cell and tissue cultures by regulating conditions such as temperature- humidity- and CO2.', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE140', 'Muffle furnace', 'isolate the samples from the fuel and the combustion to eliminate contamination of the samples', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE141', 'Nitrogen evaporator', 'Nitrogen evaporators use a stream of nitrogen gas to continuously blow on the surface of a solvent (AKA “Nitrogen Blowdown”).', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE142', 'Pharmaceutical fridge', 'to protect drugs and vaccines.', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE143', 'PCR hood', 'PCR cabinets provide an ISO5 sterile environment for DNA or RNA amplification', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE144', 'Precision electronic analytical balance -3digits', 'null', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE145', 'Rotary evaporator', 'used for the efficient and gentle removal of solvents from samples by evaporation.', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE146', 'RT PCR', 'Real time amplification of nucleicacid molecules. Can be used in diagnosis of infectious diseases and other genetic conditions.', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE147', 'Soxhlet extraction apparatus', 'used for liquid-solid extractions', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE148', 'Fiber Analyzer', 'Used for the content analysis of the Crude Fiber- acid/alkaline detergent fiber (ADF)- neutral detergent fiber (NDF)- acid detergent lignin (ADL)- cellulose and hemicellulose in the raw materials and finished products of food- grain', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE149', 'precision analytical balance', 'null', 2020, 'NO', 'NO', 'F003', 'D008', 'inactive'),
('IE150', 'Dissecting Microscope with Camera', 'tret', 2020, 'YES', 'YES', 'F001', 'D003', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_researchers`
--

DROP TABLE IF EXISTS `tbl_researchers`;
CREATE TABLE IF NOT EXISTS `tbl_researchers` (
  `c_id` varchar(50) NOT NULL DEFAULT '0',
  `c_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nic` varchar(50) DEFAULT NULL,
  `tp_no` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

DROP TABLE IF EXISTS `tbl_reservation`;
CREATE TABLE IF NOT EXISTS `tbl_reservation` (
  `res_id` varchar(50) DEFAULT '0',
  `user_id` varchar(50) DEFAULT NULL,
  `f_id` varchar(50) DEFAULT NULL,
  `d_id` varchar(50) DEFAULT NULL,
  `i_id` varchar(50) DEFAULT NULL,
  `res_datetime` datetime DEFAULT NULL,
  `r_from` datetime DEFAULT NULL,
  `r_to` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

DROP TABLE IF EXISTS `tbl_staff`;
CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `s_id` varchar(50) NOT NULL DEFAULT '0',
  `s_name` varchar(50) NOT NULL DEFAULT '0',
  `s_email` varchar(50) NOT NULL DEFAULT '0',
  `tp_no` varchar(50) NOT NULL DEFAULT '0',
  `role_id` varchar(50) NOT NULL DEFAULT 'active',
  `d_id` varchar(50) NOT NULL DEFAULT 'active',
  `status` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(20) NOT NULL,
  `password` varchar(5000) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `attempt` int(1) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'active',
  `vcode` int(5) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tp_no` int(11) DEFAULT '0',
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `role_id`, `attempt`, `status`, `vcode`, `user_name`, `email`, `tp_no`, `image`) VALUES
('S001', 'e10adc3949ba59abbe56e057f20f883e', 'R01', 0, 'active', NULL, 'HajeevanAD', 'hajeevan26@gmail.com', 702401190, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
CREATE TABLE IF NOT EXISTS `user_log` (
  `log_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `action` varchar(40) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` varchar(10) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
('R01', 'Admin'),
('R02', 'Department Head'),
('R03', 'Staff'),
('R04', 'Researcher');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
