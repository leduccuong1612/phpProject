<html>
    <header>
        <title>Get All Post</title>
    </header>
    <body>
        <h1> Manage </h1>
        <button><a href="manager/new">New Post</a></button>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Thumb</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th> 
            </tr>
            <tr>
            <?php foreach ($postsByPage as $item):  ?>
                <tr>
                    <td><?echo $item->id?></td>           
                    <td><img src="app/public/picture/<?php echo $item->image ?>" alt="" height="60" width="60"></td>
                    <td><?echo $item->title?></td>
                    <td><?echo $item->status?></td>
                    <td><a href="manager/post/<?php echo $item->id?>">Show </a>|
                    <a href="manager/edit/<?php echo $item->id?>">Edit</a>|
                    <a href="manager/delete/<?php echo $item->id?>">Delete</a></td>
                </tr>
            <?php endforeach ?>       
            </tr>
        </table>
        <? for ($page=1;$page<=$numberOfPages;$page++) {
            echo '<a href="index.php?page='.$page . '">' . $page . '</a> ';
        }
        ?>
    </body>
</html>