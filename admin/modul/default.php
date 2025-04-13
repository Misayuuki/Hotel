<?php session_start(); ?>
<div class="container mt-5">
    <div class="alert alert-warning text-center" role="alert">
        <h4 class="alert-heading">Selamat bekerja, <?= $_SESSION['username']; ?>!</h4>
        <p>Semoga harimu menyenangkan. Apa pun yang kamu kelola hari ini, semoga lancar dan berdampak baik!</p>
    </div>
</div>
