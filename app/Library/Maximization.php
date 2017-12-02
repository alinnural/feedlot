<?php 
namespace App\library;

use App\Library\SimplexMethod;
use Illuminate\Http\Request;

class Maximization extends SimplexMethod
{
    private $valueArray = array();
    private $num = array();
    private $total_number;

    public function index()
    {
        echo SimplexMethod::is_ok();
        return "Maximization extends SimplexMethod";

    }

    public function get_num()
    {
        return $this->num;
    }

    public function get_total_number()
    {
        return $this->total_number;
    }
    
    public function optimize(Request $request)
    {
        $flag=0;
        $minRow=0;
        //solves for the maximization problem
        //get the number of constraints from the hidden form input named numbers and put it into the array named num
        //$num[0]=num of variables and $num[1]=num of constraints
        $num = array();
        $i=0;
        $token=strtok($request->input('numbers'), ',');
        while($token)
        {
            $this->num[$i++]=$token;
            $token=strtok(',');
        }
        
        //$n+1 would be the total number of columns
        $this->total_number = $this->num[0]+$this->num[1];
        
        //get the values from the form and insert it into the array
        $this->insert_value($request);
        
        //add the slack variables to the matrix, the number of slack variables depends on the number of constraints
        $this->add_slack_variables($request);

        $cek = $this->valuesArray;
        
        //insert the values from the form input with the name answer into the last column of the matrix - this are the constants of the equation
        $this->insert_value_from_name_answer($request);
        
        return $this->valuesArray;
    }

    private function insert_value($request)
    {
        for($k=1; $k<=$this->num[1]+1; $k++)
        {
            for($j=1; $j<=$this->num[0]; $j++)
            {
                //first rows would have the coefficients of the constraints
                if($k!=$this->num[1]+1)
                    $this->valuesArray[$k-1][$j-1] = floatval($request->input('cons'.$k.'_'.$j.''));
                //last row would have the coefficients of the objective function
                else
                    $this->valuesArray[$k-1][$j-1] = floatval($request->input('var'.$j.''))*-1;
            }
        }
    }

    private function add_slack_variables($request)
    {
        for($i=1; $i<=$this->num[1]+1; $i++)
        {
            $k=0;
            for($j=$this->num[0]; $j<=$this->total_number; $j++)
            {
                if($k!=($i-1))
                    $this->valuesArray[$i-1][$j]=0;
                else if ($i==$this->num[1]+1)
                    $this->valuesArray[$i-1][$j]=1;
                else
                {
                    //if the inequality sign of the constraint is less than, the sign of the slack variable would be postive
                    if($request->input('sign'.$k.'')=='lessThan')
                        $this->valuesArray[$i-1][$j]=1;
                    //if the inequality sign of the constraint is greater than, the sign of the slack variable would be negative
                    else
                        $this->valuesArray[$i-1][$j]=-1;
                }
                $k++;
            }
        }
    }

    private function insert_value_from_name_answer($request)
    {
        for($i=1; $i<=$this->num[1]+1; $i++)
        {
            if($i!=$this->num[1]+1)
                $this->valuesArray[$i-1][$this->total_number+1]=floatval($request->input('answer'.$i.''));
            //the last column would have the value of zero since there is no constant in the objective function
            else
                $this->valuesArray[$i-1][$this->total_number+1]=0;
        }
    }

    private function print_dump($array)
    {
        echo "<pre>";
        print_r($array);
        die();
    }
}