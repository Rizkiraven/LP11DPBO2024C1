<?php

include("KontrakView.php");
include("presenter/ProsesPasien.php");

class DeleteView implements KontrakView
{
    private $prosespasien;

    function __construct()
    {
        //konstruktor
        $this->prosespasien = new ProsesPasien();
    }

    function tampil()
    {
        if (!empty($_GET['id_hapus']))
        {
            $id = $_GET['id_hapus'];
            $this->prosespasien->delete($id);
            header("location:index.php");
        }
    }
}
