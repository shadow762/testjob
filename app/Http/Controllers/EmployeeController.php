<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Sex;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('sex')->get();

        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getForm($id = null)
    {
        $employee = [];
        $sexes = Sex::pluck('name', 'id')->toArray();

        if($id) {
            $employee = Employee::find($id);
        }

        return view('employees.form', ['employee' => $employee, 'sexes' => $sexes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required',
            'name' => 'required',
            'bithday' => 'required',
            'sex_id' => 'required',
            'image' => 'file|max:200|mimes:jpeg,png',
        ]);

        $imageUrl = '';
        if($request->hasFile('image'))
            $imageUrl = ImageController::saveImage($request->file('image'));

        if($request->id) {
            $employee = Employee::find($request->id);

            $employee->surname = $request->surname;
            $employee->name = $request->name;
            $employee->lastname = $request->lastname;
            $employee->bithday = $request->bithday;
            $employee->sex_id = $request->sex_id;
            $imageUrl ? $employee->image = $imageUrl : '';

            $employee->save();
        }
        else {
            Employee::create([
                'surname' => $request->surname,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'bithday' => $request->bithday,
                'sex_id' => $request->sex_id,
                'image' => $imageUrl,
            ]);
        }
        return redirect()->route('default');
    }

    public function get(Request $request) {
        $employees = Employee::with('sex');

        if(count($request->search_sex) == 1) {
            $employees = $employees->where('sex_id', '=', $request->search_sex);
        }

        if($request->search_age_from) {
            $date = Carbon::now()->subYear((int)$request->search_age_from)->toDateString();
            $employees = $employees->where('bithday', '<=', $date);
        }
        if($request->search_age_to) {
            $date = Carbon::now()->subYear((int)$request->search_age_to + 1)->addDay()->toDateString();
            $employees = $employees->where('bithday', '>=', $date);
        }

        if($request->search_query) {
            $temp = explode(' ', $request->search_query);
            $employees->where(function($query) use ($temp) {
                foreach($temp as $item) {
                    //если число - проверяем возраст
                    if(is_numeric($item)) {
                        $date_from = Carbon::now()->subYear((int)$item + 1)->addDay();
                        $date_to = Carbon::now()->subYear((int)$item);
                        $query->whereBetween('bithday', [$date_from, $date_to]);
                    }
                    else
                        $query->orWhere('surname', '=', $item)->orWhere('name', '=', $item)->orWhere('lastname', '=', $item);
                }
            });
        }
        $employees = $employees->paginate(5);

        foreach($employees as $key=>$employee) {
            $employee->bithday = Carbon::now()->diffInYears(Carbon::parse($employee->bithday));
            $employee->image = asset($employee->image);
            $employee->edit_link = route('employee.form', ['id' => $employee->id]);
            $employee->delete_link = route('employee.delete', ['id' => $employee->id]);
        }

        $response = [
            'pagination' => [
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage()
            ],
            'data' => $employees
        ];

        return response()->json($response);

    }

    public function delete() {

    }
}
