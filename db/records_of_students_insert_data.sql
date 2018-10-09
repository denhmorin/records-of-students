SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
USE `records_of_students`;

/* Insert data into table `city` */
INSERT INTO `city` (`city_id`, `city_name`, `zip`) VALUES
(1, 'Zagreb', '10000'),
(2, 'Varaždin', '42000'),
(3, 'Sisak', '10100');

/* Insert data into table `schools` */
INSERT INTO `schools` (`school_id`, `school_name`, `school_street`, `city_id`, `school_telephone`, `school_email`) VALUES
(1, 'Osnovna škola Zagreb 1', 'Vukovarska ulica 11', 1, '78346394637', 'name@mail.com'),
(2, 'Osnovna škola Zagreb 2', 'Vukovarska ulica 11', 1, '78346394637', 'name@mail.com'),
(3, 'Osnovna škola Zagreb 3', 'Vukovarska ulica 11', 2, '78346394637', 'name@mail.com'),
(4, 'Osnovna škola Zagreb 4', 'Vukovarska ulica 11', 2, '78346394637', 'name@mail.com'),
(5, 'Osnovna škola Zagreb 5', 'Vukovarska ulica 11', 2, '78346394637', 'name@mail.com'),
(6, 'Osnovna škola Zagreb 6', 'Vukovarska ulica 11', 3, '78346394637', 'name@mail.com');

/* Insert data into table `teachers` */
INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `teacher_surname`, `teacher_street`, `city_id`, `teacher_telephone`, `teacher_email`) VALUES
(1, 'Ivan', 'Ivić', 'Vukovarska ulica 11', 1, '78346394637', 'name@mail.com'),
(2, 'Josipa', 'Josić', 'Vukovarska ulica 11', 2, '78346394637', 'name@mail.com'),
(3, 'Vedrana', 'Horvat', 'Vukovarska ulica 11', 1, '78346394637', 'name@mail.com'),
(4, 'Ana', 'Prpa', 'Vukovarska ulica 11', 1, '78346394637', 'name@mail.com'),
(5, 'Marko', 'Grba', 'Vukovarska ulica 11', 3, '78346394637', 'name@mail.com'),
(6, 'Božo', 'Kralj', 'Vukovarska ulica 11', 2, '78346394637', 'name@mail.com'),
(7, 'Branka', 'Car', 'Vukovarska ulica 11', 2, '78346394637', 'name@mail.com');

/* Insert data into table `classes` */
INSERT INTO `classes` (`class_id`, `class_name`, `class_mark`, `school_id`, `teacher_id`) VALUES
/*school_id=1 */
(1, '1', 'a', 1, 1),
(2, '2', 'b', 1, 2),
(3, '3', 'a', 1, 3),
(4, '4', 'a', 1, 4),
/*school_id=2 */
(5, '1', 'a', 2, 1),
(6, '2', 'b', 2, 2),
(7, '3', 'a', 2, 3),
(8, '4', 'a', 2, 4),
/*school_id=3 */
(9, '1', 'a', 3, 1),
(10, '2', 'b', 3, 2),
(11, '3', 'a', 3, 3),
(12, '4', 'a', 3, 4),
/*school_id=4 */
(13, '1', 'a', 4, 1),
(14, '2', 'b', 4, 2),
(15, '3', 'a', 4, 3),
(16, '4', 'a', 4, 4),
/*school_id=5 */
(17, '1', 'a', 5, 1),
(18, '2', 'b', 5, 2),
(19, '3', 'a', 5, 3),
(20, '4', 'a', 5, 4),
/*school_id=6 */
(21, '1', 'a', 6, 1),
(22, '2', 'b', 6, 2),
(23, '3', 'a', 6, 3),
(24, '4', 'a', 6, 4);

