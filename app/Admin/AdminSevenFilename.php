<?php

namespace App\Admin;

trait AdminSevenFilename
{
    public function this_filename($states)
    {
    	$file = data_get($this,$states);
        $filename = null;
        if(is_array($file)){
            $filename = count($file)." Files ready to submit";
        }else{
            if($file){
                $filename = $file->getClientOriginalName();
            }
        }
        $response = [
            'filename' => $filename,
            'state' => $states,
            'file' => $file
        ];
        return view('components.filename',$response);
    }
}
