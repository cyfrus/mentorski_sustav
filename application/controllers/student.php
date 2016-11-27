<?php




class Student extends CI_Controller{

	public function index()
	{	

		$this->load->library('session');
		
		if (isset($_POST["vrati_enrolled"]) && $this->session->userdata('logiran')=="DA")
		{
			$this->load->model("podaci");
			$this->podaci->vrati_en($_POST["vrati_enrolled"],$this->session->userdata('id_studenta'));
		}
		if(isset($_POST["add_predmet"]))
		{
			$this->dodaj_predmet_na_upisni_list($_POST["add_predmet"]);
		}
		if(isset($_POST["remove_predmet"]))
		{
			$this->izbrisi_predmet_sa_liste($_POST["remove_predmet"]);
		}
		if(isset($_POST["prosao_predmet"]))
		{
			$this->prosao_predmet($_POST["prosao_predmet"]);
		}

		if($this->session->userdata('role')=="mentor" && $this->session->userdata('logiran')=="DA")
		{
			
		
			$this->dohvatiStudenta();
		
		}



		if($this->session->userdata("role")!="mentor")
		{
			
			$data["warning"] = "Samo mentorima dozvoljen pristup!";
			$this->load->view("template/header.php");
			$this->load->view("view_warning.php",$data);
			$this->load->view("template/footer.php");
			
		}



		if(isset($_POST["log_out"]))
		{
			$this->session->sess_destroy();
			$url = site_url("home");
			header('Location: '.$url);
		}
	}

	public function dohvatiStudenta()
	{
		$id_studenta = $_GET["id"];
		$this->session->set_userdata("id_studenta",$id_studenta);
		$this->load->model("podaci");
		$data = $this->podaci->getLista($this->session->userdata("id_studenta"));

		
		if(empty($data["student"]))
		{
			$data["warning"] = "STUDENT NEPOSTOJI!";
		}
		$this->load->model("podaci");
		$ects = $this->podaci->zbrojEctsa($this->session->userdata("id_studenta"));
		$data["polozenih"] = $ects["polozenih"];
		$data["upisanih"] = $ects["upisanih"];
		$this->load->view("template/header.php");
		$this->load->view("view_student.php",$data);
		$this->load->view("template/footer.php");
	}


	public function dodaj_predmet_na_upisni_list($id_predmeta)
	{

		$this->load->model("podaci");
		$this->podaci->dodaj_predmet_na_upisni_list($id_predmeta,$this->session->userdata("id_studenta"));
	}
	public function izbrisi_predmet_sa_liste($id_predmeta)
	{
		$this->load->model("podaci");
		$this->podaci->izbrisi_predmet_sa_liste($id_predmeta,$this->session->userdata("id_studenta"));
	}

	public function prosao_predmet($id)
	{
		 $this->load->model("podaci");
		$this->podaci->prosao_predmet($id,$this->session->userdata("id_studenta"));

	}

	
	
}