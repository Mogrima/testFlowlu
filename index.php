<?php
require_once("./connects.php");

$sql = 'SELECT * FROM `brack` ORDER BY `id` DESC LIMIT 3';
$query = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        .hide {
            display: none;
        }
    </style>
</head>

<body>
    <h1 class="text-center mt-3">Проверка правильной расстановки скобок</h1>
    <div class="container mt-5">
        <div class="row g-3 mb-3">
            <div class="col">
                <label for="exampleFormControlTextarea1" class="form-label">Введите текст</label>
                <input class="brack-input form-control form-control-lg mb-4" id="exampleFormControlTextarea1"
                    type="text" placeholder="< a * ( 4 / 7 - [ 2 - 2] / { 11 } ) >" required>
                <div class="alert hide" role="alert">

                </div>
                <a href="index.php" class="link btn btn-primary">Отправить</a>
            </div>
            <div class="col">
                <h3 class="text-muted">Последние проверки:</h3>
                <div class="list-group">


                    <?php
        while($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Success: <?=$row->result?></h5>
                        </div>
                        <p class="mb-1"><?=$row->input?></p>
                    </div>
                    <?php }
        ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        const input = document.querySelector('.brack-input');
        const link = document.querySelector('.link');
        const alert = document.querySelector('.alert');
        const listBlock = document.querySelector('.list-group');

        link.addEventListener("click", (event) => {
            event.preventDefault();
            let inputText = input.value;
            if (input.value == "") {
                getAlert("alert-success", "alert-danger", "Нельзя отправлять пустое поле!")
            } else {
                submitBrack(input.value);
            }
        })

        function getAlert(dltClass, addClass, text) {
            alert.classList.remove("hide");
                if (alert.classList.contains(dltClass)) {
                        alert.classList.remove(dltClass);
                    }
                    alert.classList.add(addClass);
                    alert.innerText = text;
        }

        function submitBrack(str) {
            const request = new XMLHttpRequest();
            const url = "brackates.php?str=" + str;

            request.open('GET', url);

            request.setRequestHeader('Content-Type', 'application/x-www-form-url');

            request.addEventListener("readystatechange", () => {

                if (request.readyState === 4 && request.status === 200) {

                    console.log(request.responseText);
                    let answer = JSON.parse(request.responseText);
                    if (answer.success == true) {
                        getAlert("alert-danger", "alert-success", "Скобки расставлены правильно!");
                    } else {
                        getAlert("alert-success", "alert-danger", "Скобки расставлены неправильно!");
                    }
                    insertItem(str, answer.success);
                   
                }
            });
            input.value = "";
            request.send();
        }

        function insertItem(text, res) {
            let elem = document.createElement("div");
                elem.setAttribute("class", "list-group-item list-group-item-action");
                elem.innerHTML = `
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Success: ${res}</h5>
                    </div>
                    <p class="mb-1">${text}</p>
                `;
                listBlock.lastChild.remove();
                listBlock.insertBefore(elem, listBlock.firstChild);
        }
    </script>
</body>

</html>