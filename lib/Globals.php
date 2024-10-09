<?php

/*
|--------------------------------------------------------------------------
| Pre Load Directory Files
|--------------------------------------------------------------------------
| This function is used to load all files in a given directory
| and its subdirectories into the application recursively.
| 
*/
function load_dir_files($directory) {
	if(is_dir($directory)){

		$scan = scandir($directory); unset($scan[0], $scan[1]);
		foreach($scan as $file) :

			if(is_dir($directory."/".$file)):
                load_dir_files($directory."/".$file);
                else: if(strpos($file, '.php') !== false) { require_once($directory."/".$file); }
			endif;

		endforeach;

    }

}

/*
|--------------------------------------------------------------------------
| Delete Directory and its contents
|--------------------------------------------------------------------------
| This function is used to delete a directory and its contents
| 
*/
function delete_dir($dirPath) {
    if (is_dir($dirPath)) {
        $files = scandir($dirPath);
        foreach ($files as $file) {
           if ($file !== '.' && $file !== '..') {
              $filePath = $dirPath . '/' . $file;
              if (is_dir($filePath)) {
                    delete_dir($filePath);
              } else {
                 unlink($filePath);
              }
           }
        }
        rmdir($dirPath);
     }
}

/*
|--------------------------------------------------------------------------
| Require Multiple Files
|--------------------------------------------------------------------------
| This function is used to require multiple files at once
| 
*/

function require_files(){
    foreach(func_get_args() as $file){
        require_once($file);
    }
}


/*
|--------------------------------------------------------------------------
| Substring
|--------------------------------------------------------------------------
|
| This function is used to get a substring from a string.
|
*/
function substring($string, $length, $end = '...'){

    if(strlen($string) > $length)
        return substr($string, 0, $length) . $end;

    return $string;

}

/*
|--------------------------------------------------------------------------
|  CSRF Token
|--------------------------------------------------------------------------
|
| This function is used to get the CSRF token.
|
*/
if(!function_exists('csrf_token')){

    function csrf_token(){
        return \Leaf\Anchor\CSRF::token();
    }

}

/*
|--------------------------------------------------------------------------
|  CSRF Field
|--------------------------------------------------------------------------
|
| This function is used to generate a CSRF token field.
|
*/
if(!function_exists('csrf_field')){

    function csrf_field(){
        return '<input type="hidden" name="_token" value="'.csrf_token().'">';
    }

}

/*
|--------------------------------------------------------------------------
|  CSRF Document Meta
|--------------------------------------------------------------------------
|
| This function is used to generate a CSRF token meta tag.
|
*/
if(!function_exists('csrf_meta')){

    function csrf_meta(){
        return '<meta name="csrf-token" content="'.csrf_token().'">';
    }

}

/*
|--------------------------------------------------------------------------
|  Carbon
|--------------------------------------------------------------------------
|
| This function is used to get the Carbon instance.
|
*/
if(!function_exists('carbon')){

    function carbon(){
        return \Carbon\Carbon::class;
    }

}

/*
|--------------------------------------------------------------------------
|  Carbon Now
|--------------------------------------------------------------------------
|
| This function is used to get the current time in Carbon format.
|
*/
if(!function_exists('now')){

    function now(){
        return \Carbon\Carbon::now();
    }

}

function active($key, $value){
    return $key == $value ? 'active' : '';
}

/*
|--------------------------------------------------------------------------
|  Slugify
|--------------------------------------------------------------------------
|
| This function is used to slugify a string.
|
*/
if(!function_exists('slugify')){

    function slugify($string){
        
        $string = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return strtolower(trim($string, '-'));

    }
}

/*
|--------------------------------------------------------------------------
|  Public Storage Path
|--------------------------------------------------------------------------
|
| This function is used to get the public storage path.
|
| TODO: This function is here for future compatibility when there are
| multiple storage engines. For now, it just returns the
| public path.
|
*/
function urlPath($file, $engine = 'local'){

    if(strpos($file, '/assets/') === 0) return $file;
    if(strpos($file, '/storage/') === 0) return $file;

    return '/storage/' . trim($file, '/');
    
}

/*
|--------------------------------------------------------------------------
| Data (array|object) to XML (xml_encode)
|--------------------------------------------------------------------------
|
| This function is used to convert an array or object to XML.
|
*/
if(!function_exists('xml_encode')){

    function xml_encode($data, $rootNodeName = 'data', $xml = null) {
        if ($xml === null) {
            $xml = new SimpleXMLElement("<?xml version='1.0' encoding='utf-8'?><$rootNodeName></$rootNodeName>");
        }
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                xml_encode($value, $key, $xml->addChild($key));
            } else {
                $xml->addChild($key, $value);
            }
        }
        return $xml->asXML();
    }

}