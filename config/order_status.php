<?php

return [
    'order_status_admin' => [
        '0' => [
            'status' => 'pending',
            'details' => 'Pembayaran diterima dan akan segera diproses'
        ],
        '1' => [
            'status' => 'Sedang diproses',
            'details' => 'Pesanan sedang diproses'
        ],
        '2' => [
            'status' =>'Dropped Off',
            'details' => 'Pesanan telah diantar ke point pick up dan akan dikirim'
        ],
        3 => [
            'status' => 'Terkirim',
            'details' => 'Pesanan telah sampai ke alamat tujuan'
        ],
        '4' => [
            'status' => 'Selesai',
            'details' => 'Transaksi Berhasil'
        ],
        5 => [
            'status' => 'Dibatalkan',
            'details' => 'Pesanan telah dibatalkan'
        ]
    ],

    'order_status_vendor' => [
        '0' => [
            'status' => 'pending',
            'details' => 'Pembayaran diterima dan akan segera diproses'
        ],
        '1' => [
            'status' => 'Sedang diproses',
            'details' => 'Pesanan sedang diproses'
        ],
        '2' => [
            'status' =>'Dropped Off',
            'details' => 'Pesanan telah diantar ke point pick up dan akan dikirim'
        ],
        3 => [
            'status' => 'Terkirim',
            'details' => 'Pesanan telah sampai ke alamat tujuan'
        ],
        '4' => [
            'status' => 'Selesai',
            'details' => 'Transaksi Berhasil'
        ],
        5 => [
            'status' => 'Dibatalkan',
            'details' => 'Pesanan telah dibatalkan'
        ]
    ]
];
