<?php


namespace Model\Entities;


class StudentCardNumber
{
    use \Library\Shared;
    use \Library\Entity;


    public static function search($studentCardNumber = "", ?int $limit = 1): self|array|null
    {
        $result = [];
        foreach (['group'] as $var)
            if ($$var)
                $filters[$var] = $$var;
        $db = self::getDB();
        $studentCardNumber = $db->select(['studentCardNumber' => []]);
        if (!empty($filters))
            $studentCardNumber->where(['studentCardNumber' => $filters]);
        foreach ($studentCardNumber->many($limit) as $studentCardNumber) {
            $class = CLASS;
            $result[] = new $class($studentCardNumber['id'], $studentCardNumber['studentCardNumber'],);
        }
        return $limit == 1 ? ($result[0] ?? null) : $result;
    }

    public function save(): self
    {
        $db = $this->db;
        if (!$this->id) {
            $insert = [
                'studentCardNumber' => $this->studentCardNumber
            ];
            $this->id = $db->insert([
                'studentCardNumber' => $insert
            ])->run(true)->storage['inserted'];
        }

        if (!empty($this->_changed)) {
            $db->update('studentCardNumber', (array)$this->_changed)
                ->where(['studentCardNumber' => ['id' => $this->id]])
                ->run();
        }

        return $this;
    }

    /**
     * studentCardNumber constructor.
     * @param string|null $studentCardNumber
     */
    public function __construct(public int $id = 0, public ?string $studentCardNumber = null)
    {
        $this->db = $this->getDB();
    }

}