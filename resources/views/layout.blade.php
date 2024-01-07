<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Diary</title>
    
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}
table {
    border-collapse: collapse;
    width: 100%;
}

table, th, td {
    border: 1px solid #ccc;
}
table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
th, td {
    padding: 8px;
    text-align: left;
}
header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

header h1 {
    margin: 0;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

main {
    max-width: 1200px;
    margin: 20px auto;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(2, 1fr);
}

section {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
}

input[type="text"],
input[type="date"],
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 12px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}
.carousel {
    width: 300px;
    margin: 20px auto;
    overflow: hidden;
    position: relative;
}

.carousel .slide {
    width: 300px;
    height: 100px;
    line-height: 100px;
    text-align: center;
    background: #f4f4f4;
    border: 1px solid #ccc;
    position: absolute;
    left: 0;
    transition: all 0.3s ease;
}

    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z8r3+J24BR3E3R+Q6OvvkLXIUnzrEAiKK1cSkJ" crossorigin="anonymous">
</head>
<body>
    
    <header>
        <h1>School Diary</h1> 
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Выйти из аккаунта</button>
        </form>
        <nav>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="lessons">Расписание</a></li>
                <li><a href="myClass">Мой класс</a></li>
                <li><a href="homework">Домашние задания</a></li>
            </ul>
        </nav>
    </header>
    @yield('main_content')
    <footer>
        <p>&copy; 2023 School Diary</p>
    </footer>
</body>
</html>