<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
interface TaskInterface
{
    public function getTop3Tasks($classId);
    public function getUnverifiedTasks();
    public function getAllUnverifiedTasks();
    public function getAllTasks($classId);
    public function uploadTaskFile(Request $request);
    public function downloadTaskFile(Request $request);
    public function uploadSolutionFile(Request $request);
    public function downloadSolutionFile(Request $request);


}
?>