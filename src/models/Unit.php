<?php
class Unit extends Model {
    protected static $tableName = 'units';
    protected static $columns = [
        'id', 
        'name_unit',
        'initials_unit',
        'chief_id'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_unit = mb_strtoupper($this->name_unit, 'UTF-8');
        $this->initials = mb_strtoupper($this->initials, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_unit = mb_strtoupper($this->name_unit, 'UTF-8');
        $this->initials = mb_strtoupper($this->initials, 'UTF-8');
        return parent::update();
    }

    private function validate() {
        $errors = [];

        if(!$this->name_unit) {
            $errors['name_unit'] = 'Nome é um campo abrigatório.';
        }

        if(!$this->initials_unit) {
            $errors['initials_unit'] = 'Sigla é um campo abrigatório.';
        }

        if(!$this->chief_id) {
            $errors['chief_id'] = 'Comandante é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

}