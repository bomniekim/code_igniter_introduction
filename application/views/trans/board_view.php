<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
</head>
<body>

    <h2>게시판</h2>

    <table style="border: 1px dotted black">
        <thead>
            <tr>
                <th>num</th>
                <th>name</th>
                <th>message</th>
            </tr>
        </thead>
        <tbody>
        <!-- 연관배열의 키값이 변수명이 됨 -->
        <?php foreach($rows as $row) : ?>
            <tr>
                <td><?=$row['num']?></td>
                <td><?=$row['name']?></td>
                <td><?=$row['msg']?></td>
            </tr>

        <?php endforeach ?>
         <!-- 중괄호 대신 이렇게 쓸 수 있음  -->
         
    </tbody>
    </table>

    <form action="http://localhost/code_igniter/Intro/insertBoard" method="post">
        <input type="text" name="name">
        <input type="text" name="msg">
        <input type="submit">
    </form>
   
</body>
</html>