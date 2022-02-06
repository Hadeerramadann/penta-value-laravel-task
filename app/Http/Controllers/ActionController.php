<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\accounts;
use App\Models\projects;
use App\Models\jops;
use App\Models\tasks;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $accounts =  accounts::all();
       $projects =  projects::all();
       $jops =  jops::all();
       $tasks =  tasks::all();
        
       $data = array(
        'accounts' => $accounts, 
        'projects' => $projects,
        'jops' => $jops,

        ); 
        $all_data=DB::table('accounts')
        ->leftjoin('projects','accounts.id','=','projects.account_id')
        ->leftjoin('jops','projects.id','=','jops.project_id')
        ->leftjoin('tasks','jops.id','=','tasks.jop_id')
        ->select('accounts.name as account_name','projects.name as project_name','projects.price as project_price','jops.name as jop_name','jops.amount as jops_amount','tasks.name as task_name')
        ->get();
    
        $task_data=DB::table('tasks')
        ->join('jops','jops.id','=','tasks.jop_id')
        ->join('projects','projects.id','=','jops.project_id')
        ->select( 'tasks.name as task_name')
        ->where('projects.price','<',100)
        ->get();
    
// return $data;
        return view('welcome',compact('data','all_data','task_data'));
    }

    /**
     *  add account.
     *
     * @return \Illuminate\Http\Response
     */
    public function AddAcount(Request $request)
    {
        $data = $request->all();
        $AccountName=$data['name'];

        $account= new accounts();
        $account ->name=$AccountName;
        $account ->save();

        return redirect('/');



        
    }

    /**
     * add project
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AddProject(Request $request)
    {
        $data = $request->all();
        $ProjectName=$data['name'];
        $ProjectPrice=$data['price'];
        $AcountId=$data['account'];



        $project= new projects();
        $project ->name=$ProjectName;
        $project ->price=$ProjectPrice;
        $project ->account_id=$AcountId;
      

        $project ->save();

      return redirect('/');
    }

    /**
     * add jop
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AddJop(Request $request)
    {
        $data = $request->all();
        $JopName=$data['name'];
        $JopAmount=$data['amount'];
        $ProjectId=$data['project'];



        $jop= new jops();
        $jop ->name=$JopName;
        $jop ->amount=$JopAmount;
        $jop ->project_id=$ProjectId;
      

        $jop ->save();

      return redirect('/');
    }

    /**
     * add task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AddTask(Request $request)
    {
        $data = $request->all();
        $TaskName=$data['name'];
        $JopId=$data['jop'];



        $task= new tasks();
        $task ->name=$TaskName;
        $task ->jop_id=$JopId;
       
      

        $task ->save();

      return redirect('/');
    }

    
}
