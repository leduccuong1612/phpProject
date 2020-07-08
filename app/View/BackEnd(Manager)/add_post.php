This is add post
<button><a href="/phpExercise/project1">Back</a></button>
<form action="?controller=manager&method=create" method="POST" enctype="multipart/form-data">	            			
    <label>Title:</label>
    <input type="text" name="title">
    <br>
    <label>Description:</label>
    <textarea name="description" rows="5"></textarea>
    <br>
    <label>Status:</label>
    <select name="status">
        <option value="1">Disable</option>
        <option value="2">Enable</option>
    </select>				    
    <br>
    <label>Image:</label>
    <input type="file" name="image" id="image" value="" >
    <br>
    <button type="submit" name="btnSubmit">Submit</button>
</form>