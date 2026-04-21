<?php
namespace App\Models\adminModel;
use CodeIgniter\Model;

class GetEmployeeModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'first_name',
        'last_name',
        'username',
        'password_hash',
        'role_id'
    ];
}