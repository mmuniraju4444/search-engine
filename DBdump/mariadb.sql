-- Adminer 4.8.0 MySQL 5.5.5-10.5.8-MariaDB-1:10.5.8+maria~focal-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10,	'2021_04_22_122000_page_table',	1),
(11,	'2021_04_22_143736_page_data_table',	1),
(12,	'2021_04_22_200416_stop_words_table',	1);

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_uuid_unique` (`uuid`),
  UNIQUE KEY `pages_url_unique` (`url`),
  FULLTEXT KEY `search` (`url`,`title`,`description`,`keywords`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pages` (`id`, `uuid`, `url`, `title`, `description`, `keywords`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'f92dd579-cb06-40c6-aa1c-3b08dad37e0a',	'https://getbootstrap.com/docs/5.0/forms/form-control/',	'Form controls · Bootstrap v5.0',	'Give textual form controls like <input>s and <textarea>s an upgrade with custom styles, sizing, focus states, and more.',	'',	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:34:12'),
(2,	'41717c99-7eab-4c89-86cf-624af4317d17',	'https://dev.mysql.com/doc/refman/8.0/en/fulltext-stopwords.html',	'MySQL :: MySQL 8.0 Reference Manual :: 12.10.4 Full-Text Stopwords',	'',	'',	NULL,	'2021-04-23 16:34:18',	'2021-04-23 16:34:18'),
(3,	'39bd0eee-7bb7-4372-b18a-a0e920a64c40',	'https://laravel.com/docs/8.x/seeding#introduction',	'Database: Seeding - Laravel - The PHP Framework For Web Artisans',	'',	'',	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:34:22'),
(4,	'4201c5f5-5ac8-4cc5-bc6a-ec128260c194',	'https://www.google.com/search?q=coronavirus+prevention',	'coronavirus prevention - Google Search',	'',	'',	NULL,	'2021-04-23 16:34:23',	'2021-04-23 16:34:23'),
(5,	'ac7fe597-28e2-4c69-b7d8-44153c490eea',	'https://www.cdc.gov/coronavirus/2019-ncov/prevent-getting-sick/prevention.html',	'How to Protect Yourself & Others  | CDC',	'Know how coronavirus (COVID-19) spreads and take steps to protect yourself and others. Avoid close contact, clean your hands often, cover coughs and sneezes, stay home if you’re sick, and know how to clean and disinfect.',	'How coronavirus spreads, Steps protect yourself from coronavirus, What to do if sick from coronavirus, cleaning and disinfecting, Disease Information, Prevention & Infection Control',	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:34:24'),
(6,	'ac248085-b078-48af-98b6-fe228806aea0',	'https://www.cdc.gov/coronavirus/2019-ncov/prevent-getting-sick/how-to-wear-cloth-face-coverings.html',	'How to Safely Wear and Take Off a Cloth Face Covering | CDC',	'Cloth face coverings are an additional step to help slow the spread of COVID-19 when combined with every day preventive actions and social distancing in public settings.',	'cloth face covering, take off cloth face covering, proper fit, safely wear cloth face covering, remove cloth face covering, Coronavirus [CoV], Facemasks',	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:34:26');

DROP TABLE IF EXISTS `page_data`;
CREATE TABLE `page_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_data_uuid_unique` (`uuid`),
  KEY `page_data_page_id_foreign` (`page_id`),
  KEY `page_data_data_index` (`data`(768)),
  FULLTEXT KEY `search` (`data`),
  CONSTRAINT `page_data_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `page_data` (`id`, `uuid`, `data`, `page_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'e888b677-a18f-4d9a-bccd-19a2d43d391b',	'Give textual form controls like <input>s and <textarea>s an upgrade with custom styles, sizing, focus states, and more.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(2,	'9319330e-6cbb-4dbe-bbb2-9dcf726850e4',	'Set heights using classes like .form-control-lg and .form-control-sm.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(3,	'901476d7-1c7a-47c4-91e9-1c6d4c5d3f87',	'Add the disabled boolean attribute on an input to give it a grayed out appearance and remove pointer events.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(4,	'94047eee-0fad-45ec-b093-363e2113336f',	'Add the readonly boolean attribute on an input to prevent modification of the input’s value. Read-only inputs appear lighter (just like disabled inputs), but retain the standard cursor.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(5,	'c69e705e-6fd3-4e9d-ad01-c7611d2daf5d',	'If you want to have <input readonly> elements in your form styled as plain text, use the .form-control-plaintext class to remove the default form field styling and preserve the correct margin and padding.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(6,	'22e6a04c-683f-45ff-b0c1-a79b6ecf0c18',	'Datalists allow you to create a group of <option>s that can be accessed (and autocompleted) from within an <input>. These are similar to <select> elements, but come with more menu styling limitations and differences. While most browsers and operating systems include some support for <datalist> elements, their styling is inconsistent at best.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(7,	'5462fe74-be00-46df-9304-d69c5dd690b7',	'Learn more about support for datalist elements.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(8,	'5319e684-1745-4d8e-9795-ae29e5081798',	'$input-* are shared across most of our form controls (and not buttons).',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(9,	'e1d786d1-e16f-4093-93b6-44877a37ff28',	'$form-label-* and $form-text-* are for our <label>s and .form-text component.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(10,	'e094c641-b5f3-48ae-9872-15de70f6c50d',	'Designed and built with all the love in the world by the Bootstrap team with the help of our contributors.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(11,	'fd14418d-7645-4497-97a3-ff0eadaa0313',	'Currently v5.0.0-beta3. Code licensed MIT, docs CC BY 3.0.',	1,	NULL,	'2021-04-23 16:34:12',	'2021-04-23 16:46:24'),
(12,	'b3fd590b-a0fb-4c60-8046-144c8ea28ff4',	'The stopword list is loaded and searched for full-text queries        using the server character set and collation (the values of the        character_set_server and        collation_server system        variables). False hits or misses might occur for stopword        lookups if the stopword file or columns used for full-text        indexing or searches have a character set or collation different        from character_set_server or        collation_server.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(13,	'4d3ec47b-e055-4658-958c-15a0279a6877',	'Case sensitivity of stopword lookups depends on the server        collation. For example, lookups are case-insensitive if the        collation is utf8mb4_0900_ai_ci, whereas        lookups are case-sensitive if the collation is        utf8mb4_0900_as_cs or        utf8mb4_bin.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(14,	'5b177176-1dcb-4c3f-972d-5e66afda7f5a',	'Stopwords for InnoDB Search Indexes',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(15,	'0744611f-0915-462a-82e8-5404524bbb6f',	'Stopwords for MyISAM Search Indexes',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(16,	'f8a818e5-8433-411c-858c-45c300bb3343',	'InnoDB has a relatively short list of          default stopwords, because documents from technical, literary,          and other sources often use short words as keywords or in          significant phrases. For example, you might search for          “to be or not to be” and expect to get a sensible          result, rather than having all those words ignored.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(17,	'b24c47dc-e430-4f73-ae28-a52014f8f374',	'To see the default InnoDB stopword list,          query the          INFORMATION_SCHEMA.INNODB_FT_DEFAULT_STOPWORD          table.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(18,	'6046909d-9356-4d82-a9ee-9243193a4d25',	'To define your own stopword list for all          InnoDB tables, define a table with the same          structure as the          INNODB_FT_DEFAULT_STOPWORD table,          populate it with stopwords, and set the value of the          innodb_ft_server_stopword_table          option to a value in the form          db_name/table_name          before creating the full-text index. The stopword table must          have a single VARCHAR column          named value. The following example          demonstrates creating and configuring a new global stopword          table for InnoDB.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(19,	'73ee2f45-d595-4278-bf52-2f27471f9d1c',	'Verify that the specified stopword (\'Ishmael\') does not appear          by querying the words in          INFORMATION_SCHEMA.INNODB_FT_INDEX_TABLE.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(20,	'848e8276-b9da-40fa-a9e5-d954ad015bf9',	'By default, words less than 3 characters in length or            greater than 84 characters in length do not appear in an            InnoDB full-text search index. Maximum            and minimum word length values are configurable using the            innodb_ft_max_token_size            and            innodb_ft_min_token_size            variables. This default behavior does not apply to the ngram            parser plugin. ngram token size is defined by the            ngram_token_size option.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(21,	'1d23f372-c095-433d-980c-1b1e3bed3e63',	'To create stopword lists on a table-by-table basis, create          other stopword tables and use the          innodb_ft_user_stopword_table          option to specify the stopword table that you want to use          before you create the full-text index.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(22,	'd030e0e1-3051-4289-95ae-6d2a048489ac',	'The stopword file is loaded and searched using          latin1 if          character_set_server is          ucs2, utf16,          utf16le, or utf32.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(23,	'320b2235-9f46-4972-97ef-d320a915101d',	'To override the default stopword list for MyISAM tables, set          the ft_stopword_file system          variable. (See Section 5.1.8, “Server System Variables”.) The          variable value should be the path name of the file containing          the stopword list, or the empty string to disable stopword          filtering. The server looks for the file in the data directory          unless an absolute path name is given to specify a different          directory. After changing the value of this variable or the          contents of the stopword file, restart the server and rebuild          your FULLTEXT indexes.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(24,	'a2ab749d-3bdf-4e23-835c-299fa4db4086',	'The stopword list is free-form, separating stopwords with any          nonalphanumeric character such as newline, space, or comma.          Exceptions are the underscore character (_)          and a single apostrophe (\') which are          treated as part of a word. The character set of the stopword          list is the server\'s default character set; see          Section 10.3.2, “Server Character Set and Collation”.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(25,	'f5265aea-c7c7-490a-b97e-86625a0bc412',	'The following list shows the default stopwords for          MyISAM search indexes. In a MySQL source          distribution, you can find this list in the          storage/myisam/ft_static.c file.',	2,	NULL,	'2021-04-23 16:34:21',	'2021-04-23 16:46:33'),
(26,	'2b74a2bb-44bb-4d9b-84bc-037e169710b1',	'Laravel includes the ability to seed your database with test data using seed classes. All seed classes are stored in the database/seeders directory. By default, a DatabaseSeeder class is defined for you. From this class, you may use the call method to run other seed classes, allowing you to control the seeding order.',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(27,	'01f94948-58d4-49f2-a966-3a5235bb4dec',	'{tip} Mass assignment protection is automatically disabled during database seeding.',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(28,	'df982790-d0fb-48ed-81be-5adb97d2bde0',	'To generate a seeder, execute the make:seeder Artisan command. All seeders generated by the framework will be placed in the database/seeders directory:',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(29,	'cb5ec26e-8d3e-4ca0-aeaf-072e26ff7e3b',	'A seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database however you wish. You may use the query builder to manually insert data or you may use Eloquent model factories.',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(30,	'084319f2-beb1-4dd7-aa02-04ace66f4c5b',	'As an example, let\'s modify the default DatabaseSeeder class and add a database insert statement to the run method:',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(31,	'f746b33d-434a-46f8-91d4-768d124a4703',	'{tip} You may type-hint any dependencies you need within the run method\'s signature. They will automatically be resolved via the Laravel service container.',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(32,	'dbea322b-c479-4c7e-a4e0-2d8254c967c4',	'Of course, manually specifying the attributes for each model seed is cumbersome. Instead, you can use model factories to conveniently generate large amounts of database records. First, review the model factory documentation to learn how to define your factories.',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(33,	'913a44bf-5bac-4c74-b0a2-67f9848d92e6',	'For example, let\'s create 50 users that each has one related post:',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(34,	'5fc67464-be88-4d31-9c8d-59d918402fae',	'Within the DatabaseSeeder class, you may use the call method to execute additional seed classes. Using the call method allows you to break up your database seeding into multiple files so that no single seeder class becomes too large. The call method accepts an array of seeder classes that should be executed:',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(35,	'4c5a7f8a-36ea-420e-a259-a38dc823ea95',	'You may execute the db:seed Artisan command to seed your database. By default, the db:seed command runs the Database\\Seeders\\DatabaseSeeder class, which may in turn invoke other seed classes. However, you may use the --class option to specify a specific seeder class to run individually:',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(36,	'8470a721-b0a5-4a1e-a92c-5deb6de582f9',	'You may also seed your database using the migrate:fresh command in combination with the --seed option, which will drop all tables and re-run all of your migrations. This command is useful for completely re-building your database:',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(37,	'fc92f930-106e-4f1a-9f7a-8a62b558b915',	'Some seeding operations may cause you to alter or lose data. In order to protect you from running seeding commands against your production database, you will be prompted for confirmation before the seeders are executed in the production environment. To force the seeders to run without a prompt, use the --force flag:',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(38,	'0d5ff442-f8c2-44ba-bc09-6bf233ceb9f0',	'Laravel Partners are elite shops providing top-notch Laravel development and consulting. Each of our partners can help you craft a beautiful, well-architected project.',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(39,	'8e710e82-2294-410c-bfd7-7d565aa60774',	'Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in most web projects.',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(40,	'6473cd66-6c70-44f3-b38b-ba18d61c1e38',	'Laravel is a Trademark of Taylor Otwell.Copyright © 2011-2021 Laravel LLC.',	3,	NULL,	'2021-04-23 16:34:22',	'2021-04-23 16:46:34'),
(41,	'f5512157-12d1-4c61-980b-b5fa719d5868',	'Effective February 2, 2021, masks are required on planes, buses, trains, and other forms of public transportation traveling into, within, or out of the United States and in U.S. transportation hubs such as airports and stations.​',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(42,	'0099fd58-8de5-4eb5-bf25-c460c11c0fdf',	'To receive email updates about COVID-19, enter your email address:',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(43,	'a4eb0049-4320-4bc8-a9ba-0025e98d1e2a',	'Español',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(44,	'65eeb5a3-1929-46a7-acdc-7517adf095c7',	'繁體中文',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(45,	'f773d363-aee9-4e90-9e49-78dbc353001d',	'Tiếng Việt',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(46,	'd05e36c4-d095-4c5b-9d55-481507e142bb',	'한국어',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(47,	'523ade2f-ca02-4a49-a56f-9fd773c9eebd',	'Tagalog',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(48,	'aedf3f3d-60a1-4af7-9051-e824c1e7e629',	'Русский',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(49,	'2fa6dd5e-3b26-4350-a195-6eedcf1d245d',	'العربية',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(50,	'de17135d-dd2d-40e3-a6a9-ff1f3718bea0',	'Kreyòl Ayisyen',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(51,	'558a2693-ead3-4021-b38f-cf8f822b8b3b',	'Français',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(52,	'c0bbb3a3-81c6-4391-8ff1-fdaa0df7e038',	'Polski',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(53,	'301ac3ec-0dcd-480f-ab41-5a318bb40392',	'Português',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(54,	'4901ffde-7bcc-4013-8e8b-e0c64a5f3a94',	'Italiano',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(55,	'b51cdf88-86b9-4d50-bb08-782b790f8b7f',	'Deutsch',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(56,	'4651fac6-17ab-4e4e-87de-0d14d29b3454',	'日本語',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(57,	'3d72c123-1f84-41de-b3b4-3ea6a309abe4',	'فارسی',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(58,	'794c58e6-4563-443a-9e9c-1f9dc39a2ce6',	'English',	5,	NULL,	'2021-04-23 16:34:24',	'2021-04-23 16:46:37'),
(59,	'18d8a1b4-de37-4149-a4d5-2c55cda7c3ad',	'Masks are a critical step to help prevent people from getting and spreading COVID-19. A cloth mask offers some protection to you as well as protecting those around you. Wear a mask and take every day preventive actions in public settings and mass transportation, at events and gatherings, and anywhere you will be around other people.',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(60,	'47a81a19-9788-45f3-99b8-ad1a5d239102',	'To receive email updates about COVID-19, enter your email address:',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(61,	'fba7dc3d-d73f-4bd4-b8f2-f33d637e05e4',	'Español',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(62,	'ebc4eedc-8386-4f9b-99b6-e029c2d3325d',	'繁體中文',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(63,	'3db1fbf7-b10a-4d80-9c6b-33fea6fe2592',	'Tiếng Việt',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(64,	'3c6a1246-4c91-488a-b11b-5eae6bb05074',	'한국어',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(65,	'809ce01a-9714-4f84-9f68-d8a3b9072f9d',	'Tagalog',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(66,	'186d90d1-5bdd-4966-b6aa-a03758c4db92',	'Русский',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(67,	'404a0a81-1924-40c0-b4e2-6506c66e7ef4',	'العربية',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(68,	'c9c48b22-70f6-4a1a-ab80-146d7e124b25',	'Kreyòl Ayisyen',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(69,	'6ecb28b9-c0b8-4df0-b82e-191bb57e2329',	'Français',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(70,	'54c1b887-f205-403c-a9a0-eca43b947f00',	'Polski',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(71,	'330a4e49-1ad3-4951-8e4c-24f14d339319',	'Português',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(72,	'1f4305d8-2cfc-4400-8b81-7c4a9c5f7d9a',	'Italiano',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(73,	'19272a83-9156-4591-9ec1-a40aff4be568',	'Deutsch',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(74,	'669137de-8a9a-4556-908a-5372d6f02633',	'日本語',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(75,	'db74810a-cdc2-4536-9124-ff656b5c82d4',	'فارسی',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37'),
(76,	'e29c2f40-50e7-4a83-a12c-7eb526e7225e',	'English',	6,	NULL,	'2021-04-23 16:34:26',	'2021-04-23 16:46:37');

DROP TABLE IF EXISTS `stop_words`;
CREATE TABLE `stop_words` (
  `value` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `stop_words` (`value`) VALUES
('and'),
('or'),
('be'),
('from'),
('etc');

-- 2021-04-23 16:50:20
