<?php
class Condition extends Model {
    protected static $tableName = 'conditions';
    protected static $columns = [
        'id', 
        'name_condition',
        'color_condition'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_condition = mb_strtoupper($this->name_condition, 'UTF-8');
        $this->color_condition = $this->color_condition ? $this->color_condition : 'dark';
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_condition = mb_strtoupper($this->name_condition, 'UTF-8');
        $this->color_condition = $this->color_condition ? $this->color_condition : 'dark';
        return parent::update();
    }

    private function validate() {
        $errors = [];

        if(!$this->name_condition) {
            $errors['name_condition'] = 'Condição é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}