<?

namespace SchoolBoard\Boards;

/**
 * Interface Board
 *
 * @package SchoolBoard\Boards
 */
interface Board
{
    public function calculateAverage(array $grades);

    public function calculatePassOrFail(array $grades);

    public function formatOutputData(array $data, $object = null);

    public function prepareGradesData(array $grades);
}
