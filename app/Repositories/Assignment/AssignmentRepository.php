<?php

namespace App\Repositories\Assignment;

use App\Interfaces\AssignmentRepositoryInterface;
use App\Models\Assignment;
use App\Models\City;

class AssignmentRepository implements AssignmentRepositoryInterface
{
    public function getAssignments(){
        return Assignment::get();
    }
}
