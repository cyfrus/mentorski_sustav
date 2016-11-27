<?php


class Register extends CI_Controller
{
	private $data;
	public function index()
	{	



		
		if(isset($_POST["register"]) && $_POST["register"]=="true")
			{
				if( $this->provjeriFormu()=="true")
					{
						$this->insert_data();
						$this->data["error"]="Registracija uspješna !!";
					}
			}
			else
			{
				$this->data["error"]="";
			}
	
		$this->load->view("template/header");
		$this->load->view("view_register",$this->data);
		$this->load->view("template/footer");
	}

	public function insert_data()
	{
		
		$this->load->model("podaci");
		$this->podaci->insert($_POST);
	}

	public function provjeriFormu()
	{

		

		$this->load->model("podaci");
		$svikorisnici = $this->podaci->dohvatisveKorisnike();
		$postoji = 0;

		
		
		foreach ($svikorisnici as $value) {

			if($value->email==$_POST["email"])
			{
				
				$postoji = 1;
				break;
			}
		}
		echo $postoji;
		if($_POST["password"]!=$_POST["password_re"])
		{
			$this->data["error"]="Passwordi se ne podudaraju!";
			return false;
		}else if($postoji===1)
		{	
			$this->data["error"]="Korisnik s tim emailom vec postoji!";
			return false;
		}
		
		return true;

	}
	


}