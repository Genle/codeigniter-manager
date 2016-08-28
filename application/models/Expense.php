<?php

/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 8/7/16
 * Time: 8:47 PM
 */
class Expense extends CI_Model
{
    private $expense_table = 'expense';
    private $product_table = 'product';
    private $user_table = 'user';

    public function __construct()
    {
        $this->load->library('session');
        //$this->output->enable_profiler(true);
    }

    /**
     * @param $exp the value of the field that we want
     * @param $field from the table
     * @return bool
     */
    public function getExpense($exp, $field)//to check up
    {

        if(!is_string($exp) OR !is_string($field) OR empty($exp) OR empty($field))
            return false;

        $tables = array('place'=>'expense', 'date'=>'product', 'price' => 'product', 'description'=>'product');
        $current_table = $tables[$field];
        $expense = $this->db->select('*')
            ->from("$this->product_table")
            ->join("$this->expense_table", "$this->product_table.idExpense = $this->expense_table.id")
            ->where("$this->expense_table.id = $this->session->userdata['logged_in']['id'] AND $current_table.$field = '$exp'")
            ->get()
            ->result();

        return $expense;

    }

    /**
     * get all expenses in database
     * @return array
     */

    public function getAllExpenses()
    {
        $places = $this->getAllPlaces();
        $dates = $this->getDifferentDate($places);


        if(empty($places) OR empty($dates) OR count($places) == 0 OR count($dates) == 0)
            return false;

        $expenses_array = array();

        foreach ($places as $place)
        {
            foreach ($dates as $date)
            {
                if(count($date) == 1 ){

                    $newDate = $date[0]->date;

                    $product = $this->db->select("description, price")
                        ->from($this->product_table)
                        ->where("$this->product_table.idExpense = '$place->id' AND  $this->product_table.date = '$newDate'  ")
                        ->get()
                        ->result();

                    if(is_array($product) && count($product) > 0)
                        array_push($expenses_array, array($place, $date, $product));//array{place, date, array_of_product}
                }
                else if(count($date) > 1)
                {

                    for($i =0 ; $i<count($date); $i++)
                    {
                        $newDate = $date[$i]->date;

                        $product = $this->db->select("description, price")
                            ->from($this->product_table)
                            ->where("$this->product_table.idExpense = '$place->id' AND  $this->product_table.date = '$newDate'  ")
                            ->get()
                            ->result();

                        if(is_array($product) && count($product) > 0)
                            array_push($expenses_array, array($place, $newDate, $product));//array{place, date, array_of_product}
                    }
                }


            }

        }


        if(!empty($expenses_array) && count($expenses_array) > 0)
            return $expenses_array;
        else
            return false;

    }

    /**
     * get all places..
     * @return mixed
     */

    public function getAllPlaces()
    {
        $places = $this->db->select('id,place')
            ->from($this->expense_table)
            ->order_by("$this->expense_table.id", 'DESC')
            ->get()
            ->result();

        return $places;

    }

    /**
     * Get the last expenses.
     * @param $number
     * @return bool
     */
    public function getLastExpenses($number)
    {
        if(!is_numeric($number) OR empty($number))
            return false;

        $places = $this->getPlaces($number); //get an array of array of places.
        $products = array();

        for ($i = 0; $i<count($places); $i++)
        {

            $id_place = $places[$i]->id;
            $product = $this->db->select('*')
            ->from($this->product_table)
            ->where("$id_place = $this->product_table.idExpense")
            ->order_by("$this->product_table.id", 'DESC')
            ->get()
            ->result();

            array_push($products, $product);
        }

        return $products;

    }


    /**
     * get places from expense table
     * @param $number
     * @return bool
     */
    public function getPlaces($number)
    {
        if(!is_numeric($number) OR empty($number))
            return false;

        $places = $this->db->select('id,place')
            ->from($this->expense_table)
            ->limit($number)
            ->order_by("$this->expense_table.id", 'DESC')
            ->get()
            ->result();


        return $places;
    }

