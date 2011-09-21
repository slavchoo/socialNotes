CREATE TABLE `notes` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`title`  varchar(255) NULL ,
`text`  text NULL ,
`slug`  varchar(255) NULL ,
`created_at`  int(11) UNSIGNED,
`user_id`  int(11) UNSIGNED NULL ,
`actual_date`  int(11) UNSIGNED,
PRIMARY KEY (`id`)
)
;
