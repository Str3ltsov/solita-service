<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSkillsRequest;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\LogActivity;
use App\Models\SpecialistOccupation;
use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\forSelector;
use App\Traits\SkillServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Flash;
use Response;

class CustomerController extends AppBaseController
{
    use forSelector, SkillServices;

    /** @var CustomerRepository $customerRepository */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @return Response
     */
    public function index()
    {
        return view('customers.index')
            ->with('customers', $this->customerRepository->all());
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return Response
     */
    public function create()
    {
        return view('customers.create')
            ->with(['roles_list'=> $this->rolesForSelector(),
                'status_list' => $this->userStatusForSelector(),
                'exp_list' => $this->experienceSelector(),
                ]);
    }

    public function createUser( Request $request, $id, $newUser = true ) {
        $request->validate(User::$rules);

//        if (empty($request['new_password']) OR ($request['new_password'] != $request['new_password_confirmation'] )) {
//            Flash::error(__("messages.passwordmismatch"));
//
//            return redirect()->back()->withInput()->withErrors([__("messages.passwordmismatch")]);
//        }

        if ( $newUser ) {
            $user = new User();
            if (empty($request['new_password']) OR ($request['new_password'] != $request['new_password_confirmation'] )) {
                Flash::error(__("messages.passwordmismatch"));

                return redirect()->back()->withInput()->withErrors([__("messages.passwordmismatch")]);
            }

        }
        else {
            $user = $this->customerRepository->find($id);
            if (empty($user)) {
                Flash::error('Customer not found');

                return redirect(route('customers.index'));
            }

            if (!empty($request['new_password'])) {
                if ($request['new_password'] != $request['new_password_confirmation'] ) {
                    Flash::error(__("messages.passwordmismatch"));
                    return redirect()->back()->withInput()->withErrors([__("messages.passwordmismatch")]);
                }
            }

        }

        $user->name = $request->name;
        $user->email = $request->email;
        $request->new_password && $user->password = Hash::make($request->new_password);
        $user->type = $request->type;
        $user->street = $request->street;
        $user->house_flat = $request->house_flat;
        $user->post_index = $request->post_index;
        $user->city = $request->city;
        $user->phone_number = $request->phone_number;
        $user->work_info = $request->work_info ?? null;
        $user->hourly_price = $request->hourly_price ?? null;
        $user->status_id = $request->status_id;
        $user->experience_id = $request->experience_id ?? null;
        $user->save();

        SpecialistOccupation::firstOrCreate([
            'specialist_id' => $user->id,
            'percentage' => 0,
            'created_at' => now()
        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', __('messages.userupdated'));

//        Flash::success('Customer updated successfully.');
//
//        return redirect(route('customers.index'));
    }

    /**
     * Store a newly created Customer in storage.
     *
     * @param CreateCustomerRequest $request
     *
     * @return Response
     *
     *
     */
    public function store(CreateCustomerRequest $request)
    {
        return $this->createUser($request, null, true);


    }

    /**
     * Display the specified Customer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customer = $this->customerRepository->find($id);
        $skills = $this->getSkills();
        $addedSkills = $this->getAddedSkills($skills, $id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.show')
            ->with([
                'customer' => $customer,
                'skills' => $this->skillSelector($skills, $addedSkills)
            ]);
    }

    /**
     * Show the form for editing the specified Customer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.edit')->with([
            'customer' => $customer,
            'roles_list' => $this->rolesForSelector(),
            'status_list' => $this->userStatusForSelector(),
            'exp_list' => $this->experienceSelector(),
        ]);
    }

    /**
     * Update the specified Customer in storage.
     *
     * @param int $id
     * @param UpdateCustomerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerRequest $request)
    {

        return $this->createUser($request, $id, false);

    }

    /**
     * Remove the specified Customer from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        $this->customerRepository->delete($id);

        Flash::success('Customer deleted successfully.');

        return redirect(route('customers.index'));
    }


    /**
     * Show customer statistics page.
     *
     * @return Response
     */
    public function statistics()
    {
        $data = $this->customerRepository->getActivity('Logins', 'Logged in', 'line');

        return view('customers.statistics')->with(['data' => $data]);
    }

    /**
     * Show customer logs page.
     *
     * @return Response
     */
    public function logs()
    {
        $logs = LogActivity::all();

        return view('customers.logs')->with(['logs' => $logs]);
    }

    /*
     * Page for adding a skill to customer.
     */
    public function addSkill($id): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $skills = $this->getSkills();
        $addedSkills = $this->getAddedSkills($skills, $id);

        return view('customers.add_skill')
            ->with([
                'customer' => $this->customerRepository->find($id),
                'skills' => $this->skillSelector($skills, $addedSkills),
                'experiences' => $this->experienceSelector()
            ]);
    }

    /*
     * Form that adds a skill to customer.
     */
    public function saveAddedSkill($id, AddSkillsRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->createSkillsUsers($validated, $id);

            return redirect()
                ->route('customers.show', $id)
                ->with('success', __('messages.successAddSkill'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Form that removes a skill from customer.
     */
    public function removeSkill($id): \Illuminate\Http\RedirectResponse
    {
        try {
            $skillUser = $this->getSkillUser($id);
            $skillUser->delete();

            return back()->with('success', __('messages.successRemoveSkill'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