    /**
     * add an expense
     * @param $place
     * @return bool
     */

    public function addPlaceExpense($place)
    {

        if( !is_string($place) OR empty($place) )
            return false;

        return  $this->db->set(array('place'=>$place,'idUser'=> $this->session->userdata['logged_in']['id']))
        ->insert($this->expense_table);

    }


    public function addNewExpense($description, $price,$id, $date)
    {


        if(!is_string($description) OR !is_numeric($price) OR !is_string($id)  OR empty($date) OR empty($id) OR empty($description) OR empty($price) )
            return false;

        $new_date = $this->validateDate($date);

        if($new_date == false)
            return false;


       return  $this->db->set(array('description'=> $description, 'price'=>$price, 'date'=>$new_date, 'idExpense'=> $id))
                ->insert($this->product_table) ;




    }

    /**
     * Check if place exist or not and by the same time get the id
     * @param $place
     * @return bool
     */
    public function checkPlace($place)
    {
        if(!is_string($place) OR empty($place))
            return false;


        $id = $this->db->select('id')
            ->from($this->expense_table)
            ->where("place = '$place'")
            ->get()
            ->result();
       if(!empty($id[0]->id))
           return $id[0]->id;
        else
            return false;

    }

    /**
     * Validate date and get it in the database format
     * @param $date
     * @return bool|string
     */
    public function validateDate($date)
    {

        $datePart = explode("-", $date);
        if(count($datePart) == 3 )
        {
            $year = date("y");
            if(intval($datePart[0]) > 0 && intval($datePart[0]) < 32 && intval($datePart[1] ) > 0 && intval($datePart[1] ) < 13 && intval($datePart[2]) > 0 && intval($datePart[2]) <= $year )
                return $datePart[2]."-".$datePart[1]."-".$datePart[0];
            else
                return false;
        }
        else
            return false;
    }

    /**
     * get different date linked to each place
     * @param $places
     */

    public function getDifferentDate($places)
    {
        $dates_of_places = array();
        if(is_array($places))
        {
            foreach ($places as $place)
            {
                $date = $this->db->select("date")
                    ->distinct()
                    ->from($this->product_table)
                    ->where("$this->product_table.idExpense = $place->id")
                    ->get()
                    ->result();
                array_push($dates_of_places,$date);

            }

        }
        if(is_array($dates_of_places))
            return $dates_of_places;
        else
            return false;
    }

    /**
     * build expenses array for home view
     * @param $places
     * @param $dates
     * @return bool
     */


    public function buildExpenseArray($number)
    {
        $places = $this->getPlaces($number);
        $dates = $this->getDifferentDate($places);


        if(empty($places) OR empty($dates) OR count($places) == 0 OR count($dates) == 0)
            return false;

        $expenses_array = array();

        foreach ($places as $place)
        {
            foreach ($dates as $date)
            {
                if(count($date) == 1 ){

                    $newDate = $date[0]->date;

                    $product = $this->db->select("description, price")
                        ->from($this->product_table)
                        ->where("$this->product_table.idExpense = '$place->id' AND  $this->product_table.date = '$newDate'  ")
                        ->get()
                        ->result();

                    if(is_array($product) && count($product) > 0)
                        array_push($expenses_array, array($place, $date, $product));//array{place, date, array_of_product}
                }
                else if(count($date) > 1)
                {

                    for($i =0 ; $i<count($date); $i++)
                    {
                        $newDate = $date[$i]->date;

                        $product = $this->db->select("description, price")
                            ->from($this->product_table)
                            ->where("$this->product_table.idExpense = '$place->id' AND  $this->product_table.date = '$newDate'  ")
                            ->get()
                            ->result();

                        if(is_array($product) && count($product) > 0)
                            array_push($expenses_array, array($place, $newDate, $product));//array{place, date, array_of_product}
                    }
                }


            }

        }


       if(!empty($expenses_array) && count($expenses_array) > 0)
           return $expenses_array;
        else
            return false;

    }




}