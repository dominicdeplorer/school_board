<?php

namespace SchoolBoard\Boards;

/**
 * Class Csmb
 *
 * @package SchoolBoard\Boards
 */
class Csmb implements Board
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
        return max($grades) > 8 ? 'Pass' : 'Fail';
    }

    /**
     * @param  array       $data
     * @param  mixed|null  $object
     *
     * @return array
     */
    public function formatOutputData(array $data, $object = null): array
    {
        if (is_null($object)) {
            $object = new \SimpleXMLElement('<student/>');
        }
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $new_object = $object->addChild($key);
                $this->formatOutputData($value, $new_object);
            } else {
                if ($key != 0 && $key == (int)$key) {
                    $key = "key_$key";
                }
                $object->addChild(str_replace(' ', '', $key), $value);
            }
        }
        return [$object->asXML(), 'xml'];
    }

    /**
     * @param  array  $grades
     *
     * @return array
     */
    public function prepareGradesData(array $grades): array
    {
        asort($grades);
        if (count($grades) > 2) {
            $grades = array_slice($grades, -2, 2);
        }
        return $grades;
    }
}