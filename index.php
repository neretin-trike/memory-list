<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#1a1c30" />
    <title>MEMORY LIST</title>
    <link rel="stylesheet" href="libs/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="libs/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.6/SmoothScroll.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
</head>
<body>
    <script>
        var arr = [
            {"name": "Вася", "age": 20},
            {"name": "Петя", "age": 22},
            {"name": "Таня", "age": 18}
            ];

        function CreateNewFile(){
            $.ajax({
                url: 'data.php',
                type: 'POST',
                data: {myJson: JSON.stringify(arr), fileName: 'js/new_file.json'},
            });
        }    


        // var filename = "firstfile.txt";
        // var filemessage = "uploading a file";
        // var filecontent = "The data of the file."
        // var basecontent = btoa(filecontent);
        // var apiurl = contents_url.replace('{+path}',filename);
        // var filedata = '{"message":"'+filemessage+'","content":"'+basecontent+'"}';

        // $.ajax({ 
        //     url: apiurl,
        //     type: 'PUT',
        //     beforeSend: function(xhr) { 
        //         xhr.setRequestHeader("Authorization", "token TOKEN-FROM-PREVIOUS-CALL"); 
        //     },
        //     data: filedata
        // }).done(function(response) {
        //     console.log(response);
        // });

        $.ajax({ 
        url: 'https://api.github.com/repos/neretin-trike/test_repo1/contents/6.txt',
        type: 'PUT',
            beforeSend: function(xhr) { 
                xhr.setRequestHeader("Authorization", "token f50f37f4e837d8f06201cead71a7259dfeb72793"); 
            },
            data: '{ "message": "My commit message", "committer": { "name": "Mike A", "email": "someemail@gmail.com" }, "content": "0J3QtdGD0LbRgtC+INC30LDRgNCw0LHQvtGC0LDQu9C+", "sha":"27c91a075c2efffbf40738200e983825e3e5b6c3"}'
            }).done(function(response) {
        console.log(response);
        });


    </script>
        <?php

            // РАБОТАЕТ ЧЕРЕЗ КОНСОЛЬ curl -i -H 'Authorization: token 88fc079801737f85dda005b1e868f4831bed1cad' -d '{"name": "test_repo1", "message": "Initial Commit", "committer": {"name": "neretin-trike", "email": "hawktrike@gmail.com"}, "content": "bXkgbmV3IGZpbGUgY29udGVudHM=", "note":"Test Commit"}' https://api.github.com/user/repos

            // curl -i -X PUT -H 'Authorization: token 88fc079801737f85dda005b1e868f4831bed1cad' -d '{
            //     "message": "English",
            //     "committer": {
            //       "name": "Mike A",
            //       "email": "someemail@gmail.com"
            //     },
            //     "content": "0JAg0YLQtdC/0LXRgNGMINCy0L7RgiDRjdGC0L4=",
            //     "sha": "e6011912c7231c4a028dd58999337f4189efc1e8"
            //   }' https://api.github.com/repos/neretin-trike/test_repo1/contents/5.txt

            // curl -i -X PUT -H 'Authorization: token f94ce61613d5613a23770b324521b63d202d5645' -d '{"path": "test4.txt", "message": "Создал файл через curl", "committer": {"name": "neretin-trike", "email": "hawktrike@gmail.com"}, "content": "bXkgbmV3IGZpbGUgY29udGVudHM=", "branch": "master"}' https://api.github.com/repos/InViN-test/test_repo1/contents/test4.txt
        ?>
    <div class="wrapper">
    </div>
    <footer>
        <button onclick="CreateNewFile()">Создать новый файл</button>
        <nav>
            <div class="special-tag"></div>
            <div class="favorite-tag"></div>
            <div class="resent-tag"></div>
            <div class="old-tag"></div>
        </nav>
        <svg fill="#1a1c30" aria-hidden="true" class="octicon" height="32" version="1.1" viewBox="0 0 16 16" width="32"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path></svg>
        <a href="https://github.com/neretin-trike/memory-list">Fork me on GitHub</a>
    </footer>
    <!-- <script src="js/main.js"></script> -->
</body>
</html>