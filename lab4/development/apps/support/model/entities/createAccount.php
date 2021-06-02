<?php


namespace Model\Entities;


class CreateAccount extends General
{

    public function __construct(public int $id = 0, public ?string $studentId = null, public ?string $firstName = null, public ?string $lastName = null, public ?string $group = null)
    {
        parent::__construct($id,$studentId,$firstName,$lastName,$group);
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
                'CreateAccount' => $insert
            ])->run(true)->storage['inserted'];
        }

        if (!empty($this->_changed)) {
            $db->update('CreateAccount', (array)$this->_changed)
                ->where(['CreateAccount' => ['id' => $this->id]])
                ->run();
        }

        return $this;
    }


}