/* Insert data into table `students` */
INSERT INTO `students` (`student_id`, `student_image`, `student_name`, `student_surname`, `student_oib`, `student_telephone`, `student_street`, `city_id`, `student_email`, `student_grade`, `student_status`, `class_id`) VALUES
/* class_id=1 school_id=1 */
(1, 'img/user.png', 'Ivan', 'Horvat', '1254777784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 2.24, 1, 1),
(2, 'img/user.png', 'Marija', 'Marić', '2254654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 2.37, 1, 1),
(3, 'img/user.png', 'Josipa', 'Jopina', '3254654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.49, 1, 1),
(4, 'img/user.png', 'Antonio', 'Antić', '4254654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.50, 1, 1),
(5, 'img/user.png', 'Boško', 'Balaban', '5254654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 5.00, 1, 1),
/* class_id=2 school_id=1 */
(6, 'img/user.png', 'Nikolina', 'Niki', '6254654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 2, 1, 2),
(7, 'img/user.png', 'Ivan', 'Marić', '7254654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 2.4, 1, 2),
(8, 'img/user.png', 'Josipa', 'Balaban', '8254654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.34, 1, 2),
(9, 'img/user.png', 'Antonio', 'Horvat', '9254654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4, 1, 2),
(10, 'img/user.png', 'Marija', 'Horvat', '1154654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.34, 1, 2),
/* class_id=3 school_id=1 */
(11, 'img/user.png', 'Adrijana', 'Bobić', '1254888784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.46, 1, 3),
(12, 'img/user.png', 'Andreja', 'Deka', '1354654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.44, 1, 3),
(13, 'img/user.png', 'Ivan', 'Deka', '1454654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.76, 1, 3),
(14, 'img/user.png', 'Marko', 'Markić', '1554654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.76, 1, 3),
(15, 'img/user.png', 'Hrvoje', 'Vojko', '1654654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.56, 1, 3),
/* class_id=4 school_id=1 */
(16, 'img/user.png', 'Andrijan', 'Deka', '1754654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.65, 1, 4),
(17, 'img/user.png', 'Ivan', 'Bobić', '1854654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.75, 1, 4),
(18, 'img/user.png', 'Hrvoje', 'Balaban', '1954654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.57, 1, 4),
(19, 'img/user.png', 'Nikolina', 'Markić', '1214654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.86, 1, 4),
(20, 'img/user.png', 'Msrijana', 'Marijanović', '1224654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.76, 1, 4),


/* class_id=5 school_id=2 */
(21, 'img/user.png', 'Đuro', 'Đurić', '1234656784344', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.45, 1, 5),
(22, 'img/user.png', 'Pero', 'Perić', '1244654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.67, 1, 5),
(23, 'img/user.png', 'Branko', 'Brankić', '1254564784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.65, 1, 5),
(24, 'img/user.png', 'Bosiljko', 'Horvat', '1264654784554', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.87, 1, 5),
(25, 'img/user.png', 'Ana', 'Anić', '1274654784599', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.76, 1, 5),
/* class_id=6 school_id=2 */
(26, 'img/user.png', 'Ana', 'Horvat', '1284654784774', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 2.24, 1, 6),
(27, 'img/user.png', 'Marija', 'Marić', '2294654786624', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 2.37, 1, 6),
(28, 'img/user.png', 'Josipa', 'Jopina', '3254655484524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.49, 1, 6),
(29, 'img/user.png', 'Antonio', 'Antić', '4254678784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.50, 1, 6),
(30, 'img/user.png', 'Boško', 'Balaban', '5984654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 5.00, 1, 6),
/* class_id=7 school_id=2 */
(31, 'img/user.png', 'Nikolina', 'Niki', '0051654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 2, 1, 7),
(32, 'img/user.png', 'Ivan', 'Marić', '7252608784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 2.4, 1, 7),
(33, 'img/user.png', 'Josipa', 'Balaban', '8093654784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.34, 1, 7),
(34, 'img/user.png', 'Antonio', 'Horvat', '9254650384524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4, 1, 7),
(35, 'img/user.png', 'Marija', 'Horvat', '1105654704524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.34, 1, 7),
/* class_id=8 school_id=2 */
(36, 'img/user.png', 'Adrijana', 'Bobić', '0256654780524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.46, 1, 8),
(37, 'img/user.png', 'Andreja', 'Deka', '1357650284524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.44, 1, 8),
(38, 'img/user.png', 'Ivan', 'Deka', '4586044784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.76, 1, 8),
(39, 'img/user.png', 'Marko', 'Markić', '1550554784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.76, 1, 8),
(40, 'img/user.png', 'Hrvoje', 'Vojko', '1654154780924', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 4.56, 1, 8),

/* class_id=9 school_id=3 */
(41, 'img/user.png', 'Andrijan', 'Deka', '1754299784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.65, 1, 9),
(42, 'img/user.png', 'Ivan', 'Bobić', '1854354789224', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.75, 1, 9),
(43, 'img/user.png', 'Hrvoje', 'Balaban', '1953554784524', '3467457458', 'Vukovarska ulica 11', 1, 'mail@mail.com', 3.57, 1, 9),
(44, 'img/user.png', 'Nikolina', 'Markić', '1214586784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.86, 1, 9),
(45, 'img/user.png', 'Msrijana', 'Marijanović', '1224984784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.76, 1, 9),
/* class_id=10 school_id=3 */
(46, 'img/user.png', 'Đuro', 'Đurić', '1234854784004', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.45, 1, 10),
(47, 'img/user.png', 'Pero', 'Perić', '1244954000524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.67, 1, 10),
(48, 'img/user.png', 'Branko', 'Brankić', '1250004784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.65, 1, 10),
(49, 'img/user.png', 'Bosiljko', 'Horvat', '1211124784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.87, 1, 10),
(50, 'img/user.png', 'Ana', 'Anić', '1274634784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.76, 1, 10),
/* class_id=11 school_id=3 */
(51, 'img/user.png', 'Ivan', 'Horvat', '1254644111524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 2.24, 1, 11),
(52, 'img/user.png', 'Marija', 'Marić', '2254654222524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 2.37, 1, 11),
(53, 'img/user.png', 'Josipa', 'Jopina', '3254651333524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.49, 1, 11),
(54, 'img/user.png', 'Antonio', 'Antić', '4254652444524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.50, 1, 11),
(55, 'img/user.png', 'Boško', 'Balaban', '5254653555524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 5.00, 1, 11),
/* class_id=12 school_id=3 */
(56, 'img/user.png', 'Nikolina', 'Niki', '6254666784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 2, 1, 12),
(57, 'img/user.png', 'Ivan', 'Marić', '7254655787774', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 2.4, 1, 12),
(58, 'img/user.png', 'Josipa', 'Balaban', '8254888784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.34, 1, 12),
(59, 'img/user.png', 'Antonio', 'Horvat', '9254999784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4, 1, 12),
(60, 'img/user.png', 'Marija', 'Horvat', '1111659784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.34, 1, 12),

/* class_id=13 school_id=4 */
(61, 'img/user.png', 'Adrijana', 'Bobić', '1233654184524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.46, 1, 13),
(62, 'img/user.png', 'Andreja', 'Deka', '1354654344524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.44, 1, 13),
(63, 'img/user.png', 'Ivan', 'Deka', '1454654364524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.76, 1, 13),
(64, 'img/user.png', 'Marko', 'Markić', '1554654674524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.76, 1, 13),
(65, 'img/user.png', 'Hrvoje', 'Vojko', '165465584524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.56, 1, 13),
/* class_id=14 school_id=4 */
(66, 'img/user.png', 'Andrijan', 'Deka', '1754676468424', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.65, 1, 14),
(67, 'img/user.png', 'Ivan', 'Bobić', '1854654784344', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.75, 1, 14),
(68, 'img/user.png', 'Hrvoje', 'Balaban', '1954654889224', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.57, 1, 14),
(69, 'img/user.png', 'Nikolina', 'Markić', '1214654999524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.86, 1, 14),
(70, 'img/user.png', 'Msrijana', 'Marijanović', '1994654714524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.76, 1, 14),
/* class_id=15 school_id=4 */
(71, 'img/user.png', 'Đuro', 'Đurić', '1234654724954', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.45, 1, 15),
(72, 'img/user.png', 'Pero', 'Perić', '1244659234524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.67, 1, 15),
(73, 'img/user.png', 'Branko', 'Brankić', '1254854744524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.65, 1, 15),
(74, 'img/user.png', 'Bosiljko', 'Horvat', '1264654756524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.87, 1, 15),
(75, 'img/user.png', 'Ana', 'Anić', '1274654766524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.76, 1, 15),
/* class_id=16 school_id=4 */
(76, 'img/user.png', 'Ivan', 'Horvat', '1254654776624', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 2.24, 1, 16),
(77, 'img/user.png', 'Marija', 'Marić', '2254654664524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 2.37, 1, 16),
(78, 'img/user.png', 'Josipa', 'Jopina', '3266654794524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.49, 1, 16),
(79, 'img/user.png', 'Antonio', 'Antić', '4254666781524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.50, 1, 16),
(80, 'img/user.png', 'Boško', 'Balaban', '5254654755524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 5.00, 1, 16),

/* class_id=17 school_id=5 */
(81, 'img/user.png', 'Nikolina', 'Niki', '6254654443524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 2, 1, 17),
(82, 'img/user.png', 'Ivan', 'Marić', '7254654774524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 2.4, 1, 17),
(83, 'img/user.png', 'Josipa', 'Balaban', '8254656684524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.34, 1, 17),
(84, 'img/user.png', 'Antonio', 'Horvat', '9254633786524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4, 1, 17),
(85, 'img/user.png', 'Marija', 'Horvat', '1154654722524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.34, 1, 17),
/* class_id=18 school_id=5 */
(86, 'img/user.png', 'Adrijana', 'Bobić', '1254654782224', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.46, 1, 18),
(87, 'img/user.png', 'Andreja', 'Deka', '1354654733524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.44, 1, 18),
(88, 'img/user.png', 'Ivan', 'Deka', '1454656784124', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.76, 1, 18),
(89, 'img/user.png', 'Marko', 'Markić', '1554654834224', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.76, 1, 18),
(90, 'img/user.png', 'Hrvoje', 'Vojko', '1654654734324', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.56, 1, 18),
/* class_id=19 school_id=5 */
(91, 'img/user.png', 'Andrijan', 'Deka', '1754654734424', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.65, 1, 19),
(92, 'img/user.png', 'Ivan', 'Bobić', '1854654736524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.75, 1, 19),
(93, 'img/user.png', 'Hrvoje', 'Balaban', '1954658684624', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.57, 1, 19),
(94, 'img/user.png', 'Nikolina', 'Markić', '1214654664724', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.86, 1, 19),
(95, 'img/user.png', 'Msrijana', 'Marijanović', '1333654784824', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.76, 1, 19),
/* class_id=20 school_id=5 */
(96, 'img/user.png', 'Đuro', 'Đurić', '1234876784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.45, 1, 20),
(97, 'img/user.png', 'Pero', 'Perić', '1243454784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.67, 1, 20),
(98, 'img/user.png', 'Branko', 'Brankić', '1287654784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 4.65, 1, 20),
(99, 'img/user.png', 'Bosiljko', 'Horvat', '1264864784524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.87, 1, 20),
(100, 'img/user.png', 'Ana', 'Anić', '1274654788524', '3467457458', 'Vukovarska ulica 11', 2, 'mail@mail.com', 3.76, 1, 20);