-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2018 at 01:20 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Database: `records_of_students`
--
CREATE SCHEMA IF NOT EXISTS `records_of_students` DEFAULT CHARACTER SET utf8;
USE `records_of_students`;

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(120) NOT NULL,
  `zip` varchar(20) NOT NULL,
  PRIMARY KEY (`city_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(120) NOT NULL,
  `school_street` varchar(200) NOT NULL,
  `city_id` int(11) NOT NULL,
  `school_telephone` varchar(30) NOT NULL,
  `school_email` varchar(50) NOT NULL,
  PRIMARY KEY (`school_id`),
  INDEX `fk_schools_city1_idx` (`city_id` ASC),
  CONSTRAINT `fk_schools_city1`
    FOREIGN KEY (`city_id`)
    REFERENCES `records_of_students`.`city` (`city_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(120) NOT NULL,
  `teacher_surname` varchar(120) NOT NULL,
  `teacher_street` varchar(200) NOT NULL,
  `city_id` int(11) NOT NULL,
  `teacher_telephone` varchar(30) NOT NULL,
  `teacher_email` varchar(50) NOT NULL,
  PRIMARY KEY (`teacher_id`),
  INDEX `fk_teachers_city1_idx` (`city_id` ASC),
  CONSTRAINT `fk_teachers_city1`
    FOREIGN KEY (`city_id`)
    REFERENCES `records_of_students`.`city` (`city_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(20) NOT NULL,
  `class_mark` varchar(20) NOT NULL,
  `school_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`),
  INDEX `fk_classes_school_idx` (`school_id` ASC),
  INDEX `fk_classes_teacher_idx` (`teacher_id` ASC),
  CONSTRAINT `fk_classes_school1`
    FOREIGN KEY (`school_id`)
    REFERENCES `records_of_students`.`schools` (`school_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_teacher1`
    FOREIGN KEY (`teacher_id`)
    REFERENCES `records_of_students`.`teachers` (`teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_image` varchar(200) NOT NULL,
  `student_name` varchar(120) NOT NULL,
  `student_surname` varchar(120) NOT NULL,
  `student_oib` varchar(13) NOT NULL,
  `student_telephone` varchar(30) NOT NULL,
  `student_street` varchar(200) NOT NULL,
  `city_id` int(11) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_grade` decimal(3,2) NOT NULL,
  `student_status` int(1) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE INDEX `student_oib_UNIQUE` (`student_oib` ASC),
  INDEX `fk_students_city_idx` (`city_id` ASC),
  INDEX `fk_students_class_idx` (`class_id` ASC),
  CONSTRAINT `fk_students_city1`
    FOREIGN KEY (`city_id`)
    REFERENCES `records_of_students`.`city` (`city_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_class1`
    FOREIGN KEY (`class_id`)
    REFERENCES `records_of_students`.`classes` (`class_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



/*SET SQL_MODE=@OLD_SQL_MODE*/;
/*SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS*/;
/*SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS*/;