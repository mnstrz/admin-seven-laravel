<?php

namespace App\Http\Livewire\Creator;

use Livewire\Component;
use App\Models\AdminSevenCrudModel;
use App\Admin\AdminSevenPaginate;

class AdminSevenCreator extends Component
{
	use AdminSevenPaginate;

	public $results = [];
	public $keyword = null;
	public $selected_id = null;
	protected $listeners = ['confirmDelete','cancelDelete'];

	public function mount()
	{
		\AdminSeven::backendGate('authorize','creator');
		$this->getData();
	}

	public function reloadPage()
	{
		$this->getData();
	}

	public function getData()
	{
		$results = AdminSevenCrudModel::with('thisUser')
									->paginate($this->per_page,['*'],"page",$this->page)
									->toArray();
		$this->results = $results['data'];
	}

	public function delete($id){
		$this->selected_id = $id;
		$this->dispatchBrowserEvent('confirm-delete');
	}

	public function confirmDelete(){
		$data = AdminSevenCrudModel::where('id',$this->selected_id)->first();
		if(!$data){
			abort('404');
		}
		$data->delete();
		$this->page = 1;
		$this->getData();
	}

	public function cancelDelete(){
		$this->selected_id = null;
	}

    public function render()
    {
        return view('livewire.backend.creator.list');
    }
}
