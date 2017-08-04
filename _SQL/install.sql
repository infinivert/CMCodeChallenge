USE psamatho_CMCode;

CREATE TABLE `credits` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `label` varchar(255) NOT NULL,
    `bonus` int(10) unsigned NOT NULL,
    `cost` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT DEFAULT CHARSET=utf8;

INSERT INTO `credits` VALUES 
    (1,'Individual',0,20),
    (2,'Professional',0,50),
    (3,'Most Popular',10,100),
    (4,'Big Bonus',22,200),
    (5,'Best Value',60,500);