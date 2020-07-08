<html>
<header>
    <title>Post</title>
</header>
<body>
    <?php foreach ($post as $item):  ?>
        <h1><?php echo $item->title ?></h1>
        <button><a href="/phpExercise/project1/guest">Back</a></button>
        <table border=1>
            <tr>
                <th> Picture</th>
                <th> Description </th>
            </tr>

                <tr>
                    <td><img src="app/public/picture/<?php echo $item->image ?>" alt=""></td>
                    <td><?php echo $item->description?></td>
                </tr>
        </table>
    <?php endforeach ?>
</body>
</html>