<?php

namespace SchoolBoard\Models;

/**
 * Class Grade
 *
 * @package SchoolBoard\Models
 */
class Grade extends BaseModel
{
    /**
     * @param $studentId
     *
     * @return array
     */
    public function getGradesOfStudent($studentId): array
    {
        $query = $this->connection->prepare(
        '
            SELECT `subject`, `grade` FROM `grades` WHERE `student_id` = :studentId
        '
        );
        $query->execute(['studentId' => $studentId]);
        return $query->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}