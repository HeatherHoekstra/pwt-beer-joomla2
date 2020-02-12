DROP TABLE IF EXISTS `#__beers`;

CREATE TABLE `#__beers`
(
    `id`           INT(11)       NOT NULL AUTO_INCREMENT,
    `name`         VARCHAR(100)  NOT NULL,
    `tagline`      VARCHAR(255)  NOT NULL,
    `description`  TEXT(500)     NOT NULL,
    `abv`          DECIMAL(2, 1) NOT NULL,
    `rating`       INT(11)       NOT NULL DEFAULT 0,
    `image_url`    VARCHAR(500)  NOT NULL DEFAULT 'noimg',
    `state`        TINYINT(3)    NOT NULL DEFAULT 0,
    `publish_up`   datetime      NOT NULL DEFAULT '0000-00-00 00:00:00',
    `publish_down` datetime      NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8;


DROP TABLE IF EXISTS `#__ratings`;

CREATE TABLE `#__ratings`
(
    `id`        INT(11) NOT NULL AUTO_INCREMENT,
    `beer_id`   INT(11) NOT NULL,
    `rating`    INT(11) NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8;
