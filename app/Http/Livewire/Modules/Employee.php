<?php

namespace App\Http\Livewire\Modules;

use App\Exports\ExportStaff;
use App\Imports\ImportStaffFromExcel;
use App\Models\User;
use App\Services\CacheKeys;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;


class Employee extends Component
{
    use WithPagination, WithFileUploads;

    public $hideModal;
    public $modalHeader;
    public $firstname;
    public $lastname;
    public $dob;
    public $mode;
    public $email;
    public $joinDate;
    public $phone;
    public $roles;
    public $role;
    public $hidden;
    public $password;
    public $showUpdatePasswordField;
    public $perPage = 5;
    public $file;


    protected $listeners = ['refresh'=> '$refresh'];
    protected $paginationTheme = 'bootstrap';


    protected function rules()
    {
        return [
            'firstname' => ['required','string','max:255'],
            'lastname' => ['required','string','max:255'],
            'email' => ['required','email','max:255',Rule::unique('users')->ignore($this->hidden)],
            'phone' => ['nullable','string','max:14'],
            'dob' => ['required','string'],
            'joinDate' => ['required','string',],
        ];
    }

    public function mount()
    {
        $roles = Cache::remember(CacheKeys::ROLE_CACHE, now()->addDays(30), function (){
            return Role::where('id','>',1)->get();
        });
        $this->fill([
            'hideModal' => true,
            'modalHeader' => 'Add new employee',
            'mode' => 0,
            'firstname' => null,
            'lastname' => null,
            'email' => null,
            'dob' => null,
            'joinDate' => null,
            'phone' => null,
            'roles' => $roles->except(1),
            'role' => null,
            'hidden' => null,
            'password' => null,
            'showUpdatePasswordField' => false,

        ]);
    }

    public function OpenModal(int $mode = 0, int $_id = null)
    {
        $this->resetErrorBag();
        $this->hideModal = false;
        $this->mode = 0;
        if ($mode == 1) {
            $this->mode = 1;
            $this->modalHeader = 'Update Employee Information';
            //fetch the employee whose information is to be updated
            $staff = User::find($_id);
            $this->firstname = $staff->firstname;
            $this->lastname = $staff->lastname;
            $this->email = $staff->email;
            $this->dob = $staff->dob;
            $this->joinDate = $staff->join_date;
            $this->phone = $staff->phone;
            $this->hidden = $_id;
            $this->role = $staff->roles->first()['id'] ?? null;
            $this->password = $staff->password_text;
            $this->showUpdatePasswordField = true;
        }
    }
    public function CloseModal()
    {
        $this->resetErrorBag();
        $this->reset([
            'firstname',
            'lastname',
            'email',
            'phone',
            'dob',
            'joinDate',
            'mode',
            'modalHeader'
        ]);
        $this->hideModal = true;
        $this->mount();
    }
    public function LoadMore()
    {
        $this->perPage = $this->perPage + 5;
    }


    public function BanUnbanEmployee(int $id, $mode)
    {
        try {
            $user = User::findOrFail($id);
            $user->update(['status' => (int) $mode]);
            $this->emit('success','Action successful');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('error','User Not Found');
        }
        return back();
    }

    public function Save()
    {
        $this->validate();
        $response = null;
        try {
            $user = User::create([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'phone' => $this->phone,
                'join_date' => $this->joinDate,
                'password' => Hash::make(generate_password()),
                'password_text' => generate_password(),
                'dob' => $this->dob
            ]);
            if ($user){
                //assign the chosen role to the user
                $user->assignRole($this->role);
                $response = $user->update([
                    'staff_identity' => build_staff_id($this->dob,$this->firstname,$this->lastname,$user->id)
                ]);
                if ($response){
                    $this->emit('success','User account set up successfully');
                }else{
                    $this->emit('error');
                }
                $this->CloseModal();
            }else{
                $this->emit('error');
            }
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            $this->emit('error');
        }
    }
    public function UpdateRecord()
    {
        $this->validate([
            'firstname' => ['required','string','max:255'],
            'lastname' => ['required','string','max:255'],
            'email' => ['required','email','max:255',Rule::unique('users')->ignore($this->hidden)],
            'phone' => ['nullable','string','max:14'],
            'dob' => ['nullable',],
            'joinDate' => ['nullable',],
            'password'=>['required','min:6']
        ]);
        $response = null;
        try {
            $user = User::findOrFail($this->hidden);
            $user->update([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'phone' => $this->phone,
                'join_date' => $this->joinDate,
                'password' => Hash::make($this->password),
                'password_text' => $this->password,
                'dob' => $this->dob
            ]);
            $user->assignRole($this->role);

            $response = $user->update([
                'staff_identity' => build_staff_id($this->dob,$this->firstname,$this->lastname,$user->id,1)
            ]);
            if ($response){
                $this->emit('success','User account updated');
                $this->CloseModal();
            }else{
                $this->emit('error','Something went wrong');
            }
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            $this->emit('error','Something went wrong');
        }
    }

    public function RemoveStaff(int $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            $this->emit('success','Staff removed successfully');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('error','User not found');
        }
    }
    public function ExportStaffData()
    {
        return Excel::download(new ExportStaff, 'staff-information.xlsx');
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => ['required','mimes:xlsx']
        ]);
        Excel::import(new ImportStaffFromExcel,$this->file->store('files'));
        $this->emit('success','Operation successful');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.modules.employee', [
            'employees'=> User::where('id', '>', 1)->paginate($this->perPage)
        ]);
    }
}
