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
.grade-block {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
}

.grade-green {
    background-color: #4CAF50; /* Зелёный цвет */
    color: white;
}

.grade-orange {
    background-color: #FFA500; /* Оранжевый цвет */
    color: white;
}

.grade-red {
    background-color: #FF0000; /* Красный цвет */
    color: white;
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
    display: block !important;
    position: relative;
}

.carousel-control-prev,
.carousel-control-next {
    position: relative;
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
.grade-container {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

.grade-item {
        flex: 0 0 auto;
        padding: 0 5px; /* Add some padding to separate grades */
        box-sizing: border-box;
    }
    
.grade-block {
    width: 100px;  /* Задайте ширину квадрата оценки по вашему усмотрению */
    height: 100px; /* Задайте высоту квадрата оценки по вашему усмотрению */
    margin-right: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
}

.grade-block-markonly {
    display: inline-block;
    width: 50px;  /* Задайте ширину квадрата оценки по вашему усмотрению */
    height: 50px; /* Задайте высоту квадрата оценки по вашему усмотрению */
    margin-right: 10px;
    align-items: center;
    justify-content: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
}
.grade-green {
    background-color: #4CAF50; /* Зелёный цвет */
    color: white;
}

.grade-orange {
    background-color: #FFA500; /* Оранжевый цвет */
    color: white;
}

.grade-red {
    background-color: #FF0000; /* Красный цвет */
    color: white;
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
body {
    background-color: #f8f8f8;
    color: #333;
}

/* Заголовки */
h1, h2, h3, h4, h5, h6 {
    color: #3366cc; /* Синий цвет */
}

/* Ссылки */
a {
    color: #3366cc; /* Синий цвет */
}

a:hover {
    color: #004080; /* Темно-синий цвет при наведении */
}

/* Фон секции */
section {
    background-color: #ffffff; /* Белый цвет */
}

/* Тень блока секции */
section {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Таблицы */
table th, table td {
    border: 1px solid #3366cc; /* Синий цвет */
}

table th {
    background-color: #f0f0f0;
}

/* Кнопки */
button {
    background-color: #3366cc; /* Синий цвет */
    color: #ffffff; /* Белый цвет текста */
}

button:hover {
    background-color: #004080; /* Темно-синий цвет при наведении */
}

/* Стиль для задачи */
.task-item {
    border-color: #3366cc; /* Синий цвет рамки задачи */
}

/* Ошибка */
.error-message {
    color: red;
    margin-top: 10px;
}
.message-container {
            display: flex;
            flex-direction: column;
            max-width: 300px;
            margin: 10px;
        }

        .user-message {
            align-self: flex-end;
            background-color: #4CAF50;
            color: white;
            border-radius: 10px 10px 0 10px;
            padding: 10px;
            margin-bottom: 5px;
        }

        .other-user-message {
            align-self: flex-start;
            background-color: #ddd;
            border-radius: 10px 10px 10px 0;
            padding: 10px;
            margin-bottom: 5px;
        }
        body {
  margin: 0;
  font-family: Arial, sans-serif;
}
.news-image {
         /* Изображение займет 100% ширины родительского контейнера */
  height: auto; /* Высота будет автоматически рассчитана для сохранения соотношения сторон */
  max-width: 400px; /* Максимальная ширина изображения, чтобы избежать растягивания */
  display: block; /* Убедитесь, что изображение не имеет отступа снизу */
  margin: 0 auto; /* Центрирование изображения внутри родительского контейнера */
}
.news-slider-container {
  width: 100%; /* Занимает всю ширину родительского контейнера */
  overflow: hidden;
  height: 400px; /* Задайте фиксированную высоту, чтобы показывать только одну новость сразу */
  position: relative;
}

.news-slider {
  display: flex;
  flex-direction: column;
  transition: transform 0.5s ease;
  height: 100%; /* Занимает 100% высоты контейнера */
}

.news {
  box-sizing: border-box;
  padding: 20px;
  border-bottom: 1px solid #ccc;
}

/* Прокрутка новостей при hover */
.news-slider-container:hover .news-slider {
  transform: translateY(-100%);
}

/* Настройка стилей для изображения и других элементов по мере необходимости */
.news img {
  max-width: 100%;
  height: auto;
}
    </style>

    <!-- CSS Bootstrap link -->

<!-- JS Bootstrap link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<!-- CSS Bootstrap link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<!-- JS Bootstrap links (Popper.js and Bootstrap JS) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-Qr4qcr5FhLQDy/8uR8LhFVovWy++L8BvNX1I7/Z8E+mcNFlcTz6mGgyd91b2v2MR" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    

    @yield('main_content')
    <footer>
        <p>&copy; 2023 School Diary</p>
    </footer>
</body>
</html>