<?php
class Status extends Model {
    protected static $tableName = 'status';
    protected static $columns = [
        'id', 
        'name_status'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_status = mb_strtoupper($this->name_status, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_status = mb_strtoupper($this->name_status, 'UTF-8');
        return parent::update();
    }

    private function validate() {
        $errors = [];

        if(!$this->name_status
        ) {
            $errors['name_status'] = 'Status é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}