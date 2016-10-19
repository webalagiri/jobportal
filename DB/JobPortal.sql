/*
SQLyog Ultimate v8.82 
MySQL - 5.6.17 : Database - ri_jobportal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_10_11_061518_create_ri_list_group_table',1),('2016_10_11_061943_create_ri_list_entities_table',1),('2016_10_11_063008_entrust_setup_tables',1),('2016_10_11_070112_create_company_profile_table',2),('2016_10_11_101813_create_jobs_table',3),('2016_10_11_103422_create_candidate_personal_profile_table',4),('2016_10_11_113101_create_candidate_language_table',5),('2016_10_11_113546_create_candidate_job_profile_table',6),('2016_10_11_114621_create_candidate_education_table',7),('2016_10_11_115130_create_candidate_certification_table',8),('2016_10_11_115519_create_candidate_experience_table',9),('2016_10_11_120727_create_job_application_table',10),('2016_10_11_121416_create_job_template_table',11),('2016_10_11_123104_create_job_interview_table',11),('2016_10_11_130236_create_job_appointment_table',11),('2016_10_11_130749_create_job_offer_table',12);

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permission_role` */

/*Table structure for table `permissions` */

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

/*Table structure for table `ri_candidate_certification` */

CREATE TABLE `ri_candidate_certification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `course_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_type` int(10) unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` int(10) unsigned NOT NULL,
  `country` int(10) unsigned NOT NULL,
  `year_of_completion` date NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_candidate_certification_candidate_id_foreign` (`candidate_id`),
  KEY `ri_candidate_certification_course_type_foreign` (`course_type`),
  KEY `ri_candidate_certification_city_foreign` (`city`),
  KEY `ri_candidate_certification_country_foreign` (`country`),
  CONSTRAINT `ri_candidate_certification_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_certification_city_foreign` FOREIGN KEY (`city`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_certification_country_foreign` FOREIGN KEY (`country`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_certification_course_type_foreign` FOREIGN KEY (`course_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_candidate_certification` */

/*Table structure for table `ri_candidate_education` */

CREATE TABLE `ri_candidate_education` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_type` int(10) unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `university` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` int(10) unsigned NOT NULL,
  `country` int(10) unsigned NOT NULL,
  `year_of_completion` date NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_candidate_education_candidate_id_foreign` (`candidate_id`),
  KEY `ri_candidate_education_course_type_foreign` (`course_type`),
  KEY `ri_candidate_education_city_foreign` (`city`),
  KEY `ri_candidate_education_country_foreign` (`country`),
  CONSTRAINT `ri_candidate_education_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_education_city_foreign` FOREIGN KEY (`city`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_education_country_foreign` FOREIGN KEY (`country`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_education_course_type_foreign` FOREIGN KEY (`course_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_candidate_education` */

/*Table structure for table `ri_candidate_experience` */

CREATE TABLE `ri_candidate_experience` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_location` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` int(10) unsigned NOT NULL,
  `country` int(10) unsigned NOT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_industry_area` int(10) unsigned NOT NULL,
  `job_functional_area` int(10) unsigned NOT NULL,
  `contract_type` int(10) unsigned NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_description` text COLLATE utf8_unicode_ci,
  `responsibilities` text COLLATE utf8_unicode_ci,
  `achievements` text COLLATE utf8_unicode_ci,
  `annual_salary` double(12,2) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_candidate_experience_candidate_id_foreign` (`candidate_id`),
  KEY `ri_candidate_experience_city_foreign` (`city`),
  KEY `ri_candidate_experience_country_foreign` (`country`),
  KEY `ri_candidate_experience_job_industry_area_foreign` (`job_industry_area`),
  KEY `ri_candidate_experience_job_functional_area_foreign` (`job_functional_area`),
  KEY `ri_candidate_experience_contract_type_foreign` (`contract_type`),
  CONSTRAINT `ri_candidate_experience_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_experience_city_foreign` FOREIGN KEY (`city`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_experience_contract_type_foreign` FOREIGN KEY (`contract_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_experience_country_foreign` FOREIGN KEY (`country`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_experience_job_functional_area_foreign` FOREIGN KEY (`job_functional_area`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_experience_job_industry_area_foreign` FOREIGN KEY (`job_industry_area`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_candidate_experience` */

/*Table structure for table `ri_candidate_job_profile` */

CREATE TABLE `ri_candidate_job_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `profile_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_details` text COLLATE utf8_unicode_ci,
  `current_salary` double(12,2) DEFAULT NULL,
  `expected_salary` double(12,2) DEFAULT NULL,
  `job_title` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skills` text COLLATE utf8_unicode_ci,
  `total_experience_years` int(11) DEFAULT NULL,
  `total_experience_months` int(11) DEFAULT NULL,
  `current_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preferred_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resume` text COLLATE utf8_unicode_ci,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_candidate_job_profile_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `ri_candidate_job_profile_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_candidate_job_profile` */

insert  into `ri_candidate_job_profile`(`id`,`candidate_id`,`profile_name`,`profile_details`,`current_salary`,`expected_salary`,`job_title`,`skills`,`total_experience_years`,`total_experience_months`,`current_location`,`preferred_location`,`resume`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,7,'test','test',40000.00,80000.00,'test','test',3,NULL,'Chennai','Bangalore',NULL,'Baskar','Baskar',NULL,NULL);

/*Table structure for table `ri_candidate_language` */

CREATE TABLE `ri_candidate_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `language_read` tinyint(4) DEFAULT NULL,
  `language_write` tinyint(4) DEFAULT NULL,
  `language_speak` tinyint(4) DEFAULT NULL,
  `proficiency_level` int(10) unsigned NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_candidate_language_candidate_id_foreign` (`candidate_id`),
  KEY `ri_candidate_language_language_id_foreign` (`language_id`),
  KEY `ri_candidate_language_proficiency_level_foreign` (`proficiency_level`),
  CONSTRAINT `ri_candidate_language_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_language_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_language_proficiency_level_foreign` FOREIGN KEY (`proficiency_level`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_candidate_language` */

/*Table structure for table `ri_candidate_personal_profile` */

CREATE TABLE `ri_candidate_personal_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `alternate_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` int(10) unsigned NOT NULL,
  `country` int(10) unsigned NOT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `date_of_birth` date NOT NULL,
  `marital_status` tinyint(4) NOT NULL,
  `physically_challenged` tinyint(1) DEFAULT NULL,
  `photo` text COLLATE utf8_unicode_ci,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_candidate_personal_profile_candidate_id_foreign` (`candidate_id`),
  KEY `ri_candidate_personal_profile_city_foreign` (`city`),
  KEY `ri_candidate_personal_profile_country_foreign` (`country`),
  CONSTRAINT `ri_candidate_personal_profile_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_personal_profile_city_foreign` FOREIGN KEY (`city`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_candidate_personal_profile_country_foreign` FOREIGN KEY (`country`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_candidate_personal_profile` */

insert  into `ri_candidate_personal_profile`(`id`,`candidate_id`,`first_name`,`last_name`,`email`,`phone`,`mobile`,`location`,`address`,`alternate_mobile`,`city`,`country`,`pincode`,`gender`,`date_of_birth`,`marital_status`,`physically_challenged`,`photo`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (2,7,'Baskaran','Subbaraman','sbaskar@ggmail.com',NULL,'45454555556','test12','test12','898898989898',5,55,'8888888',1,'0000-00-00',1,1,'text','Admin','Admin','2016-10-17 14:03:05','2016-10-17 14:03:05');

/*Table structure for table `ri_company_profile` */

CREATE TABLE `ri_company_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_type` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` int(10) unsigned NOT NULL,
  `country` int(10) unsigned NOT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_logo` text COLLATE utf8_unicode_ci,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_company_profile_company_id_foreign` (`company_id`),
  KEY `ri_company_profile_company_type_foreign` (`company_type`),
  KEY `ri_company_profile_city_foreign` (`city`),
  KEY `ri_company_profile_country_foreign` (`country`),
  CONSTRAINT `ri_company_profile_city_foreign` FOREIGN KEY (`city`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_company_profile_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_company_profile_company_type_foreign` FOREIGN KEY (`company_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_company_profile_country_foreign` FOREIGN KEY (`country`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_company_profile` */

insert  into `ri_company_profile`(`id`,`company_id`,`company_name`,`description`,`company_type`,`email`,`phone`,`location`,`address`,`city`,`country`,`pincode`,`company_logo`,`contact_person`,`contact_person_mobile`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,1,'Alten Calsoft','Alten Calsoft',2,'calsoft@gmail.com','3445677777',NULL,'Anna Salai',13,55,'600001',NULL,'Baskar',NULL,'Calsoft','Calsoft',NULL,NULL),(2,2,'Polaris','Polaris',2,'polaris@gmail.com','6546677443',NULL,'ECR',13,55,'600033',NULL,'Arun',NULL,'Polaris','Polaris',NULL,NULL),(3,4,'HCL Technologies','HCL Technologies',3,'hcl11@gmail.com','3455665532','Chennai','ECR Road, Chennai',13,55,'600004','companylogo.jpg','Baskar','8787877575','Admin','Admin','2016-10-16 08:00:12','2016-10-16 08:00:12'),(5,8,'Wipro Technologies','Wipro Technologies',3,'wipro1288@gmail.com','345569999','Chennai','ECR Road, Chennai',13,55,'600032','','Vimal','8787444445','Admin','Admin','2016-10-17 16:08:56','2016-10-17 16:08:56');

/*Table structure for table `ri_job_application` */

CREATE TABLE `ri_job_application` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `preferred_location` int(10) unsigned NOT NULL,
  `country` int(10) unsigned NOT NULL,
  `contract_type` int(10) unsigned NOT NULL,
  `job_type` int(10) unsigned NOT NULL,
  `job_applied_date` date NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_job_application_candidate_id_foreign` (`candidate_id`),
  KEY `ri_job_application_job_id_foreign` (`job_id`),
  KEY `ri_job_application_company_id_foreign` (`company_id`),
  KEY `ri_job_application_preferred_location_foreign` (`preferred_location`),
  KEY `ri_job_application_country_foreign` (`country`),
  KEY `ri_job_application_contract_type_foreign` (`contract_type`),
  KEY `ri_job_application_job_type_foreign` (`job_type`),
  CONSTRAINT `ri_job_application_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_application_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_application_contract_type_foreign` FOREIGN KEY (`contract_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_application_country_foreign` FOREIGN KEY (`country`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_application_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `ri_jobs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_application_job_type_foreign` FOREIGN KEY (`job_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_application_preferred_location_foreign` FOREIGN KEY (`preferred_location`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_job_application` */

/*Table structure for table `ri_job_appointment` */

CREATE TABLE `ri_job_appointment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_application_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `interview_status_id` int(10) unsigned NOT NULL,
  `appointment_order_status_id` int(10) unsigned NOT NULL,
  `appointment_order_date` date NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_appointment_job_application_id_foreign` (`job_application_id`),
  KEY `ri_job_appointment_candidate_id_foreign` (`candidate_id`),
  KEY `ri_job_appointment_company_id_foreign` (`company_id`),
  KEY `ri_job_appointment_interview_status_id_foreign` (`interview_status_id`),
  CONSTRAINT `job_appointment_job_application_id_foreign` FOREIGN KEY (`job_application_id`) REFERENCES `ri_job_application` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_appointment_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_appointment_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_appointment_interview_status_id_foreign` FOREIGN KEY (`interview_status_id`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_job_appointment` */

/*Table structure for table `ri_job_interview` */

CREATE TABLE `ri_job_interview` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_application_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `interview_type_id` int(10) unsigned NOT NULL,
  `interview_status_id` int(10) unsigned NOT NULL,
  `interview_date` date NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_interview_job_application_id_foreign` (`job_application_id`),
  KEY `ri_job_interview_candidate_id_foreign` (`candidate_id`),
  KEY `ri_job_interview_company_id_foreign` (`company_id`),
  KEY `ri_job_interview_interview_type_id_foreign` (`interview_type_id`),
  KEY `ri_job_interview_interview_status_id_foreign` (`interview_status_id`),
  CONSTRAINT `job_interview_job_application_id_foreign` FOREIGN KEY (`job_application_id`) REFERENCES `ri_job_application` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_interview_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_interview_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_interview_interview_status_id_foreign` FOREIGN KEY (`interview_status_id`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_interview_interview_type_id_foreign` FOREIGN KEY (`interview_type_id`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_job_interview` */

/*Table structure for table `ri_job_offer` */

CREATE TABLE `ri_job_offer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_application_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `offer_letter_status` int(10) unsigned NOT NULL,
  `offer_letter_date` date NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_offer_job_application_id_foreign` (`job_application_id`),
  KEY `ri_job_offer_candidate_id_foreign` (`candidate_id`),
  KEY `ri_job_offer_company_id_foreign` (`company_id`),
  CONSTRAINT `job_offer_job_application_id_foreign` FOREIGN KEY (`job_application_id`) REFERENCES `ri_job_application` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_offer_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_offer_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_job_offer` */

/*Table structure for table `ri_job_template` */

CREATE TABLE `ri_job_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_details` text COLLATE utf8_unicode_ci,
  `job_post_type` int(10) unsigned NOT NULL,
  `job_contract_type` int(10) unsigned NOT NULL,
  `no_vacancy` int(11) DEFAULT NULL,
  `job_experience` text COLLATE utf8_unicode_ci,
  `job_min_experience` int(11) DEFAULT NULL,
  `job_max_experience` int(11) DEFAULT NULL,
  `job_salary_min` double(12,2) DEFAULT NULL,
  `job_salary_max` double(12,2) DEFAULT NULL,
  `job_skills` text COLLATE utf8_unicode_ci,
  `job_industry_area` int(10) unsigned NOT NULL,
  `job_functional_area` int(10) unsigned NOT NULL,
  `template_created_by` int(10) unsigned NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_job_template_job_post_type_foreign` (`job_post_type`),
  KEY `ri_job_template_job_industry_area_foreign` (`job_industry_area`),
  KEY `ri_job_template_job_functional_area_foreign` (`job_functional_area`),
  KEY `ri_job_template_job_contract_type_foreign` (`job_contract_type`),
  KEY `ri_job_template_template_created_by_foreign` (`template_created_by`),
  CONSTRAINT `ri_job_template_job_contract_type_foreign` FOREIGN KEY (`job_contract_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_template_job_functional_area_foreign` FOREIGN KEY (`job_functional_area`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_template_job_industry_area_foreign` FOREIGN KEY (`job_industry_area`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_template_job_post_type_foreign` FOREIGN KEY (`job_post_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_job_template_template_created_by_foreign` FOREIGN KEY (`template_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_job_template` */

/*Table structure for table `ri_jobs` */

CREATE TABLE `ri_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `job_post_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_post_type` int(10) unsigned NOT NULL,
  `job_post_vacancy` int(10) unsigned DEFAULT NULL,
  `job_experience` text COLLATE utf8_unicode_ci,
  `job_experience_min` int(10) unsigned DEFAULT NULL,
  `job_experience_max` int(10) unsigned DEFAULT NULL,
  `job_salary_min` int(10) unsigned DEFAULT NULL,
  `job_salary_max` int(10) unsigned DEFAULT NULL,
  `job_skills` text COLLATE utf8_unicode_ci,
  `job_industry_area` int(10) unsigned NOT NULL,
  `job_functional_area` int(10) unsigned NOT NULL,
  `job_active_from` date DEFAULT NULL,
  `job_active_to` date DEFAULT NULL,
  `job_status` tinyint(4) NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_jobs_company_id_foreign` (`company_id`),
  KEY `ri_jobs_job_post_type_foreign` (`job_post_type`),
  KEY `ri_jobs_job_industry_area_foreign` (`job_industry_area`),
  KEY `ri_jobs_job_functional_area_foreign` (`job_functional_area`),
  CONSTRAINT `ri_jobs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_jobs_job_functional_area_foreign` FOREIGN KEY (`job_functional_area`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_jobs_job_industry_area_foreign` FOREIGN KEY (`job_industry_area`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ri_jobs_job_post_type_foreign` FOREIGN KEY (`job_post_type`) REFERENCES `ri_list_entities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_jobs` */

insert  into `ri_jobs`(`id`,`company_id`,`job_post_name`,`job_description`,`job_post_type`,`job_post_vacancy`,`job_experience`,`job_experience_min`,`job_experience_max`,`job_salary_min`,`job_salary_max`,`job_skills`,`job_industry_area`,`job_functional_area`,`job_active_from`,`job_active_to`,`job_status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,1,'Angular JS Developer','Developer',50,NULL,NULL,1,4,NULL,0,'Java, Angular JS',33,45,NULL,NULL,0,'Admin','Admin',NULL,'2016-10-17 16:41:21'),(2,4,'Tech Lead','Technology head',50,20,'Experience in handling clients',NULL,NULL,50000,80000,'Java, JEE, Spring, Hibernate',34,42,'2016-10-16','2016-10-16',1,'Admin','Admin','2016-10-16 10:15:11','2016-10-16 10:15:11'),(4,4,'Enterprise Architect','Responsible for solution architecture & enterprise architecture',50,5,'Experience in various domains and integration',NULL,NULL,300000,400000,'Java, JEE, Spring, Hibernate, .NET 4.5',34,42,'2016-10-17','2016-10-17',1,'Admin','Admin','2016-10-17 16:38:41','2016-10-17 16:38:41');

/*Table structure for table `ri_list_entities` */

CREATE TABLE `ri_list_entities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_entity_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `list_group_id` int(10) unsigned NOT NULL,
  `sequence_no` smallint(6) DEFAULT NULL,
  `delete_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'RI_Admin',
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'RI_Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ri_list_entities_list_group_id_foreign` (`list_group_id`),
  CONSTRAINT `ri_list_entities_list_group_id_foreign` FOREIGN KEY (`list_group_id`) REFERENCES `ri_list_group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_list_entities` */

insert  into `ri_list_entities`(`id`,`list_entity_name`,`code`,`list_group_id`,`sequence_no`,`delete_status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'Government',NULL,4,1,1,'RI_Admin','RI_Admin',NULL,NULL),(2,'Private Limited',NULL,4,2,1,'RI_Admin','RI_Admin',NULL,NULL),(3,'Public Limited',NULL,4,3,1,'RI_Admin','RI_Admin',NULL,NULL),(4,'Ahmedabad',NULL,3,1,1,'RI_Admin','RI_Admin',NULL,NULL),(5,'Alleppey',NULL,3,2,1,'RI_Admin','RI_Admin',NULL,NULL),(6,'Aurangabad',NULL,3,3,1,'RI_Admin','RI_Admin',NULL,NULL),(7,'Bangalore',NULL,3,4,1,'RI_Admin','RI_Admin',NULL,NULL),(8,'Bellary',NULL,3,5,1,'RI_Admin','RI_Admin',NULL,NULL),(9,'Bhilai',NULL,3,6,1,'RI_Admin','RI_Admin',NULL,NULL),(10,'Bhubaneshwar',NULL,3,7,1,'RI_Admin','RI_Admin',NULL,NULL),(11,'Calicut',NULL,3,8,1,'RI_Admin','RI_Admin',NULL,NULL),(12,'Chandigarh',NULL,3,9,1,'RI_Admin','RI_Admin',NULL,NULL),(13,'Chennai',NULL,3,10,1,'RI_Admin','RI_Admin',NULL,NULL),(14,'Cochin',NULL,3,11,1,'RI_Admin','RI_Admin',NULL,NULL),(15,'Coimbatore',NULL,3,12,1,'RI_Admin','RI_Admin',NULL,NULL),(16,'Cuttack',NULL,3,13,1,'RI_Admin','RI_Admin',NULL,NULL),(17,'Dehradun',NULL,3,14,1,'RI_Admin','RI_Admin',NULL,NULL),(18,'Ernakulam',NULL,3,15,1,'RI_Admin','RI_Admin',NULL,NULL),(19,'Erode',NULL,3,16,1,'RI_Admin','RI_Admin',NULL,NULL),(20,'Faridabad',NULL,3,17,1,'RI_Admin','RI_Admin',NULL,NULL),(21,'Ghaziabad',NULL,3,18,1,'RI_Admin','RI_Admin',NULL,NULL),(22,'Goa',NULL,3,19,1,'RI_Admin','RI_Admin',NULL,NULL),(23,'Gorakhpur',NULL,3,20,1,'RI_Admin','RI_Admin',NULL,NULL),(24,'Gulbarga',NULL,3,21,1,'RI_Admin','RI_Admin',NULL,NULL),(25,'Gurgaon',NULL,3,22,1,'RI_Admin','RI_Admin',NULL,NULL),(26,'Haridwar',NULL,3,23,1,'RI_Admin','RI_Admin',NULL,NULL),(27,'Hubli',NULL,3,24,1,'RI_Admin','RI_Admin',NULL,NULL),(28,'Hyderabad',NULL,3,25,1,'RI_Admin','RI_Admin',NULL,NULL),(29,'Banking',NULL,5,1,1,'RI_Admin','RI_Admin',NULL,NULL),(30,'Finance',NULL,5,2,1,'RI_Admin','RI_Admin',NULL,NULL),(31,'Insurance',NULL,5,3,1,'RI_Admin','RI_Admin',NULL,NULL),(32,'Retail',NULL,5,4,1,'RI_Admin','RI_Admin',NULL,NULL),(33,'Manufacturing',NULL,5,5,1,'RI_Admin','RI_Admin',NULL,NULL),(34,'Healthcare',NULL,5,6,1,'RI_Admin','RI_Admin',NULL,NULL),(35,'Human Resource',NULL,6,1,1,'RI_Admin','RI_Admin',NULL,NULL),(36,'Marketing',NULL,6,2,1,'RI_Admin','RI_Admin',NULL,NULL),(37,'Customer Service Support',NULL,6,3,1,'RI_Admin','RI_Admin',NULL,NULL),(38,'Sales',NULL,6,4,1,'RI_Admin','RI_Admin',NULL,NULL),(39,'Accounting',NULL,6,5,1,'RI_Admin','RI_Admin',NULL,NULL),(40,'Finance',NULL,6,6,1,'RI_Admin','RI_Admin',NULL,NULL),(41,'Distribution',NULL,6,7,1,'RI_Admin','RI_Admin',NULL,NULL),(42,'Research and Development',NULL,6,8,1,'RI_Admin','RI_Admin',NULL,NULL),(43,'Administration',NULL,6,9,1,'RI_Admin','RI_Admin',NULL,NULL),(44,'Management',NULL,6,10,1,'RI_Admin','RI_Admin',NULL,NULL),(45,'Production',NULL,6,11,1,'RI_Admin','RI_Admin',NULL,NULL),(46,'Operations',NULL,6,12,1,'RI_Admin','RI_Admin',NULL,NULL),(47,'IT',NULL,6,13,1,'RI_Admin','RI_Admin',NULL,NULL),(48,'Purchase',NULL,6,14,1,'RI_Admin','RI_Admin',NULL,NULL),(49,'Legal',NULL,6,15,1,'RI_Admin','RI_Admin',NULL,NULL),(50,'Full Time',NULL,9,1,1,'RI_Admin','RI_Admin',NULL,NULL),(51,'Part Time',NULL,9,2,1,'RI_Admin','RI_Admin',NULL,NULL),(52,'Contract',NULL,9,3,1,'RI_Admin','RI_Admin',NULL,NULL),(53,'Permanent',NULL,9,4,1,'RI_Admin','RI_Admin',NULL,NULL),(54,'Temporary',NULL,9,5,1,'RI_Admin','RI_Admin',NULL,NULL),(55,'India',NULL,1,1,1,'RI_Admin','RI_Admin',NULL,NULL),(56,'Assamese',NULL,7,1,1,'RI_Admin','RI_Admin',NULL,NULL),(57,'Bengali',NULL,7,2,1,'RI_Admin','RI_Admin',NULL,NULL),(58,'Bihari',NULL,7,3,1,'RI_Admin','RI_Admin',NULL,NULL),(59,'English',NULL,7,4,1,'RI_Admin','RI_Admin',NULL,NULL),(60,'Chinese',NULL,7,5,1,'RI_Admin','RI_Admin',NULL,NULL),(61,'Arabic',NULL,7,6,1,'RI_Admin','RI_Admin',NULL,NULL),(62,'Danish',NULL,7,7,1,'RI_Admin','RI_Admin',NULL,NULL),(63,'French',NULL,7,8,1,'RI_Admin','RI_Admin',NULL,NULL),(64,'German',NULL,7,9,1,'RI_Admin','RI_Admin',NULL,NULL),(65,'Gujarathi',NULL,7,10,1,'RI_Admin','RI_Admin',NULL,NULL),(66,'Hindi',NULL,7,11,1,'RI_Admin','RI_Admin',NULL,NULL),(67,'Italian',NULL,7,12,1,'RI_Admin','RI_Admin',NULL,NULL),(68,'Japanese',NULL,7,13,1,'RI_Admin','RI_Admin',NULL,NULL),(69,'Kannada',NULL,7,14,1,'RI_Admin','RI_Admin',NULL,NULL),(70,'Kashmiri',NULL,7,15,1,'RI_Admin','RI_Admin',NULL,NULL),(71,'Latin',NULL,7,16,1,'RI_Admin','RI_Admin',NULL,NULL),(72,'Malayalam',NULL,7,17,1,'RI_Admin','RI_Admin',NULL,NULL),(73,'Marathi',NULL,7,18,1,'RI_Admin','RI_Admin',NULL,NULL),(74,'Oriya',NULL,7,19,1,'RI_Admin','RI_Admin',NULL,NULL),(75,'Punjabi',NULL,7,20,1,'RI_Admin','RI_Admin',NULL,NULL),(76,'Sanskrit',NULL,7,21,1,'RI_Admin','RI_Admin',NULL,NULL),(77,'Sindhi',NULL,7,22,1,'RI_Admin','RI_Admin',NULL,NULL),(78,'Spanish',NULL,7,23,1,'RI_Admin','RI_Admin',NULL,NULL),(79,'Tamil',NULL,7,24,1,'RI_Admin','RI_Admin',NULL,NULL),(80,'Telugu',NULL,7,25,1,'RI_Admin','RI_Admin',NULL,NULL),(81,'Urdu',NULL,7,26,1,'RI_Admin','RI_Admin',NULL,NULL);

/*Table structure for table `ri_list_group` */

CREATE TABLE `ri_list_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delete_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'RI_Admin',
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'RI_Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ri_list_group` */

insert  into `ri_list_group`(`id`,`list_group_name`,`code`,`delete_status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'Country',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(2,'States',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(3,'Cities',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(4,'Company Type',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(5,'Industry Area',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(6,'Functional Area',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(7,'Languages',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(8,'Proficiency',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(9,'Contract Type',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(10,'Interview Type',NULL,1,'RI_Admin','RI_Admin',NULL,NULL),(11,'Interview Status',NULL,1,'RI_Admin','RI_Admin',NULL,NULL);

/*Table structure for table `role_user` */

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`user_id`,`role_id`) values (1,1),(2,1),(4,1),(8,1),(3,2),(7,2);

/*Table structure for table `roles` */

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (1,'Client','Client','Client',NULL,NULL),(2,'Candidate','Candidate','Candidate',NULL,NULL);

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`delete_status`,`created_at`,`updated_at`) values (1,'Alten Calsoft','calsoft@gmail.com','123456','sfsdfsd',1,NULL,'2016-10-17 06:15:27'),(2,'Polaris','polaris@gmail.com','123456','dfsdfdsf',0,NULL,'2016-10-17 16:17:54'),(3,'Baskar','baskar@gmail.com','123456','fdsfdsfds',0,NULL,'2016-10-17 07:04:53'),(4,'HCL Technologies','hcl11@gmail.com','HCL Technologies',NULL,1,'2016-10-16 08:00:12','2016-10-16 08:00:12'),(7,'Baskaran Subbaraman','sbaskar@ggmail.com','Baskaran',NULL,1,'2016-10-17 14:03:05','2016-10-17 14:03:05'),(8,'Wipro Technologies','wipro1288@gmail.com','Wipro Technologies',NULL,1,'2016-10-17 16:08:56','2016-10-17 16:08:56');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
