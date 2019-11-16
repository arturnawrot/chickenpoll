<?php
namespace App\Repositories\Contracts;


interface RoleRepositoryInterface extends RepositoryInterface {
    // Returns owners of a specific rank
    public function showUsers($rank);

    // Returns how many users have a specific rank
    public function countUsers($rank);
}