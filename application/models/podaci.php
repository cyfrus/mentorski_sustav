<?php


class Podaci extends CI_Model{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert($data)
	{

		$email = $data["email"];
		$uloga = "student";
		$status = $data["status"];
		$sifra = $this->kript($data["password"]);



		$sql = "INSERT INTO korisnici (email, password, role, status)
        VALUES (".$this->db->escape($email).", ".$this->db->escape($sifra).",".$this->db->escape($uloga).",".$this->db->escape($status).")";

		$this->db->query($sql);
	}

	public function kript($sifra)
	{
		return crypt($sifra,"1231124321");
	}


	public function dohvatisveKorisnike()
	{
		$query = $this->db->query("SELECT email FROM korisnici");
		return $query->result();
	}

	public function provjeriLogin($login_data)
	{
		$username= $login_data["username"];
		$password = $login_data["password"];
		$query = $this->db->query("SELECT email, password FROM korisnici WHERE email='$username'");
		$podaci_iz_baze = $query->result();

		if(empty($podaci_iz_baze[0]))
		{
				return false;
		}
		else{
		if($login_data["username"]===$podaci_iz_baze[0]->email && $this->password_verify($password,$podaci_iz_baze[0]->password))
		{
			return true;
		}
		else
		{
			return false;
		}
		}
	}
	public function password_verify($pass,$passDB)
	{
			return $passDB===crypt($pass,$passDB);

	}


	public function getPredmetiFromStudent()
	{
			$email = $this->session->userdata("username");

	}

	public function setSession($p)
	{

		$username = $p["username"];
		$query = $this->db->query("SELECT * FROM korisnici WHERE email='$username'");
		$rezultat = $query->result();
		if(!isset($this->session))
		{
		 $this->session->set_userdata("id",$rezultat[0]->id);
		 $this->session->set_userdata("email",$rezultat[0]->email);
		 $this->session->set_userdata("status",$rezultat[0]->status);
		 $this->session->set_userdata("role",$rezultat[0]->role);
		}
	}

	public function getLista($id_studenta)
	{


		$id = $id_studenta;

		$query = $this->db->query("SELECT email,status FROM korisnici WHERE id='$id' AND role='student'");
		$query3 = $this->db->query("SELECT * FROM upisi  INNER JOIN predmeti ON upisi.predmet_id=predmeti.id");
		$rezultat3 = $query3->result();
		$query4 = $this->db->query("SELECT * FROM predmeti");
		$rezultat4  = $query4->result();
		$rezultat = $query->result();


		 $lista;

		 $check = 0;
		foreach ($rezultat3 as $key => $value) {
		 	# code...
		 		if($value->student_id == $id)
		 		{
		 			$lista["upisani"][$key] = $value;
		 		}
		 }
		 foreach ($rezultat4 as $key4 => $value4) {
		 	# code...
		 				foreach ($rezultat3 as $key3 => $value3) {
		 					# code...
		 						if($value4->id == $value3->predmet_id && $id == $value3->student_id)
		 						{
		 							$check = 1;

		 						}
		 				}
		 				if($check == 0)
		 				{
		 				$lista["svi"][$key4] = $value4;
		 				$lista["svi"][$key4]->status="slobodan";
		 				}
		 				$check = 0;
		 }


		 	if(empty($rezultat))
		 	{
		 		$lista["warning"] = "Nepostoji student s tim id-em!";
		 	}else
		 	{
		 		$lista["student"] = $rezultat[0]->email;
		 		$lista["status"] = $rezultat[0]->status;
		 	}

			if(!empty($lista))
		 	return $lista;

}


	public function getStudenti()
	{

		$query = $this->db->query("SELECT email,id FROM korisnici WHERE role='student'");
		$rezultat = $query->result();
		return $rezultat;

	}

	public function dodaj_predmet_na_upisni_list($id_predmeta,$id_studenta)
	{

		$sql = "INSERT INTO upisi (student_id,predmet_id,status) VALUES ('$id_studenta','$id_predmeta','enrolled')";
		$this->db->query($sql);
	}

	public function izbrisi_predmet_sa_liste($id_predmeta,$id_studenta)
	{


		$sql = "DELETE FROM upisi WHERE student_id='$id_studenta' AND predmet_id='$id_predmeta'";
		$this->db->query($sql);
	}

	public function prosao_predmet($id_predmeta,$id_studenta)
	{

		$sql = "UPDATE upisi SET status='passed' WHERE student_id='$id_studenta' AND predmet_id='$id_predmeta'";
		$this->db->query($sql);
	}

	public function getPredmeti()
	{
		$sql = "SELECT id,ime FROM predmeti";
		$query = $this->db->query($sql);
		$rezultat =$query->result();
		return $rezultat;
	}
	public function dohvatiPredmet($id)
	{
		$sql = "SELECT * FROM predmeti WHERE id='$id'";
		$query = $this->db->query($sql);
		$rezultat = $query->result();
		return $rezultat;
	}

	public function updatePredmet($promjenjeni_podaci)
	{

		$id = $promjenjeni_podaci["promjeni_predmet_submit"];
		$ime = $promjenjeni_podaci["ime_input"];
		$kod =  $promjenjeni_podaci["kod_input"];
		$program =  $promjenjeni_podaci["program_input"];
		$bodovi =  $promjenjeni_podaci["bodovi_input"];
		$sem_red =  $promjenjeni_podaci["sem_red_input"];
		$sem_izv =  $promjenjeni_podaci["sem_izv_input"];
		$izborni =  $promjenjeni_podaci["izborni_input"];
		$sql = "UPDATE predmeti SET ime='$ime', kod='$kod', program='$program', bodovi='$bodovi', sem_redovni='$sem_red', sem_izvanredni='$sem_izv', izborni='$izborni' WHERE id='$id'";
		$query = $this->db->query($sql);
	}


	public function zbrojEctsa($id_studenta)
	{


		$sql = "SELECT predmet_id FROM upisi WHERE student_id='$id_studenta' AND status='enrolled'";
		$query = $this->db->query($sql);
		$rezultat = $query->result();

		$sql3 = "SELECT predmet_id FROM upisi WHERE student_id='$id_studenta' AND status='passed'";
		$query3 = $this->db->query($sql3);
		$rezultat3 = $query3->result();


			$zbroj = array();
			$zbroj["upisanih"] = 0;
			$zbroj["polozenih"] = 0;




		foreach ($rezultat as $key => $value) {
			# code...
			$sql2 = "SELECT bodovi FROM predmeti WHERE id='$value->predmet_id'";
			$query2  = $this->db->query($sql2);
			$rezultat2 = $query2->result();

			if(!empty($rezultat2))
			{
				$zbroj["upisanih"] = $zbroj["upisanih"] + $rezultat2[0]->bodovi;
			}
		}

		foreach ($rezultat3 as $key3 => $value3) {
			# code...

			$sql4 = "SELECT bodovi FROM predmeti WHERE id='$value3->predmet_id'";
			$query4  = $this->db->query($sql4);
			$rezultat4 = $query4->result();



			if(!empty($rezultat4))
			{
				$zbroj["polozenih"] = $zbroj["polozenih"] + $rezultat4[0]->bodovi;
			}
		}


		return $zbroj;
	}

	public function vrati_en($id,$id_studenta)
	{
		$sql = "UPDATE upisi SET status='enrolled' WHERE student_id='$id_studenta' AND predmet_id='$id'";
		$this->db->query($sql);
	}


}
