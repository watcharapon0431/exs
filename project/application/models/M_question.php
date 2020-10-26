<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Da_question.php");

class M_question extends Da_question
{
	function get_by_user_id()
	{
		$sql = "SELECT q_id, q_name, q_description, q_seq, q_status, q_ca_id, ca.ca_name as q_ca_name, 
				CASE
    				WHEN q_level = 1 THEN 'ง่ายมาก'
    				WHEN q_level = 2 THEN 'ง่าย'
    				WHEN q_level = 3 THEN 'ปานกลาง'
    				WHEN q_level = 4 THEN 'ยาก'
    				WHEN q_level = 5 THEN 'ยากมาก'
				END as q_level_name
				FROM `question` as q
                LEFT JOIN category as ca ON ca.ca_id = q.q_ca_id
				WHERE q_create_user_id=?";
		return $this->db->query($sql, array($this->q_create_user_id));
	}

	function count_question()
	{
		$sql = "SELECT count(q_id) as count_question
				FROM `question`
				WHERE q_create_user_id=?";
		return $this->db->query($sql, array($this->q_create_user_id));
	}

	function get_by_name()
	{
		$sql = "SELECT *
				FROM `question`
				WHERE q_name=?";
		return $this->db->query($sql, array($this->q_name));
	}

	function get_name_by_id()
	{
		$sql = "SELECT q_name
				FROM `question`
				WHERE q_id=?";
		return $this->db->query($sql, array($this->q_id));
	}
}
