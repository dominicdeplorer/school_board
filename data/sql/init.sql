CREATE TABLE `grades`
(
    `id`         int(11) NOT NULL,
    `student_id` int(11) NOT NULL,
    `subject`    varchar(255) NOT NULL,
    `grade`      int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `students`
(
    `id`    int(11) NOT NULL,
    `name`  varchar(255) NOT NULL,
    `board` varchar(4)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `grades`
    ADD PRIMARY KEY (`id`),
  ADD KEY `grades_student_id_foreign` (`student_id`);

ALTER TABLE `students`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `grades`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `students`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `grades`
    ADD CONSTRAINT `grades_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;