DELETE FROM students;

DELIMITER $$

DROP PROCEDURE IF EXISTS insertStudents$$
CREATE PROCEDURE insertStudents()
BEGIN

    DECLARE students_counter INT DEFAULT 0;
    DECLARE count_of_students INT DEFAULT 0;
    DECLARE grades_counter INT DEFAULT 0;
    DECLARE count_of_grades INT DEFAULT 0;
    DECLARE student_new_id INT DEFAULT 0;
    DECLARE subject_name VARCHAR(255) DEFAULT '';
    DECLARE subjectExist VARCHAR(255) DEFAULT '';

    SET count_of_students = FLOOR(RAND()*100);

    WHILE students_counter <= count_of_students DO

        INSERT INTO `students` SET
            `name` = ELT(FLOOR(RAND()*10)+1, 'Alex', 'David', 'Steven', 'John' , 'Oliver' , 'William' , 'James' , 'Noah', 'Benjamin', 'Lucas'),
            `board` = ELT(FLOOR(RAND()*2)+1, 'CSM', 'CSMB');

        SET grades_counter = 0;
        SET count_of_grades = FLOOR(RAND()*4);
        SET student_new_id = LAST_INSERT_ID();

        WHILE grades_counter <= count_of_grades DO

            SET subject_name = ELT(FLOOR(RAND()*9)+1, 'Biology', 'Chemistry', 'Environmental Science', 'Maths', 'Physics', 'Human Biology', 'Psychology', 'Sport Science', 'Sociology');
            SET subjectExist = (SELECT `id` FROM `grades` WHERE `student_id` = student_new_id AND `subject` = subject_name);

            IF (subjectExist IS NULL) THEN

                INSERT INTO `grades` SET
                    `student_id` = student_new_id,
                    `subject` = subject_name,
                    `grade` = FLOOR(RAND()*12)+1;
                SET grades_counter = grades_counter + 1;

            END IF;

        END WHILE;

        SET students_counter = students_counter + 1;

    END WHILE;

END$$

DELIMITER ;

CALL insertStudents();
