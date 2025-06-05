<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Card Stocking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    @yield('sidebar')

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<style>
    body {
        display: flex;
        margin: 0;
        position: relative;
        height: 100vh;
        background-color: black;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/images/psu.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        opacity: 0.5;
        z-index: -1;
    }

    .sidebar {
        width: 250px;
        height: 100svh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #202541;
        display: flex;
        flex-direction: column;
    }

    .sidebar h4 {
        color: white !important;
        margin: 0;
        padding: 15px;
    }

    .sidebar .nav {
        flex-direction: column;
    }

    .content {
        margin-left: 250px;
        padding: 20px;
        width: calc(100% - 250px);
    }

    .custom-nav {
        color: white;
    }

    /* 
    .custom-nav:hover {
        font-weight: bold;
        color: #0323d9;
    }

    .custom-nav:focus {
        background-color: #0323d9;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        margin-right: 20px;
        margin-left: 20px;
        outline: none;
    } */

    /* .custom-nav.active,
    .custom-nav:active {
        background-color: #e0e0e0;
        color: #e0e0e0 !important;
    } */
    input {
        text-align: center;
    }
</style>

</html>