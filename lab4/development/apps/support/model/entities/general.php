<?php


namespace Model\Entities;


class General
{
    use \Library\Shared;
    use \Library\Entity;


    public static function search(?int $studentId = 0, ?string $firstName = "", ?string $lastName = "", ?string $group = "", ?int $limit = 1): self|array|null
    {
        $result = [];
        foreach (['studentId', 'firstName', 'lastName', 'group'] as $var)
            if ($$var)
                $filters[$var] = $$var;
        $db = self::getDB();
        $generals = $db->select(['Generals' => []]);
        if (!empty($filters))
            $generals->where(['Generals' => $filters]);
        foreach ($generals->many($limit) as $generals) {
            $class = CLASS;
            $result[] = new $class($generals['id'], $generals['studentId'], $generals['firstName'], $generals['lastName'], $generals['group'],);
        }
        return $limit == 1 ? ($result[0] ?? null) : $result;
    }

    public function save(): self
    {
        $db = $this->db;
        if (!$this->id) {
            $insert = [
                'studentId' => $this->studentId,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'group' => $this->group
            ];
            $this->id = $db->insert([
                'Generals' => $insert
            ])->run(true)->storage['inserted'];
        }

        if (!empty($this->_changed)) {
            $db->update('Generals', (array)$this->_changed)
                ->where(['Generals' => ['id' => $this->id]])
                ->run();
        }

        return $this;
    }

    /**
     * General constructor.
     * @param int $id
     * @param int $studentId
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $group
     */
    public function __construct(public int $id = 0, public ?string $studentId = null, public ?string $firstName = null, public ?string $lastName = null, public ?string $group = null)
    {
        $this->db = $this->getDB();
    }

}