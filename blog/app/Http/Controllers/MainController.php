<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

use App\Service;
use App\Slider;
use App\Social;
use App\Form;
use App\Animal;

class MainController extends Controller
{
	public function showController(){

		$service = Service::all();
		$slider = Slider::all();
		$social = Social::all();
		$form = Form::all();
		$animal = Animal::all();

    	return view('welcome', [
    		'service'=>$service, 
    		'slider'=>$slider, 
    		'social'=>$social,
    		'form'=>$form,
    		'animal'=>$animal
    	]);
    }

    public function postController(Request $request){
        $this->validate($request, [
            'name' => 'min:3',
            'email' => 'required|email',
            'subject' => 'min:3',
            'textarea' => 'min:5',

        ]);

        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'textarea' => $request->textarea,
            'optradio' => $request->optradio,
        ];

        Mail::send('email', $data, function($massege) use ($data){
            $massege->from($data['email']);
            $massege->to('tamar.mekhrishvili@geolab.edu.ge');
            $massege->subject($data['subject']);
        });

    }
    
}
