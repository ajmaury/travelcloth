<html>
   <body>
      <?php
         echo Form::open(array('url' => 'admin/showUploadFile','files'=>'true'));
         echo 'Select the file to upload.'; ?>
        <input type="file" name="image" multiple>
        <?php echo Form::submit('Upload File');
         echo Form::close();
      ?>
   </body>
</html>