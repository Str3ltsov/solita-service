<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\LogActivity;
use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Response;

class CustomerController extends AppBaseController
{
    /** @var CustomerRepository $customerRepository */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $customers = $this->customerRepository->all();
        return view('customers.index')
            ->with('customers', $customers);
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return Response
     */
    public function create()
    {
        return view('customers.create');
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
        $user->password = Hash::make($request->new_password);
        $user->street = $request->street;
        $user->house_flat = $request->house_flat;
        $user->post_index = $request->post_index;
        $user->city = $request->city;
        $user->phone_number = $request->phone_number;
        $user->save();

        Flash::success(__('messages.userupdated'));

        return redirect(route('customers.index'));

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

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.show')->with('customer', $customer);
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

        return view('customers.edit')->with('customer', $customer);
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

}
