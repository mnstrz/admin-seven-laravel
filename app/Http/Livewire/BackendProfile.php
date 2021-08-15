<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Admin\AdminSevenFilename;
use App\User;

class BackendProfile extends Component
{
	use WithFileUploads,AdminSevenFilename;

	public $edit = false;
	public $id_user = null;
	public $username = null;
	public $email = null;
	public $password = null;
	public $avatar = null;
	public $avatar_path = null;
	public $password_confirmation = null;
	public $current_password = null;
	public $password_match = true;
	public $new_avatar = null;

	public function mount(){
		$this->getData();
	}

	public function getData(){

		$user = \Auth::guard('admin')->user();
		$this->id_user = $user->id;
		$this->username = $user->username;
		$this->email = $user->email;
		$this->avatar = null;
		$this->new_avatar = null;
		$this->avatar_path = ($user->avatar) ? \Storage::url($user->avatar) : '';
		$this->password = null;
		$this->current_password = null;
		$this->password_confirmation = null;
		$this->edit = false;
	}

	public function resetForm()
	{
		$this->getData();
	}

	public function updatedPasswordConfirmation(){
		if($this->password_confirmation != $this->password){
			$this->password_match = false;
		}else{
			$this->password_match = true;
		}
	}

	public function save()
	{
		$this->validate([
			'username' => 'required|unique:users,username,'.$this->id_user,
			'email' => 'required|unique:users,email,'.$this->id_user
		]);
		
		$user = User::where('id',$this->id_user)->first();

		# password
		if($this->password){

			$this->validate([
				'password' => 'required|confirmed|min:6'
			]);

			# check current password
			if(!Hash::check($this->current_password,$user->password)){
				$message = [
					"message" => "Current Password Doesn't match with out record",
					"variant" => "error"
				];
				$this->dispatchBrowserEvent('show-message',['message' => $message]);
				return $this;
			}

			# make new password
			$user->password = $this->password;
		}

		# avatar
		if($this->new_avatar){
        	$this->deleteAvatar($this->avatar,$user);
        	# get file extension
			$extension = explode('/', $this->new_avatar['type']);
			$extension = end($extension);

			# get image
			$image = $this->new_avatar['file'];
			$image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

			# set filename
			$filename = uniqid();

			# set path
			$path_file = 'public/avatar/'.$filename.".$extension";

			# store into storage
			\Storage::disk('local')->put($path_file, $image);
			$user->avatar = $path_file;
        }

		$user->username = $this->username;
		$user->email = $this->email;
		$user->save();

		$message = [
			"message" => "Profile Updated",
			"variant" => "success"
		];
		$this->dispatchBrowserEvent('show-message',['message' => $message]);
		$this->getData();
	}

	public function deleteAvatar($avatar,$user)
	{
		if(!is_string($avatar)){
			if(file_exists(\Storage::path($user->avatar))){
				\File::delete(\Storage::path($user->avatar));
			}
		}
	}

	public function edit()
	{
		$this->getData();
		$this->edit = true;
	}

    public function render()
    {
        return view('livewire.backend.profile');
    }
}
