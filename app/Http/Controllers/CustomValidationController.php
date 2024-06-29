<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Rules\BirthYearRule;
   
class CustomValidationController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('forms');
    }
        
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'birth_year' => [
                    'required',
                    new BirthYearRule()
                ]
            ]);
        
        /*
            $validatedData['password'] = bcrypt($validatedData['password']);
            $user = User::create($validatedData);
        */
            
        return back()->with('success', 'User created successfully.');
    }
}
