<style>
    .notif-img {
        width: 50px;
        /* Atur lebar gambar sesuai kebutuhan */
        height: auto;
        /* Biarkan tinggi menyesuaikan secara otomatis */
        margin-right: 10px;
        /* Beri jarak antara gambar dan konten */
        border-radius: 5px;
        /* Opsional: Buat gambar dengan sudut membulat */
    }

    /* styles.css */
    .icon {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .icon::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: -100%;
        /* Di atas ikon */
        font-size: 12px;
        left: 180%;
        transform: translateX(-90%);
        background-color: #ff646d;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s, visibility 0.2s;
    }

    .icon:hover::after {
        opacity: 1;
        visibility: visible;
    }

    .tooltip {
        display: none;
        position: absolute;
        background-color: #333;
        color: #fff;
        padding: 5px;
        border-radius: 3px;
        font-size: 14px;
        white-space: nowrap;
    }


    .scrollbar-inner1 {
        height: 100%;
        overflow-y: auto;
        /* Enable vertical scroll; */
        padding: 10px;
        /* background: #f0f0f0; */
    }

    .sidebar .nav-item a {
        color: #c2c7d0;
        padding: 10px 15px;
        display: block;
        transition: all 0.3s;
    }

    .sidebar .nav-item a:hover {
        background-color: #495057;
        color: #000435;
    }

    .sidebar .nav-item .collapse .nav-item a {
        padding-left: 30px;
    }
    
    .notification {
        background-color: red;
        color: white;
        padding: 2px 5px;
        border-radius: 50%;
        font-size: 12px;
    }

    .notif-box {
        width: 300px;
        max-height: 400px;
        overflow-y: auto;
    }

    .notif-icon {
        width: 40px;
        height: 40px;
    }

    .notif-content {
        display: inline-block;
        margin-left: 10px;
    }

    .block {
        font-weight: bold;
    }

    .time {
        font-size: 12px;
    }

    .bg-danger {
        background-color: red;
    }

    .text-white {
        color: white;
    }
</style>