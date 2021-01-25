<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait AdminSevenFormat{
	public function format_showImageList($path)
	{
		$paths = json_decode($path);
		if($paths){
			$path = $paths[0];
		}else{
			$path = $path;
		}
		if(file_exists(\Storage::path($path))){
			return \AdminSeven::makePathAsHtml($path,"img-fuild img-thumbnail","width='50px'");
		}
	}

	public function format_showFileList($path,$field,$selected_primary_key)
	{
		if($path == null){
			return '';
		}
		$html = "";
		$paths = json_decode($path);
		if($paths){
			foreach($paths as $key => $path){
				if(file_exists(\Storage::path($path))){
					$metafile = [
						"primary_key" => $this->primary_key,
						"selected_primary_key" => $selected_primary_key,
						"field" => $field,
						"model" => $this->model,
						"key" => $key
					];
					$metafile = json_encode($metafile);
					$metafile = base64_encode($metafile);
					$html .= "<a href=".url("backend/download/$metafile")." class='mr-1 ".\AdminSeven::colorSkin()."' data-tooltip=true data-original-title=Download><i class='fas fa-download'></i></a>";
				}
			}
		}else{
			if(file_exists(\Storage::path($path))){
				$metafile = [
					"primary_key" => $this->primary_key,
					"selected_primary_key" => $selected_primary_key,
					"field" => $field,
					"model" => $this->model
				];
				$metafile = json_encode($metafile);
				$metafile = base64_encode($metafile);
				$html .= "<a href=".url("backend/download/$metafile")." class='".\AdminSeven::colorSkin()."' data-tooltip=true data-original-title=Download><i class='fas fa-download'></i></a>";
			}
		}
		return $html;
	}

	public function format_Label($value,$variant)
	{
		$badge = "";
		if(is_array($value)){
			foreach($value as $val){
				$badge .="<label class='badge bg-$variant mr-1'>$val</label>";
			}
		}else{
			$badge = "<label class='badge bg-$variant'>$value</label>";
		}
		return $badge;
	}

	public function format_showImage($path)
	{
		$paths = json_decode($path);
		if($paths){
			$html = "";
			foreach($paths as $path){
				$html .= \AdminSeven::makePathAsHtml($path,"img-fuild img-thumbnail","width='100px'");
			}
			return $html;
		}else{
			return \AdminSeven::makePathAsHtml($path,"img-fuild img-thumbnail","width='100px'");
		}
	}

	public function format_showFile($path,$field)
	{
		if($path == null){
			return '';
		}
		$paths = json_decode($path);
		if($paths){
			$html = "";
			foreach($paths as $key => $path){
				if(file_exists(\Storage::path($path))){
					$metafile = [
						"primary_key" => $this->primary_key,
						"selected_primary_key" => $this->selected_primary_key,
						"field" => $field,
						"model" => $this->model,
						"key" => $key
					];
					$metafile = json_encode($metafile);
					$metafile = base64_encode($metafile);

					$html .= "<div class='container-float'><div class='float'>
								<a href='".url("backend/download/$metafile")."' class='btn btn-sm ".\AdminSeven::accentSkin()."'><i class='fas fa-download'></i></a>
								<button class='btn btn-sm btn-danger' wire:click=deleteFile('$key','$field')>
									<i class='fas fa-trash'></i>
								</button>
							</div>";
					$html .= \AdminSeven::makePathAsHtml($path,"img-fuild img-thumbnail","width='70%'");
					$html .= "</div>";
				}
			}
			$html .= "</div>";
			return $html;
		}else{
			if(file_exists(\Storage::path($path))){
				$metafile = [
					"primary_key" => $this->primary_key,
					"selected_primary_key" => $this->selected_primary_key,
					"field" => $field,
					"model" => $this->model
				];
				$metafile = json_encode($metafile);
				$metafile = base64_encode($metafile);

				if(file_exists(\Storage::path($path))){
					$html = "<div class='container-float'>
								<div class='float'>
									<a href='".url("backend/download/$metafile")."' class='btn btn-sm ".\AdminSeven::accentSkin()."'><i class='fas fa-download'></i></a>
									<button class='btn btn-sm btn-danger' wire:click=deleteFile(0,'$field')>
										<i class='fas fa-trash'></i>
									</button>
								</div>";
					$html .= \AdminSeven::makePathAsHtml($path,"img-fuild img-thumbnail","width='70%'");
					$html .= "</div>";
					return $html;
				}
			}
		}
	}
}