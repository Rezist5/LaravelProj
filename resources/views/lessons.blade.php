@extends('layout')

@section('main_content')
<div>
    <h1>Lesson Schedule</h1>
    <!-- Calendar to select date -->
    <input type="date" id="lessonDate">

    <!-- Table to display lessons -->
    <div id="lessonTable">
        <!-- Rendered lesson table will appear here -->
    </div>
</div>

<script>
    function getLessonsByDate() {
        const selectedDate = document.getElementById('lessonDate').value;

        fetch(`/getLessonsByDate/${selectedDate}`)
            .then(response => response.json())
            .then(data => renderLessonTable(data))
            .catch(error => console.error('Error:', error));
    }

    function renderLessonTable(lessons) {

        let tableContent = '<table>';
    
    // Sort lessons by LessonNumber for sequential display
    lessons.sort((a, b) => a.LessonNumber - b.LessonNumber);
    
    // Loop through lessons to build table rows
    lessons.forEach(function(lesson) {
        tableContent += '<tr>';
        // Populate table cells with lesson information
        tableContent += `<td>Date: ${lesson.LessonDate}</td>`;
        tableContent += `<td>Lesson Number: ${lesson.LessonNumber}</td>`;
        tableContent += `<td>Classroom: ${lesson.classroom}</td>`;
        tableContent += `<td>Teacher: ${lesson.teacher}</td>`; // Assuming you fetch the teacher's name
        // Add other necessary cells and data
        
        tableContent += '</tr>';
    });

    // Add empty slots for teachers to add new lessons
    // For instance, add an empty slot for each lesson number
    for (let i = 1; i <= totalLessonSlots; i++) {
        const isLessonPresent = lessons.some(lesson => lesson.LessonNumber === i);
        if (!isLessonPresent) {
            tableContent += `<tr><td colspan="4">Empty slot for Lesson ${i}</td></tr>`;
            // You can add form fields/buttons here to create a new lesson on this slot
        }
    }

    tableContent += '</table>';        
    document.getElementById('lessonTable').innerHTML = tableContent;
    }

    document.getElementById('lessonDate').addEventListener('change', getLessonsByDate);
    getLessonsByDate(); 
</script>
@endsection
