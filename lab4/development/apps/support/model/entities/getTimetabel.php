<?php


namespace Model\Entities;


class GetTimetable
{
    use \Library\Shared;
    use \Library\Entity;


    public static function search($group = "", ?int $limit = 1): self|array|null
    {
        $result = [];
        foreach (['group'] as $var)
            if ($$var)
                $filters[$var] = $$var;
        $db = self::getDB();
        $getTimetable = $db->select(['Timetable' => []]);
        if (!empty($filters))
            $getTimetable->where(['Timetable' => $filters]);
        foreach ($getTimetable->many($limit) as $getTimetable) {
            $class = CLASS;
            $result[] = new $class($getTimetable['id'], $getTimetable['group'],);
        }
        return $limit == 1 ? ($result[0] ?? null) : $result;
    }

    public function save(): self
    {
        $db = $this->db;
        if (!$this->id) {
            $insert = [
                'group' => $this->group
            ];
            $this->id = $db->insert([
                'Timetable' => $insert
            ])->run(true)->storage['inserted'];
        }

        if (!empty($this->_changed)) {
            $db->update('Timetable', (array)$this->_changed)
                ->where(['Timetable' => ['id' => $this->id]])
                ->run();
        }

        return $this;
    }

    /**
     * GetTimetable constructor.
     * @param string|null $group
     */
    public function __construct(public int $id = 0, public ?string $group = null)
    {
        $this->db = $this->getDB();
    }

}