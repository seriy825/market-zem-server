<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AssignmentRepositoryInterface;

class AssignmentController extends Controller
{
    private AssignmentRepositoryInterface $assignmentRepository;
    public function __construct(AssignmentRepositoryInterface $assignmentRepository)
    {
        $this->assignmentRepository = $assignmentRepository;
    }
    public function index()
    {
        $assignments = $this->assignmentRepository->getAssignments();
        return response()->json($assignments,200);
    }
}
