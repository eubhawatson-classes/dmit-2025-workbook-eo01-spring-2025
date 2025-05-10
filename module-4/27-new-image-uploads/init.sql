-- We're going to create a brand new table to store information about the images that we upload; however, since tables generally only store text, we will be uploading the actual file to the server and then just storing the filename here.

CREATE TABLE `gallery_prep` (
`image_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
`title` VARCHAR(50) NOT NULL,
`description` VARCHAR(255) NULL,
`filename` VARCHAR(255) NOT NULL,
`uploaded_on` datetime NOT NULL,
PRIMARY KEY(`image_id`)
);