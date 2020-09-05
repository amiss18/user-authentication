User authentication and registration with PHP and PDO
=====================================================

This is an example User authentication

Requirements
------------

  * PHP 7.2.9 or higher;

Installation
------------
- Clone the repo


Database config
--------------
```
//config.php

define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASSWORD', 'bd');
define('PORT', '3306');
define('DATABASE', 'teste');
define('CHARSET', 'utf8mb4');


```


Run these SQL statements to create the users table with some data in it.
----------------------------------------------------------------------
```bash
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(6,	'John Doe',	'admin@example.com',	'$2y$10$4m51MQpp72gpiON6mi6aaOBDkbq3esg1nzNFmF8i0CqH/SfBlxf0G',	'ROLE_ADMIN',	'2020-09-05 15:15:10',	NULL);
```



Usage
-----
- Run the PHP webserver:


```bash
$ php -S localhost:8000
```
- Access from a browser using this URL: `http://localhost:8000`


