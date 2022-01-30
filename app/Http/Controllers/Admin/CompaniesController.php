<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Mail\HelloEmail;
use Illuminate\Support\Facades\Mail;
use Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[
            'title'=>'Company'
        ];

        $company = Companies::orderBy('created_at', 'desc')->get();
        return view('admin.companies.index', compact('company'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[
            'title'=>'Company'
        ];
        return view('admin.companies.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'image.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);  
        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/logo_images' ;
           // $file->move($destinationPath,$fileName);
            $file->storeAs('public/logo_images/',$fileName);
        }else{
            $fileName = '';
        }
          // dd($request->all());
            Companies::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $fileName,
            'website' => $request->website,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        $reveiverEmailAddress = "ritujaryal6@gmail.com";
        Mail::to($reveiverEmailAddress)->send(new HelloEmail);
       // if (Mail::failures() != 0) {
          //  return "Email has been sent successfully.";
       // }
        return redirect()->route('companies.index')->with('success', 'Company added Succesfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $company)
    {
       // return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $company)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            //'image' => 'image|mimes:jpeg,png,jpg|max:2048'
            'image.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);
        $company_info = Companies::where('id', $company->id)->first();

        if ($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = md5(time()).'.'.$extension;
           // $file->move(public_path().'\logo_images',$fileName);
            $file->storeAs('public/logo_images/',$fileName);

        } else {
            $fileName=$company_info->logo;
        }
        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $fileName,
            'website' => $request->website,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $company,Request $request)
    {
        Employee::where('company_id',$company->id)->delete(); 
        $company->delete();   
        return redirect()->route('companies.index')->with('success', 'Company Deleted Succesfully');
    }
}
