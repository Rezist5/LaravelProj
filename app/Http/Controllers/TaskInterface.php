<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
interface TaskInterface
{

    // Get the top 3 tasks for a student
    public function getTop3Tasks($classId);

    // Get unverified tasks for a teacher
    public function getUnverifiedTasks();

    // Get all unverified tasks for a teacher
    public function getAllUnverifiedTasks();

    // Get all tasks for a given class
    public function getAllTasks($classId);

    // Upload task file by teachers
    public function uploadTaskFile(Request $request);

    // Download task file
    public function downloadTaskFile(Request $request);

    // Upload solution file by students
    public function uploadSolutionFile(Request $request);

    // Download solution file
    public function downloadSolutionFile(Request $request);
}