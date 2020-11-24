<?php 
    //system upload
    $file_max_weight = 8388608; // membatasi ukuran file 200000 = 200kb, disini 8,3 mb
    $ok_ext = array('jpg','png','gif','jpeg'); // ekstensi file
    $destination = 'uploads/'; // folder untuk menyimpan filenya
    // PHP sets a global variable $_FILES['file'] which containes all information on the file
    // The $_FILES['file'] is also an array, so to have the file name we're supposed to write $_FILES['file']['name']
    // To shorten that I added the following line. With that I could just do $file['name']
    $file = $_FILES['file'];
    $filename = explode(".", $file["name"]); 
    $file_name = $file['name']; // file original name
    $file_name_no_ext = isset($filename[0]) ? $filename[0] : null; // File name without the extension
    $file_extension = $filename[count($filename)-1];
    $file_weight = $file['size'];
    $file_type = $file['type'];

    // If there is no error
    if( $file['error'] == 0 ){
        // mengecek apakah extensi file sama dengaan keinginan
        if( in_array($file_extension, $ok_ext)):
            // mengecek ukuran file
            if( $file_weight <= $file_max_weight ):
                    // mengubah nama file, dan di encript dengan md5
                    $fileNewName = md5( $file_name_no_ext[0].microtime() ).'.'.$file_extension ;
                    // and move it to the destination folder
                    if( move_uploaded_file($file['tmp_name'], $destination.$fileNewName) ):
                        echo "File berhasil di Upload";
                        echo "<br><br><br><img src=\"uploads/$fileNewName\"/>";
                    else:
                        echo "Upload Gagal";
                    endif;
            else:
               $error4="File terlalu besar";
            endif;
        else:
            $error3="Extensi file tidak didukung";
        endif;
    }
    //*system upload
?>

