<?php

namespace SchoolBoard\Controllers;

use SchoolBoard\Models\Grade;
use SchoolBoard\Models\Student;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StudentController
 *
 * @package SchoolBoard\Controllers
 */
class StudentController
{

    /**
     * @var Student
     */
    private $studentModel;

    /**
     * @var Grade
     */
    private $gradeModel;

    /**
     * @var mixed
     */
    private $board;

    /**
     * @var array|mixed
     */
    private $student;

    /**
     * StudentController constructor.
     *
     * @param  array  $request
     */
    public function __construct(array $request)
    {
        $studentId = (int)$request['id'];
        $this->studentModel = new Student();
        $this->student = $this->studentModel->getStudent($studentId);
        if ($this->student) {
            $boardClassName = 'SchoolBoard\Boards\\' . $this->student['board'];
            $this->board = new $boardClassName();
            $this->gradeModel = new Grade();
            $this->student['grades'] = $this->gradeModel->getGradesOfStudent($this->student['id']);
        }
    }

    /**
     * @param  array  $request
     *
     * @return array
     */
    public function schoolBoard(array $request): array
    {
        if ($this->student) {
            $this->student['grades'] = $this->board->prepareGradesData($this->student['grades']);
            return $this->board->formatOutputData(
                [
                    'id' => $this->student['id'],
                    'name' => $this->student['name'],
                    'list_of_grades' => $this->student['grades'],
                    'average' => $this->board->calculateAverage($this->student['grades']),
                    'board' => strtoupper($this->student['board']),
                    'board_result' => $this->board->calculatePassOrFail($this->student['grades']),
                ]
            );
        }
        return [json_encode('Student Not Found!'), 'json', Response::HTTP_NOT_FOUND];
    }
}