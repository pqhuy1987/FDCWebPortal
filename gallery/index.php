<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a href="#">GALLERY HÌNH ẢNH CÔNG TY</a>
        </div>
       
        <div class="clear"></div>
     </div>
</div> 

<?php
    // Include the UberGallery class
    include('resources/UberGallery.php');
?>
<?php
	//-----------------------------------------------------------------------------//
        $files = scandir('upload/tintuc/', 1);
        foreach ($files as $file):
            
            $dir = 'upload/tintuc/' . $file;
             if (is_dir($dir) && $file != '.' && $file != '..'): 
?>
                <h3 class="tlq"><div class="col2"><a href="#"><?php echo ucwords($file); ?></a></div></h3>
                <?php
				{
					 $gallery = UberGallery::init()->createGallery($dir);
				}
				 ?>
            <?php endif; ?>
            
        <?php endforeach; 

   //-----------------------------------------------------------------------------//

    // Define theme path
    if (!defined('THEMEPATH')) {
        define('THEMEPATH', $gallery->getThemePath());
    }

    // Set path to theme index
    $themeIndex = $gallery->getThemePath(true) . '/index.php';

    // Initialize the theme
    if (file_exists($themeIndex)) {
        include($themeIndex);
    } else {
        die('ERROR: Failed to initialize theme');
    }
?>
