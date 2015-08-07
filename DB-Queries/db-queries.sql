--20 july--

ALTER TABLE `builders` ADD `builder_footer_image` VARCHAR(100) NOT NULL AFTER `builder_image`;
--30 july-- 
ALTER TABLE `project_floor_plan` CHANGE `size` `size` INT(20) NOT NULL;
ALTER TABLE `project_floor_plan` CHANGE `price` `price` INT(20) NOT NULL;

--url changes--
ALTER TABLE `projects` ADD COLUMN `projectSlug` VARCHAR(200) NOT NULL AFTER `project_title`;
ALTER TABLE `cities` ADD `citySlug` VARCHAR(200) NOT NULL AFTER `city_name`;
ALTER TABLE `builders` ADD `builderSlug` VARCHAR(200) NOT NULL AFTER `builder_name`;

--floor plan update--
ALTER TABLE `project_floor_plan` ADD `bhk_type` INT(1) NOT NULL AFTER `plan_type`;
