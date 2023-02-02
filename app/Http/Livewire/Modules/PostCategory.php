<?php

namespace App\Http\Livewire\Modules;

use App\Services\CacheKeys;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PostCategory extends Component
{
    public $hideModal,$name,$categories,$_id,$updateMode;

    protected $rules = [
        'name'=>['required','unique:postcategories','max:100']
    ];

    public function OpenCreateModal()
    {
        $this->hideModal = false;
        $this->resetErrorBag();
    }

    public function mount()
    {
        $categories = Cache::remember(CacheKeys::POST_CATEGORY_CACHE, now()->addDays(30), function (){
            return \App\Models\Postcategory::get();
        });
        $this->fill([
            'hideModal' => true,
            'name' => null,
            'categories' => $categories,
            '_id' => null,
            'updateMode' => false
        ]);
    }
    public function render()
    {
        return view('livewire.modules.post-category');
    }

    public function SaveNewCategory()
    {
        $this->validate();
        $response = \App\Models\Postcategory::create(['name'=>$this->name]);

        if ($response){
            $this->emit('success');
            $this->reset(['name']);
            $this->refresh();
        }else{
            $this->emit('failure');
        }
        return back();
    }
    public function LaunchEditModal(int $id, string $name)
    {
        $this->_id = $id;
        $this->name = $name;
        $this->hideModal = false;
        $this->updateMode = true;
        $this->resetErrorBag();
    }
    public function UpdateCategory()
    {
        $this->validate([
            'name' => ['required',Rule::unique('postcategories')->ignore($this->_id),'max:100']
        ]);
        try {
            $category = \App\Models\Postcategory::findOrFail($this->_id);
           $response = $category->update([
                'name'=>$this->name
            ]);
           if ($response){
               $this->emit('success');
               $this->refresh();
           }else{
               $this->emit('failure');
           }
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('failure');
        }
    }
    public function DeleteCategory(int $id)
    {
        try {
            $category = \App\Models\Postcategory::findOrFail($id);
            $response = $category->delete();
            if ($response){
                $this->emit('success');
                $this->refresh();
            }else{
                $this->emit('failure');
                return back();
            }
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('failure');
        }
    }
    public function refresh()
    {
        $this->mount();
        $this->render();
    }
}
