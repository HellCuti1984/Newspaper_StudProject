<?php 

namespace App\Libraries;

use File;
	
class TrickyClass
{
	
	//ДОБАВИЛ В Illuminate\Support\Facades\File
	public static function deleteFileInStorageFolder($folderPath)
	{
		if(File::exists('storage/'.$foledPath)) 
		{
			File::delete('storage/'.$foledPath);
		}
	}
}
	
?>