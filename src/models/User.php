<?php

class User extends Model {
    protected static $tableName = 'users';
    protected static $columns = [
        'id',
        'name',
        'rank',
        'cadre',
        'email',
        'password',
        'is_admin'
    ];
    
    public function insert() {
        $this->validate();
        $this->id = null;
        $this->formatData();
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $user = User::getOne(['id' => $this->id]);
        if(!$this->password) {
            $this->password = $user->password;
        } else {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
        $this->name = mb_strtoupper($this->name, 'UTF-8');
        $this->email = strtolower($this->email);
        $this->is_admin = $this->is_admin ? 1 : 0;
        return parent::update();
    }

    private function validate() {
        $errors = [];
        $user = User::getOne(['id' => $this->id]);

        if($user) {
            if($this->password && !$this->confirm_password) {
                $errors['confirm_password'] = 'Confirmação de Senha é um campo abrigatório.';               
            }

            if(!$this->password && $this->confirm_password) {
                $errors['password'] = 'Senha é um campo abrigatório.';               
            }
            
            if($this->password && $this->confirm_password 
                && $this->password !== $this->confirm_password) {
                    $errors['password'] = 'As senhas não são iguais.';
                    $errors['confirm_password'] = 'As senhas não são iguais.';
            }
        }

        
        if(!$this->name) {
            $errors['name'] = 'Nome é um campo abrigatório.';
        }
        
        if(!$this->rank) {
            $errors['rank'] = 'Posto/Graduação é abrigatório.';
        }
        
        if(!$this->cadre) {
            $errors['cadre'] = 'Quadro/Especialidade é abrigatório.';
        }
        
        if(!$this->email) {
            $errors['email'] = 'Email é um campo abrigatório.';
        } elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email inválido.';
        }
            
        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

    private function formatData() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->name = mb_strtoupper($this->name, 'UTF-8');
        $this->email = strtolower($this->email);
        $this->is_admin = $this->is_admin ? 1 : 0;
    }
}