-- Default columns names for the PdoSessionHandler as apart of Symfony

CREATE TABLE IF NOT EXISTS `sessions` (
  `sess_id`       varchar(128)      NOT NULL PRIMARY KEY,
  `sess_data`     blob              NOT NULL,
  `sess_time`     integer UNSIGNED  NOT NULL,
  `sess_lifetime` mediumint         NOT NULL
);
