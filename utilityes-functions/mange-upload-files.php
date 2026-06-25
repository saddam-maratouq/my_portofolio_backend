
<?php 

#############  upload file Many directory functions ##############


/*
 * Upload file to primary directory AND copy to secondary 
*/

function uploadFileToDirectories( $uploadfileName ,  string $fileTargetPath , string $fileTargetCopy = ''  , string $formFileName ='upload_file' , string $filePrefix = 'uploadfile')  {

   global $finalFileName ; 

    if (! empty($uploadfileName)) {

    $tmpName = $_FILES[$formFileName]['tmp_name'];

     // Get file extension
    $fileExtension  = pathinfo($uploadfileName, PATHINFO_EXTENSION);

    // generate unique naming ...
    $fileName =  $filePrefix . '_' . uniqid() . '.' .  $fileExtension; // Ex: burger_65f8a2b3c4d5e.png

    $targetPath = $fileTargetPath  . $fileName;  // ex : "../../../upload-img/our-menu/burger/" . file_name 
		
    $targetPathCopy = $fileTargetCopy . $fileName ;
    
    // Move uploaded file to target folder on pc 
    if (! move_uploaded_file($tmpName , $targetPath)) {
    
      header("Location: ?upload_error=1");
      exit();
    }

    
      // ✅ COPY the originals  files to sec all files path  (not move again!) 
        if (!copy($targetPath, $targetPathCopy)) {
            $error = error_get_last();
            $errorMessage = isset($error['message']) ? $error['message'] : 'Unknown error';
            error_log("copy error: " . $errorMessage);
            header("Location: ?upload_error=all-files-upload-err&error_detail=" . urlencode($errorMessage));
            exit();
        }

  }

  $finalFileName  = $fileName ?? null;

}



/*
 * delete file from primary and sec =>  Dir 
 *   update  Upload file to primary directory AND copy to secondary directory 
*/
function updateUploadFileToDirectories( $uploadFileName , $existFile , $formFileName , $prefix  , $targetFileDirectory , $copiedFileDirectory  )  {
	
  global $updateUploadFileName ;

  
  if (!empty($uploadFileName) && $existFile !=  $uploadFileName) {

    $tmpName  = $_FILES[$formFileName]['tmp_name'];
    

    // Get file extension
    $fileExtension  = pathinfo( $uploadFileName, PATHINFO_EXTENSION);

    // generate unique naming ...
    $fileName =  $prefix .'_' . uniqid() . '.' .  $fileExtension; // Ex: burger_65f8a2b3c4d5e.png
  
    $targetPath = $targetFileDirectory . $fileName;

    $filePath = $targetFileDirectory ; 

   $targetPathCopy = $copiedFileDirectory  . $fileName ; // new directory target  for  paste  from primary file directory  // 

    // Delete old one 
    if ( $existFile && file_exists($filePath . $existFile )   ) {

      unlink($filePath . $existFile);
    }

     // Delete old sec file on sec directory .. 
    if ( $existFile && file_exists($copiedFileDirectory . $existFile )) {
      unlink($copiedFileDirectory . $existFile);
    }


    
    // Move uploaded file
    if (! move_uploaded_file($tmpName, $targetPath)) {
      header("Location: ?upload_error=1");
      exit();
    }


    // copy new upload file 
      if (! copy($targetPath,  $targetPathCopy  )) {
      header("Location: ?copy_err=1");
      exit();
    }


  } else {
    $fileName =  $existFile ;
  }

# get file naming after update process ...
 $updateUploadFileName =  $fileName ?? null;

}

######################################################################## 





#############  upload file Single  directory functions ##############

/*
 * Upload file to single directory 
*/

function uploadFile( $uploadfileName ,  string $fileTargetPath ,    string $formFileName ='upload_file' , string $filePrefix = 'uploadfile')  {

   global $finalFileName ; 

    if (! empty($uploadfileName)) {

    $tmpName = $_FILES[$formFileName]['tmp_name'];

     // Get file extension
    $fileExtension  = pathinfo($uploadfileName, PATHINFO_EXTENSION);

    // generate unique naming ...
    $fileName =  $filePrefix . '_' . uniqid() . '.' .  $fileExtension; // Ex: burger_65f8a2b3c4d5e.png

    $targetPath = $fileTargetPath  . $fileName;  // ex : "../../../upload-img/our-menu/burger/" . file_name 
		

    
    // Move uploaded file to target folder on pc 
    if (! move_uploaded_file($tmpName , $targetPath)) {
    
      header("Location: ?upload_error=1");
      exit();
    }



  }

  $finalFileName  = $fileName ?? null;

}
 



/*
 * delete file first then 
 *  update Upload file to single directory 
*/

function updateUploadfile( $uploadFileName , $existFile , $formFileName , $prefix  , $targetFileDirectory )  {
	
  global $updateUploadFileName ;

  
  if (!empty($uploadFileName) && $existFile !=  $uploadFileName) {

    $tmpName  = $_FILES[$formFileName]['tmp_name'];
    

    // Get file extension
    $fileExtension  = pathinfo( $uploadFileName, PATHINFO_EXTENSION);

    // generate unique naming ...
    $fileName =  $prefix .'_' . uniqid() . '.' .  $fileExtension; // Ex: burger_65f8a2b3c4d5e.png
  
    $targetPath = $targetFileDirectory . $fileName;

    $filePath = $targetFileDirectory ; 

    // Delete old one 
    if ( $existFile && file_exists($filePath . $existFile )   ) {

      unlink($filePath . $existFile);
    }



    // Move uploaded file
    if (! move_uploaded_file($tmpName, $targetPath)) {
      header("Location: ?upload_error=1");
      exit();
    }

  } else {
    $fileName =  $existFile ;
  }

# get file naming after update process ...
 $updateUploadFileName =  $fileName ?? null;

}


#####################################################################


