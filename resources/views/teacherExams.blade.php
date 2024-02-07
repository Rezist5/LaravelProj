@extends('layout')
@include('header')
@section('main_content')
<ul id="controlWorksList">
        <!-- Сюда будут добавляться контрольные работы динамически -->
    </ul>
    <button id="createControlWork">Создать новую контрольную работу</button>

    <!-- Модальное окно для создания новой контрольной работы -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Создать новую контрольную работу</h2>
            <form  action="{{ }}" method="POST">
                <label for="controlWorkName">Название контрольной работы:</label>
                <input type="text" id="controlWorkName" name="controlWorkName">
                <label for="duration">Длительность(в часах):</label>
                <input type="text" id="duration" name="duration">
                <button type="submit">Создать</button>
            </form>
        </div>
    </div>

    <script>

        const createModal = document.getElementById('createModal');
        const createControlWorkButton = document.getElementById('createControlWork');
        const closeModal = document.querySelector('.close');

        createControlWorkButton.addEventListener('click', () => {
            createModal.style.display = 'block';
        });

        closeModal.addEventListener('click', () => {
            createModal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === createModal) {
                createModal.style.display = 'none';
            }
        });

        // Добавить обработчик для формы создания новой контрольной работы
        const createControlWorkForm = document.getElementById('createControlWorkForm');
        createControlWorkForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const controlWorkNameInput = document.getElementById('controlWorkName');
            const controlWorkName = controlWorkNameInput.value.trim();
            if (controlWorkName !== '') {

                // Отправить данные на сервер для сохранения
                // В реальном приложении эти данные будут отправляться на сервер
                // и после успешного сохранения контрольной работы, она будет добавлена в список.
                // Здесь мы просто создаем новый элемент списка на клиенте для демонстрации.
                
                controlWorkNameInput.value = '';
                createModal.style.display = 'none';
            } else {
                alert('Введите название контрольной работы.');
            }
        });

    </script>
@endsection