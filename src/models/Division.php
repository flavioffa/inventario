<?php
class Division extends Model {
    protected static $tableName = 'divisions';
    protected static $columns = [
        'id', 
        'name_division',
        'initials_division',
        'chief_division_id',
        'division_unit_id'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_division = mb_strtoupper($this->name_division, 'UTF-8');
        $this->initials_division = mb_strtoupper($this->initials_division, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_division = mb_strtoupper($this->name_division, 'UTF-8');
        $this->initials_division = mb_strtoupper($this->initials_division, 'UTF-8');
        return parent::update();
    }

    private function validate() {
        $errors = [];

        if(!$this->name_division) {
            $errors['name_division'] = 'Nome é um campo abrigatório.';
        }

        if(!$this->initials_division) {
            $errors['initials_division'] = 'Sigla é um campo abrigatório.';
        }

        if(!$this->chief_division_id) {
            $errors['chief_division_id'] = 'Chefe é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

}