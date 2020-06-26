<?php
class Manufacturer extends Model {
    protected static $tableName = 'manufacturers';
    protected static $columns = [
        'id', 
        'name_manufacturer'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->name_manufacturer = mb_strtoupper($this->name_manufacturer, 'UTF-8');
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->name_manufacturer = mb_strtoupper($this->name_manufacturer, 'UTF-8');
        return parent::update();
    }

    private function validate() {
        $errors = [];

        if(!$this->name_manufacturer
        ) {
            $errors['name_manufacturer'] = 'Fabricante é um campo abrigatório.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}