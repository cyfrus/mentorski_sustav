<?php


class Home extends CI_Controller{


	public function index()
	{

		$this->load->library('session');



		if(isset($_POST["login"]) && $_POST["login"] == "true")
		{
			$this->validate_user();
			
		}

		if(isset($_POST["log_out"]) || $this->session->userdata("logiran")!="DA")
		{
			$this->session->sess_destroy();
			$this->loginView();
			
		}

		if(isset($_POST["promjeni_predmet"]) && $this->session->userdata('logiran')==="DA" &&  $this->session->userdata('role')=="mentor")
		{
			$this->dohvatiPredmet($_POST["promjeni_predmet"]);
		}
		else if(isset($_POST["predmeti"]) && $this->session->userdata('logiran')==="DA" &&  $this->session->userdata('role')=="mentor")
		{
			$this->getPredmeti();
		}
		else if(isset($_POST["studenti"]) && $this->session->userdata('logiran')==="DA" &&  $this->session->userdata('role')=="mentor")
		{
			$this->getStudenti();
		}else  if(isset($_POST["detalji_predmeta"]) && $this->session->userdata('logiran')=="DA")
		{
		 	$this->dohvatiPredmet($_POST["detalji_predmeta"]);
		}
		else if($this->session->userdata('logiran')==="DA" && $this->session->userdata('role')=="mentor")
		{
			
			$this->load->model("podaci");
			$this->load->view("template/header");
			$this->load->view("view_mentor.php");
			$this->load->view("template/footer");
		}

		if(isset($_POST["promjeni_predmet_submit"]) && $this->session->userdata('logiran')==="DA")
		{
			$this->load->model("podaci");
			$this->podaci->updatePredmet($_POST);

		}
			
		if(isset($_POST["add_predmet"]) && $this->session->userdata('logiran')=="DA")
		{
			$this->dodaj_predmet_na_upisni_list($_POST["add_predmet"]);
		}
		if(isset($_POST["remove_predmet"]) && $this->session->userdata('logiran')=="DA")
		{
			$this->izbrisi_predmet_sa_liste($_POST["remove_predmet"]);
		}
		if(isset($_POST["prosao_predmet"]) && $this->session->userdata('logiran')=="DA")
		{
			$this->prosao_predmet($_POST["prosao_predmet"]);
		}

		if(isset($_POST["vrati_enrolled"]) && $this->session->userdata('logiran')=="DA")
		{
			$this->load->model("podaci");
			$this->podaci->vrati_en($_POST["vrati_enrolled"],$this->session->userdata('id'));
		}


		if($this->session->userdata('role')=="student" && $this->session->userdata('logiran')=="DA")
		{	
			$this->dohvatiStudenta();
		}



		
}




	public function validate_user()
	{
			$this->load->model("podaci");
			if($this->podaci->provjeriLogin($_POST))
			{
				$this->session->set_userdata("logiran","DA");
				$this->podaci->setSession($_POST);
			}
			
	}


	public function loginView()
	{
			$this->load->view("template/header");
			$this->load->view("view_login");
			$this->load->view("template/footer");
	}



	public function loggedView($lista)
	{
			if(!empty($lista["upisani"]))
			{
				$data["lista"] = $lista["upisani"];
			}
			if(!empty($lista["svi"]))
			{
			$data["svi"] = $lista["svi"];	
			}
			if(!empty($lista["studenti"]))
			{
				$data["studenti"]= $lista["studenti"];
			}
			if(!empty($lista["predmeti"]))
			{
				$data["predmeti"]= $lista["predmeti"];
			}
			if(!empty($lista["predmet"]))
			{
				$data["predmet"]= $lista["predmet"];
			}

			$this->load->view("template/header");
			$this->load->view("view_mentor.php",$data);
			$this->load->view("template/footer");


	}


	public function getStudenti()
	{
		
		$this->load->model("podaci");
		$data["studenti"] = $this->podaci->getStudenti();
		$this->loggedView($data);
	}



	public function getPredmeti()
	{
		
		$this->load->model("podaci");
		$data["predmeti"] = $this->podaci->getPredmeti();
		$this->loggedView($data);
	}



	public function dohvatiPredmet($id)
	{
		$this->load->model("podaci");
		$data["predmet"] = $this->podaci->dohvatiPredmet($id);
		$this->loggedView($data);
	}

	public function dohvatiStudenta()
	{
		$id_studenta = $this->session->userdata("id");
		$this->load->model("podaci");
		$data = $this->podaci->getLista($id_studenta);

		
		if(empty($data["student"]))
		{
			$data["warning"] = "STUDENT NEPOSTOJI!";
		}
		$this->load->model("podaci");
		$ects = $this->podaci->zbrojEctsa($this->session->userdata("id"));
		$data["polozenih"] = $ects["polozenih"];
		$data["upisanih"] = $ects["upisanih"];
		$this->load->view("template/header.php");
		$this->load->view("view_student.php",$data);
		$this->load->view("template/footer.php");
	}

	public function dodaj_predmet_na_upisni_list($id_predmeta)
	{

		$this->load->model("podaci");
		$this->podaci->dodaj_predmet_na_upisni_list($id_predmeta,$this->session->userdata("id"));
	}
	public function izbrisi_predmet_sa_liste($id_predmeta)
	{
		$this->load->model("podaci");
		$this->podaci->izbrisi_predmet_sa_liste($id_predmeta,$this->session->userdata("id"));
	}

	public function prosao_predmet($id)
	{
		$this->load->model("podaci");
		$this->podaci->prosao_predmet($id,$this->session->userdata("id"));

	}
}