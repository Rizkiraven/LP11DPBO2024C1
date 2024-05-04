<?php

include("KontrakView.php");
include("presenter/ProsesPasien.php");

class UpdateView implements KontrakView
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

        if (isset($_POST['submit']))
        {
            $id = $_POST['id_update'];
            $this->prosespasien->update($id, $_POST);
            header("Location: index.php");
            exit();
        }
        elseif (isset($_GET['id_update']))
        {
            $id = $_GET['id_update'];
            $result = $this->prosespasien->getDataPasienById($id);
            if ($result) 
            {
                $pasien = $result->fetch_assoc();
                $data = "
                <form action='update.php' method='post'>
                <input type='hidden' name='id_update' value='{$id}'>
                    <div class='form-group '>
                        <label for='nama'>Nama :</label>
                        <input class='form-control', type='text' id='nama' name='nama' value='{$pasien['nama']}'>
                    </div>
                    <div class='form-group '>
                        <label for='nik'>Nik :</label>
                        <input class='form-control', type='text' id='nik' name='nik' value='{$pasien['nik']}'>
                    </div>
                    <div class='form-group '>
                        <label for='email'>Email :</label>
                        <input class='form-control', type='email' id='email' name='email' value='{$pasien['email']}'>
                    </div>
                    <div class='form-group '>
                        <label for='tempat'>Tempat :</label>
                        <input class='form-control', type='text' id='tempat' name='tempat' value='{$pasien['tempat']}'>
                    </div>
                    <div class='form-group '>
                        <label for='tl'>Tanggal Lahir :</label>
                        <input class='form-control', type='date' id='tl' name='tl' value='{$pasien['tl']}'>
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
                        <input class='form-control', type='text' id='telp' name='telp' value='{$pasien['telp']}'>
                    </div>
                    <div class='form-group '>
                        <input type='submit' value='Submit' name='submit'>
                    </div>
                </form>";
            }
        }

        if (isset($_POST['submit']))
        {
            $id = $_POST['id_update'];
            $this->prosespasien->update($id, $_POST);
            header("Location: index.php");
            exit();
        }

        $judul = 'Update Data Pasien';

        // Membaca template skin.html
        $this->tpl = new Template("templates/skinForm.html");

        // Mengganti kode Data_Tabel dengan data yang sudah diproses
        $this->tpl->replace("DATA_CRUD", $data);
        $this->tpl->replace("TITLE_CRUD", $judul);

        // Menampilkan ke layar
        $this->tpl->write();
    }
}
