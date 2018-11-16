-- Создание базы данных
CREATE DATABASE bgtu_web;

-- Создание таблицы 'bgtu_web_data'
DROP TABLE IF EXISTS `bgtu_web_data`;
CREATE TABLE IF NOT EXISTS `bgtu_web_data` (
`id` INT NOT NULL AUTO_INCREMENT,
`surname` VARCHAR(128) NOT NULL,
`name` VARCHAR(128) NOT NULL,
`patronymic` VARCHAR(128) NOT NULL,
`email` VARCHAR(128) NOT NULL,
`sex` VARCHAR(10),
`course` VARCHAR(10),
`about` VARCHAR(256) DEFAULT '',
`confirmation` TINYINT NOT NULL DEFAULT 0,
`date` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;




