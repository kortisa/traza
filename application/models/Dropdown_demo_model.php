<?php
class dropdown_demo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_country()
    {
        $result = $this->db->get('program.ta_country')->result();;
        $id = array('0');
        $name = array('Select Country');
        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id, $result[$i]->code);
            array_push($name, $result[$i]->name);
        }
        return array_combine($id, $name);
    }
    
    function get_city($sid=NULL)
    {
        $result = $this->db->where('countrycode', $sid)->get('program.ta_city')->result();
        $id = array('0');
        $name = array('Select City');
        for ($i=0; $i<count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($name, $result[$i]->name);
        }
        return array_combine($id, $name);
    }

    function get_city_ubah($sid=NULL)
    {
        $result = $this->db->where('countrycode', $sid)->get('program.ta_city')->result();
        $id = array('0');
        $name = array('Select City');
        for ($i=0; $i<count($result); $i++)
        {
            array_push($id, $result[$i]->id);
            array_push($name, $result[$i]->name);
        }
        return array_combine($id, $name);
    }
}
?>