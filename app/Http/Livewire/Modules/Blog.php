<?php

namespace App\Http\Livewire\Modules;

use App\Models\Post;
use App\Services\CacheKeys;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination,WithFileUploads;
    public $hideModal;
    public $header;
    public $title;
    public $body;
    public $tags;
    public $category;
    public $published;
    public $mode;
    public $categories;
    public $hidden;
    public $perPage = 3;
    public $image;
    public $image2;
    public $image3;
    public $firstImage;
    public $secondImage;
    public $thirdImage;
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'title'=>['required','string','unique:posts','max:255'],
        'body'=>['required','string'],
        'tags'=>['nullable'],
        'category'=>['required']
    ];



    public function OpenModal(int $mode = 0, int $id = null)
    {
        $this->resetErrorBag();
        $this->hideModal = false;
        if ($mode === 0){
            //Create mode
            $this->header = 'New Post';
            $this->mode = 0;
        }else{
            //update mode
            $this->header = 'Update Post';
            //find the post from the database
            $post = Post::find($id);
            $this->title = $post->title;
            $this->body = $post->body;
            $this->tags = $post->tags;
            $this->category = $post->postcategory_id;
            $this->published = $post->published;
            $this->hidden = $post->id;
            $this->mode = $mode;
            $this->firstImage = $post->image_1;
            $this->secondImage = $post->image_2;
            $this->thirdImage = $post->image_3;
        }
    }
    public function CloseModal()
    {
        $this->resetErrorBag();
        $this->reset(['title','tags','body','published','category','header','image','image2','image3']);
        $this->hideModal = true;
    }

    public function LoadMore()
    {
        $this->perPage = $this->perPage + 3;
    }

    public function SavePost()
    {

        $this->validate();
        $response = null;

        //get the input and remove excess white space from it
        $tag = preg_replace('/\s+/', ' ', $this->tags);

        $response = Post::create([
            'slug'=> Str::slug($this->title),
            'title' => $this->title,
            'body' => $this->body,
            'author' => 'Admin',
            'published' => $this->published,
            'postcategory_id' => $this->category,
            'tags' => $tag,
        ]);
        if ($response){
            $this->emit('success','Post created successfully');
            $this->CloseModal();
        }else{
            $this->emit('fail');
        }
    }

    public function UpdatePost()
    {
        $data = [
            'title' => $this->title,
            'body' => $this->body,
            'published' => $this->published,
            'postcategory_id' => $this->category,
        ];
        $rules = [
            'title'=>['required','string','max:255',Rule::unique('posts')->ignore($this->hidden)],
            'body'=>['required','string'],
            'tags'=>['nullable'],
        ];
        Validator::make($data,$rules,['title.required' => 'This cannot be left blank'])->validate();
        $response = null;

        //get the input and remove excess white space from it
        $tag = preg_replace('/\s+/', ' ', $this->tags);
        //fetch the post
        try {
            $post = Post::findOrFail($this->hidden);
          $response = $post->update([
                'slug'=> Str::slug($this->title),
                'title' => $this->title,
                'body' => $this->body,
                'published' => $this->published,
                'postcategory_id' => $this->category,
                'tags' => $tag,
            ]);
          if ($response){
              $this->emit('success','Post updated');
              $this->hideModal = true;
          }else{
              $this->emit('failure');
          }

        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('failure');
        }
        return back();
    }

    public function DeletePost($id)
    {
        try {
            $response = null;
            $post = Post::findOrFail($id);

            $response = $post->delete();
            if ($response){
                $this->emit('success','Post deleted');
            }else{
                $this->emit('failure','Unable to delete post');
            }
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('failure');
        }
        return back();
    }

    public function PublishPost(int $id, $mode)
    {
        /*
         * If mode === 1, then publish post
         * if mode === 0, then unpublish post
         */
        $post = Post::find($id);
        try {
            $post->update([
                'published'=> $mode
            ]);
            $this->emit('success',$mode === 1 ? 'Published Successfully' : 'Post Unpublished');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('failure');
        }
        return back();
    }

    private function CustomUpload($image,$column)
    {
        try {
            $post = Post::findOrFail($this->hidden);
            //upload the image
            $src = Cloudinary::upload($image->getRealPath(), [
                'folder'=>'blog',
                'transformation'=>[
                    'width'=> 1280,
                    'height'=> 600,
                    'crop'=>'fill'
                ]
            ])->getSecurePath();

            $response = null;
            $response = $post->update([
                $column => $src
            ]);
            if ($response){
                $this->emit('success','Image uploaded successfully');
                $this->hideModal = true;
            }else{
                $this->emit('failure');
            }
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('failure');
        }
    }

    public function SaveFile($columnName,$imageRank)
    {
        $this->validate(
            [
                "$columnName"=> ['required','max:1024','image']
            ],
            [
                "$columnName".'.image'=>'The image must be of type image',
                "$columnName".'.max' => 'The image must not exceed 1 mb'
            ]
            );
        if ($imageRank == 1){
            $this->CustomUpload($this->image,'image_1');
        }elseif ($imageRank == 2){
            $this->CustomUpload($this->image2,'image_2');
        }else{
            $this->CustomUpload($this->image3,'image_3');
        }
        return back();
    }

    public function mount()
    {
        $categories = Cache::remember(CacheKeys::POST_CATEGORY_CACHE, now()->addDays(30), function (){
           return \App\Models\Postcategory::get();
        });

        $this->fill([
            'hideModal' => true,
            'category' => $categories[0]['id'],
            'title'=> null,
            'tags' => null,
            'published' => 1,
            'body' => null,
            'categories' => $categories,
            'perPage' => 3,
            'mode' => 0
        ]);
    }


    public function render()
    {
        return view('livewire.modules.blog', [
            'posts'=> Post::paginate($this->perPage)
        ]);
    }
}
