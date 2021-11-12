ALTER TABLE `business_settings` ADD `page_id` int(20) DEFAULT NULL AFTER `lang`;

ALTER TABLE `orders` ADD `serial_number` int(20) NULL DEFAULT NULL AFTER `code`;
ALTER TABLE `carts` CHANGE `address_id` `address_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `carts` ADD `shipping_address` longtext NULL DEFAULT NULL AFTER `billing_address_id`;
ALTER TABLE `carts` ADD `billing_address` longtext NULL DEFAULT NULL AFTER `shipping_address`;