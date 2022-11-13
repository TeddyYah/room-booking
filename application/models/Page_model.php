<?php 

class Page_model extends CI_model
{
    public function getAllSlider()
    {
        return $this->db->get('page_slider')->result_array();
    }

    public function editSlider($id)
    {
        return $this->db->where('id', $id)
            ->get('page_slider')->row();
    }

    public function updateSlider($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('page_slider', $data);
    }
}
?>