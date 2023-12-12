<?php
	// Connection
	require_once('connection.php');

   // Set Default Time
    date_default_timezone_set('Asia/Jakarta'); 

    // BASE URL (Path sesuai server)
    $realpath    = str_replace('\\', '/', dirname(__FILE__));
    $projectName = substr_replace(str_replace($_SERVER['DOCUMENT_ROOT'], '', $realpath), "", -6);
    define("BASE_URL", "http://$_SERVER[HTTP_HOST]$projectName");


    // Check data column in Config DB - (name_apps, owner, maintenance, updated_at) 
    $runSql = mysqli_query($link, "SELECT * FROM config");
    $config = mysqli_fetch_assoc($runSql);
    function app($column, $updateValue = NULL){
        global $config;
        if ($updateValue) {

        } else {
            return $config[$column];
        }
    }


    // Get Random Name and Email (Fake or Dummy)
    // Source data (https://github.com/fzaninotto/Faker/blob/master/src/Faker/Provider/id_ID)
    function fake($type){
        $firstName = array(
            'Abyasa', 'Ade', 'Adhiarja', 'Adiarja', 'Adika', 'Adikara', 'Adinata',
            'Aditya', 'Agus', 'Ajiman', 'Ajimat', 'Ajimin', 'Ajiono', 'Akarsana',
            'Alambana', 'Among', 'Anggabaya', 'Anom', 'Argono', 'Aris', 'Arta',
            'Artanto', 'Artawan', 'Arsipatra', 'Asirwada', 'Asirwanda', 'Aslijan',
            'Asmadi', 'Asman', 'Asmianto', 'Asmuni', 'Aswani', 'Atma', 'Atmaja',
            'Bagas', 'Bagiya', 'Bagus', 'Bagya', 'Bahuraksa', 'Bahuwarna',
            'Bahuwirya', 'Bajragin', 'Bakda', 'Bakiadi', 'Bakianto', 'Bakidin',
            'Bakijan', 'Bakiman', 'Bakiono', 'Bakti', 'Baktiadi', 'Baktianto',
            'Baktiono', 'Bala', 'Balamantri', 'Balangga', 'Balapati', 'Balidin',
            'Balijan', 'Bambang', 'Banara', 'Banawa', 'Banawi', 'Bancar', 'Budi',
            'Cagak', 'Cager', 'Cahyadi', 'Cahyanto', 'Cahya', 'Cahyo', 'Cahyono',
            'Caket', 'Cakrabirawa', 'Cakrabuana', 'Cakrajiya', 'Cakrawala',
            'Cakrawangsa', 'Candra', 'Chandra', 'Candrakanta', 'Capa', 'Caraka',
            'Carub', 'Catur', 'Caturangga', 'Cawisadi', 'Cawisono', 'Cawuk',
            'Cayadi', 'Cecep', 'Cemani', 'Cemeti', 'Cemplunk', 'Cengkal', 'Cengkir',
            'Dacin', 'Dadap', 'Dadi', 'Dagel', 'Daliman', 'Dalimin', 'Daliono', 'Damar', 'Damu', 'Danang',
            'Ade', 'Agnes', 'Ajeng', 'Amalia', 'Anita', 'Ayu', 'Aisyah', 'Ana',
            'Ami', 'Ani', 'Azalea', 'Aurora', 'Alika', 'Anastasia', 'Amelia',
            'Almira', 'Bella', 'Betania', 'Belinda', 'Citra', 'Cindy', 'Chelsea',
            'Clara', 'Cornelia', 'Cinta', 'Cinthia', 'Ciaobella', 'Cici', 'Carla',
            'Calista', 'Devi', 'Dewi','Dian', 'Diah', 'Diana', 'Dina', 'Dinda',
            'Dalima', 'Eka', 'Eva', 'Endah', 'Elisa', 'Eli', 'Ella', 'Ellis',
            'Elma', 'Elvina', 'Fitria', 'Fitriani', 'Febi', 'Faizah', 'Farah',
            'Farhunnisa', 'Fathonah', 'Gabriella', 'Gasti', 'Gawati', 'Genta',
            'Ghaliyati', 'Gina', 'Gilda', 'Halima', 'Hesti', 'Hilda', 'Hafshah',
            'Hamima', 'Hana', 'Hani', 'Hasna'
        );

        $lastName = array(
            'Adriansyah', 'Ardianto', 'Anggriawan', 'Budiman', 'Budiyanto',
            'Damanik', 'Dongoran', 'Dabukke', 'Firmansyah', 'Firgantoro',
            'Gunarto', 'Gunawan', 'Hardiansyah', 'Habibi', 'Hakim', 'Halim',
            'Haryanto', 'Hidayat', 'Hidayanto', 'Hutagalung', 'Hutapea', 'Hutasoit',
            'Irawan', 'Iswahyudi', 'Kuswoyo', 'Januar', 'Jailani', 'Kurniawan',
            'Kusumo', 'Latupono', 'Lazuardi', 'Maheswara', 'Mahendra', 'Mustofa',
            'Mansur', 'Mandala', 'Megantara', 'Maulana', 'Maryadi', 'Mangunsong',
            'Manullang', 'Marpaung', 'Marbun', 'Narpati', 'Natsir', 'Nugroho',
            'Najmudin', 'Nashiruddin', 'Nainggolan', 'Nababan', 'Napitupulu',
            'Pangestu', 'Putra', 'Pranowo', 'Prabowo', 'Pratama', 'Prasetya',
            'Prasetyo', 'Pradana', 'Pradipta', 'Prakasa', 'Permadi', 'Prasasta',
            'Prayoga', 'Ramadan', 'Rajasa', 'Rajata', 'Saptono', 'Santoso',
            'Saputra', 'Saefullah', 'Setiawan', 'Suryono', 'Suwarno', 'Siregar',
            'Sihombing', 'Salahudin', 'Sihombing', 'Samosir', 'Saragih', 'Sihotang',
            'Simanjuntak', 'Sinaga', 'Simbolon', 'Sitompul', 'Sitorus', 'Sirait',
            'Siregar', 'Situmorang', 'Tampubolon', 'Thamrin', 'Tamba', 'Tarihoran',
            'Utama', 'Uwais', 'Wahyudin', 'Waluyo', 'Wibowo', 'Winarno', 'Wibisono',
            'Wijaya', 'Widodo', 'Wacana', 'Waskita', 'Wasita', 'Zulkarnain',
            'Agustina', 'Andriani', 'Anggraini', 'Aryani', 'Astuti',
            'Fujiati', 'Farida', 'Handayani', 'Hassanah', 'Hartati', 'Hasanah',
            'Haryanti', 'Hariyah', 'Hastuti', 'Halimah', 'Kusmawati', 'Kuswandari',
            'Laksmiwati', 'Laksita', 'Lestari', 'Lailasari', 'Mandasari',
            'Mardhiyah', 'Mayasari', 'Melani', 'Mulyani', 'Maryati', 'Nurdiyanti',
            'Novitasari', 'Nuraini', 'Nasyidah', 'Nasyiah', 'Namaga', 'Palastri',
            'Pudjiastuti', 'Puspasari', 'Puspita', 'Purwanti', 'Pratiwi',
            'Purnawati', 'Pertiwi', 'Permata', 'Prastuti', 'Padmasari', 'Rahmawati',
            'Rahayu', 'Riyanti', 'Rahimah', 'Suartini', 'Sudiati', 'Suryatmi',
            'Susanti', 'Safitri', 'Oktaviani', 'Utami', 'Usamah', 'Usada',
            'Uyainah', 'Yuniar', 'Yuliarti', 'Yulianti', 'Yolanda', 'Wahyuni',
            'Wijayanti', 'Widiastuti', 'Winarsih', 'Wulandari', 'Wastuti', 'Zulaika',
        );

        $emailDomain = array(
            'gmail.com', 'yahoo.com', 'gmail.co.id', 'yahoo.co.id',
        );

        $random_keys=array_rand($firstName,1);
        if ($type == 'name') {
            return $firstName[$random_keys].' '.$lastName[$random_keys];
        } else if($type == 'email'){
            return strtolower($firstName[$random_keys]).'@'.$emailDomain[mt_rand(0, count($emailDomain) - 1)];
        }
    }


    // Detail array with print
    function parr($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }


    // Date format Indonesia language
    function waktu($type = NULL){
        $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'];

        $bulan = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
        );

        if ($type == NULL) {
            return $hari[date('w')].', '.date('d').' '.$bulan[date('m')].' '.date('Y');
        } elseif ($type == 'day') {
            return $hari[date('w')];
        } elseif ($type == 'month') {
            return $bulan[date('m')];
        }
    }


    // Generate string random by Stephen Watkins (Stackoverflow)
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

