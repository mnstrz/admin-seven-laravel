<div>
    <div class="row">
    	<div class="col-6 mx-auto">
    		<x-card :title="'Profile'">
    			<div class="d-flex flex-row justify-content-center mb-3">
    				<div class="image">
			          <img src="{{ $avatar_path }}" class="img-circle elevation-2" alt="User Image" width="100px">
			        </div>
    			</div>
    			@if($edit)
    			<x-table-simple :class="'table-striped'">
    				<tr>
    					<th>Username</th>
    					<td>{{ $username }}</td>
    				</tr>
    				<tr>
    					<th>Email</th>
    					<td>{{ $email }}</td>
    				</tr>
				</x-table-simple>
				<div class="d-flex flex-row justify-content-end mt-3">
					<div>
						<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="edit()">
							<span>Edit</span>
						</button>
					</div>
				</div>
    			@else
    			<form wire:submit.prevent="save">
				    {!! Form::uploadImage(
	                      [4,8],
	                      "Avatar",
	                      [
	                        "name" => "new_avatar",
	                        "color" => "info",
	                        "wire:model.lazy" => "new_avatar"
	                      ],
	                      [
	                      	"aspectRatio" => "1/1"
	                      ],
	                      $avatar_path
	                    ) 
				    !!}
				    {{ $this->this_filename('new_avatar') }}
	      			{!! Form::inputTextAppend(
	                      [4,8],
	                      "Username",
	                      [
	                        "name" => "username",
	                        "placeholder" => "Username",
	                        "color" => "info",
	                        "before" => "@",
	                        "wire:model.lazy" => "username"
	                      ]
	                    ) 
	      			!!}
	      			@error('username') <label class="badge badge-danger"> {{ $message }}</label>@enderror
	    			{!! Form::inputEmail(
	                      [4,8],
	                      "Email",
	                      [
	                        "name" => "email",
	                        "placeholder" => "Email",
	                        "wire:model.lazy" => "email"
	                      ]
	                    ) 
	      			!!}
	      			@error('email') <label class="badge badge-danger"> {{ $message }}</label>@enderror
	    			{!! Form::inputPassword(
	                      [4,8],
	                      "New Password",
	                      [
	                        "name" => "password",
	                        "placeholder" => "New Password",
	                        "wire:model.lazy" => "password"
	                      ],
	                      "Fill this if you wanna change your current password"
	                    ) 
	      			!!}
	      			@error('password') <label class="badge badge-danger"> {{ $message }}</label>@enderror
	    			{!! Form::inputPassword(
	                      [4,8],
	                      "New Password Confirmation",
	                      [
	                        "name" => "password",
	                        "placeholder" => "New Password Confirmation",
	                        "wire:model.lazy" => "password_confirmation"
	                      ]
	                    ) 
	      			!!}
	      			@if(!$password_match) 
	      				<label class="badge badge-danger">New Password Doesn't match</label>
	      			@endif
	      			@if($password)
	    			{!! Form::inputPassword(
	                      [4,8],
	                      "Current Password",
	                      [
	                        "name" => "current_password",
	                        "placeholder" => "Current Password",
	                        "wire:model.lazy" => "current_password"
	                      ]
	                    ) 
	      			!!}
	      			@endif
				</form>
				<div class="d-flex flex-row justify-content-end mt-3">
					<div>
						<button class="btn btn-sm btn-danger" wire:click="resetForm()">
							<span>Reset</span>
						</button>
						<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="save()">
							<span>Update</span>
						</button>
					</div>
				</div>
				@endif
    		</x-card>
    	</div>	
    </div>
    <script type="text/javascript">
    	window.addEventListener('show-message', event => {
    		console.log(event.detail.message);
	    	toastr.remove()
			showToast(event.detail.message.message,event.detail.message.variant)
		})
    </script>
</div>
