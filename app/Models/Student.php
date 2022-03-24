<?php

namespace SchoolBoard\Models;

/**
 * Class Student
 *
 * @package SchoolBoard\Models
 */
class Student extends BaseModel
{
    /**
     * @param $studentId
     *
     * @return array|mixed
     */
    public function getStudent($studentId)
    {
        $query = $this->connection->prepare(
        '
            SELECT * FROM `students` WHERE id = :studentId
        '
        );
        $query->execute(['studentId' => $studentId]);
        $student = $query->fetch(\PDO::FETCH_ASSOC);
        if ($student) {
            $student = $this->prepareBoardName($student);
        }
        return $student;
    }

    /**
     * @param $student
     *
     * @return array
     */
    private function prepareBoardName($student): array
    {
        $student['board'] = ucfirst(strtolower($student['board']));

        return $student;
    }
}