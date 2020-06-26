<?php
class Part extends Model {
    protected static $tableName = 'parts';
    protected static $columns = [
        'id', 
        'name_part',
        'division_id'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_part = mb_strtoupper($this->name_part, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_part = mb_strtoupper($this->name_part, 'UTF-8');
        return parent::update();
    }

    private function validate() {
        $errors = [];

        if(!$this->name_part) {
            $errors['name_part'] = 'Nome é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}