<h1>Создание своей MVC</h1>
<p>
    <h3>Список требований для использования</h3>
    <ol>
        <li> Имена таблиц в БД должен быть в нижнем регистре,
             разделенный нижним подчеркиванием.
        </li>
    </ol>
    <h3>Особенности работы с БД</h3>
    <ol>
        <li>
            Каждой таблице в БД надо создать свою МОДЕЛЬ "МОДЕЛЬ"_"Имя_Таблицы".
            Родительский клас для них лежит в папке с ядром название mysql.php
        </li>
        <li>
            Выборка из БД происходит только если отправлен параметр $select в конструктор класса.
        </li>
        <li>
            <div>$select - массив, где ключ - это ключ для работ с sql запросомЮ (WHERE, ORDER, GROUP, LIMIT ).Значение ключа это уже условие.
            Надо дополнить другими операторами, на данный момент их мало.</div>
        </li>
        <li>
            <div>
                <h3>Получение записей из бд</h3>
            
                <h4>Получение нескольких строк из таблицы:</h4>
                <div>
                    <p>
                        // создаем запрос
                        $select = array(<br>
                            'where' => 'id >= 1 AND id <= 5', // условие<br>
                            'group' => 'first_name', // группируем<br>
                            'order' => 'id DESC', // сортируем<br>
                            'limit' => 10 // задаем лимит<br>
                        );
                        $model = new Model_Users($select); // создаем объект модели<br>
                        $usersInfo = $model->getAllRows(); // получаем все строки<br>
                        var_dump($usersInfo); // выводим данные<br>
                    </p>
                </div>
                <h4>Получение одной строки из таблицы:</h4>
                <div>
                    <p>
                        $select = array(<br>
                            'where' => 'id = 2'<br>
                        );<br>
                        $model = new Model_Users($select);<br>
                        $usersInfo = $model->getOneRow();<br>
                        var_dump($usersInfo);<br>
                    </p>
                </div>
                <h4>Помимо получения строк, мы можем получать значения конкретных столбцов:</h4>
                <div>
                    <p>
                        // запрос<br>
                        $select = array(<br>
                            'where' => 'id = 2'<br>
                        );<br>
                        $model = new Model_Users($select);<br> 
                        $model->fetchOne(); // извлекаем данные<br>
                        // получаем значения столбцов<br>
                        $firstName = $model->first_name;<br>
                        $lastName = $model->last_name;<br>
                        // выводим<br>
                        var_dump($firstName);<br>
                        var_dump($lastName);<br>
                    </p>
                </div>
                <h3>Создание записи в бд</h3>
                <h4>Также просто, как и получать, мы можем и записывать данные:</h4>
                <div>
                    <p>
                        // создаем объект<br>
                        $model = new Model_Users();<br>
                        // задаем значения для полей таблицы<br>
                        $model->id = 10; // id можно и пропустить, если для этого поля настроен авто инкремент <br>
                        $model->first_name = 'Иван';<br>
                        $model->last_name = 'Иванов';<br>
                        $result = $model->save(); // создаем запись<br>
                        var_dump($result); // проверяем результат:  true или false<br>
                    </p>
                </div>
                <h3>Обновление записи в бд</h3>
                <h4>Обновление записей в таблице тоже не составит проблем, выглядеть это будет так:</h4>
                <div>
                    <p>
                        // запрос<br>
                        $select = array(<br>
                            'where' => 'id = 10'<br>
                        );<br>
                        // модель<br>
                        $model = new Model_Users($select);<br>
                        // извлекаем данные<br>
                        $model->fetchOne(); <br>
                        // задаем новые значения<br>
                        $model->first_name = 'Петр';<br>
                        $model->last_name = 'Петров';<br>
                        // обновляем запись<br>
                        $result = $model->update();<br>
                        var_dump($result); // проверяем результат:  true или false<br>
                    </p>
                </div>
                <h3>Удаление записи в бд</h3>
                <h4>И последнее элементарное действие с базой данных – удаление записей.</h4>
                <div>
                    <p>
                        // модель<br>
                        $model = new Model_Users();<br>
                        // условие удаления<br>
                        $select = array(<br>
                            'where' => 'id > 10'<br>
                        );<br>
                        // удаляем<br>
                        $result = $model->deleteBySelect($select);<br>
                        var_dump($result); // проверяем результат. Вернется количество удаленных строк<br>
                    </p>
                </div>
            
                <h4>И еще один доступный вариант удаления, для одной записи:</h4>
                <div>
                    <p>
                        // запрос<br>
                        $select = array(<br>
                            'where' => 'id = 10'<br>
                        );<br>
                        // модель<br>
                        $model = new Model_Users($select);<br>
                        // извлекаем данные<br>
                        $model->fetchOne();<br>
                        // удаляем строку<br>
                        $result = $model->deleteRow();<br>
                        var_dump($result);<br>
                    </p>
                </div>
            </div>
        </li>
    </ol>
</p>