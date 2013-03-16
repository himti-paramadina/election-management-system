<div class="row">
    <div class="span5">
        <h1>Registrasi Pemilih</h1>
        <p>Kamu akan mendaftar sebagai pemilih pada <strong><?php echo $election['Election']['name']; ?></strong></p>
        <?php echo $this->Form->create(null, array(
                    'url' => array('controller' => 'voters', 'action' => 'register', $election_identifier)
                )); 
        ?>
            <fieldset>
                <legend>Form Registrasi</legend>
                <?php echo $this->Form->input('name', array(
                    'label' => 'Nama Lengkap',
                    'placeholder' => 'Isikan nama lengkap kamu'
                )); ?>
                <?php echo $this->Form->input('email', array(
                    'label' => 'E-mail',
                    'placeholder' => 'Isikan e-mail kamu'
                )); ?>
                <?php echo $this->Form->input('phone_number', array(
                    'label' => 'No. Telp.',
                    'placeholder' => 'Isikan no. telepon kamu'
                )); ?>
                
                <br/>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </fieldset>
        <?php $this->Form->end(); ?>
    </div>
    <div class="span7">
        <!-- Registration Info -->
        <h2>Syarat Pemilih</h2>
        
        <p>Pemilih yang berhak mengikuti Pemilu HIMTI Paramadina adalah mahasiswa aktif Program Studi Teknik Informatika
        Universitas Paramadina. Setelah melakukan registrasi, Komisi Pemilihan Umum akan melakukan verifikasi terlebih dahulu
        sebelum pemilih mendapatkan hak suara.</p>
        
        <h2>Informasi</h2>
        
        <p>Setelah melakukan registrasi, maka kamu akan mendapatkan informasi secara berkala langsung dari
        Komisi Pemilihan Umum <?php echo $election['Election']['name']; ?>. Pastikan kamu mendapatkan e-mail informasi dari alamat
        <strong>kpu[at]himti.paramadina.ac.id</strong>. Jika kamu tidak mendapatkannya, coba cek kotak spam/junk email di
        inbox email kamu, karena terkadang e-mail tertentu secara tidak sengaja ter-filter.</p>
        
        <p>Isikan informasi disamping dengan lengkap. Jangan lupa, pelaksanaan <strong><?php echo $election['Election']['name']; ?></strong>
        akan dilaksanakan pada hari <strong>Kamis, 22 November 2012</strong>.</p>
    </div>
</div>