<html>
<header>
    <title>List All Post</title>
</header>
<body>
    <h1>Guest</h1>
    <table border=1>
        <tr>
            <th> ID </th>
            <th> NAME </th>
            <th> FULL_NAME </th>
            <th> image </th>
        </tr>
        <?php foreach ($postsByPage as $item):  ?>
            <tr>
                <td><a href="guest/post/<?php echo $item->id?>"><?echo $item->id?></a></td>
                <td><?echo $item->title?></td>
                <td><?echo $item->description?></td>
                <td><img src="app/public/picture/<?php echo $item->image ?>" alt=""></td>
            </tr>
        <?php endforeach ?>
    </table>
    <? for ($page=1;$page<=$numberOfPages;$page++) {
            echo '<a href="?page='.$page . '">' . $page . '</a> ';
        }
    ?>
</body>
</html>