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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script>
        var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
    </script>
</head>
<body>
    <script>

        var myStorage = localStorage;


        function CheckPass(){
            // Decrypt 
            myKey = "U2FsdGVkX19u1EskqGOn+p8MwoGOSYplw/VNKtZdMkbf2l5hOLpOXLhPWGw9EGnZFGJWUeQV4U0dWQAhd3ASKg==";

            var bytes  = CryptoJS.AES.decrypt(myKey, pass.value.toString());
            var privateToken = bytes.toString(CryptoJS.enc.Utf8);

            if(privateToken!=""){
                myStorage.setItem('token', privateToken);
                console.log(privateToken);
            }
        }    

        var dataJson = "";
        $.ajax({ 
        url: 'https://api.github.com/repos/neretin-trike/test_repo1/contents/7.txt',
        type: 'GET',
            }).done(function(response) {

            var filecontent = "Ещё одна проверка";
            var basecontent =  Base64.encode(filecontent);

            var commit = {
                message: "Мой коммит",
                commiter:{
                    name: "neretin-trike",
                    email: "hawktrike@gmail.com"
                },
                content: basecontent,
                sha: response.sha
            }
            dataJson = JSON.stringify(commit);

            UpdateFile();
        });
        
        function UpdateFile(){
            $.ajax({ 
            url: 'https://api.github.com/repos/neretin-trike/test_repo1/contents/7.txt',
            type: 'PUT',
                beforeSend: function(xhr) { 
                    xhr.setRequestHeader("Authorization", "token "+ myStorage.token); 
                },
                data: dataJson
                }).done(function(response) {
            console.log(response);
            });
        }

        // $.ajax({ 
        //     url: 'https://api.github.com/authorizations',
        //     type: 'POST',
        //     beforeSend: function(xhr) { 
        //         xhr.setRequestHeader("Authorization", "Basic " + btoa("neretin-trike:e2e4002544125")); 
        //     },
        //     data: '{"scopes":["repo"],"note":"create repo with ajax"}'
        // }).done(function(response) {
        //     console.log(response);
        // });



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
        <input type="text" id="pass">
        <button onclick="CheckPass()">Проверить пароль</button>
        <nav>
            <div class="special-tag"></div>
            <div class="favorite-tag"></div>
            <div class="resent-tag"></div>
            <div class="old-tag"></div>
        </nav>
        <svg fill="#1a1c30" aria-hidden="true" class="octicon" height="32" version="1.1" viewBox="0 0 16 16" width="32"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path></svg>
        <a href="https://github.com/neretin-trike/memory-list">Fork me on GitHub</a>
    </footer>
    <script src="js/main.js"></script>
</body>
</html>