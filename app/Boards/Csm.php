<?php

namespace SchoolBoard\Boards;

/**
 * Class Csm
 *
 * @package SchoolBoard\Boards
 */
class Csm implements Board
{

    /**
     * @param  array  $grades
     *
     * @return string
     */
    public function calculateAverage(array $grades): string
    {
        return number_format(array_sum($grades) / count($grades), 2);
    }

    /**
     * @param  array  $grades
     *
     * @return string
     */
    public function calculatePassOrFail(array $grades): string
    {
        return $this->calculateAverage($grades) >= 7 ? 'Pass' : 'Fail';
    }

    /**
     * @param  array       $data
     * @param  mixed|null  $object
     *
     * @return array
     */
    public function formatOutputData(array $data, $object = null): array
    {
        return [json_encode($data), 'json'];
    }

    /**
     * @param  array  $grades
     *
     * @return array
     */
    public function prepareGradesData(array $grades): array
    {
        asort($grades);
        return $grades;
    }
}