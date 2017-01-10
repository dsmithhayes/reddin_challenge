CREATE TABLE IF NOT EXISTS `users` (
  `id`            int(12) UNSIGNED  NOT NULL AUTO_INCREMENT,
  `first_name`    varchar(256)      NOT NULL,
  `last_name`     varchar(256)      NOT NULL,
  `email`         varchar(256)      NOT NULL,
  `password`      varchar(256)      DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
