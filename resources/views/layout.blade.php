<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Diary</title>
    
    <style>
        body,
h1,
h2,
h3,
h4,
h5,
h6,
p,
ol,
ul {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    color: #333;
}

/* Header styles */
header {
    background-color: #f0f0f0;
    padding: 10px 20px;
    text-align: center;
}

/* Navigation styles */
nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 0 10px;
}

/* Section styles */
section {
    padding: 20px;
    margin: 20px 0;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th,
table td {
    border: 1px solid #ccc;
    padding: 8px;
}

/* News slider styles */
.news-slider {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.news-slider img {
    width: 100%;
    height: auto;
    display: block;
}

/* Carousel styles */
.carousel {
    position: relative;
}

.carousel-inner {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel-inner .carousel-item {
    display: none;
    position: relative;
}

.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 50%;
    z-index: 5;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    transform: translateY(-50%);
    transition: background-color 0.3s ease;
}
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

section {
    margin-bottom: 30px;
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 15px;
    color: #333;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type='text'],
input[type='password'],
input[type='number'],
textarea,
select,
button {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

input[type='file'] {
    margin-bottom: 10px;
}

/* Responsive styles */
@media (min-width: 768px) {
    main {
        width: 80%;
        margin: auto;
    }
}

/* Styles for specific sections */
.createLessons table {
    width: 100%;
}

.createLessons table th,
.createLessons table td {
    padding: 8px;
    text-align: center;
}

.createLessons table th {
    background-color: #f0f0f0;
}

.CreateNews input[type='text'],
.CreateNews textarea {
    width: calc(100% - 20px);
}

.CreateNews label {
    margin-top: 10px;
}

.SubjectCreate,
.ClassCreate,
.UserCreate {
    max-width: 400px;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background-color: rgba(255, 255, 255, 0.8);
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 20px;
    height: 20px;
    fill: #333;
}

.visually-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}
.task-item {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
}

.task-actions {
    margin-top: 10px;
}

.task-actions form {
    display: inline-block;
    margin-right: 10px;
}

.error-message {
    color: red;
    margin-top: 10px;
}
    </style>
    <!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z8r3+J24BR3E3R+Q6OvvkLXIUnzrEAiKK1cSkJ" crossorigin="anonymous">
</head>
<body>
    

    @yield('main_content')
    <footer>
        <p>&copy; 2023 School Diary</p>
    </footer>
</body>
</html>