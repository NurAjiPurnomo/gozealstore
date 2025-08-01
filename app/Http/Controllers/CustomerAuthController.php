<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Theme;
use Illuminate\Http\Request;

class CustomerAuthController extends Controller
{
    private $themeFolder;

    public function __construct()
    {
        $theme = Theme::where('status', 'active')->first();
        if ($theme) {
            $this->themeFolder = $theme->folder;
        } else {
            $this->themeFolder = 'theme.default';
        }
    }

    public function login()
    {
        return view($this->themeFolder.'.customer.login', [
            'title' => 'Login',
        ]);
    }

    public function register()
    {
        return view($this->themeFolder.'.customer.register', [
            'title' => 'Register',
        ]);
    }

    public function store_register(Request $request)
    {
        $validasi = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:customers,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()
                ->with('errorMessage', 'Validasi error, silahkan cek kembali data anda')
                ->withErrors($validasi)
                ->withInput();
        } else {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = \Hash::make($request->password);
            $customer->save();

            // jika berhasil tersimpan, maka redirect ke halaman login
            return redirect()->route('customer.login')
                ->with('successMessage', 'Registrasi Berhasil');
        }
    }

    public function store_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validasi = \Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()
                ->with('errorMessage', 'Validasi error, silahkan cek kembali data anda')
                ->withErrors($validasi)
                ->withInput();
        }

        $customer = Customer::where('email', $credentials['email'])->first();

        if ($customer && \Hash::check($credentials['password'], $customer->password)) {
            // Login
            \Auth::guard('customer')->login($customer);

            return redirect()->route('home')
                ->with('successMessage', 'Login berhasil');
        } else {
            return redirect()->back()
                ->with('errorMessage', 'Email atau password salah')
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        \Auth::guard('customer')->logout();

        return redirect()->route('customer.login')
            ->with('successMessage', 'Anda telah berhasil logout');
    }
}
