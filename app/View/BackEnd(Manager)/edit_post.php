this is edit post
<button><a href="/phpExercise/project1">Back</a></button>
<form action="?controller=manager&method=update" method="POST" enctype="multipart/form-data">	
    <?php foreach ($post as $item):  ?>      
        <input type="hidden" name="id" value="<?echo $item->id ?>">    			
        <label>Title:</label>
        <input type="text" name="title" value="<?echo $item->title ?>">
        <br>
        <label>Description:</label>
        <textarea name="description" rows="5"><?echo $item->description ?></textarea>
        <br>
        <label>Status:</label>
        <select name="status">
            <option value="1"  <? ($item->status === 1) ? print('Selected') : '' ?>>Disable</option>
            <option value="2"  <? ($item->status === 2) ? print('Selected') : '' ?>>Enable</option>
        </select>				    
        <br>
        <label>Image:</label>
        <input type="file" name="image" id="image">
        <? 
        
        ?>
        <br>
        <button type="submit" name="btnUpdate">Submit</button>
    <?php endforeach ?>  
</form>