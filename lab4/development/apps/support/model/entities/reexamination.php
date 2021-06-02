<?php


namespace Model\Entities;


class Reexamination extends General
{

    public $lecturer;
    public $discipline;

    public function __construct(public int $id = 0, public ?string $studentId = null, public ?string $firstName = null, public ?string $lastName = null, public ?string $group = null, public ?string $lecturer = null, public ?string $discipline = null)
    {
        parent::__construct($id,$studentId,$firstName,$lastName,$group);
        $this->lecturer = $lecturer;
        $this->discipline = $discipline;
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
                'lecturer' => $this->lecturer
                'discipline' => $this->discipline

            ];
            $this->id = $db->insert([
                'Reexamination' => $insert
            ])->run(true)->storage['inserted'];
        }

        if (!empty($this->_changed)) {
            $db->update('Reexamination', (array)$this->_changed)
                ->where(['Reexamination' => ['id' => $this->id]])
                ->run();
        }

        return $this;
    }

}