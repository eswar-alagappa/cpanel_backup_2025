<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home_model extends CI_Model {

        public $title;
        public $content;
        public $date;
		public $alias;

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }

        public function insert_entry($table, $data)
        {
                //$this->title    = $_POST['title']; // please read the below note
                //$this->content  = $_POST['content'];
				//$this->alias  = $_POST['alias'];
                //$this->date     = time();

                $this->db->insert($table, $data);
				$lastId = $this->db->insert_id();
				return ((isset($lastId) && !empty($lastId)) ? $lastId : false);
        }
		
		public function delete_data($table, $id)
		{
			$this->db->where('id', $id);
			$this->db->delete($table);
			if ($this->db->affected_rows() > 0)
			{
			  return TRUE;
			}
			else
			{
			  return FALSE;
			}
		}
		
        public function update_entry($table, $data, $id)
        {

                $this->db->update($table, $data, array('id' => $id));
				if ($this->db->affected_rows() > 0)
				{
				  return TRUE;
				}
				else
				{
				  return FALSE;
				}
        }
		
		public function getPage($table, $type)
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('alias',$type);
			$this->db->where('status',1);
			$query = $this->db->get();

			if ( $query->num_rows() > 0 )
			{
				return  $query->row();//$query->result();
			}
		}
		
		public function select_data_bycondition($table, $field, $value)
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($field,$value);
			$query = $this->db->get();

			if ( $query->num_rows() > 0 )
			{
				return  $query->row();//$query->result();
			}
		}
		
		public function select_data_byid($table, $id)
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('id',$id);
			$query = $this->db->get();

			if ( $query->num_rows() > 0 )
			{
				return  $query->row();//$query->result();
			}
		}
		
		 public function select_data($table)
        {
			$this->db->select('*');
			 $this->db->from($table);
			 $this->db->order_by('id','desc');
			  $query = $this->db->get();

			if ( $query->num_rows() > 0 )
			{
				/* $array = array();
				foreach ($query->result() as $row)
			   {
				  echo $row->title;
				  echo $row->name;
				  echo $row->body;
			   } */
				return $query->result();
			}

		}

}
