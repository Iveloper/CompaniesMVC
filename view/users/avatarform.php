<form method="POST" action="/getAvatar" enctype="multipart/form-data">
    
    <input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
    <label for="avatar">Choose your avatar:</label>
    <div style="margin-left: 545px; padding: 11px;">
    <input type="FILE" name="avatar">
    </div>
    <input type="submit" name="avatarsub" value="Upload">
    
</form>