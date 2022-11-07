<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCookieRequest;
use App\Http\Requests\UpdateCookieRequest;
use Illuminate\Http\Request;
use App\Repositories\CookieRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;

class CookieController extends AppBaseController
{
    /** @var CookieRepository */
    private $cookieRepository;

    public function __construct(CookieRepository $cookieRepo)
    {
        $this->cookieRepository = $cookieRepo;
    }

    /**
     * Display a listing of the Cookies.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $cookies = $this->cookieRepository->all();

        return view('cookies.index')->with('cookies', $cookies);
    }

    /**
     * @return Response
     */
    public static function showCookieConsent()
    {
        $cookies = DB::table('cookies')->get();

        return $cookies;
    }

    /**
     * Show the form for creating a new Cookie
     *
     * @return Response
     */
    public function create()
    {
        return view('cookies.create');
    }

    /**
     * Store a newly created Cookie in storage.
     *
     * @param CreateCookieRequest $request
     * @return Response
     */
    public function store(CreateCookieRequest $request)
    {
        $input = $request->all();

        $fields = [
            'name' => Str::lower($input['name']),
            'description' => $input['description'],
            'isMandatory' => isset($input['isMandatory'])
        ];

        $this->cookieRepository->create($fields);

        Flash::success('Cookie saved successfully.');

        return redirect(route('cookies.index'));

    }

    /**
     * Display the specified Cookie
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $cookie = $this->cookieRepository->find($id);

        if (empty($cookie)) {
            Flash::error('Cookie not found');

            return redirect(route('cookies.index'));
        }

        return view('cookies.show')->with('cookie', $cookie);

    }

    /**
     * Show the form for editing the specified Cookie
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $cookie = $this->cookieRepository->find($id);

        if (empty($cookie)) {
            Flash::error('Cookie not found');

            return redirect(route('cookies.index'));
        }

        return view('cookies.edit')->with(['cookie' => $cookie]);
    }

    /**
     * Update specified Cookie in storage.
     *
     * @param int $id
     * @param UpdateCookieRequest $request
     * @return Response
     */
    public function update($id, UpdateCookieRequest $request)
    {
        $cookie = $this->cookieRepository->find($id);

        if (empty($cookie)) {
            Flash::error('Cookie not found');

            return redirect(route('cookies.index'));
        }

        $input = $request->all();
        $fields = [
            'name' => Str::lower($input['name']),
            'description' => $input['description'],
            'isMandatory' => isset($input['isMandatory'])
        ];

        $this->cookieRepository->update($fields, $id);

        Flash::success('Cookie updated successfully.');

        return redirect(route('cookies.index'));
    }

    /**
     * Remove specified Cookie from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cookie = $this->cookieRepository->find($id);

        if (empty($cookie)) {
            Flash::error('Cookie not found');

            return redirect(route('cookies.index'));
        }

        $this->cookieRepository->delete($id);

        Flash::success('Cookie deleted successfully.');

        return redirect(route('cookies.index'));
    }
}
