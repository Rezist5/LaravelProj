@extends('layout')
<h2>Create Task</h2>

<form action="{{ route('add.task') }}" method="post" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="lessonId" value="{{ $lesson->id }}">
    <input type="hidden" name="classId" value="{{ $lesson->classId }}">

    <div>
        <label for="taskFilePath">Task File Path:</label>
        <input type="file" id="taskFilePath" name="taskFilePath" required>
    </div>
    <div>
        <label for="deadline">Deadline:</label>
        <input type="date" id="deadline" name="deadline" required>
    </div>
    <div>
        <button type="submit">Create Task</button>
    </div>
</form>