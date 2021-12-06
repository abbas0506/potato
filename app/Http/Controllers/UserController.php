<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (session('user')) {
            if (session('user')->userid == 'admin') {
                $products = Product::all();
                $clients = Client::all();
                $stores = Store::all();
                return view('admin.index', compact('products', 'clients', 'stores'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function signin(Request $request)
    {
        $request->validate([
            'userid' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('userid', $request->userid)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                //authenticated, save into session
                session([
                    'user' => $user,
                ]);
                if ($user->userid == 'admin') return redirect()->route('admin');
                else if ($user->userid == 'user') return redirect('user');
                else echo "some invalid user";
            } else {
                return redirect()->back()->with('error', "User not found");
            }
        } else {
            return redirect()->back()->with('error', "User not found");
        }
    }
    public function signout()
    {
        session()->flush('user');
        return redirect('/');
    }
}