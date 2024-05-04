<?php

include("KontrakView.php");
include("presenter/ProsesPasien.php");

class CreateView implements KontrakView
{
    private $prosespasien;
    private $tpl;

    function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

    function tampil()
    {
        $data = "";

        $data = "
        <form action='create.php' method='post'>
            <div class='form-group '>
                <label for='nama'>Nama :</label>
                <input class='form-control', type='text' id='nama' name='nama'>
            </div>
            <div class='form-group '>
                <label for='nik'>Nik :</label>
                <input class='form-control', type='text' id='nik' name='nik'>
            </div>
            <div class='form-group '>
                <label for='email'>Email :</label>
                <input class='form-control', type='email' id='email' name='email'>
            </div>
            <div class='form-group '>
                <label for='tempat'>Tempat :</label>
                <input class='form-control', type='text' id='tempat' name='tempat'>
            </div>
            <div class='form-group '>
                <label for='tl'>Tanggal Lahir :</label>
                <input class='form-control', type='date' id='tl' name='tl'>
            </div>
            <div class='form-group '>
                <label for='gender'>Gender :</label>
                <select class='form-control' id='gender' name='gender'>
                    <option value='Laki-laki'>Laki-laki</option>
                    <option value='Perempuan'>Perempuan</option>
                </select>
            </div>
            <div class='form-group '>
                <label for='telp'>No Telepon :</label>
                <input class='form-control', type='text' id='telp' name='telp'>
            </div>
            <div class='form-group '>
                <input type='submit' value='Submit' name='submit'>
            </div>
        </form>";

        if(isset($_POST['submit']))
        {
            $this->prosespasien->add($_POST);   
            header("location:index.php");
        }

        $judul = 'Tambah Data Pasien';

        // Membaca template skin.html
		$this->tpl = new Template("templates/skinForm.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_CRUD", $data);
        $this->tpl->replace("TITLE_CRUD", $judul);

		// Menampilkan ke layar
		$this->tpl->write();
    }
}