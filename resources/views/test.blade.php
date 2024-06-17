<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Example</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="sidebar">
        <a href="#dashboard">Dashboard</a>
        <a href="#pangan">Pangan</a>
        <a href="#ternak">Ternak</a>
        <a href="#profile">Profile</a>
    </div>

    <div class="content">
        <button id="openModalBtn">Tambahkan Pangan</button>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambahkan Pangan</h2>
            <form>
                <label for="jumlahPangan">Jumlah pangan</label>
                <input type="text" id="jumlahPangan" name="jumlahPangan" placeholder="60kg">
                <button type="submit">Tambahkan Pangan</button>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
