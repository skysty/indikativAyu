<?php
/**
 * Created by PhpStorm.
 * User: e.tagay
 * Date: 08.08.2023
 * Time: 16:42
 */
include('../incs/connect.php');
$query = mysqli_query($connection, "CREATE TABLE IF NOT EXISTS locale (
        id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        object varchar(255),
        kaz varchar(255),
        rus varchar(255)); ") or print(mysqli_error($connection));

$query = mysqli_query($connection, "CREATE UNIQUE INDEX local_object_idx ON locale (object);") or print(mysqli_error($connection));
echo "OK \n";

$query = mysqli_query($connection, "ALTER TABLE `tutors` ADD `lastnameRu` VARCHAR(50) DEFAULT NULL; ") or print(mysqli_error($connection));
$query = mysqli_query($connection, "ALTER TABLE `tutors` ADD `firstnameRu` VARCHAR(50) DEFAULT NULL; ") or print(mysqli_error($connection));
$query = mysqli_query($connection, "ALTER TABLE `tutors` ADD `patronymicRu` VARCHAR(50) DEFAULT NULL; ") or print(mysqli_error($connection));
$query = mysqli_query($connection, "ALTER TABLE `korsetkishter` ADD `korsetkish_ati_ru` VARCHAR(255); ") or print(mysqli_error($connection));

echo "OK \n";
