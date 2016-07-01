<html>
    <head>
        <script>
            var xhr = new XMLHttpRequest();
            function xhr_post() {
                xhr.open('POST', 'sql_ang.php?action=xhr_post', true);
                ajax_hit(xhr,'POST');
            }

            function xhr_get() {
                xhr.open('GET', 'sql_ang.php?action=xhr_get', true);
                ajax_hit(xhr,'GET');

            }
            function ajax_hit(xhr,type) {
                xhr.onreadystatechange = function () {
                    if (this.readyState !== 4)
                        return;
                    if (this.status !== 200)
                        return; // or whatever error handling you want
                    document.getElementById('y').innerHTML = this.responseText;
                };
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var data="";
                if(type=="POST"){
                    data="post data hit";
                }
                xhr.send(data);

            }



        </script>
    </head>
    <body>
        <div id="y"></div>
        <input type="button" onclick="xhr_get()" value="xhr GET ajax click">
        <input type="button" onclick="xhr_post()"value="xhr POST ajax click">

    </body>


</html>